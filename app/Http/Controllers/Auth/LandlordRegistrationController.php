<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LandlordRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('sign-up-landlord');
    }

    public function register(Request $request)
    {
        $request->validate([
            'landlord_name' => 'required|string|max:255|unique:landlords',
            'email' => 'required|string|email|max:255|unique:landlords',
            'password' => 'required|string|min:5|confirmed',
            'contact_info' => 'required|string|max:255',
        ]);

        Landlord::create([
            'landlord_name' => $request->landlord_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('login-landlord')->with('success', 'Registration successful. Please log in.');
    }
}
