<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    
    public function create()
    {
        $landlord = Auth::guard('landlord')->user();
        $tenants = Tenant::where('landlord_id', $landlord->id)->get();
        return view('landlord.create-lease', compact('landlord', 'tenants'));
    }

    public function store(Request $request)
    {
        $landlord = Auth::guard('landlord')->user();

        $request->validate([
            'tenant_id' => 'required|exists:tenants,tenant_id',
            'room_number' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'lease_agreement' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Check if the tenant already has an active lease
        $existingLease = Lease::where('tenant_id', $request->tenant_id)
            ->where('end_date', '>', now())
            ->first();

        if ($existingLease) {
            return redirect()->back()->withErrors(['tenant_id' => 'This tenant already has an active lease.']);
        }

        // Check if the room number is already taken by the landlord
        $existingRoom = Lease::where('landlord_id', $landlord->id)
            ->where('room_number', $request->room_number)
            ->where('end_date', '>', now())
            ->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['room_number' => 'This room number is already assigned to another tenant.']);
        }

        $leaseAgreementPath = $request->file('lease_agreement')->store('lease_agreements', 'public');

        Lease::create([
            'landlord_id' => $landlord->id, // Use the authenticated landlord's ID
            'tenant_id' => $request->tenant_id,
            'room_number' => $request->room_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'lease_agreement' => $leaseAgreementPath,
        ]);

        return redirect()->route('leases.create')->with('success', 'Lease created successfully.');
    }

}
