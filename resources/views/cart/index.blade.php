<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبد خرید - فروشگاه آنلاین</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #1f2937;
            --success: #10b981;
            --danger: #ef4444;
            --light: #f9fafb;
            --dark: #111827;
            --gray: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 1px 3px rgba(0,0,0,0.1);
            --radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', 'Segoe UI', sans-serif;
        }

        body {
            background-color: #fff;
            min-height: 100vh;
            color: #333;
        }

        /* هدر */
        .header {
            background: white;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--secondary);
        }

        .logo h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .search-form {
            flex: 1;
            min-width: 250px;
            max-width: 400px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 14px;
            background: #fff;
            text-align: right;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .search-btn {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 16px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 18px;
            padding: 8px;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 11px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* کیف پول در هدر */
        .wallet-balance {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: linear-gradient(135deg, var(--success), #0da271);
            color: white;
            border-radius: 15px;
            font-weight: 500;
            font-size: 13px;
        }

        /* دکمه بازگشت */
        .back-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 13px;
            border: 1px solid var(--primary);
        }

        .back-btn:hover {
            background: white;
            color: var(--primary);
        }

        /* محتوای اصلی */
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* عنوان */
        .page-title {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* پیام سبد خرید خالی */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .empty-cart i {
            font-size: 3.5rem;
            color: var(--primary);
            opacity: 0.5;
            margin-bottom: 15px;
        }

        .empty-cart h3 {
            font-size: 1.3rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .empty-cart p {
            color: var(--gray);
            margin-bottom: 25px;
            font-size: 14px;
        }

        .btn-shopping {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 500;
            transition: all 0.3s;
            border: 1px solid var(--primary);
            font-size: 13px;
        }

        .btn-shopping:hover {
            background: white;
            color: var(--primary);
        }

        /* محتویات سبد خرید */
        .cart-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 25px;
        }

        @media (max-width: 992px) {
            .cart-content {
                grid-template-columns: 1fr;
            }
        }

        /* لیست محصولات */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-item {
            background: white;
            border-radius: var(--radius);
            padding: 15px;
            display: flex;
            gap: 15px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .cart-item-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            background: #f8fafc;
            border-radius: 6px;
            padding: 8px;
            border: 1px solid var(--border);
        }

        .cart-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cart-item-title {
            font-size: 1rem;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .cart-item-title a {
            color: inherit;
            text-decoration: none;
        }

        .cart-item-title a:hover {
            color: var(--primary);
        }

        .cart-item-category {
            font-size: 12px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cart-item-price {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .current-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--danger);
        }

        .old-price {
            font-size: 0.9rem;
            color: var(--gray);
            text-decoration: line-through;
            opacity: 0.7;
        }

        /* کنترل تعداد - حذف فلش‌ها */
        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: var(--radius);
            padding: 4px;
            border: 1px solid var(--border);
            width: fit-content;
        }

        .qty-btn {
            background: white;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: var(--dark);
            transition: all 0.3s;
            font-weight: bold;
        }

        .qty-btn:hover {
            background: var(--primary);
            color: white;
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 0.9rem;
            font-weight: bold;
            color: var(--dark);
            -moz-appearance: textfield; /* حذف فلش در فایرفاکس */
        }

        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none; /* حذف فلش در کروم و سافاری */
            margin: 0;
        }

        .remove-btn {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .remove-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* سایدبار خلاصه */
        .cart-summary {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            position: sticky;
            top: 80px;
            height: fit-content;
        }

        .summary-title {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #eee;
            font-size: 14px;
        }

        .summary-label {
            color: var(--gray);
        }

        .summary-value {
            font-weight: 500;
            color: var(--secondary);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            margin-top: 10px;
            border-top: 2px solid var(--primary);
        }

        .total-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .total-price {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--danger);
        }

        .summary-actions {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-continue {
            background: var(--light);
            color: var(--primary-dark);
            border: 1px solid var(--primary);
            padding: 10px;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
        }

        .btn-continue:hover {
            background: var(--primary);
            color: white;
        }

        .btn-checkout {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-checkout:hover {
            background: var(--primary-dark);
        }

        .btn-clear {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 8px;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .btn-clear:hover {
            background: var(--danger);
            color: white;
        }

        /* فوتر */
        .footer {
            background: var(--dark);
            color: white;
            padding: 25px 20px;
            margin-top: 40px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .footer-links a {
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .footer-links a:hover {
            color: white;
        }

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                padding: 12px;
            }
            
            .search-form {
                width: 100%;
                max-width: 100%;
                order: 3;
                margin-top: 10px;
            }
            
            .header-actions {
                width: 100%;
                justify-content: center;
            }
            
            .cart-item {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }
            
            .cart-item-image {
                width: 120px;
                height: 120px;
            }
            
            .cart-item-controls {
                justify-content: center;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .cart-summary {
                padding: 15px;
            }
            
            .total-price {
                font-size: 1.2rem;
            }
            
            .btn-checkout,
            .btn-continue,
            .btn-clear {
                padding: 8px;
                font-size: 12px;
            }
        }

        /* لودینگ و پیام‌ها */
        .loading {
            display: none;
            text-align: center;
            padding: 15px;
        }

        .loading i {
            font-size: 1.5rem;
            color: var(--primary);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .message {
            padding: 12px 15px;
            border-radius: var(--radius);
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: fadeIn 0.3s ease;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <a href="{{ route('home') }}" class="logo">
            <i class="fas fa-store" style="color: var(--primary); font-size: 24px;"></i>
            <h1>فروشگاه آنلاین</h1>
        </a>

        <!-- فرم جستجو -->
        <form class="search-form" method="GET" action="{{ route('home') }}">
            <input type="text" 
                   class="search-input" 
                   name="q" 
                   placeholder="جستجوی محصولات..."
                   value="">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- اکشن‌های کاربر -->
        <div class="header-actions">
            <!-- نمایش کیف پول برای کاربران لاگین کرده -->
            @auth
                @if(auth()->user()->getWalletBalance() > 0)
                    <div class="wallet-balance">
                        <i class="fas fa-wallet"></i>
                        {{ number_format(auth()->user()->getWalletBalance()) }}
                    </div>
                @endif
                
                <!-- دکمه بازگشت به فروشگاه -->
                <a href="{{ route('home') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به فروشگاه
                </a>
                
                <!-- آواتار کاربر -->
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" 
                   class="user-avatar" 
                   title="پروفایل"
                   style="width: 36px; height: 36px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @else
                <!-- اگر لاگین نیست -->
                <a href="{{ route('login') }}" class="back-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    ورود به حساب
                </a>
            @endauth
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="cart-container">
        <h1 class="page-title">
            <i class="fas fa-shopping-cart"></i>
            سبد خرید شما
        </h1>
        
        <!-- پیام‌ها -->
        <div id="message-container"></div>
        
        @if($cart->items->count() == 0)
            <!-- سبد خرید خالی -->
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>سبد خرید شما خالی است</h3>
                <p>محصولات مورد علاقه خود را به سبد خرید اضافه کنید</p>
                <a href="{{ route('home') }}" class="btn-shopping">
                    <i class="fas fa-store"></i>
                    بازگشت به فروشگاه
                </a>
            </div>
        @else
            <!-- محتوای سبد خرید -->
            <div class="cart-content">
                <!-- لیست محصولات -->
                <div class="cart-items">
                    @foreach($cart->items as $item)
                    <div class="cart-item" id="cart-item-{{ $item->id }}">
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="cart-item-image">
                        
                        <div class="cart-item-details">
                            <h3 class="cart-item-title">
                                <a href="{{ route('products.show', $item->product->id) }}">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            
                            @if($item->product->category)
                                <div class="cart-item-category">
                                    <i class="fas fa-tag"></i>
                                    {{ $item->product->category->name }}
                                </div>
                            @endif
                            
                            <div class="cart-item-price">
                                @if($item->product->discount_price && $item->product->discount_price < $item->product->price)
                                    <span class="current-price">{{ number_format($item->product->discount_price) }} تومان</span>
                                    <span class="old-price">{{ number_format($item->product->price) }} تومان</span>
                                @else
                                    <span class="current-price">{{ number_format($item->product->price) }} تومان</span>
                                @endif
                            </div>
                            
                            <div class="cart-item-controls">
                                <div class="quantity-control">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                    <input type="number" id="qty-{{ $item->id }}" class="qty-input" 
                                           value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           data-product-stock="{{ $item->product->stock }}">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                </div>
                                
                                <button class="remove-btn" onclick="removeItem({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- خلاصه سفارش -->
                <div class="cart-summary">
                    <h2 class="summary-title">
                        <i class="fas fa-receipt"></i>
                        خلاصه سفارش
                    </h2>
                    
                    <div class="summary-row">
                        <span class="summary-label">تعداد محصولات:</span>
                        <span class="summary-value">{{ $cart->total_items }} عدد</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">جمع کل:</span>
                        <span class="summary-value">{{ number_format($cart->total) }} تومان</span>
                    </div>
                    
                    <div class="total-row">
                        <span class="total-label">مبلغ قابل پرداخت:</span>
                        <span class="total-price">{{ number_format($cart->total) }} تومان</span>
                    </div>
                    
                    <div class="summary-actions">
                        <a href="{{ route('home') }}" class="btn-continue">
                            <i class="fas fa-arrow-right"></i>
                            ادامه خرید
                        </a>
                        
                        <button class="btn-checkout" onclick="window.location.href='{{ route('checkout.index') }}'">
                            <i class="fas fa-credit-card"></i>
                            ادامه فرآیند خرید
                        </button>
                        
                        <button class="btn-clear" onclick="clearCart()">
                            <i class="fas fa-trash"></i>
                            خالی کردن سبد خرید
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- فوتر -->
    <footer class="footer">
        <div class="footer-container">
            <div>
                <p>فروشگاه آنلاین © {{ date('Y') }} - تمامی حقوق محفوظ است</p>
            </div>
            <ul class="footer-links">
                <li><a href="#"><i class="fas fa-question-circle"></i> راهنمای خرید</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> تماس با ما</a></li>
                <li><a href="#"><i class="fas fa-shield-alt"></i> حریم خصوصی</a></li>
            </ul>
        </div>
    </footer>

    <!-- لودینگ -->
    <div class="loading" id="loading">
        <i class="fas fa-spinner"></i>
    </div>

    <script>
        // نمایش پیام
        function showMessage(type, text) {
            const container = document.getElementById('message-container');
            const message = document.createElement('div');
            message.className = `message ${type}`;
            message.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${text}</span>
            `;
            
            container.innerHTML = '';
            container.appendChild(message);
            
            setTimeout(() => {
                message.remove();
            }, 3000);
        }
        
        // نمایش لودینگ
        function showLoading(show) {
            document.getElementById('loading').style.display = show ? 'block' : 'none';
        }
        
        // به‌روزرسانی تعداد
        async function updateQuantity(itemId, change) {
            const input = document.getElementById(`qty-${itemId}`);
            const max = parseInt(input.dataset.productStock);
            let newQuantity = parseInt(input.value) + change;
            
            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > max) newQuantity = max;
            
            // به‌روزرسانی موقت UI
            input.value = newQuantity;
            
            // ارسال درخواست به سرور
            try {
                showLoading(true);
                const response = await fetch(`/cart/update/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // رفرش صفحه برای به‌روزرسانی قیمت‌ها
                    location.reload();
                }
            } catch (error) {
                showMessage('error', 'خطا در به‌روزرسانی تعداد');
            } finally {
                showLoading(false);
            }
        }
        
        // حذف محصول
        async function removeItem(itemId) {
            if (!confirm('آیا از حذف این محصول از سبد خرید اطمینان دارید؟')) {
                return;
            }
            
            try {
                showLoading(true);
                const response = await fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // حذف از UI
                    document.getElementById(`cart-item-${itemId}`).remove();
                    
                    // رفرش صفحه
                    location.reload();
                }
            } catch (error) {
                showMessage('error', 'خطا در حذف محصول');
            } finally {
                showLoading(false);
            }
        }
        
        // خالی کردن سبد خرید
        async function clearCart() {
            if (!confirm('آیا از خالی کردن سبد خرید اطمینان دارید؟')) {
                return;
            }
            
            try {
                showLoading(true);
                const response = await fetch('/cart/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // رفرش صفحه
                    location.reload();
                }
            } catch (error) {
                showMessage('error', 'خطا در خالی کردن سبد خرید');
            } finally {
                showLoading(false);
            }
        }
        
        // ادامه فرآیند خرید
        function checkout() {
            showMessage('success', 'به زودی فرآیند خرید کامل خواهد شد');
        }
        
        // به‌روزرسانی تعداد با تغییر مستقیم در input
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', async function() {
                const itemId = this.id.replace('qty-', '');
                const max = parseInt(this.dataset.productStock);
                let newQuantity = parseInt(this.value);
                
                if (newQuantity < 1) newQuantity = 1;
                if (newQuantity > max) newQuantity = max;
                
                this.value = newQuantity;
                
                try {
                    showLoading(true);
                    const response = await fetch(`/cart/update/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ quantity: newQuantity })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        location.reload();
                    }
                } catch (error) {
                    showMessage('error', 'خطا در به‌روزرسانی تعداد');
                } finally {
                    showLoading(false);
                }
            });
            
            // جلوگیری از ورود مستقیم عدد نامعتبر
            input.addEventListener('input', function() {
                const max = parseInt(this.dataset.productStock);
                const min = 1;
                let value = parseInt(this.value);
                
                if (isNaN(value)) value = min;
                if (value < min) value = min;
                if (value > max) value = max;
                
                this.value = value;
            });
        });
    </script>
</body>
</html>