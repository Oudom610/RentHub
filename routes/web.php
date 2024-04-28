<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LandlordRegistrationController;
use App\Http\Controllers\Auth\LandlordLoginController;

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
});

Route::get('/signup', [LandlordRegistrationController::class, 'showRegistrationForm'])->name('register.landlord');
Route::post('/signup', [LandlordRegistrationController::class, 'register']);

Route::get('/login-landlord', [LandlordLoginController::class, 'showLoginForm'])->name('login-landlord');
Route::post('/login-landlord', [LandlordLoginController::class, 'login'])->name('login-landlord.post');

Route::get('/login-tenant', function () {
    return view('tenant-login');
});

Route::middleware(['landlord.auth'])->group(function () {
    Route::get('/dashboard', [LandlordLoginController::class, 'dashboard'])->name('landlord.dashboard');
    Route::post('/logout-landlord', [LandlordLoginController::class, 'logout'])->name('logout-landlord');
    Route::get('/create-tenant', function () {
        return view('dashboard.register-tenant');
    });
    

    // Add any other landlord-specific routes here
});


// Route::get('/dashboard', function () {
//     return view('dashboard.home-dashboard');
// });

// Route::get('/create-tenant', function () {
//     return view('dashboard.register-tenant');
// });

//test
