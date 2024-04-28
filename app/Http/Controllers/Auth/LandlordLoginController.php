<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('landlord-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('landlord')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('landlord.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // New method to handle the dashboard rendering
    public function dashboard()
    {
        if (Auth::guard('landlord')->check()) {
            $landlord = Auth::guard('landlord')->user();
            return view('dashboard.home-dashboard', compact('landlord'));
        } else {
            // If not authenticated, redirect to landlord login
            return redirect()->route('login-landlord');
        }
    }

    public function logout()
    {
        Auth::guard('landlord')->logout();

        // Optionally, you can invalidate the user session to regenerate the session ID
        request()->session()->invalidate();

        // Optionally, regenerate a new session ID for added security
        request()->session()->regenerateToken();

        return redirect('/'); // Redirect to the homepage or login page
    }
}
