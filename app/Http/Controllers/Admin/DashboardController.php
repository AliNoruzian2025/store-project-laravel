<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * نمایش داشبورد ادمین
     */
    public function index()
    {
        // آمار کلی
        $stats = [
            // کاربران
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_customers' => User::where('role', 'user')->count(),
            
            // محصولات
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'featured_products' => Product::where('is_featured', true)->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            
            // دسته‌بندی‌ها
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),
            
            // سفارشات
            'total_orders' => Order::count(),
            'total_orders_amount' => Order::sum('total_amount') ?? 0,
            
            // سفارشات امروز
            'today_orders' => Order::whereDate('created_at', Carbon::today())->count(),
            'today_orders_amount' => Order::whereDate('created_at', Carbon::today())->sum('total_amount') ?? 0,
            
            // سفارشات این ماه
            'month_orders' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)->count(),
            'month_orders_amount' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)->sum('total_amount') ?? 0,
            
            // وضعیت سفارشات
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            
            // پرداخت‌ها - با استفاده از ?? برای جلوگیری از خطا
            'total_payments' => Order::where('payment_status', 'paid')->count(),
            'total_payments_amount' => Order::where('payment_status', 'paid')->sum('total_amount') ?? 0,
            'wallet_payments' => Order::where('payment_method', 'wallet')->count(),
            'online_payments' => Order::where('payment_method', 'online')->count(),
            'paid_orders' => Order::where('payment_status', 'paid')->count(),
            
            // کیف پول
            'total_wallet_balance' => Wallet::sum('balance') ?? 0,
            'total_transactions' => WalletTransaction::count(),
            
            // اضافه کردن کلیدهای جدید برای جلوگیری از خطا
            'total_wallet_balance_formatted' => number_format(Wallet::sum('balance') ?? 0) . ' تومان',
            'total_orders_amount_formatted' => number_format(Order::sum('total_amount') ?? 0) . ' تومان',
            'today_orders_amount_formatted' => number_format(Order::whereDate('created_at', Carbon::today())->sum('total_amount') ?? 0) . ' تومان',
        ];
        
        // آمار ماهانه فروش برای چارت
        $monthlySales = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(total_amount) as total_amount')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => $this->getMonthName($item->month),
                    'orders' => $item->order_count ?? 0,
                    'amount' => $item->total_amount ?? 0
                ];
            });
        
        // آخرین سفارشات
        $recentOrders = Order::with(['user', 'items'])
            ->latest()
            ->limit(10)
            ->get();
        
        // آخرین کاربران
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->limit(5)
            ->get();
        
        // محصولات پرفروش
        $bestSellingProducts = Product::select('products.*')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        
        // سفارشات در انتظار پردازش
        $pendingProcessingOrders = Order::whereIn('status', ['pending', 'processing'])
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'stats',
            'monthlySales',
            'recentOrders',
            'recentUsers',
            'bestSellingProducts',
            'pendingProcessingOrders'
        ));
    }
    
    /**
     * تبدیل شماره ماه به نام فارسی
     */
    private function getMonthName($monthNumber)
    {
        $persianMonths = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];
        
        return $persianMonths[$monthNumber] ?? 'ماه ناشناس';
    }
    
    /**
     * دریافت آمار برای AJAX (به‌روزرسانی زنده)
     */
    public function getStats()
    {
        $stats = [
            'total_orders' => Order::count(),
            'today_orders' => Order::whereDate('created_at', Carbon::today())->count(),
            'today_orders_amount' => Order::whereDate('created_at', Carbon::today())->sum('total_amount') ?? 0,
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_payments' => Order::where('payment_status', 'paid')->count(),
        ];
        
        return response()->json($stats);
    }
    
    /**
     * آمار فروش هفته جاری
     */
    public function getWeeklySales()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $weeklySales = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->select(
                DB::raw('DAYNAME(created_at) as day'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_amount) as amount')
            )
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();
        
        return response()->json($weeklySales);
    }
}