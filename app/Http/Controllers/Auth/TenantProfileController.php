<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TenantProfileController extends Controller
{
    public function __construct()
    {
        // Ensure this controller uses the 'tenant' authentication guard
        $this->middleware('auth:tenants');
    }

    /**
     * Show the form for viewing the logged-in tenant's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $tenant = Auth::guard('tenants')->user(); // Fetch the currently authenticated tenant
        return view('tenant.profile', compact('tenant'));
    }

    /**
     * Handle the uploading of the profile picture for the tenant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('profile_picture')) {
            $filename = $request->profile_picture->store('tenant_profile_pictures', 'public');
            $tenant = Auth::guard('tenants')->user();
            $tenant->profile_picture = $filename;
            $tenant->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        }

        return redirect()->back()->with('error', 'There was an error uploading the image.');
    }

    /**
     * Update a specific field for the logged-in tenant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateField(Request $request)
    {
        $tenant = Auth::guard('tenants')->user();
        $field = $request->field;
        $value = $request->value;

        if (in_array($field, ['tenant_name', 'email', 'contact_info'])) { // Ensure the field is allowed to be updated
            $tenant->$field = $value;
            $tenant->save();
            return redirect()->route('tenant.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('tenant.profile')->with('error', 'Invalid field specified.');
    }

    // Change Password
    public function showChangePasswordForm()
    {
        $tenant = Auth::guard('tenants')->user();
        // Return the view for changing password
        return view('tenant.change-password', compact('tenant'));
    }

    public function changePassword(Request $request)
    {
        $tenant = Auth::guard('tenants')->user(); // Ensure the correct guard is used

        // Define validation rules
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:5|confirmed', // The new password and confirmation must match
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // If validation fails, return with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the old password matches the current one
        if (!Hash::check($request->input('old_password'), $tenant->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect'])->withInput();
        }

        // If validation passes, update the password
        $tenant->password = Hash::make($request->input('new_password'));
        $tenant->save();

        session()->flash('success', 'Password changed successfully.');

        return redirect()->route('tenant.profile'); // Redirect to a safe location after changing the password
    }


    public function removeProfilePicture(Request $request)
    {
        $tenant = Auth::guard('tenants')->user();

        if ($tenant->profile_picture) {
            Storage::delete('public/' . $tenant->profile_picture);
            $tenant->profile_picture = 'default/Default-icon.png';
            $tenant->save();
        }

        return redirect()->back()->with('success', 'Profile picture removed.');
    }

}
