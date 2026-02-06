<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - فروشگاه آنلاین</title>
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
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* ناوبری */
        .breadcrumb {
            background: white;
            padding: 12px 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            font-size: 14px;
            border: 1px solid var(--border);
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* اطلاعات محصول */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
            }
        }

        /* تصاویر محصول */
        .product-images {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .main-image-container {
            position: relative;
            width: 100%;
            height: 300px;
            background: #f8fafc;
            border-radius: var(--radius);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid var(--border);
        }

        .main-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* نشان تخفیف */
        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
        }

        /* اطلاعات محصول */
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .product-title {
            font-size: 1.5rem;
            color: var(--dark);
            font-weight: 600;
        }

        .product-category {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--gray);
            font-size: 14px;
        }

        /* قیمت محصول - کامپکت‌تر */
        .price-section {
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            margin: 15px 0;
            max-width: 300px; /* عرض کمتر */
        }

        .price-main {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 10px;
        }

        .price-amount {
            font-size: 1.6rem; /* کوچک‌تر */
            font-weight: bold;
            color: var(--danger);
        }

        .price-currency {
            font-size: 0.9rem; /* کوچک‌تر */
            color: var(--danger);
        }

        .old-price-section {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        .old-price {
            font-size: 0.9rem; /* کوچک‌تر */
            color: var(--gray);
            text-decoration: line-through;
            opacity: 0.7;
        }

        .price-label {
            font-size: 11px; /* کوچک‌تر */
            color: var(--gray);
            background: #e5e7eb;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* موجودی */
        .stock-status {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px; /* کوچک‌تر */
            border-radius: var(--radius);
            font-weight: 500;
            margin-bottom: 15px;
            font-size: 13px; /* کوچک‌تر */
            max-width: fit-content;
        }

        .in-stock {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .out-of-stock {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* توضیحات */
        .product-description {
            margin: 20px 0;
        }

        .description-title {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .description-content {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.7;
        }

        /* کنترل تعداد - حذف فلش‌ها */
        .product-actions {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: var(--radius);
            padding: 5px;
            border: 1px solid var(--border);
            width: fit-content;
        }

        .quantity-btn {
            background: white;
            border: none;
            width: 32px; /* کوچک‌تر */
            height: 32px; /* کوچک‌تر */
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--dark);
            transition: all 0.3s;
            font-weight: bold;
        }

        .quantity-btn:hover {
            background: var(--primary);
            color: white;
        }

        /* حذف فلش‌های بالا و پایین در input */
        .quantity-input {
            width: 45px; /* کوچک‌تر */
            text-align: center;
            border: none;
            background: transparent;
            font-size: 1rem;
            font-weight: bold;
            color: var(--dark);
            -moz-appearance: textfield; /* حذف فلش در فایرفاکس */
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none; /* حذف فلش در کروم و سافاری */
            margin: 0;
        }

        .btn-add-to-cart {
            flex: 1;
            min-width: 180px;
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px; /* کوچک‌تر */
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            height: 44px; /* ارتفاع برابر با quantity-selector */
        }

        .btn-add-to-cart:hover {
            background: var(--primary-dark);
        }

        .btn-add-to-cart:disabled {
            background: var(--gray);
            cursor: not-allowed;
        }

        /* محصولات مرتبط */
        .related-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 1.2rem;
            color: var(--dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .related-products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .related-product {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 260px; /* ارتفاع ثابت */
        }

        .related-product:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .related-image {
            width: 100%;
            height: 120px;
            object-fit: contain;
            background: #f8fafc;
            padding: 10px;
        }

        .related-info {
            padding: 12px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center; /* وسط‌چین */
            text-align: center; /* متن وسط‌چین */
        }

        .related-name {
            font-size: 13px;
            margin-bottom: 8px;
            height: 40px;
            overflow: hidden;
            line-height: 1.3;
            width: 100%;
        }

        .related-price {
            font-size: 14px;
            font-weight: bold;
            color: var(--danger);
            margin-top: auto; /* فشار دادن به پایین */
            padding: 5px 0;
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
            .price-section {
                max-width: 100%;
            }
            
            .related-products {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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
                
                <!-- سبد خرید -->
                <button class="action-btn cart-btn" onclick="window.location.href='{{ route('cart.index') }}'">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                </button>
                
                <!-- آواتار کاربر -->
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" 
                   class="user-avatar" 
                   title="پروفایل"
                   style="width: 36px; height: 36px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @else
                <!-- دکمه بازگشت -->
                <a href="{{ route('home') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            @endauth
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="product-container">
        <!-- ناوبری -->
        <div class="breadcrumb">
            <a href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                صفحه اصلی
            </a>
            <span style="color: var(--gray);">/</span>
            @if($product->category)
                <a href="{{ route('home', ['category' => $product->category_id]) }}">
                    {{ $product->category->name }}
                </a>
                <span style="color: var(--gray);">/</span>
            @endif
            <span>{{ $product->name }}</span>
        </div>

        <!-- اطلاعات اصلی محصول -->
        <div class="product-detail">
            <!-- تصاویر -->
            <div class="product-images">
                <div class="main-image-container">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="main-image">
                    <!-- نشان درصد تخفیف -->
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <div class="discount-badge">
                            {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                        </div>
                    @endif
                </div>
            </div>

            <!-- اطلاعات -->
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                
                @if($product->category)
                    <div class="product-category">
                        <i class="fas fa-tag"></i>
                        دسته‌بندی: {{ $product->category->name }}
                    </div>
                @endif

                <!-- قیمت -->
                <div class="price-section">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <div class="price-main">
                            <span class="price-amount">{{ number_format($product->discount_price) }}</span>
                            <span class="price-currency">تومان</span>
                        </div>
                        <div class="old-price-section">
                            <span class="old-price">{{ number_format($product->price) }}</span>
                            <span class="price-label">قیمت قبل</span>
                        </div>
                    @else
                        <div class="price-main">
                            <span class="price-amount">{{ number_format($product->price) }}</span>
                            <span class="price-currency">تومان</span>
                        </div>
                    @endif
                </div>

                <!-- موجودی -->
                <div class="stock-status {{ $product->is_in_stock ? 'in-stock' : 'out-of-stock' }}">
                    <i class="fas {{ $product->is_in_stock ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    {{ $product->is_in_stock ? 'موجود در انبار' : 'ناموجود' }}
                    @if($product->is_in_stock)
                        <span style="margin-right: 10px;">({{ $product->stock }} عدد)</span>
                    @endif
                </div>

                <!-- توضیحات -->
                @if($product->description)
                    <div class="product-description">
                        <h3 class="description-title">
                            <i class="fas fa-align-right"></i>
                            توضیحات محصول
                        </h3>
                        <div class="description-content">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                @endif

                <!-- اقدامات -->
                <div class="product-actions">
                    @if($product->is_in_stock)
                        <div class="quantity-selector">
                            <button class="quantity-btn" onclick="updateQuantity(-1)">-</button>
                            <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="{{ $product->stock }}">
                            <button class="quantity-btn" onclick="updateQuantity(1)">+</button>
                        </div>
                        
                        <button class="btn-add-to-cart" onclick="addToCart()" id="add-to-cart-btn">
                            <i class="fas fa-cart-plus"></i>
                            افزودن به سبد خرید
                        </button>
                    @else
                        <button class="btn-add-to-cart" disabled>
                            <i class="fas fa-bell"></i>
                            اطلاع‌رسانی هنگام موجود شدن
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- محصولات مرتبط -->
        @if($relatedProducts->count() > 0)
            <div class="related-section">
                <h2 class="section-title">
                    <i class="fas fa-box"></i>
                    محصولات مشابه
                </h2>
                
                <div class="related-products">
                    @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="related-product">
                        <img src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" class="related-image">
                        <div class="related-info">
                            <div class="related-name">{{ $relatedProduct->name }}</div>
                            <div class="related-price">{{ number_format($relatedProduct->final_price) }} تومان</div>
                        </div>
                    </a>
                    @endforeach
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

    <script>
        // کنترل تعداد محصول
        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) + change;
            const max = parseInt(input.max);
            const min = parseInt(input.min);
            
            if (value < min) value = min;
            if (value > max) value = max;
            
            input.value = value;
        }
        
        // افزودن به سبد خرید
        async function addToCart() {
            const productId = {{ $product->id }};
            const quantity = document.getElementById('quantity').value;
            const button = document.getElementById('add-to-cart-btn');
            
            @auth
                try {
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال افزودن...';
                    
                    const response = await fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ quantity: quantity })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // به‌روزرسانی شمارنده سبد خرید
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.cart_count;
                        }
                        
                        // نمایش پیام موفقیت
                        button.innerHTML = '<i class="fas fa-check"></i> اضافه شد';
                        button.style.background = '#10b981';
                        
                        setTimeout(() => {
                            button.innerHTML = '<i class="fas fa-cart-plus"></i> افزودن به سبد خرید';
                            button.style.background = '';
                            button.disabled = false;
                        }, 1500);
                    }
                } catch (error) {
                    button.innerHTML = '<i class="fas fa-times"></i> خطا!';
                    button.style.background = '#ef4444';
                    setTimeout(() => {
                        button.innerHTML = '<i class="fas fa-cart-plus"></i> افزودن به سبد خرید';
                        button.style.background = '';
                        button.disabled = false;
                    }, 1500);
                }
            @else
                // اگر کاربر لاگین نیست
                if (confirm('برای افزودن به سبد خرید باید وارد حساب کاربری خود شوید. آیا می‌خواهید وارد شوید؟')) {
                    window.location.href = '{{ route("login") }}';
                }
            @endauth
        }
        
        // جلوگیری از ورود مستقیم عدد در input
        document.getElementById('quantity').addEventListener('input', function() {
            const max = parseInt(this.max);
            const min = parseInt(this.min);
            let value = parseInt(this.value);
            
            if (isNaN(value)) value = min;
            if (value < min) value = min;
            if (value > max) value = max;
            
            this.value = value;
        });
    </script>
</body>
</html>