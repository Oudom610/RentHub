<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class TenantLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('tenant-login'); // Ensure this view exists
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::guard('tenant')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // return redirect()->intended(route('tenant.dashboard'));
            return redirect()->route('tenant.dashboard');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);

        //return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput($request->only('email'));

        // $credentials = $request->only('email', 'password');

        // if (Auth::guard('tenant')->attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect()->intended(route('tenant.dashboard'));
        // }

        // return redirect()->back()->withInput($request->only('email'))->withErrors([
        //     'email' => 'These credentials do not match our records.',
        // ]);
    }

    public function dashboard()
    {
        if (Auth::guard('tenant')->check()) {
            $tenant = Auth::guard('tenant')->user();
            // return view('landlord.home-dashboard', compact('landlord'));
            return view('tenant.home-dashboard', ['tenant' => $tenant]);
        } else {
            // If not authenticated, redirect to landlord login
            return redirect()->route('login-tenant');
        }
    }

    public function logout()
    {
        Auth::guard('tenant')->logout();
        // Optionally, you can invalidate the user session to regenerate the session ID
        request()->session()->invalidate();

        // Optionally, regenerate a new session ID for added security
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
