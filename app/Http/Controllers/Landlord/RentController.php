<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\RentPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function index()
    {
        // Fetch all rent payments with related lease and tenant information
        $rentPayments = RentPayment::with('lease', 'tenant')->get();
        $landlord = Auth::guard('landlord')->user();
        $tenants = Tenant::where('landlord_id', $landlord->id)->get();

        return view('landlord.rent-show', compact('rentPayments', 'landlord', 'tenants'));
    }

    public function create()
    {
        $landlord = Auth::guard('landlord')->user();

        // Fetch tenants with active leases for the landlord
        $tenantsWithActiveLeases = Tenant::whereHas('leases', function ($query) use ($landlord) {
            $query->where('landlord_id', $landlord->id)
                ->where('end_date', '>=', now());
        })
        ->with(['leases' => function ($query) use ($landlord) {
            $query->where('landlord_id', $landlord->id)
                ->where('end_date', '>=', now());
        }])
        ->get();

        return view('landlord.rent-create', compact('tenantsWithActiveLeases', 'landlord'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'tenant_name' => 'required|exists:tenants,tenant_name',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'proof_of_payment' => 'nullable|string',
            'status' => 'nullable|in:pending,approved,declined',
        ]);

        // Retrieve the authenticated landlord
        $landlord = Auth::guard('landlord')->user();

        // Retrieve the tenant ID based on the selected tenant name
        $tenantName = $request->input('tenant_name');
        $tenant = Tenant::where('landlord_id', $landlord->id)
            ->where('tenant_name', $tenantName)
            ->firstOrFail();
        $tenantId = $tenant->tenant_id; // Use 'tenant_id' instead of 'id'

        // Retrieve the active lease ID for the tenant
        $activeLease = $tenant->leases()
            ->where('end_date', '>=', now()->toDateString())
            ->latest('start_date')
            ->first();

        if (!$activeLease) {
            // Handle the case when there is no active lease for the selected tenant
            return redirect()->back()->withErrors(['error' => 'Active lease not found for the selected tenant.']);
        }

        // Create the rent payment only if an active lease is found
        $rentPayment = RentPayment::create([
            'lease_id' => $activeLease->lease_id, // Use 'lease_id' instead of 'id'
            'tenant_id' => $tenantId,
            'payment_date' => $request->payment_date,
            'amount' => $request->amount,
            'proof_of_payment' => $request->proof_of_payment,
            'status' => $request->status,
        ]);

        if (!$rentPayment) {
            // Handle the case when rent payment creation fails
            return redirect()->back()->withErrors(['error' => 'Failed to create rent payment.']);
        }

        return redirect()->route('rent.create')->with('success', 'Rent payment added successfully.');
    }

    public function updateStatus(Request $request, RentPayment $rentPayment)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:pending,approved,declined',
        ]);

        // Update the status
        $rentPayment->status = $request->status;
        $rentPayment->save();

        return redirect()->route('rent.index')->with('success', 'Rent payment status updated successfully.');
    }

    public function destroy(RentPayment $rentPayment)
    {
        $rentPayment->delete();

        return redirect()->route('rent.index')->with('success', 'Rent payment deleted successfully.');
    }



}
