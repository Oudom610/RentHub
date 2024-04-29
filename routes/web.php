<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Auth\LandlordLoginController;
use App\Http\Controllers\Auth\LandlordRegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Landlord Signup and Login
Route::get('/signup', [LandlordRegistrationController::class, 'showRegistrationForm'])->name('register.landlord');
Route::post('/signup', [LandlordRegistrationController::class, 'register']);
Route::get('/login-landlord', [LandlordLoginController::class, 'showLoginForm'])->name('login-landlord');
Route::post('/login-landlord', [LandlordLoginController::class, 'login'])->name('login-landlord.post');

// Tenant Login
Route::get('/login-tenant', function () {
    return view('tenant-login');
});

Route::middleware(['landlord.auth'])->group(function () {
    Route::get('/dashboard', [LandlordLoginController::class, 'dashboard'])->name('landlord.dashboard');
    Route::post('/logout-landlord', [LandlordLoginController::class, 'logout'])->name('logout-landlord');
    // Route::get('/create-tenant', function () {
    //     return view('dashboard.register-tenant');
    // });
    Route::get('/tenant/register', [TenantController::class, 'showRegistrationForm'])->name('tenant.register');
    Route::post('/tenant/register', [TenantController::class, 'register'])->name('tenant.register.submit');
});


// Route::get('/dashboard', function () {
//     return view('dashboard.home-dashboard');
// });

// Route::get('/create-tenant', function () {
//     return view('dashboard.register-tenant');
// });

//test
