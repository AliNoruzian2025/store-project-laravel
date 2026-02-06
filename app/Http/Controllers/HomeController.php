<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // دریافت پارامترها
        $categoryId = $request->get('category');
        $searchQuery = $request->get('q');
        
        // شروع کوئری محصولات
        $productsQuery = Product::where('is_active', true);
        
        // فیلتر بر اساس دسته‌بندی
        if ($categoryId && is_numeric($categoryId)) {
            $productsQuery = $productsQuery->where('category_id', $categoryId);
        }
        
        // فیلتر بر اساس جستجو
        if ($searchQuery && strlen($searchQuery) > 0) {
            $productsQuery = $productsQuery->where(function($query) use ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        
        // مرتب‌سازی و صفحه‌بندی
        $products = $productsQuery->orderBy('created_at', 'desc')->paginate(12);
        
        // دسته‌بندی‌ها با تعداد محصولات
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();
        
        // اطلاعات سبد خرید کاربر
        $cartCount = 0;
        if (auth()->check()) {
            $cartCount = auth()->user()->cartItems()->count();
        }
        
        return view('home', compact(
            'products', 
            'categories', 
            'categoryId', 
            'searchQuery',
            'cartCount'
        ));
    }

    
    /**
     * نمایش صفحه تک محصول
     */
    public function showProduct($id)
    {
        $product = Product::where('is_active', true)
            ->with('category')
            ->findOrFail($id);
            
        // محصولات مرتبط
        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        // اطلاعات سبد خرید کاربر
        $cartCount = 0;
        if (auth()->check()) {
            $cartCount = auth()->user()->cartItems()->count();
        }
        
        return view('products.show', compact('product', 'relatedProducts', 'cartCount'));
    }
    
    /**
     * جستجوی پیشرفته
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}