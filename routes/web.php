<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/signup', function () {
    return view('sign-up');
});

Route::get('/login-landlord', function () {
    return view('landlord-login');
});

Route::get('/login-tenant', function () {
    return view('tenant-login');
});

Route::get('/dashboard-home', function () {
    return view('dashboard.home-dashboard');
});

Route::get('/create-tenant', function () {
    return view('dashboard.register-tenant');
});
