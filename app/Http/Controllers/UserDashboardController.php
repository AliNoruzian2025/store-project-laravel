<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserDashboardController extends Controller
{
    /**
     * نمایش داشبورد کاربر
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // بررسی وجود جدول orders
        $ordersExist = Schema::hasTable('orders');
        
        if ($ordersExist) {
            try {
                $stats = [
                    'total_orders' => Order::where('user_id', $user->id)->count(),
                    'pending_orders' => Order::where('user_id', $user->id)
                        ->whereIn('status', ['pending', 'processing'])->count(),
                    'completed_orders' => Order::where('user_id', $user->id)
                        ->where('status', 'completed')->count(),
                ];
                
                $recentOrders = Order::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();
            } catch (\Exception $e) {
                $stats = [
                    'total_orders' => 0,
                    'pending_orders' => 0,
                    'completed_orders' => 0,
                ];
                $recentOrders = collect([]);
            }
        } else {
            $stats = [
                'total_orders' => 0,
                'pending_orders' => 0,
                'completed_orders' => 0,
            ];
            $recentOrders = collect([]);
        }
        
        return view('user.dashboard', compact('stats', 'recentOrders'));
    }
    
    /**
     * نمایش پروفایل کاربر
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    /**
     * بروزرسانی پروفایل
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|digits:10',
        ]);
        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
        
        return redirect()->route('user.dashboard')
            ->with('success', 'پروفایل با موفقیت بروزرسانی شد.');
    }
    
    /**
     * تغییر رمز عبور
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور فعلی صحیح نیست.']);
        }
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('user.dashboard')
            ->with('success', 'رمز عبور با موفقیت تغییر یافت.');
    }
    
    /**
     * نمایش کیف پول
     */
    public function wallet()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        
        // اگر کیف پول وجود ندارد، ایجاد کن
        if (!$wallet) {
            $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        }
        
        $transactions = $wallet->transactions()
            ->latest()
            ->take(10)
            ->get();
        
        return view('user.wallet.index', compact('wallet', 'transactions'));
    }
    
    /**
     * نمایش سفارشات کاربر
     */
    public function orders(Request $request)
    {
        $user = Auth::user();
        $status = $request->input('status');
        
        $query = Order::where('user_id', $user->id)->latest();
        
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        
        $orders = $query->paginate(10);
        
        return view('user.orders.index', compact('orders'));
    }
    
    /**
     * نمایش جزئیات سفارش
     */
    public function orderShow(Order $order)
    {
        // بررسی مالکیت سفارش
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $order->load('items.product');
        
        return view('user.orders.show', compact('order'));
    }
    
    /**
     * لغو سفارش
     */
    public function cancelOrder(Order $order)
    {
        // بررسی مالکیت سفارش
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        // بررسی اینکه سفارش قابل لغو باشد
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()
                ->with('error', 'فقط سفارشات در انتظار یا در حال پردازش قابل لغو هستند.');
        }
        
        $order->update([
            'status' => 'cancelled',
        ]);
        
        return redirect()->route('user.orders.show', $order)
            ->with('success', 'سفارش با موفقیت لغو شد.');
    }
}