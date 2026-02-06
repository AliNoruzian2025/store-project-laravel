<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // نمایش صفحه انتخاب روش پرداخت
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است.');
        }
        
        $totalAmount = $cart->total;
        $walletBalance = $user->getWalletBalance();
        
        return view('checkout.index', compact('cart', 'totalAmount', 'walletBalance'));
    }
    
    // پرداخت با کیف پول
    public function payWithWallet(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        if (!$cart || $cart->items->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'سبد خرید شما خالی است.'
            ]);
        }
        
        $totalAmount = $cart->total;
        $walletBalance = $user->getWalletBalance();
        
        // بررسی موجودی کیف پول
        if ($walletBalance < $totalAmount) {
            return response()->json([
                'success' => false,
                'message' => 'موجودی کیف پول شما کافی نیست.',
                'needed' => $totalAmount - $walletBalance
            ]);
        }
        
        DB::beginTransaction();
        
        try {
            // ایجاد سفارش
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'processing',
                'address' => $user->address,
                'postal_code' => $user->postal_code,
                'payment_method' => 'wallet',
                'payment_status' => 'paid',
            ]);
            
            // ایجاد آیتم‌های سفارش
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->final_price,
                    'total_price' => $item->product->final_price * $item->quantity,
                ]);
                
                // کاهش موجودی محصول
                $item->product->decrement('stock', $item->quantity);
            }
            
            // کسر از کیف پول
            $wallet = $user->wallet;
            $wallet->decrement('balance', $totalAmount);
            
            // ثبت تراکنش کیف پول
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $user->id,
                'type' => 'purchase',
                'amount' => $totalAmount,
                'description' => 'پرداخت سفارش #' . $order->id,
                'tracking_code' => 'ORDER-' . $order->id,
                'status' => 'completed',
            ]);
            
            // خالی کردن سبد خرید
            $cart->items()->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'پرداخت با موفقیت انجام شد.',
                'order_id' => $order->id,
                'redirect' => route('checkout.complete', $order->id)
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'خطا در پرداخت: ' . $e->getMessage()
            ]);
        }
    }
    
    // پرداخت آنلاین
    public function payOnline(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است.');
        }
        
        // اطمینان از وجود کیف پول
        $wallet = $user->wallet;
        if (!$wallet) {
            $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        }
        
        // ایجاد تراکنش پرداخت
        $transaction = WalletTransaction::create([
            'wallet_id' => $wallet->id, // ← این خطا اضافه شد
            'user_id' => $user->id,
            'type' => 'purchase',
            'amount' => $cart->total,
            'description' => 'پرداخت سفارش',
            'tracking_code' => 'PAY-' . time() . '-' . $user->id,
            'status' => 'pending',
        ]);
        
        return view('checkout.payment', compact('cart', 'transaction'));
    }
    
    // پرداخت آنلاین - فرآیند
    public function processOnlinePayment(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        $transactionId = $request->input('transaction_id');
        
        DB::beginTransaction();
        
        try {
            // ایجاد سفارش
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $cart->total,
                'status' => 'processing',
                'address' => $user->address,
                'postal_code' => $user->postal_code,
                'payment_method' => 'online',
                'payment_status' => 'paid',
            ]);
            
            // ایجاد آیتم‌های سفارش
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->final_price,
                    'total_price' => $item->product->final_price * $item->quantity,
                ]);
                
                // کاهش موجودی محصول
                $item->product->decrement('stock', $item->quantity);
            }
            
            // بروزرسانی تراکنش پرداخت
            $transaction = WalletTransaction::find($transactionId);
            if ($transaction) {
                $transaction->update([
                    'status' => 'completed',
                    'description' => 'پرداخت سفارش #' . $order->id,
                ]);
            }
            
            // خالی کردن سبد خرید
            $cart->items()->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'پرداخت با موفقیت انجام شد.',
                'order_id' => $order->id,
                'redirect' => route('checkout.complete', $order->id)
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'خطا در پرداخت: ' . $e->getMessage()
            ]);
        }
    }
    
    // تکمیل سفارش و وارد کردن آدرس
    public function showComplete($orderId)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($orderId);
        $order->load('items.product');
        
        return view('checkout.complete', compact('order'));
    }
    
    // ارسال سفارش
    public function shipOrder(Request $request, $orderId)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'postal_code' => 'required|string|digits:10',
        ]);
        
        $order = Order::where('user_id', Auth::id())->findOrFail($orderId);
        
        // بروزرسانی سفارش
        $order->update([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'status' => 'completed',
        ]);
        
        // بروزرسانی آدرس کاربر
        $user = Auth::user();
        $user->update([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
        
        return redirect()->route('user.orders.show', $orderId)
            ->with('success', 'سفارش شما با موفقیت ثبت و ارسال شد.');
    }
}