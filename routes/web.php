<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome'); // landing page
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [QRCodeController::class, 'dashboard'])->middleware('auth');

Route::post('/generate-qr', [QRCodeController::class, 'generate'])->middleware('auth')->name('generate.qr');
// Protected route
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user-feedback-form', function () {
    return view('/user/user-feedback-form');
});
Route::get('/user-feedback-home', function () {
    return view('/user/user-feedback-home');
});
