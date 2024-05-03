<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
            return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field specified.']);
    }


}
