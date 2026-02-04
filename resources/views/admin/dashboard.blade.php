<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت - فروشگاه</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        /* استایل‌های مخصوص ادمین */
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #dee2e6;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --radius: 12px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* هدر جدید */
        .main-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-top {
            background: rgba(0, 0, 0, 0.1);
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .store-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .store-icon {
            font-size: 1.8rem;
            color: #ffd700;
        }
        
        .store-name {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .user-welcome {
            font-size: 0.9rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .user-welcome i {
            color: #4cd964;
        }
        
        .header-main {
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-badge {
            background: linear-gradient(135deg, #ff8a00, #ff5e3a);
            color: white;
            padding: 6px 18px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(255, 94, 58, 0.3);
        }
        
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .header-btn {
            padding: 10px 20px;
            border-radius: var(--radius);
            border: none;
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-store {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .btn-store:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        
        .btn-logout {
            background: rgba(231, 76, 60, 0.9);
            color: white;
            border: none;
        }
        
        .btn-logout:hover {
            background: rgba(192, 57, 43, 0.9);
        }
        
        .notification-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }
        
        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: #ff4757;
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* بقیه استایل‌های داشبورد شما */
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .admin-header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 40px;
            border-radius: var(--radius);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .admin-title {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-badge {
            background: #e74c3c;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-info h3 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .stat-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .icon-users { background: #3498db; }
        .icon-products { background: #2ecc71; }
        .icon-orders { background: #f39c12; }
        .icon-categories { background: #9b59b6; }

        .admin-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .action-card {
            background: white;
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--dark);
            border: 2px solid transparent;
        }

        .action-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .action-card h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .action-card p {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .recent-table {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 40px;
        }

        .table-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid var(--border);
            font-weight: bold;
            color: var(--dark);
        }

        .table-row {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            align-items: center;
        }

        .table-row:hover {
            background: #f8f9fa;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .col-1 { flex: 2; }
        .col-2 { flex: 1; }
        .col-3 { flex: 1; }
        .col-4 { flex: 1; }

        .btn-admin {
            padding: 8px 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-admin:hover {
            background: var(--primary-dark);
        }

        .btn-danger {
            background: #e74c3c;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-success {
            background: #2ecc71;
        }

        .btn-success:hover {
            background: #27ae60;
        }

        @media (max-width: 768px) {
            .header-main {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
            
            .admin-stats {
                grid-template-columns: 1fr;
            }
            
            .admin-actions {
                grid-template-columns: 1fr;
            }
            
            .table-row {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            
            .col-1, .col-2, .col-3, .col-4 {
                flex: none;
                width: 100%;
            }
        }
        
        /* منوی بالای هدر (اپ بار) */
        .app-bar {
            background: #1a1a2e;
            color: white;
            padding: 8px 30px;
            font-size: 0.85rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .app-bar-left {
            display: flex;
            gap: 25px;
        }
        
        .app-bar-item {
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .app-bar-item:hover {
            opacity: 1;
        }
        
        .app-bar-right {
            display: flex;
            gap: 15px;
        }
        
        .app-bar-link {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .app-bar-link:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- اپ بار (منوی بالایی) -->
    <div class="app-bar">
        <div class="app-bar-left">
            <div class="app-bar-item">
                <i class="fas fa-phone"></i>
                <span>05135413230</span>
            </div>
            <div class="app-bar-item">
                <i class="fas fa-envelope"></i>
                <span>Ali.noruzian@gmail.com</span>
            </div>
            <div class="app-bar-item">
                <i class="fas fa-clock"></i>
                <span>۲۴/۷ پشتیبانی</span>
            </div>
        </div>
    </div>

    <!-- هدر اصلی -->
    <header class="main-header">
        <div class="header-top">
            <div class="store-info">
                <i class="fas fa-store store-icon"></i>
                <span class="store-name">فروشگاه اینترنتی ما</span>
            </div>
            <div class="user-welcome">
                <i class="fas fa-user-check"></i>
                خوش آمدید، {{ auth()->user()->first_name ?? 'کاربر' }}
            </div>
        </div>
        
        <div class="header-main">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-crown"></i>
                    پنل مدیریت
                    <span class="admin-badge">
                        <i class="fas fa-shield-alt"></i>
                        سطح دسترسی: ادمین
                    </span>
                </h1>
            </div>
            
            <div class="header-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">۳</span>
                </button>
                
                <a href="{{ url('/') }}" class="header-btn btn-store">
                    <i class="fas fa-store"></i>
                    مشاهده فروشگاه
                </a>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="header-btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        خروج از سیستم
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- محتوای داشبورد (همان کد قبلی شما) -->
    <div class="admin-container">
        <!-- هدر ادمین -->
        <div class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-crown"></i>
                پنل مدیریت
                <span class="admin-badge">ادمین</span>
            </h1>
            <p>مدیریت کامل فروشگاه - آخرین آمار و گزارشات</p>
            <p style="margin-top: 10px; opacity: 0.9;">
                <i class="fas fa-user"></i>
                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                | {{ auth()->user()->mobile }}
            </p>
        </div>

        <!-- آمار -->
        <div class="admin-stats">
            <div class="stat-card">
                <div class="stat-icon icon-users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <p>کاربران ثبت‌نام کرده</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-products">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ \App\Models\Product::count() }}</h3>
                    <p>محصولات فعال</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-categories">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ \App\Models\Category::count() }}</h3>
                    <p>دسته‌بندی‌ها</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orders">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>0</h3>
                    <p>سفارشات امروز</p>
                </div>
            </div>
        </div>

        <!-- اقدامات سریع -->
        <div class="admin-actions">
            <a href="#" class="action-card">
                <h3><i class="fas fa-plus-circle"></i> افزودن محصول جدید</h3>
                <p>ایجاد محصول جدید با مشخصات کامل و تصاویر</p>
            </a>

            <a href="#" class="action-card">
                <h3><i class="fas fa-edit"></i> مدیریت محصولات</h3>
                <p>ویرایش، حذف و مدیریت موجودی محصولات</p>
            </a>

            <a href="#" class="action-card">
                <h3><i class="fas fa-tags"></i> مدیریت دسته‌بندی‌ها</h3>
                <p>ایجاد و ویرایش دسته‌بندی‌های محصولات</p>
            </a>

            <a href="{{ route('admin.users.index') }}   " class="action-card">
                <h3><i class="fas fa-users-cog"></i> مدیریت کاربران</h3>
                <p>مشاهده لیست کاربران و مدیریت دسترسی‌ها</p>
            </a>
        </div>

        <!-- محصولات اخیر -->
        <div class="recent-table">
            <div class="table-header">آخرین محصولات اضافه شده</div>
            
            @php
                $recentProducts = \App\Models\Product::latest()->limit(5)->get();
            @endphp
            
            @foreach($recentProducts as $product)
            <div class="table-row">
                <div class="col-1">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             style="width: 50px; height: 50px; object-fit: contain; border-radius: 8px;">
                        <div>
                            <strong>{{ $product->name }}</strong><br>
                            <small style="color: var(--gray);">{{ $product->category->name ?? 'بدون دسته' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-2">{{ number_format($product->price) }} تومان</div>
                <div class="col-3">
                    @if($product->is_active)
                        <span style="color: #2ecc71; font-weight: 500;">
                            <i class="fas fa-check-circle"></i> فعال
                        </span>
                    @else
                        <span style="color: #e74c3c;">
                            <i class="fas fa-times-circle"></i> غیرفعال
                        </span>
                    @endif
                </div>
                <div class="col-4">
                    <a href="#" class="btn-admin" style="padding: 6px 12px; font-size: 0.9rem;">
                        <i class="fas fa-edit"></i> ویرایش
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- دکمه‌های اقدام -->
        <div style="display: flex; gap: 15px; margin-top: 40px; flex-wrap: wrap;">
            <a href="{{ url('/') }}" class="btn-admin">
                <i class="fas fa-store"></i> مشاهده فروشگاه
            </a>
            
            <a href="#" class="btn-admin btn-success">
                <i class="fas fa-chart-line"></i> گزارشات آماری
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-admin btn-danger">
                    <i class="fas fa-sign-out-alt"></i> خروج از پنل
                </button>
            </form>
        </div>
    </div>

    <!-- اسکریپت برای اعلان‌ها -->
    <script>
        // نمایش و مدیریت اعلان‌ها
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBtn = document.querySelector('.notification-btn');
            const notificationBadge = document.querySelector('.notification-badge');
            
            notificationBtn.addEventListener('click', function() {
                alert('شما ۳ اعلان خوانده نشده دارید!');
                // در حالت واقعی اینجا باید مودال اعلان‌ها نمایش داده شود
            });
            
            // شبیه‌سازی اعلان جدید
            setTimeout(() => {
                const currentCount = parseInt(notificationBadge.textContent);
                notificationBadge.textContent = currentCount + 1;
                notificationBadge.style.animation = 'pulse 0.5s';
                
                setTimeout(() => {
                    notificationBadge.style.animation = '';
                }, 500);
            }, 5000);
        });
    </script>
    
    <!-- استایل‌های انیمیشن برای اعلان‌ها -->
    <style>
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</body>
</html>