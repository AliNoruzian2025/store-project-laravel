<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تکمیل خرید - فروشگاه آنلاین</title>
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
            background-color: #f8fafc;
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

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
        .checkout-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* کارت خرید */
        .order-summary {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 25px;
        }

        .summary-title {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px 0;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 6px;
            background: #f8fafc;
        }

        .order-item-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            background: white;
            border-radius: 6px;
            padding: 5px;
            border: 1px solid var(--border);
        }

        .order-item-info {
            flex: 1;
        }

        .order-item-name {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .order-item-details {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--gray);
        }

        .order-item-price {
            font-weight: 600;
            color: var(--danger);
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-top: 2px solid var(--primary);
            margin-top: 15px;
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

        /* روش‌های پرداخت */
        .payment-methods {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .methods-title {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
        }

        .method-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .method-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s;
        }

        .method-item:hover {
            border-color: var(--primary);
            background: #f8fafc;
        }

        .method-item.selected {
            border-color: var(--primary);
            background: rgba(79, 70, 229, 0.05);
        }

        .method-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .method-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .method-icon.wallet {
            background: linear-gradient(135deg, var(--success), #0da271);
        }

        .method-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .method-details p {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .wallet-balance {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: linear-gradient(135deg, var(--success), #0da271);
            color: white;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .insufficient-balance {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .continue-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            margin-top: 25px;
        }

        .continue-btn:hover {
            background: var(--primary-dark);
        }

        .continue-btn:disabled {
            background: var(--gray);
            cursor: not-allowed;
        }

        /* پیام‌ها */
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

        .info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* لودینگ */
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

        /* کیف پول کمبود */
        .wallet-insufficient {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: var(--radius);
            padding: 15px;
            margin-top: 15px;
            display: none;
        }

        .wallet-insufficient.show {
            display: block;
        }

        .insufficient-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .charge-btn {
            padding: 8px 15px;
            background: var(--success);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .online-pay-btn {
            padding: 8px 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
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
            
            .checkout-container {
                padding: 0 15px;
                margin: 20px auto;
            }
            
            .method-item {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .insufficient-actions {
                flex-direction: column;
            }
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

        <div class="header-actions">
            <a href="{{ route('cart.index') }}" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                بازگشت به سبد خرید
            </a>
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="checkout-container">
        <h1 class="page-title">
            <i class="fas fa-shopping-bag"></i>
            تکمیل خرید
        </h1>
        
        <!-- پیام‌ها -->
        <div id="message-container"></div>
        
        <!-- خلاصه سفارش -->
        <div class="order-summary">
            <h2 class="summary-title">
                <i class="fas fa-receipt"></i>
                خلاصه سفارش
            </h2>
            
            <div class="order-items">
                @foreach($cart->items as $item)
                <div class="order-item">
                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="order-item-image">
                    <div class="order-item-info">
                        <div class="order-item-name">{{ $item->product->name }}</div>
                        <div class="order-item-details">
                            <span>{{ $item->quantity }} عدد</span>
                            <span>×</span>
                            <span class="order-item-price">{{ number_format($item->product->final_price) }} تومان</span>
                        </div>
                    </div>
                    <div class="order-item-price">
                        {{ number_format($item->product->final_price * $item->quantity) }} تومان
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="order-total">
                <div class="total-label">مبلغ قابل پرداخت:</div>
                <div class="total-price">{{ number_format($totalAmount) }} تومان</div>
            </div>
        </div>
        
        <!-- روش‌های پرداخت -->
        <div class="payment-methods">
            <h2 class="methods-title">
                <i class="fas fa-credit-card"></i>
                انتخاب روش پرداخت
            </h2>
            
            <div class="method-list">
                <!-- پرداخت با کیف پول -->
                <div class="method-item" id="wallet-method" onclick="selectMethod('wallet')">
                    <div class="method-info">
                        <div class="method-icon wallet">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="method-details">
                            <h4>پرداخت از کیف پول</h4>
                            <p>پرداخت سریع و آسان از موجودی کیف پول</p>
                            @if($walletBalance < $totalAmount)
                                <div class="insufficient-balance" id="insufficient-wallet">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    موجودی کیف پول شما کافی نیست
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="wallet-balance">
                        <i class="fas fa-wallet"></i>
                        {{ number_format($walletBalance) }} تومان
                    </div>
                </div>
                
                <!-- پرداخت آنلاین -->
                <div class="method-item selected" id="online-method" onclick="selectMethod('online')">
                    <div class="method-info">
                        <div class="method-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="method-details">
                            <h4>پرداخت آنلاین</h4>
                            <p>پرداخت امن از طریق درگاه بانکی</p>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-lock" style="color: var(--success); font-size: 1.2rem;"></i>
                    </div>
                </div>
            </div>
            
            <!-- کیف پول کمبود -->
            <div class="wallet-insufficient" id="wallet-insufficient-box">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <i class="fas fa-exclamation-circle" style="color: #e74c3c;"></i>
                    <strong>موجودی کیف پول شما کافی نیست!</strong>
                </div>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">
                    برای پرداخت این سفارش به <span id="needed-amount" style="font-weight: bold; color: #e74c3c;">0</span> تومان دیگر نیاز دارید.
                </p>
                <div class="insufficient-actions">
                    <button class="charge-btn" onclick="chargeWallet()">
                        <i class="fas fa-bolt"></i>
                        شارژ کیف پول
                    </button>
                    <button class="online-pay-btn" onclick="selectMethod('online')">
                        <i class="fas fa-credit-card"></i>
                        پرداخت آنلاین
                    </button>
                </div>
            </div>
            
            <button class="continue-btn" id="continue-btn" onclick="continuePayment()">
                <i class="fas fa-arrow-left"></i>
                ادامه فرآیند خرید
            </button>
        </div>
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
        <span style="margin-right: 10px;">در حال پردازش...</span>
    </div>

    <script>
        let selectedMethod = 'online';
        
        // انتخاب روش پرداخت
        function selectMethod(method) {
            selectedMethod = method;
            
            // بروزرسانی UI
            document.querySelectorAll('.method-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            if (method === 'wallet') {
                document.getElementById('wallet-method').classList.add('selected');
                
                // بررسی موجودی کیف پول
                const walletBalance = {{ $walletBalance }};
                const totalAmount = {{ $totalAmount }};
                
                if (walletBalance < totalAmount) {
                    document.getElementById('wallet-insufficient-box').classList.add('show');
                    document.getElementById('needed-amount').textContent = (totalAmount - walletBalance).toLocaleString();
                    document.getElementById('continue-btn').disabled = true;
                } else {
                    document.getElementById('wallet-insufficient-box').classList.remove('show');
                    document.getElementById('continue-btn').disabled = false;
                }
            } else {
                document.getElementById('online-method').classList.add('selected');
                document.getElementById('wallet-insufficient-box').classList.remove('show');
                document.getElementById('continue-btn').disabled = false;
            }
        }
        
        // شارژ کیف پول
        function chargeWallet() {
            window.location.href = "{{ route('user.wallet.index') }}";
        }
        
        // ادامه فرآیند خرید
        async function continuePayment() {
            const loading = document.getElementById('loading');
            const button = document.getElementById('continue-btn');
            const originalText = button.innerHTML;
            
            try {
                loading.style.display = 'block';
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال پردازش...';
                
                if (selectedMethod === 'wallet') {
                    // پرداخت با کیف پول
                    const response = await fetch("{{ route('checkout.wallet') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({})
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        showMessage('پرداخت با موفقیت انجام شد! در حال انتقال...', 'success');
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        if (data.needed) {
                            document.getElementById('needed-amount').textContent = data.needed.toLocaleString();
                            document.getElementById('wallet-insufficient-box').classList.add('show');
                            showMessage(data.message, 'error');
                        } else {
                            showMessage(data.message, 'error');
                        }
                    }
                } else {
                    // پرداخت آنلاین
                    window.location.href = "{{ route('checkout.online') }}";
                }
            } catch (error) {
                showMessage('خطا در ارتباط با سرور', 'error');
            } finally {
                loading.style.display = 'none';
                button.disabled = false;
                button.innerHTML = originalText;
            }
        }
        
        // نمایش پیام
        function showMessage(text, type = 'success') {
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
        
        // بررسی اولیه کیف پول
        document.addEventListener('DOMContentLoaded', function() {
            const walletBalance = {{ $walletBalance }};
            const totalAmount = {{ $totalAmount }};
            
            if (walletBalance >= totalAmount) {
                // اگر کیف پول کافی است، پرداخت با کیف پول را پیش‌فرض انتخاب کن
                selectMethod('wallet');
            }
        });
    </script>
</body>
</html>