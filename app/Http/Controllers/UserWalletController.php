<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWalletController extends Controller
{
    /**
     * نمایش کیف پول
     */
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        
        if (!$wallet) {
            $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        }
        
        $transactions = $wallet->transactions()
            ->where('status', 'completed') // فقط پرداخت‌های موفق
            ->latest()
            ->take(10)
            ->get();
        
        return view('user.wallet.index', compact('wallet', 'transactions'));
    }
    
    /**
     * شارژ کیف پول - ایجاد تراکنش و انتقال به درگاه
     */
    public function charge(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:1000|max:10000000',
        ]);
        
        $user = Auth::user();
        $wallet = $user->wallet;
        
        if (!$wallet) {
            $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        }
        
        // ایجاد تراکنش در حالت pending
        $transaction = WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'description' => 'شارژ کیف پول',
            'status' => 'pending', // منتظر پرداخت
            'tracking_code' => 'TRX-' . time() . '-' . $user->id,
        ]);
        
        // انتقال به صفحه درگاه پرداخت
        return redirect()->route('user.wallet.payment', $transaction);
    }
    
    /**
     * نمایش صفحه درگاه پرداخت
     */
    public function showPayment(WalletTransaction $transaction)
    {
        // بررسی مالکیت تراکنش
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        
        // اگر تراکنش قبلاً پرداخت شده
        if ($transaction->status === 'completed') {
            return redirect()->route('user.wallet.index')
                ->with('success', 'این تراکنش قبلاً پرداخت شده است.');
        }
        
        // اگر تراکنش لغو شده
        if ($transaction->status === 'cancelled') {
            return redirect()->route('user.wallet.index')
                ->with('error', 'این تراکنش لغو شده است.');
        }
        
        return view('user.wallet.payment', compact('transaction'));
    }
    
    /**
     * پرداخت نهایی از طریق درگاه
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:wallet_transactions,id',
        ]);
        
        $transaction = WalletTransaction::find($request->transaction_id);
        $user = Auth::user();
        
        // بررسی مالکیت
        if ($transaction->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'دسترسی غیرمجاز'
            ], 403);
        }
        
        // بررسی وضعیت
        if ($transaction->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'این تراکنش قبلاً پرداخت شده است.'
            ]);
        }
        
        // پرداخت موفق از طریق درگاه
        $transaction->update([
            'status' => 'completed',
        ]);
        
        // افزایش موجودی کیف پول
        $wallet = $user->wallet;
        $wallet->increment('balance', $transaction->amount);
        
        return response()->json([
            'success' => true,
            'message' => 'پرداخت موفقیت‌آمیز بود. کیف پول شما شارژ شد.',
            'new_balance' => $wallet->balance
        ]);
    }
    
    /**
     * لیست تراکنش‌ها (فقط موفق)
     */
    public function transactions()
    {
        // فقط تراکنش‌های موفق
        $transactions = Auth::user()->walletTransactions()
            ->where('status', 'completed')
            ->latest()
            ->paginate(15);
        
        return view('user.wallet.transactions', compact('transactions'));
    }
}