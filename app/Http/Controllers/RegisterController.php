<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Sms\RahyabSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // نمایش فرم ثبت‌نام
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ارسال OTP به شماره موبایل
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^09\d{9}$/'
        ]);
        
        $mobile = $request->mobile;
        
        // بررسی تکراری بودن شماره
        if (User::where('mobile', $mobile)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'شما قبلاً با این شماره موبایل ثبت‌نام کرده‌اید. لطفاً وارد حساب کاربری خود شوید.'
            ], 422);
        }
        
        session(['register_mobile' => $mobile]);
        
        try {
            // ارسال OTP توسط سامانه
            $smsService = new RahyabSmsService();
            $result = $smsService->sendOtp($mobile);
            
            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'کد تأیید ارسال شد'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $result['message'] ?? 'خطا در ارسال کد تأیید'
                ], 500);
            }
            
        } catch (\Exception $e) {
            \Log::error('SMS Service Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'خطا در سرویس ارسال پیامک'
            ], 500);
        }
    }

    // وریفای OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:7'
        ]);
        
        $mobile = session('register_mobile');
        if (!$mobile) {
            return response()->json([
                'status' => 'error',
                'message' => 'شماره موبایل پیدا نشد. لطفاً دوباره ارسال کنید.'
            ], 400);
        }
        
        try {
            $result = (new RahyabSmsService())->verifyOtp($mobile, $request->otp);
            
            if ($result['status'] === 'success') {
                session(['register_verified' => true]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'کد تأیید صحیح است'
                ]);
            }
            
            // خطای OTP اشتباه
            return response()->json([
                'status' => 'error',
                'message' => 'کد تأیید اشتباه است. لطفاً کد صحیح را وارد کنید.'
            ], 400);
            
        } catch (\Exception $e) {
            // خطای ارتباطی
            \Log::error('Register OTP Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'خطا در ارتباط با سرویس تأیید کد'
            ], 500);
        }
    }

    // تکمیل ثبت‌نام
    public function completeRegistration(Request $request)
    {
        if (!session('register_verified')) {
            return response()->json([
                'status' => 'error',
                'message' => 'لطفاً ابتدا شماره موبایل را تأیید کنید'
            ], 400);
        }
        
        $mobile = session('register_mobile');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'password' => 'required|string|min:7|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/|confirmed',
        ], [
            'password.regex' => 'رمز عبور باید ترکیبی از حروف و اعداد باشد',
            'first_name.min' => 'نام باید حداقل ۲ کاراکتر باشد',
            'last_name.min' => 'نام خانوادگی باید حداقل ۲ کاراکتر باشد'
        ]);
        
        // نقش همیشه user
        $user = User::create([
            'mobile' => $mobile,
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        
        session()->forget(['register_mobile', 'register_verified']);
        
        Auth::login($user);
        
        return response()->json([
            'status' => 'success',
            'message' => 'ثبت‌نام با موفقیت انجام شد',
            'redirect' => route('user.dashboard')
        ]);
    }
}