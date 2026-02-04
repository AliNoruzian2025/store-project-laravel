<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

// ==================== صفحه اصلی و جستجو (عمومی) ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('products.search');

// ==================== پنل ادمین ====================
Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // داشبورد ادمین
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // ==================== مدیریت کاربران ====================
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/change-password', [UserController::class, 'changePassword'])->name('changePassword');
        Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggleStatus');
        Route::get('/search/quick', [UserController::class, 'search'])->name('search');
    });
    
    // ==================== مدیریت دسته‌بندی‌ها ====================
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::post('/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('toggleStatus');
    });
    
    // ==================== مدیریت محصولات ====================
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('toggleFeatured');
        Route::post('/{product}/increase-stock', [ProductController::class, 'increaseStock'])->name('increaseStock');
        Route::post('/{product}/decrease-stock', [ProductController::class, 'decreaseStock'])->name('decreaseStock');
    });
    
});

// ==================== پنل کاربر عادی ====================
Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');
});