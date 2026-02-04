<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'discount_price',
        'stock', 'image', 'category_id', 'is_active', 'is_featured'
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }
    
    public function getIsInStockAttribute()
    {
        return $this->stock > 0;
    }
}