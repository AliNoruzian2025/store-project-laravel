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

    public static function validateMobile(array $data)
    {
        return validator($data, [
            'mobile' => 'required|string|digits:11|unique:users,mobile|regex:/^09[0-9]{9}$/',
        ]);
    }

    public static function validateProfile(array $data)
    {
        return validator($data, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    public static function validateAddress(array $data)
    {
        return validator($data, [
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|digits:10',
        ]);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

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

    protected $appends = ['full_name', 'name'];

    // ==================== روابط کیف پول ====================
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ==================== متدهای کیف پول ====================
    public function getWalletBalance()
    {
        if (!$this->wallet) {
            $this->wallet()->create(['balance' => 0]);
        }
        return $this->wallet->balance;
    }

    public function getFormattedWalletBalance()
    {
        return number_format($this->getWalletBalance()) . ' تومان';
    }

    public function hasSufficientBalance($amount)
    {
        return $this->getWalletBalance() >= $amount;
    }

    // ==================== Event ====================
    protected static function booted()
    {
        static::created(function ($user) {
            if (!$user->wallet) {
                $user->wallet()->create(['balance' => 0]);
            }
        });
    }
}