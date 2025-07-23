<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Landing page, with auth redirect
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user-feedback-form', function () {
    return view('/user/user-feedback-form'); // user feedback(s) page
});

Route::get('/user-feedback-home', function () {
    return view('/user/user-feedback-home'); // user feedback(s) page
});