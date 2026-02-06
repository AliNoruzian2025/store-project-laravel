<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }
        
        return view('cart.index', compact('cart'));
    }
    
    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);
        
        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);
        
        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        
        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'محصول به سبد خرید اضافه شد',
            'cart_count' => $cart->items->sum('quantity')
        ]);
    }
    
    public function update(CartItem $cartItem, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->product->stock
        ]);
        
        $cartItem->update(['quantity' => $request->quantity]);
        
        return response()->json([
            'success' => true,
            'message' => 'تعداد محصول بروزرسانی شد'
        ]);
    }
    
    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'محصول از سبد خرید حذف شد'
        ]);
    }
    
    public function clear()
    {
        $user = Auth::user();
        $cart = $user->cart;
        
        if ($cart) {
            $cart->items()->delete();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'سبد خرید خالی شد'
        ]);
    }
    
    public function checkout()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است.');
        }
        
        return redirect()->route('checkout.index');
    }
}