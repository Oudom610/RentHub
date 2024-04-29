<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function showRegistrationForm()
    {
        $landlord = Auth::guard('landlord')->user();
        return view('landlord.register-tenant', compact('landlord'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'tenant_name' => 'required|string|max:50|unique:tenants',
            'email' => 'required|string|email|max:50|unique:tenants',
            'contact_info' => 'required|string|max:50',
            'password' => 'required|string|min:5'
        ]);

        $tenant = new Tenant([
            'landlord_id' => Auth::guard('landlord')->id(),
            'tenant_name' => $request->tenant_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_info' => $request->contact_info,
            'profile_picture' => 'default-profile-picture.jpg' // Assuming a default picture
        ]);

        $tenant->save();

        return redirect('/dashboard')->with('success', 'Tenant registered successfully!');
    }
}
