<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    // فقط فیلدهای موجود در جدول
    protected $fillable = [
        'mobile',
        'first_name',  
        'last_name',   
        'password',
        'role',
        'is_active',
        'address',     
        'postal_code'  
    ];

    /**
     * ولیدیشن برای مرحله اول (شماره موبایل)
     */
    public static function validateMobile(array $data)
    {
        return validator($data, [
            'mobile' => 'required|string|digits:11|unique:users,mobile|regex:/^09[0-9]{9}$/',
        ]);
    }

    /**
     * ولیدیشن برای مرحله دوم (اطلاعات کاربر)
     */
    public static function validateProfile(array $data)
    {
        return validator($data, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * ولیدیشن برای مرحله تکمیلی (آدرس)
     */
    public static function validateAddress(array $data)
    {
        return validator($data, [
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|digits:10',
        ]);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Get full name (نام کامل)
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get name (برای سازگاری با سیستم‌هایی که name می‌خواهند)
     */
    public function getNameAttribute(): string
    {
        return $this->full_name;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // اگر می‌خواهید این accessorها در JSON نمایش داده شوند
    protected $appends = ['full_name', 'name'];
}