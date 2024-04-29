<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TenantController;
use App\Http\Controllers\Auth\TenantLoginController;
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

// Tenant Login
// Route::get('/login-tenant', [TenantLoginController::class, 'showLoginForm'])->name('login-tenant');
// Route::post('/login-tenant', [TenantLoginController::class, 'login'])->name('login-tenant.post');

// Route::get('/login-tenant', function () {
//     return view('tenant-login');
// });

// Tenant Login and Stuff
Route::get('/login-tenant', [TenantController::class, 'showLoginForm'])->name('login-tenant');
Route::post('/login-tenant', [TenantController::class, 'login'])->name('tenant.login.post');
Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
Route::post('/logout-tenant', [TenantController::class, 'logout'])->name('logout-tenant');
// Route::get('/tenant/dashboard', function () {
//     return view('tenant.home-dashboard');
// })->name('tenant.dashboard');

// Landlord Signup and Login
Route::get('/signup', [LandlordRegistrationController::class, 'showRegistrationForm'])->name('register.landlord');
Route::post('/signup', [LandlordRegistrationController::class, 'register']);
Route::get('/login-landlord', [LandlordLoginController::class, 'showLoginForm'])->name('login-landlord');
Route::post('/login-landlord', [LandlordLoginController::class, 'login'])->name('login-landlord.post');

// // Tenant middleware
// Route::middleware(['tenant.auth'])->group(function () {
//     Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
//     Route::post('/logout-tenant', [TenantController::class, 'logout'])->name('logout-tenant');
// });

//Landlord middleware
Route::middleware(['landlord.auth'])->group(function () {
    Route::get('/landlord/dashboard', [LandlordLoginController::class, 'dashboard'])->name('landlord.dashboard');
    Route::post('/logout-landlord', [LandlordLoginController::class, 'logout'])->name('logout-landlord');
    Route::get('/tenant/register', [TenantController::class, 'showRegistrationForm'])->name('tenant.register');
    Route::post('/tenant/register', [TenantController::class, 'register'])->name('tenant.register.submit');
});
