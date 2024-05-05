<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:landlord'); // Ensure the correct guard is used for this controller
    }

    /**
     * Show the form for editing the logged-in landlord's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $landlord = Auth::guard('landlord')->user(); // Fetch the currently authenticated landlord
        return view('landlord.profile', compact('landlord'));
    }

    /**
     * Handle the uploading of the profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field specified.']);
    }

    // Change Password
    public function showChangePasswordForm() {
        $landlord = Auth::guard('landlord')->user();
        // Return the view for changing password
        return view('landlord.change-password', compact('landlord'));
    }
    
    public function changePassword(Request $request) {
        $landlord = Auth::guard('landlord')->user();
        
        // Define validation rules
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:5|confirmed', // Password confirmation must match
        ];
        
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            // If validation fails, return with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Check if the old password matches the current one
        if (!Hash::check($request->input('old_password'), $landlord->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect'])->withInput();
        }
    
        // If all validations pass, update the password
        $landlord->password = Hash::make($request->input('new_password'));
        $landlord->save();
    
        session()->flash('success', 'Password changed successfully.');
    
        return redirect()->route('profile.show'); // Redirect to a safe location after changing password
    }

}
