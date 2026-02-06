<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserWalletController;

// کنترلرهای ادمین
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

// ==================== ROUTES عمومی (بدون نیاز به احراز هویت) ====================

// صفحه اصلی و صفحات عمومی
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('products.search');
Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('products.show');

// سیستم احراز هویت
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('do.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// فراموشی رمز عبور
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.send-otp');
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify-otp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// ثبت‌نام
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register/send-otp', [RegisterController::class, 'sendOtp'])->name('register.send-otp');
Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])->name('register.verify-otp');
Route::post('/register/complete', [RegisterController::class, 'completeRegistration'])->name('register.complete');

// ==================== ROUTES احراز شده (نیاز به لاگین دارد) ====================
Route::middleware(['auth'])->group(function () {
    
    // سبد خرید
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{cartItem}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });
    
    // فرآیند خرید
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/wallet', [CheckoutController::class, 'payWithWallet'])->name('wallet');
        Route::get('/online', [CheckoutController::class, 'payOnline'])->name('online');
        Route::post('/online/process', [CheckoutController::class, 'processOnlinePayment'])->name('process-online');
        Route::get('/complete/{order}', [CheckoutController::class, 'showComplete'])->name('complete');
        Route::post('/ship/{order}', [CheckoutController::class, 'shipOrder'])->name('ship');
    });
});

// ==================== ROUTES پنل کاربر ====================

Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    
    // داشبورد کاربر
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
    
    // پروفایل کاربر - تعریف کامل
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile'); // ← این همان user.profile است
    Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update'); // ← user.profile.update
    Route::put('/profile/password', [UserDashboardController::class, 'updatePassword'])->name('profile.password'); // ← user.profile.password
    
    // سفارشات کاربر
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [UserDashboardController::class, 'orders'])->name('index');
        Route::get('/{order}', [UserDashboardController::class, 'orderShow'])->name('show');
        Route::post('/cancel/{order}', [UserDashboardController::class, 'cancelOrder'])->name('cancel');
    });
    
    // کیف پول کاربر
    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('/', [UserWalletController::class, 'index'])->name('index');
        Route::post('/charge', [UserWalletController::class, 'charge'])->name('charge');
        Route::get('/payment/{transaction}', [UserWalletController::class, 'showPayment'])->name('payment');
        Route::post('/pay', [UserWalletController::class, 'processPayment'])->name('pay');
        Route::get('/transactions', [UserWalletController::class, 'transactions'])->name('transactions');
    });
});

// ==================== ROUTES پنل ادمین ====================
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // داشبورد ادمین
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/weekly-sales', [DashboardController::class, 'getWeeklySales'])->name('dashboard.weekly-sales');
    
    // مدیریت کاربران
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
    
    // مدیریت دسته‌بندی‌ها
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::post('/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('toggleStatus');
    });
    
    // مدیریت محصولات
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('toggleFeatured');
        Route::post('/{product}/increase-stock', [ProductController::class, 'increaseStock'])->name('increaseStock');
        Route::post('/{product}/decrease-stock', [ProductController::class, 'decreaseStock'])->name('decreaseStock');
    });
    
    // مدیریت سفارشات
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::put('/{order}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
});