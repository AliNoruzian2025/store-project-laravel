<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:0',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function deposit($amount, $description = null, $meta = [])
    {
        $this->increment('balance', $amount);
        
        return $this->transactions()->create([
            'user_id' => $this->user_id,
            'type' => 'deposit',
            'amount' => $amount,
            'description' => $description,
            'status' => 'completed',
            'meta' => $meta,
        ]);
    }

    public function withdraw($amount, $description = null, $meta = [])
    {
        if ($this->balance < $amount) {
            return false;
        }

        $this->decrement('balance', $amount);

        return $this->transactions()->create([
            'user_id' => $this->user_id,
            'type' => 'withdraw',
            'amount' => $amount,
            'description' => $description,
            'status' => 'completed',
            'meta' => $meta,
        ]);
    }

    public function canWithdraw($amount)
    {
        return $this->balance >= $amount;
    }

    public function getFormattedBalanceAttribute()
    {
        return number_format($this->balance) . ' تومان';
    }
}
