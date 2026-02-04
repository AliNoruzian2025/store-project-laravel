<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
                      ->orWhere('description', 'like', "%{$searchQuery}%")
                      ->orWhere('slug', 'like', "%{$searchQuery}%");
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
            
        // برگرداندن view با داده‌ها
        return view('home', compact(
            'products', 
            'categories', 
            'categoryId', 
            'searchQuery'
        ));
    }
    
    /**
     * جستجوی پیشرفته (برای آینده)
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}