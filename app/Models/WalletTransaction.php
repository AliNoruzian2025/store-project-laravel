<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'user_id',
        'type',
        'amount',
        'description',
        'tracking_code',
        'status', // فقط برای سازگاری نگه می‌داریم
        'meta',
    ];

    protected $casts = [
        'amount' => 'decimal:0',
        'meta' => 'array',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeTextAttribute()
    {
        $types = [
            'deposit' => 'شارژ',
            'withdraw' => 'برداشت',
            'purchase' => 'خرید',
            'refund' => 'عودت',
        ];

        return $types[$this->type] ?? $this->type;
    }

    // همه تراکنش‌ها موفق هستند
    public function getStatusTextAttribute()
    {
        return 'موفق';
    }

    public function getAmountFormattedAttribute()
    {
        return number_format($this->amount) . ' تومان';
    }
    
    // فقط تراکنش‌های موفق را بگیر
    public function scopeSuccessful($query)
    {
        return $query;
    }
}