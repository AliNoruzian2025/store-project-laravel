<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'address',
        'postal_code',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'integer',
    ];

    // روابط
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // اسکوپ‌ها
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // اکسسورها
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_amount) . ' تومان';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'در انتظار',
            'processing' => 'در حال پردازش',
            'completed' => 'تکمیل شده',
            'cancelled' => 'لغو شده',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];

        return $colors[$this->status] ?? 'secondary';
    }
}