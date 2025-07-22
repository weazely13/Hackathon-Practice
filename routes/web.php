<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome'); // landing page
});
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user-feedback', function () {
    return view('/auth/user-feedback'); // user feedback(s) page
});