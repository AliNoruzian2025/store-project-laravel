<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * نمایش لیست محصولات
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');
        $status = $request->input('status');
        
        $query = Product::with('category')->latest();
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        } elseif ($status === 'featured') {
            $query->where('is_featured', true);
        } elseif ($status === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        }
        
        $products = $query->paginate(20);
        
        // آمار
        $stats = [
            'total' => Product::count(),
            'active' => Product::where('is_active', true)->count(),
            'inactive' => Product::where('is_active', false)->count(),
            'featured' => Product::where('is_featured', true)->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            'with_discount' => Product::whereNotNull('discount_price')->count(),
        ];
        
        $categories = Category::where('is_active', true)->get();
        
        return view('admin.products.index', compact('products', 'stats', 'categories'));
    }

    /**
     * نمایش فرم ایجاد محصول جدید
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * ذخیره محصول جدید
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999999999',
            'discount_price' => 'nullable|numeric|min:0|lt:price|max:999999999999',
            'stock' => 'required|integer|min:0|max:999999',
            'image' => 'required|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ], [
            'price.max' => 'قیمت نباید بیشتر از 999,999,999,999 تومان باشد',
            'discount_price.max' => 'قیمت تخفیف نباید بیشتر از 999,999,999,999 تومان باشد',
            'discount_price.lt' => 'قیمت تخفیف باید کمتر از قیمت اصلی باشد',
            'stock.max' => 'موجودی نباید بیشتر از 999,999 عدد باشد',
            'image.url' => 'آدرس تصویر باید یک لینک معتبر باشد',
        ]);
        
        // ایجاد slug خودکار
        $slug = Str::slug($request->name, '-', 'fa');
        $counter = 1;
        $originalSlug = $slug;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'محصول با موفقیت ایجاد شد.');
    }

    /**
     * نمایش جزئیات محصول
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    /**
     * نمایش فرم ویرایش محصول
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * بروزرسانی محصول
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999999999',
            'discount_price' => 'nullable|numeric|min:0|lt:price|max:999999999999',
            'stock' => 'required|integer|min:0|max:999999',
            'image' => 'required|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ], [
            'price.max' => 'قیمت نباید بیشتر از 999,999,999,999 تومان باشد',
            'discount_price.max' => 'قیمت تخفیف نباید بیشتر از 999,999,999,999 تومان باشد',
            'discount_price.lt' => 'قیمت تخفیف باید کمتر از قیمت اصلی باشد',
            'stock.max' => 'موجودی نباید بیشتر از 999,999 عدد باشد',
            'image.url' => 'آدرس تصویر باید یک لینک معتبر باشد',
        ]);
        
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
        ]);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'محصول با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف محصول
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }

    /**
     * تغییر وضعیت فعال/غیرفعال
     */
    public function toggleStatus(Product $product)
    {
        $product->update([
            'is_active' => !$product->is_active
        ]);
        
        $status = $product->is_active ? 'فعال' : 'غیرفعال';
        return back()->with('success', "محصول به وضعیت {$status} تغییر یافت.");
    }

    /**
     * تغییر وضعیت ویژه/عادی
     */
    public function toggleFeatured(Product $product)
    {
        $product->update([
            'is_featured' => !$product->is_featured
        ]);
        
        $status = $product->is_featured ? 'ویژه' : 'عادی';
        return back()->with('success', "محصول به وضعیت {$status} تغییر یافت.");
    }

    /**
     * افزایش موجودی
     */
    public function increaseStock(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:999999'
        ], [
            'quantity.max' => 'تعداد نباید بیشتر از 999,999 عدد باشد'
        ]);
        
        $product->increment('stock', $request->quantity);
        
        return back()->with('success', "موجودی {$request->quantity} عدد افزایش یافت.");
    }

    /**
     * کاهش موجودی
     */
    public function decreaseStock(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:999999'
        ], [
            'quantity.max' => 'تعداد نباید بیشتر از 999,999 عدد باشد'
        ]);
        
        if ($product->stock >= $request->quantity) {
            $product->decrement('stock', $request->quantity);
            return back()->with('success', "موجودی {$request->quantity} عدد کاهش یافت.");
        }
        
        return back()->with('error', 'موجودی کافی نمی‌باشد.');
    }
}