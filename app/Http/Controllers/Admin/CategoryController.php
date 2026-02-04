<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌بندی‌ها
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        
        $query = Category::query();
        
        // فیلتر جستجو
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        
        // فیلتر وضعیت
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }
        
        $categories = $query->latest()->paginate(20);
        
        // آمار
        $stats = [
            'total' => Category::count(),
            'active' => Category::where('is_active', true)->count(),
            'inactive' => Category::where('is_active', false)->count(),
        ];
        
        return view('admin.categories.index', compact('categories', 'stats'));
    }

    /**
     * نمایش فرم ایجاد دسته جدید
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * ذخیره دسته جدید
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'is_active' => 'boolean',
        ]);
        
        // ایجاد slug خودکار از نام
        $slug = Str::slug($request->name, '-', 'fa');
        
        // اگر slug تکراری بود، شماره اضافه کن
        $counter = 1;
        $originalSlug = $slug;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    /**
     * نمایش فرم ویرایش دسته
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * بروزرسانی دسته
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'is_active' => 'boolean',
        ]);
        
        $category->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
        ]);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف دسته
     */
    public function destroy(Category $category)
    {
        // بررسی وجود محصول در این دسته
        if ($category->products()->exists()) {
            return back()->with('error', 'این دسته دارای محصول می‌باشد. ابتدا محصولات را حذف یا منتقل کنید.');
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