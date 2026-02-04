<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * نمایش لیست کاربران
     */
    public function index(Request $request)
    {
        // دریافت پارامترهای فیلتر
        $search = $request->input('search');
        $role = $request->input('role');
        $status = $request->input('status');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        // شروع کوئری
        $query = User::query();

        // اعمال فیلتر جستجو
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        // فیلتر نقش
        if ($role && in_array($role, ['admin', 'user'])) {
            $query->where('role', $role);
        }

        // فیلتر وضعیت (بر اساس وجود آدرس)
        if ($status) {
            if ($status === 'with_address') {
                $query->whereNotNull('address');
            } elseif ($status === 'without_address') {
                $query->whereNull('address');
            }
        }

        // مرتب‌سازی
        $validSortColumns = ['created_at', 'first_name', 'last_name', 'mobile'];
        $sort = in_array($sort, $validSortColumns) ? $sort : 'created_at';
        $order = in_array($order, ['asc', 'desc']) ? $order : 'desc';
        
        $query->orderBy($sort, $order);

        // صفحه‌بندی
        $users = $query->paginate(15)->withQueryString();

        // آمار
        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'users' => User::where('role', 'user')->count(),
            'active' => User::where('is_active', true)->count(), // اضافه شد
            'inactive' => User::where('is_active', false)->count(), // اضافه شد
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * نمایش فرم ایجاد کاربر جدید
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * ذخیره کاربر جدید
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mobile' => 'required|string|digits:11|regex:/^09[0-9]{9}$/|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|digits:10',
        ], [
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',
            'mobile.regex' => 'شماره موبایل معتبر نیست. شماره باید با 09 شروع شود.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ایجاد کاربر
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'کاربر با موفقیت ایجاد شد.');
    }

    /**
     * نمایش جزئیات کاربر
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * نمایش فرم ویرایش کاربر
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * بروزرسانی اطلاعات کاربر
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mobile' => [
                'required',
                'string',
                'digits:11',
                'regex:/^09[0-9]{9}$/',
                Rule::unique('users')->ignore($user->id)
            ],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|digits:10',
        ], [
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // به روزرسانی اطلاعات
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'role' => $request->role,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'اطلاعات کاربر با موفقیت به روزرسانی شد.');
    }

    /**
     * حذف کاربر
     */
    public function destroy(User $user)
    {
        // جلوگیری از حذف خود ادمین
        $currentUserId = Auth::id(); // اینجا درستش کردم
        if ($user->id === $currentUserId) {
            return back()->with('error', 'شما نمی‌توانید حساب خود را حذف کنید.');
        }

        // جلوگیری از حذف آخرین ادمین
        $adminCount = User::where('role', 'admin')->count();
        if ($user->role === 'admin' && $adminCount <= 1) {
            return back()->with('error', 'حداقل باید یک ادمین در سیستم وجود داشته باشد.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'کاربر با موفقیت حذف شد.');
    }

    /**
     * تغییر رمز عبور کاربر
     */
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'رمز عبور کاربر با موفقیت تغییر یافت.');
    }

    /**
     * تغییر وضعیت کاربر
     */
    public function toggleStatus(User $user)
    {
        // جلوگیری از غیرفعال کردن خودت
        if ($user->id === Auth::id()) {
            return back()->with('error', 'شما نمی‌توانید حساب خود را غیرفعال کنید.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'فعال' : 'غیرفعال';
        return back()->with('success', "کاربر {$user->full_name} به وضعیت {$status} تغییر یافت.");
    }

    /**
     * جستجوی سریع کاربران (برای AJAX)
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $users = User::where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%")
                    ->orWhere('mobile', 'like', "%{$query}%")
                    ->limit(10)
                    ->get(['id', 'first_name', 'last_name', 'mobile', 'role']);

        return response()->json($users);
    }
}