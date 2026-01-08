<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Sms\RahyabSmsService;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }
    
    public function sendOtp(Request $request)
    {
        $request->validate(['mobile' => 'required|regex:/^09\d{9}$/']);
        
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'شماره موبایل در سیستم موجود نیست'
            ], 404);
        }

        // ذخیره mobile در session برای مراحل بعد
        session([
            'forgot_password_mobile' => $request->mobile,
            'forgot_password_otp_verified' => false
        ]);

        // ارسال OTP با سرویس موجود (خود سامانه OTP تولید می‌کند)
        $sms = new RahyabSmsService();
        $result = $sms->sendOtp($request->mobile);

        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'کد تأیید ارسال شد'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['message'] ?? 'خطا در ارسال OTP'
        ], 500);
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
        'mobile' => 'required|regex:/^09\d{9}$/',
        'otp' => 'required|numeric|digits:7'
        ]);

        try {
            // بررسی OTP با سرویس پیامک
            $sms = new RahyabSmsService();
            $result = $sms->verifyOtp($request->mobile, $request->otp);

            if ($result['status'] === 'success') {
                // علامت‌گذاری OTP به عنوان verified
                session(['forgot_password_otp_verified' => true]);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'کد تأیید صحیح است'
                ]);
            }

            // اگر سرویس پیامک خطای verify داده
            return response()->json([
                'status' => 'error',
                'message' => $result['message'] ?? 'کد تأیید نامعتبر است'
            ], 400);
            
        } catch (\Exception $e) {
            // اگر خطای ارتباطی با سرور SMS رخ دهد
            \Log::error('OTP Verification Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'خطا در ارتباط با سرویس تأیید کد'
            ], 500);
        }
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:7|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            'password_confirmation' => 'required|same:password'
        ], [
            'password.regex' => 'رمز عبور باید ترکیبی از حروف و اعداد باشد'
        ]);

        // ۱. چک کردن session برای mobile
        $mobile = session('forgot_password_mobile');
        if (!$mobile) {
            return response()->json([
                'status' => 'error',
                'message' => 'لطفاً ابتدا شماره موبایل خود را تأیید کنید'
            ], 400);
        }

        // ۲. چک کردن اینکه OTP verify شده است
        if (!session('forgot_password_otp_verified')) {
            return response()->json([
                'status' => 'error',
                'message' => 'لطفاً ابتدا کد تأیید را بررسی کنید'
            ], 400);
        }

        // ۳. پیدا کردن کاربر
        $user = User::where('mobile', $mobile)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'کاربر یافت نشد'
            ], 404);
        }

        // ۴. آپدیت رمز عبور
        $user->password = Hash::make($request->password);
        $user->save();

        // ۵. پاک کردن session
        session()->forget(['forgot_password_mobile', 'forgot_password_otp_verified']);
        
        return response()->json([
            'status' => 'success',
            'message' => 'رمز عبور با موفقیت تغییر کرد'
        ]);
    }
}