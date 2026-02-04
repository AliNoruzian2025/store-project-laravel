<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* استایل اصلی */
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #2ecc71;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border: #dee2e6;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* هدر */
        .header {
            background: white;
            box-shadow: var(--shadow);
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--primary);
        }

        .logo h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .search-form {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 16px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-size: 16px;
            background: #f8f9fa;
            text-align: right;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
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
            font-size: 18px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 20px;
            padding: 8px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
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
            font-size: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* دکمه ورود */
        .login-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 500;
            transition: all 0.3s;
            font-size: 14px;
        }

        .login-btn:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
        }

        /* آواتار کاربر */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow);
        }

        /* ساختار صفحه */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* سایدبار دسته‌بندی‌ها */
        .sidebar {
            background: white;
            border-radius: var(--radius);
            padding: 25px 20px;
            box-shadow: var(--shadow);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .sidebar-title {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border);
        }

        .category-list {
            list-style: none;
        }

        .category-item {
            margin-bottom: 10px;
        }

        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--dark);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .category-link:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-5px);
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
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .category-link:hover .category-count,
        .category-link.active .category-count {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        /* نتایج جستجو */
        .search-results {
            background: #e8f4ff;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .search-results span {
            color: var(--primary);
            font-weight: 500;
        }

        .clear-search {
            color: var(--danger);
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .clear-search:hover {
            text-decoration: underline;
        }

        /* محصولات */
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background: #f8f9fa;
            padding: 20px;
            transition: transform 0.3s;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--dark);
            height: 50px;
            overflow: hidden;
            line-height: 1.4;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .discount-price {
            font-size: 1rem;
            color: var(--gray);
            text-decoration: line-through;
        }

        .discount-badge {
            background: var(--danger);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-add-cart {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
            gap: 10px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 15px;
            background: white;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--dark);
            box-shadow: var(--shadow);
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
        }

        .pagination .current {
            background: var(--primary);
            color: white;
        }

        /* پیام عدم وجود محصول */
        .no-products {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .no-products i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--gray);
        }

        /* فوتر */
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
        }

        .footer-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .page-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: static;
            }
            
            .header {
                flex-direction: column;
                text-align: center;
            }
            
            .search-form {
                width: 100%;
                max-width: 100%;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .header-actions {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <a href="{{ url('/') }}" class="logo">
            <i class="fas fa-store"></i>
            <h1>فروشگاه ما</h1>
        </a>

        <!-- فرم جستجو -->
        <form class="search-form" method="GET" action="{{ url('/') }}">
            <input type="text" 
                   class="search-input" 
                   name="q" 
                   placeholder="نام محصول، برند یا توضیحات..."
                   value="{{ $searchQuery ?? '' }}">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- اکشن‌های کاربر -->
        <div class="header-actions">
            <!-- سبد خرید -->
            <button class="action-btn cart-btn" onclick="window.location.href='/cart'">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </button>

            <!-- کاربر / ورود -->
            @auth
                <a href="/dashboard" class="user-avatar" title="پروفایل">
                    <i class="fas fa-user"></i>
                </a>
            @else
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
                    <a href="{{ url('/') }}" 
                       class="category-link {{ !$categoryId ? 'active' : '' }}">
                        <span>همه محصولات</span>
                        <span class="category-count">{{ $categories->sum('products_count') }}</span>
                    </a>
                </li>
                
                <!-- دسته‌بندی‌ها -->
                @foreach($categories as $category)
                <li class="category-item">
                    <a href="{{ url('/') }}?category={{ $category->id }}" 
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
                <a href="{{ url('/') }}" class="clear-search">
                    <i class="fas fa-times"></i>
                    حذف فیلتر
                </a>
            </div>
            @endif

            <h2 class="section-title">
                <i class="fas fa-box"></i>
                @if($categoryId)
                    {{ $categories->where('id', $categoryId)->first()->name ?? 'دسته‌بندی' }}
                @else
                    همه محصولات
                @endif
                @if($searchQuery)
                    <span style="font-size: 1rem; color: var(--gray);">(نتایج جستجو)</span>
                @endif
            </h2>
            
            @if($products->count() > 0)
                <div class="products-grid">
                    @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-price">
                                @if($product->discount_price)
                                    <span class="discount-price">{{ number_format($product->price) }}</span>
                                    <span>{{ number_format($product->discount_price) }}</span>
                                    <span class="discount-badge">
                                        {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    </span>
                                @else
                                    <span>{{ number_format($product->price) }}</span>
                                @endif
                                <span style="font-size: 0.9rem; color: var(--gray);">تومان</span>
                            </div>
                            <button class="btn-add-cart" data-id="{{ $product->id }}">
                                <i class="fas fa-cart-plus"></i>
                                افزودن به سبد خرید
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- صفحه‌بندی -->
                @if($products->hasPages())
                <div class="pagination">
                    {{ $products->links('pagination::simple-tailwind') }}
                </div>
                @endif
            @else
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>محصولی یافت نشد</h3>
                    <p>@if($searchQuery)هیچ محصولی با عبارت "{{ $searchQuery }}" یافت نشد.@else در حال حاضر محصولی در این دسته‌بندی موجود نیست.@endif</p>
                    <a href="{{ url('/') }}" class="login-btn" style="margin-top: 15px; display: inline-block;">
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
                <p>فروشگاه آنلاین © 2024 - تمامی حقوق محفوظ است</p>
            </div>
            <ul class="footer-links">
                <li><a href="#"><i class="fas fa-question-circle"></i> سوالات متداول</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> تماس با ما</a></li>
                <li><a href="#"><i class="fas fa-shield-alt"></i> حریم خصوصی</a></li>
            </ul>
        </div>
    </footer>

    <script>
        // افزودن به سبد خرید
        document.querySelectorAll('.btn-add-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;
                const cartCount = document.querySelector('.cart-count');
                
                // ذخیره در LocalStorage
                let cart = JSON.parse(localStorage.getItem('cart') || '[]');
                
                // بررسی وجود محصول در سبد
                const existingItem = cart.find(item => item.id === productId);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id: productId,
                        quantity: 1,
                        addedAt: new Date().toISOString()
                    });
                }
                
                localStorage.setItem('cart', JSON.stringify(cart));
                
                // افزایش شمارنده
                let count = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = count + 1;
                
                // نمایش تأیید
                const originalHTML = this.innerHTML;
                const originalBg = this.style.background;
                
                this.innerHTML = '<i class="fas fa-check"></i> اضافه شد';
                this.style.background = 'var(--success)';
                this.classList.add('added');
                
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.style.background = originalBg;
                    this.classList.remove('added');
                }, 1500);
                
                // انیمیشن شمارنده
                cartCount.style.transform = 'scale(1.3)';
                setTimeout(() => {
                    cartCount.style.transform = 'scale(1)';
                }, 300);
            });
        });

        // بارگذاری تعداد سبد خرید از LocalStorage
        document.addEventListener('DOMContentLoaded', function() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            if (totalItems > 0) {
                const cartCount = document.querySelector('.cart-count');
                cartCount.textContent = totalItems;
            }
        });

        // جستجوی لحظه‌ای (با تأخیر 500ms)
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

        // نمایش پیشنهادات جستجو (اختیاری)
        searchInput.addEventListener('focus', function() {
            if (this.value.length > 0) {
                // می‌توانید اینجا AJAX برای پیشنهادات بفرستید
            }
        });
    </script>
</body>
</html>