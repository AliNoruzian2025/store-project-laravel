<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// ==================== سیستم احراز هویت ====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('do.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== فراموشی رمز عبور ====================
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.send-otp');
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify-otp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// ==================== ثبت‌نام ====================
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register/send-otp', [RegisterController::class, 'sendOtp'])->name('register.send-otp');
Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])->name('register.verify-otp');
Route::post('/register/complete', [RegisterController::class, 'completeRegistration'])->name('register.complete');

// ==================== پنل‌ها ====================
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        $user = auth()->user();
        return "پنل ادمین<br>نام کاربر: " . $user->name;
    })->name('admin.dashboard');
});

Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/user', function () {
        $user = auth()->user();
        return "پنل کاربر<br>نام کاربر: " . $user->name;
    })->name('user.dashboard');
});