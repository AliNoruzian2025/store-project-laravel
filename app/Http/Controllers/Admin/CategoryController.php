<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌بندی‌ها
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $sort = $request->input('sort', 'latest');
        
        $query = Category::withCount('products');
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }
        
        // مرتب‌سازی
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->latest();
                break;
        }
        
        $categories = $query->paginate(20);
        
        // آمار
        $stats = [
            'total' => Category::count(),
            'active' => Category::where('is_active', true)->count(),
            'inactive' => Category::where('is_active', false)->count(),
            'with_products' => Category::has('products')->count(),
        ];
        
        return view('admin.categories.index', compact('categories', 'stats'));
    }

    /**
     * نمایش فرم ایجاد دسته‌بندی جدید
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * ذخیره دسته‌بندی جدید
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);
        
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    /**
     * نمایش فرم ویرایش دسته‌بندی
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * بروزرسانی دسته‌بندی
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);
        
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy(Category $category)
    {
        // بررسی آیا دسته‌بندی محصول دارد
        if ($category->products()->exists()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'امکان حذف دسته‌بندی وجود ندارد زیرا دارای محصول است.');
        }
        
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }

    /**
     * تغییر وضعیت فعال/غیرفعال
     */
    public function toggleStatus(Category $category)
    {
        $category->update([
            'is_active' => !$category->is_active
        ]);
        
        $status = $category->is_active ? 'فعال' : 'غیرفعال';
        return back()->with('success', "دسته‌بندی به وضعیت {$status} تغییر یافت.");
    }
}