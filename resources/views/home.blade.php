<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        /* استایل اصلی */
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
            line-height: 1.6;
        }

        /* هدر ساده */
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

        .wallet-balance i {
            font-size: 14px;
        }

        /* دکمه ورود */
        .login-btn {
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

        .login-btn:hover {
            background: white;
            color: var(--primary);
        }

        /* ساختار صفحه */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .page-container {
                grid-template-columns: 1fr;
            }
        }

        /* سایدبار دسته‌بندی‌ها */
        .sidebar {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            height: fit-content;
            position: sticky;
            top: 80px;
            border: 1px solid var(--border);
        }

        .sidebar-title {
            font-size: 1rem;
            margin-bottom: 15px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        .category-list {
            list-style: none;
        }

        .category-item {
            margin-bottom: 8px;
        }

        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: #fff;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--dark);
            transition: all 0.3s;
            border: 1px solid var(--border);
            font-size: 14px;
        }

        .category-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .category-link.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .category-count {
            background: var(--light);
            color: var(--gray);
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 11px;
        }

        /* نتایج جستجو */
        .search-results {
            background: var(--light);
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--border);
            font-size: 14px;
        }

        .search-results span {
            color: var(--primary);
            font-weight: 600;
        }

        .clear-search {
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
            background: white;
            padding: 6px 12px;
            border-radius: 15px;
            border: 1px solid var(--primary);
        }

        /* محصولات */
        .section-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* کارت‌های محصول کوچک */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .product-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            position: relative;
            border: 1px solid var(--border);
            height: 340px; /* ارتفاع ثابت */
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* لینک‌ها بدون underline */
        .product-image-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .product-title-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .product-title-link:hover .product-title {
            color: var(--primary);
        }

        /* تصویر محصول */
        .product-image-container {
            width: 100%;
            height: 140px;
            overflow: hidden;
            position: relative;
            background: #f8fafc;
            padding: 15px;
            flex-shrink: 0;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* نشان تخفیف روی تصویر */
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 11px;
            z-index: 2;
        }

        /* محتوای کارت */
        .product-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 14px;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.4;
            height: 40px;
            overflow: hidden;
            font-weight: 500;
        }

        /* بخش قیمت با ارتفاع ثابت */
        .product-price-container {
            margin-top: auto;
            padding: 10px;
            background: #f8fafc;
            border-radius: 6px;
            margin-bottom: 10px;
            min-height: 70px; /* ارتفاع ثابت برای کادر قیمت */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* قیمت با تخفیف */
        .price-with-discount {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .discounted-price-section {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 5px;
        }

        .final-price {
            font-size: 16px;
            font-weight: bold;
            color: var(--danger);
        }

        .currency {
            font-size: 12px;
            color: var(--danger);
        }

        .original-price-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .original-price {
            font-size: 13px;
            color: var(--gray);
            text-decoration: line-through;
            opacity: 0.7;
        }

        .price-label {
            font-size: 11px;
            color: var(--gray);
            background: #e5e7eb;
            padding: 2px 6px;
            border-radius: 3px;
        }

        /* قیمت بدون تخفیف */
        .price-without-discount {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 5px;
        }

        /* دکمه افزودن به سبد */
        .btn-add-cart {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13px;
        }

        .btn-add-cart:hover {
            background: var(--primary-dark);
        }

        .btn-add-cart.added {
            background: var(--success);
        }

        /* صفحه‌بندی */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 14px;
            background: white;
            border-radius: 6px;
            text-decoration: none;
            color: var(--dark);
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid var(--border);
            font-size: 14px;
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination .current {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* پیام عدم وجود محصول */
        .no-products {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .no-products i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary);
            opacity: 0.5;
        }

        .no-products h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        /* فوتر ساده */
        .footer {
            background: var(--dark);
            color: white;
            padding: 30px 20px;
            margin-top: 50px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
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
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 12px;
            }
            
            .product-card {
                height: 320px;
            }
            
            .product-image-container {
                height: 120px;
                padding: 12px;
            }
            
            .footer-container {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }
            
            .product-card {
                height: 300px;
            }
            
            .product-title {
                font-size: 13px;
            }
            
            .final-price {
                font-size: 14px;
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
                   value="{{ $searchQuery ?? '' }}">
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
                <!-- اگر لاگین نیست فقط دکمه ورود -->
                <a href="{{ route('login') }}" class="login-btn" title="ورود به حساب">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>ورود</span>
                </a>
            @endauth
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="page-container">
        <!-- سایدبار دسته‌بندی‌ها -->
        <aside class="sidebar">
            <h2 class="sidebar-title">
                <i class="fas fa-list"></i>
                دسته‌بندی‌ها
            </h2>
            
            <ul class="category-list">
                <!-- همه دسته‌بندی‌ها -->
                <li class="category-item">
                    <a href="{{ route('home') }}" 
                       class="category-link {{ !$categoryId ? 'active' : '' }}">
                        <span>همه محصولات</span>
                        <span class="category-count">{{ $categories->sum('products_count') }}</span>
                    </a>
                </li>
                
                <!-- دسته‌بندی‌ها -->
                @foreach($categories as $category)
                <li class="category-item">
                    <a href="{{ route('home', ['category' => $category->id]) }}" 
                       class="category-link {{ $categoryId == $category->id ? 'active' : '' }}">
                        <span>{{ $category->name }}</span>
                        <span class="category-count">{{ $category->products_count }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>

        <!-- محصولات -->
        <main>
            <!-- نتایج جستجو -->
            @if($searchQuery)
            <div class="search-results">
                <div>
                    <i class="fas fa-search"></i>
                    نتایج جستجو برای: <span>"{{ $searchQuery }}"</span>
                </div>
                <a href="{{ route('home') }}" class="clear-search">
                    <i class="fas fa-times"></i>
                    حذف جستجو
                </a>
            </div>
            @endif

            <h2 class="section-title">
                <i class="fas fa-box"></i>
                @if($categoryId && $categories->where('id', $categoryId)->first())
                    {{ $categories->where('id', $categoryId)->first()->name }}
                @else
                    محصولات
                @endif
            </h2>
            
            @if($products->count() > 0)
                <div class="products-grid">
                    @foreach($products as $product)
                    <div class="product-card">
                        <!-- لینک روی تصویر -->
                        <a href="{{ route('products.show', $product->id) }}" class="product-image-link">
                            <div class="product-image-container">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <div class="discount-badge">
                                        {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <div class="product-content">
                            <!-- لینک روی عنوان -->
                            <a href="{{ route('products.show', $product->id) }}" class="product-title-link">
                                <h3 class="product-title">{{ $product->name }}</h3>
                            </a>
                            
                            <!-- بخش قیمت با ارتفاع ثابت -->
                            <div class="product-price-container">
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <!-- اگر تخفیف دارد -->
                                    <div class="price-with-discount">
                                        <div class="discounted-price-section">
                                            <span class="final-price">{{ number_format($product->final_price) }}</span>
                                            <span class="currency">تومان</span>
                                        </div>
                                        <div class="original-price-section">
                                            <span class="original-price">{{ number_format($product->price) }}</span>
                                            <span class="price-label">قیمت قبل</span>
                                        </div>
                                    </div>
                                @else
                                    <!-- اگر تخفیف ندارد -->
                                    <div class="price-without-discount">
                                        <span class="final-price">{{ number_format($product->final_price) }}</span>
                                        <span class="currency">تومان</span>
                                    </div>
                                @endif
                            </div>
                            
                            <button class="btn-add-cart" data-id="{{ $product->id }}" onclick="addToCart({{ $product->id }})">
                                <i class="fas fa-cart-plus"></i>
                                افزودن به سبد
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- صفحه‌بندی -->
                @if($products->hasPages())
                <div class="pagination">
                    @if($products->onFirstPage())
                        <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    @endif

                    @for($page = 1; $page <= $products->lastPage(); $page++)
                        @if($page == $products->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $products->url($page) }}">{{ $page }}</a>
                        @endif
                    @endfor

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                    @else
                        <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                    @endif
                </div>
                @endif
            @else
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>محصولی یافت نشد</h3>
                    <p>@if($searchQuery)هیچ محصولی با عبارت "{{ $searchQuery }}" یافت نشد.@else در حال حاضر محصولی در این دسته‌بندی موجود نیست.@endif</p>
                    <a href="{{ route('home') }}" class="login-btn" style="margin-top: 15px; display: inline-block;">
                        <i class="fas fa-home"></i>
                        بازگشت به صفحه اصلی
                    </a>
                </div>
            @endif
        </main>
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
        // افزودن به سبد خرید
        async function addToCart(productId) {
            @auth
                try {
                    const button = document.querySelector(`.btn-add-cart[data-id="${productId}"]`);
                    const originalHTML = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    button.disabled = true;
                    
                    const response = await fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ quantity: 1 })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // به‌روزرسانی شمارنده سبد خرید
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.cart_count;
                        }
                        
                        // نمایش تأیید
                        button.innerHTML = '<i class="fas fa-check"></i> اضافه شد';
                        button.classList.add('added');
                        
                        setTimeout(() => {
                            button.innerHTML = originalHTML;
                            button.disabled = false;
                            button.classList.remove('added');
                        }, 1500);
                    } else {
                        button.innerHTML = originalHTML;
                        button.disabled = false;
                        alert('خطا در افزودن به سبد خرید');
                    }
                } catch (error) {
                    alert('خطا در ارتباط با سرور');
                }
            @else
                // اگر کاربر لاگین نیست
                if (confirm('برای افزودن به سبد خرید باید وارد حساب کاربری خود شوید. آیا می‌خواهید وارد شوید؟')) {
                    window.location.href = '{{ route("login") }}';
                }
            @endauth
        }

        // جستجوی لحظه‌ای
        const searchInput = document.querySelector('.search-input');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            
            if (this.value.length > 2 || this.value.length === 0) {
                searchTimeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            }
        });
    </script>
</body>
</html>