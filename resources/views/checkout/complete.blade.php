<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تکمیل سفارش #{{ $order->id }} - فروشگاه آنلاین</title>
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
        .complete-container {
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

        /* کارت سفارش */
        .order-card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 25px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
        }

        .order-number {
            font-size: 1.3rem;
            color: var(--secondary);
            font-weight: 600;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        /* آیتم‌های سفارش */
        .order-items {
            margin-bottom: 25px;
        }

        .items-title {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
            background: #f8fafc;
            border-radius: 6px;
            padding: 5px;
            border: 1px solid var(--border);
        }

        .item-name {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .item-quantity {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .item-price {
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
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--danger);
        }

        /* فرم آدرس */
        .address-form {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .form-title {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 5px;
        }

        .submit-btn {
            width: 100%;
            background: var(--success);
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
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #0da271;
        }

        .info-box {
            background: #e8f4fd;
            border: 1px solid #b3e0ff;
            border-radius: var(--radius);
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-box i {
            color: #3498db;
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
            
            .complete-container {
                padding: 0 15px;
                margin: 20px auto;
            }
            
            .item-row {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            
            .item-price {
                align-self: flex-end;
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
            <a href="{{ route('user.orders.index') }}" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                بازگشت به سفارشات
            </a>
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="complete-container">
        <h1 class="page-title">
            <i class="fas fa-check-circle"></i>
            تکمیل اطلاعات سفارش
        </h1>
        
        <!-- پیام‌ها -->
        <div id="message-container"></div>
        
        <!-- کارت سفارش -->
        <div class="order-card">
            <div class="order-header">
                <div class="order-number">سفارش #{{ $order->id }}</div>
                <span class="badge badge-success">
                    پرداخت موفق
                </span>
            </div>
            
            <div class="order-items">
                <h3 class="items-title">
                    <i class="fas fa-box"></i>
                    آیتم‌های سفارش
                </h3>
                
                @foreach($order->items as $item)
                <div class="item-row">
                    <div class="item-info">
                        <img src="{{ $item->product->image ?? '' }}" alt="{{ $item->product_name }}" class="item-image">
                        <div>
                            <div class="item-name">{{ $item->product_name }}</div>
                            <div class="item-quantity">{{ $item->quantity }} عدد</div>
                        </div>
                    </div>
                    <div class="item-price">{{ number_format($item->total_price) }} تومان</div>
                </div>
                @endforeach
                
                <div class="order-total">
                    <div class="total-label">مبلغ کل سفارش:</div>
                    <div class="total-price">{{ number_format($order->total_amount) }} تومان</div>
                </div>
            </div>
        </div>
        
        <!-- فرم آدرس -->
        <div class="address-form">
            <h2 class="form-title">
                <i class="fas fa-map-marker-alt"></i>
                اطلاعات ارسال
            </h2>
            
            <div class="info-box">
                <p style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
                    <i class="fas fa-info-circle"></i>
                    <strong>لطفاً آدرس ارسال سفارش را وارد کنید:</strong>
                </p>
                <p style="font-size: 0.9rem; color: #666;">
                    این آدرس برای پروفایل شما نیز ذخیره خواهد شد و در خرید‌های بعدی می‌توانید از آن استفاده کنید.
                </p>
            </div>
            
            <form id="address-form" method="POST" action="{{ route('checkout.ship', $order->id) }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">آدرس کامل</label>
                    <textarea name="address" class="form-control" rows="4" required
                              placeholder="استان، شهر، خیابان، کوچه، پلاک، واحد">{{ auth()->user()->address }}</textarea>
                    <div class="form-text">لطفاً آدرس دقیق و کامل را وارد کنید</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">کد پستی</label>
                    <input type="text" name="postal_code" class="form-control" required
                           value="{{ auth()->user()->postal_code }}"
                           placeholder="مثال: 1234567890"
                           pattern="\d{10}"
                           maxlength="10">
                    <div class="form-text">کد پستی باید 10 رقم باشد</div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    ثبت و ارسال سفارش
                </button>
            </form>
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

    <script>
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
        
        // اعتبارسنجی کد پستی
        document.getElementById('address-form').addEventListener('submit', function(e) {
            const postalCode = document.querySelector('input[name="postal_code"]');
            const address = document.querySelector('textarea[name="address"]');
            
            if (!address.value.trim()) {
                e.preventDefault();
                showMessage('لطفاً آدرس را وارد کنید', 'error');
                address.focus();
                return;
            }
            
            if (!postalCode.value.match(/^\d{10}$/)) {
                e.preventDefault();
                showMessage('کد پستی باید 10 رقم باشد', 'error');
                postalCode.focus();
                return;
            }
        });
        
        // فقط اعداد برای کد پستی
        document.querySelector('input[name="postal_code"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    </script>
</body>
</html>