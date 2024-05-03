<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
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

        return redirect('/landlord/dashboard')->with('success', 'Tenant registered successfully!');
    }

    public function showLoginForm()
    {
        return view('tenant-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('tenants')->attempt($credentials)) {
            $user = Auth::guard('tenants')->user();
            \Log::debug('Tenant login successful', ['user_id' => $user->id, 'email' => $user->email]);
            return redirect()->intended('tenant/dashboard');

        } else {
            \Log::debug('Tenant login failed', ['credentials' => $credentials]);
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }



    //middleware
    // public function dashboard(Request $request)
    // {
    //     $tenant = Auth::guard('tenants')->user();
    //     // Now you can use the $tenant variable in your view or perform any necessary operations
    //     return view('tenant.home-dashboard', compact('tenant'));
    // }

    public function dashboard()
    {
        $tenant = Auth::guard('tenants')->user();
        if (!$tenant) {
            return redirect('login-tenant')->with('error', 'Please log in to continue.');
        }
        return view('tenant.home-dashboard', compact('tenant'));
    }



    public function logout()
    {
        Auth::guard('tenants')->logout();

        // Optionally, you can invalidate the user session to regenerate the session ID
        request()->session()->invalidate();

        // Optionally, regenerate a new session ID for added security
        request()->session()->regenerateToken();

        return redirect('/'); // Redirect to the homepage or login page
    }

}


// if (Auth::guard('tenants')->attempt($credentials)) {
//     // return redirect()->intended('/tenant/dashboard');
//     return redirect()->intended(route('tenant.dashboard'));
// }