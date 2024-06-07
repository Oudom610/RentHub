<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tenant;
use App\Models\Lease;
use App\Models\RentPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

        return redirect('/tenant/show')->with('success', 'Tenant registered successfully!');
    }

    // Show all
    public function showAllTenant() {
        // Get the current landlord using the Auth facade or other authentication mechanism
        $landlord = Auth::guard('landlord')->user(); // Adjust as needed based on your setup
        // $landlord = Landlord::first();
        if ($landlord) {
            // Fetch tenants where landlord_id matches the current landlord's ID
            $tenants = Tenant::where('landlord_id', $landlord->id) // Get tenants of the current landlord
                             ->latest() // Optional: sort by latest
                             ->paginate(10); // Paginate with 10 items per page

            // Pass data to the view
            return view('landlord.show-tenant', [
                'tenants' => $tenants,
                'landlord' => $landlord,
            ]);
        } else {
            // Handle case where the landlord is not found or not logged in
            Log::error('Landlord not found or not logged in');
            return redirect()->back()->withErrors(['message' => 'Landlord not found']);

        }
    }

    // Destroy
    public function destroy($tenant_id) {
        $landlord = Auth::guard('landlord')->user();
    
        if ($landlord) {
            // Find the tenant by ID and check if they belong to the current landlord
            $tenant = Tenant::where('landlord_id', $landlord->id)
                            ->where('tenant_id', $tenant_id) // Adjust the key to match your model
                            ->first();
    
            if ($tenant) {
                $tenant->delete();
                session()->flash('success', 'Tenant deleted successfully.');
                return redirect()->route('tenant.show'); // Redirect back to the list of tenants
            } else {
                // If the tenant doesn't belong to the landlord or doesn't exist
                session()->flash('error', 'Tenant not found or unauthorized.');
                return redirect()->back();
            }
        } else {
            Log::error('Landlord not found or not logged in');
            return redirect()->route('landlord.dashboard')->withErrors(['message' => 'Please log in as a landlord to delete tenants']);
        }
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
            Log::debug('Tenant login successful', ['user_id' => $user->id, 'email' => $user->email]);
            return redirect()->intended('tenant/dashboard');

        } else {
            Log::debug('Tenant login failed', ['credentials' => $credentials]);
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

    // Fetch the most recent lease
    $currentLease = Lease::where('tenant_id', $tenant->tenant_id)->latest('start_date')->first();

    // Fetch upcoming lease expirations within the next month
    $upcomingLeaseExpiration = null;
    if ($currentLease && $currentLease->end_date <= Carbon::now()->addMonth()) {
        $upcomingLeaseExpiration = $currentLease;
    }

    // Fetch pending rent payments
    $pendingRentPayments = RentPayment::where('tenant_id', $tenant->tenant_id)
        ->where('status', 'pending')
        ->whereNull('proof_of_payment')
        ->get();

    // Fetch declined rent payments
    $declinedRentPayments = RentPayment::where('tenant_id', $tenant->tenant_id)->where('status', 'declined')->get();

    return view('tenant.home-dashboard', compact('tenant', 'currentLease', 'pendingRentPayments', 'declinedRentPayments', 'upcomingLeaseExpiration'));
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