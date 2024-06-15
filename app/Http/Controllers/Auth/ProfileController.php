<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:landlord'); // Ensure the correct guard is used for this controller
    }

    public function show()
    {
        $landlord = Auth::guard('landlord')->user(); // Fetch the currently authenticated landlord
        return view('landlord.profile', compact('landlord'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image', // 2MB Max
        ]);

        if ($request->hasFile('profile_picture')) {
            $filename = $request->profile_picture->store('profile_pictures', 'public');
            $landlord = Auth::guard('landlord')->user(); // Ensure to use the same guard
            $landlord->profile_picture = $filename;
            $landlord->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        }

        return redirect()->back()->with('error', 'There was an error uploading the image.');
    }

    public function updateField(Request $request)
    {
        \Log::info('Updating field: ' . $request->field . ' with value: ' . $request->value); // Laravel logging

        $landlord = Auth::guard('landlord')->user();
        $field = $request->field;
        $value = $request->value;

        if (isset($landlord->{$field})) {
            $landlord->{$field} = $value;
            $landlord->save();
            return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('profile.show')->with('error', 'Invalid field specified.');
    }


    // Change Password
    public function showChangePasswordForm()
    {
        $landlord = Auth::guard('landlord')->user();
        return view('landlord.change-password', compact('landlord'));
    }

    public function changePassword(Request $request)
    {
        $landlord = Auth::guard('landlord')->user();

        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:5|confirmed', // Password confirmation must match
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->input('old_password'), $landlord->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect'])->withInput();
        }

        $landlord->password = Hash::make($request->input('new_password'));
        $landlord->save();

        session()->flash('success', 'Password changed successfully.');

        return redirect()->route('profile.show');
    }

    public function removeProfilePicture(Request $request)
    {
        // Retrieve the authenticated user
        $landlord = Auth::guard('landlord')->user();

        // Check if the user has a profile picture
        if ($landlord->profile_picture) {
            // Delete the profile picture from storage
            Storage::delete('public/' . $landlord->profile_picture);

            // Remove the profile picture from the database
            $landlord->profile_picture = 'default/Default-icon.png';
            $landlord->save();
        }

        return redirect()->back()->with('success', 'Profile picture removed.');
    }

}
