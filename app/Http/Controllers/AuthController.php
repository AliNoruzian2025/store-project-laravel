<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        // اعتبارسنجی اولیه
        $request->validate([
            'mobile' => 'required|string|regex:/^09\d{9}$/',
            'password' => 'required|string|min:7'
        ], [
            'mobile.required' => 'شماره موبایل را وارد کنید',
            'mobile.regex' => 'شماره موبایل نامعتبر است. لطفاً شماره درست را وارد کنید',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل ۷ کاراکتر باشد'
        ]);
        
        // 1. بررسی وجود کاربر
        $user = User::where('mobile', $request->mobile)->first();
        
        if (!$user) {
            return back()->withErrors([
                'mobile' => 'حساب کاربری با این شماره موبایل وجود ندارد'
            ])->withInput($request->only('mobile'));
        }
        
        // 2. بررسی رمز عبور
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'رمز عبور وارد شده صحیح نمی‌باشد'
            ])->withInput($request->only('mobile'));
        }
        
        // 3. لاگین کردن کاربر
        Auth::login($user);
        
        // 4. انتقال به پنل
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}