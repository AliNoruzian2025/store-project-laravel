<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;

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

// پنل ادمین
Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
    // داشبورد ادمین
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // مدیریت محصولات
    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('admin.products.index');
    
    // مدیریت کاربران
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/{user}/change-password', [UserController::class, 'changePassword'])->name('admin.users.changePassword');
        Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
        Route::get('/search/quick', [UserController::class, 'search'])->name('admin.users.search');
    });
});

// پنل کاربر
Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');
});

// صفحه اصلی و جستجو
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('products.search');