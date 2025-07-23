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
    })->name('dashboard');

Route::get('/feedbacks', function () {
    return view('feedbacks'); 
    })->name('feedbacks');

Route::get('/analytics', function () {
    return view('analytics'); 
    })->name('analytics');

Route::get('/profile', function () {
    return view('profile');
    })->name('profile');


Route::middleware('auth')->group(function () {
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/user-feedback-form', function () {
    return view('/user/user-feedback-form'); // user feedback(s) page
});

Route::get('/user-feedback-home', function () {
    return view('/user/user-feedback-home'); // user feedback(s) page
});