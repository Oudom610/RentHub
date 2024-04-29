<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TenantLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('tenant-login'); // Ensure this view exists
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('tenant')->attempt($credentials, true)) {
            // Authentication passed...
            return redirect()->route('tenant.dashboard');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);

    }

    public function dashboard()
    {
        if (Auth::guard('tenant')->check()) {
            $tenant = Auth::guard('tenant')->user();
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
