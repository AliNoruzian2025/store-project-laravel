<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کاربر - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #dee2e6;
            --radius: 8px;
            --sidebar-width: 250px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
        }
        
        /* سایدبار */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-left: 1px solid var(--border);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            overflow-y: auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            text-align: center;
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2rem;
        }
        
        .user-name {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .user-mobile {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s;
            border-right: 3px solid transparent;
        }
        
        .menu-item:hover,
        .menu-item.active {
            background: #f8f9fa;
            border-right-color: var(--primary);
            color: var(--primary);
        }
        
        .menu-item i {
            width: 20px;
            text-align: center;
        }
        
        .menu-divider {
            height: 1px;
            background: var(--border);
            margin: 10px 20px;
        }
        
        /* محتوا */
        .main-content {
            flex: 1;
            margin-right: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
        }
        
        .header {
            background: white;
            padding: 15px 25px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.4rem;
            color: var(--dark);
        }
        
        .logout-btn {
            padding: 8px 16px;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* کارت‌های آمار */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.2rem;
        }
        
        .stat-icon.orders { background: #e3f2fd; color: #1976d2; }
        .stat-icon.pending { background: #fff3e0; color: #f57c00; }
        .stat-icon.completed { background: #e8f5e9; color: #388e3c; }
        .stat-icon.wallet { background: #e8f5e9; color: #388e3c; }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* کارت کیف پول */
        .wallet-card {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            border-radius: var(--radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .wallet-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .wallet-balance {
            font-size: 2.5rem;
            font-weight: bold;
        }
        
        .wallet-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .wallet-btn {
            padding: 12px 25px;
            border: none;
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.95rem;
        }
        
        .wallet-btn.charge {
            background: var(--success);
            color: white;
        }
        
        .wallet-btn.history {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .wallet-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* جدول سفارشات اخیر */
        .recent-orders {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            color: var(--dark);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid var(--border);
        }
        
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
        }
        
        tr:hover {
            background: #f8f9fa;
        }
        
        .badge {
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.8rem;
            display: inline-block;
        }
        
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        
        .btn {
            padding: 6px 12px;
            border-radius: var(--radius);
            border: none;
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.85rem;
        }
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
        .btn-sm { padding: 4px 8px; font-size: 0.8rem; }
        
        /* کارت‌های سریع */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-card {
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            text-decoration: none;
            color: var(--dark);
            transition: all 0.3s;
        }
        
        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            color: var(--primary);
        }
        
        .action-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }
        
        /* نوتیفیکیشن */
        .notification {
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            max-width: 500px;
            margin: 0 auto;
            padding: 15px 20px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
            transition: all 0.3s;
        }
        
        .notification-success {
            background: #d1fae5;
            color: #065f46;
            border-right: 4px solid #10b981;
        }
        
        .notification-error {
            background: #f8d7da;
            color: #721c24;
            border-right: 4px solid #dc3545;
        }
        
        .notification-warning {
            background: #fff3cd;
            color: #856404;
            border-right: 4px solid #ffc107;
        }
        
        .notification-info {
            background: #d1ecf1;
            color: #0c5460;
            border-right: 4px solid #17a2b8;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* برای موبایل */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: fixed;
                top: auto;
                bottom: 0;
                right: 0;
                left: 0;
                height: 60px;
                border-top: 1px solid var(--border);
                display: flex;
                justify-content: space-around;
                align-items: center;
            }
            
            .sidebar-header {
                display: none;
            }
            
            .sidebar-menu {
                display: flex;
                width: 100%;
                padding: 0;
            }
            
            .menu-item {
                flex-direction: column;
                padding: 8px;
                font-size: 0.7rem;
                flex: 1;
                text-align: center;
                border-right: none;
                border-top: 3px solid transparent;
            }
            
            .menu-item:hover,
            .menu-item.active {
                border-right-color: transparent;
                border-top-color: var(--primary);
            }
            
            .menu-divider {
                display: none;
            }
            
            .main-content {
                margin-right: 0;
                margin-bottom: 60px;
                padding: 15px;
            }
            
            .wallet-actions {
                flex-direction: column;
            }
            
            .wallet-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- نوتیفیکیشن‌ها -->
    <div id="notification-container"></div>
    
    <!-- سایدبار -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-name">{{ auth()->user()->full_name }}</div>
            <div class="user-mobile">{{ auth()->user()->mobile }}</div>
        </div>
        
        <nav class="sidebar-menu">
            <a href="{{ route('user.dashboard') }}" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>داشبورد</span>
            </a>
            
            <a href="{{ route('user.orders.index') }}" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>سفارشات من</span>
            </a>
            
            <a href="{{ route('user.wallet.index') }}" class="menu-item">
                <i class="fas fa-wallet"></i>
                <span>کیف پول</span>
            </a>
            
            <div class="menu-divider"></div>
            
            <a href="{{ route('user.profile') }}" class="menu-item">
                <i class="fas fa-user-cog"></i>
                <span>پروفایل من</span>
            </a>
            
            <div class="menu-divider"></div>
            
            <a href="{{ route('home') }}" class="menu-item">
                <i class="fas fa-store"></i>
                <span>فروشگاه</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                @csrf
                <button type="submit" class="menu-item" style="background: none; border: none; width: 100%; text-align: right;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>خروج</span>
                </button>
            </form>
        </nav>
    </aside>
    
    <!-- محتوای اصلی -->
    <main class="main-content">
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-home"></i>
                داشبورد کاربری
            </h1>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    خروج از حساب
                </button>
            </form>
        </div>
        
        <!-- کارت کیف پول -->
        <div class="wallet-card">
            <div class="wallet-header">
                <div>
                    <h3 style="margin: 0; opacity: 0.9;">موجودی کیف پول</h3>
                    <div class="wallet-balance">
                        {{ auth()->user()->getFormattedWalletBalance() }}
                    </div>
                </div>
                <i class="fas fa-wallet" style="font-size: 2.5rem; opacity: 0.7;"></i>
            </div>
            
            <div class="wallet-actions">
                <a href="{{ route('user.wallet.index') }}" class="wallet-btn charge">
                    <i class="fas fa-bolt"></i>
                    شارژ کیف پول
                </a>
                
                <a href="{{ route('user.wallet.transactions') }}" class="wallet-btn history">
                    <i class="fas fa-history"></i>
                    تاریخچه تراکنش‌ها
                </a>
            </div>
        </div>
        
        <!-- کارت‌های آمار -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-number">{{ $stats['total_orders'] ?? 0 }}</div>
                <div class="stat-label">کل سفارشات</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $stats['pending_orders'] ?? 0 }}</div>
                <div class="stat-label">سفارشات در انتظار</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $stats['completed_orders'] ?? 0 }}</div>
                <div class="stat-label">سفارشات تکمیل شده</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon wallet">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-number">{{ number_format(auth()->user()->getWalletBalance()) }}</div>
                <div class="stat-label">موجودی کیف پول</div>
            </div>
        </div>
        
        <!-- سفارشات اخیر -->
        <div class="recent-orders">
            <h2 class="section-title">
                <i class="fas fa-history"></i>
                سفارشات اخیر
            </h2>
            
            @if(isset($recentOrders) && $recentOrders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>تاریخ</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                <td>{{ number_format($order->total_amount) }} تومان</td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'pending' => 'badge-pending',
                                            'processing' => 'badge-processing',
                                            'completed' => 'badge-completed',
                                            'cancelled' => 'badge-cancelled'
                                        ];
                                        $statusTexts = [
                                            'pending' => 'در انتظار',
                                            'processing' => 'در حال پردازش',
                                            'completed' => 'تکمیل شده',
                                            'cancelled' => 'لغو شده'
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusClasses[$order->status] ?? 'badge-pending' }}">
                                        {{ $statusTexts[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.orders.show', $order) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        مشاهده
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 30px; color: var(--gray);">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <h3>هنوز سفارشی ثبت نکرده‌اید</h3>
                    <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 15px;">
                        <i class="fas fa-shopping-basket"></i>
                        شروع خرید
                    </a>
                </div>
            @endif
        </div>
        
        <!-- اقدامات سریع -->
        <div class="quick-actions">
            <a href="{{ route('user.orders.index') }}" class="action-card">
                <i class="fas fa-clipboard-list"></i>
                <h3>مدیریت سفارشات</h3>
                <p>پیگیری و مشاهده سفارشات</p>
            </a>
            
            <a href="{{ route('user.profile') }}" class="action-card">
                <i class="fas fa-user-edit"></i>
                <h3>ویرایش پروفایل</h3>
                <p>تغییر اطلاعات شخصی</p>
            </a>
            
            <a href="{{ route('user.wallet.index') }}" class="action-card">
                <i class="fas fa-wallet"></i>
                <h3>کیف پول</h3>
                <p>شارژ و مدیریت موجودی</p>
            </a>
            
            <a href="{{ route('home') }}" class="action-card">
                <i class="fas fa-store"></i>
                <h3>خرید از فروشگاه</h3>
                <p>مشاهده محصولات جدید</p>
            </a>
        </div>
    </main>
    
    <script>
        // تابع نمایش نوتیفیکیشن
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notification-container');
            
            // حذف نوتیفیکیشن‌های قبلی
            container.innerHTML = '';
            
            // ایجاد نوتیفیکیشن جدید
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas ${getIcon(type)}"></i>
                <span>${message}</span>
                <button class="notification-close" onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer; margin-right: auto;">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // حذف خودکار بعد از 3 ثانیه
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 3000);
        }

        // آیکون مناسب بر اساس نوع پیام
        function getIcon(type) {
            switch(type) {
                case 'success': return 'fa-check-circle';
                case 'error': return 'fa-exclamation-circle';
                case 'warning': return 'fa-exclamation-triangle';
                case 'info': return 'fa-info-circle';
                default: return 'fa-info-circle';
            }
        }

        // بررسی پیام‌های session و نمایش آن‌ها
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showNotification('{{ session("success") }}', 'success');
            @endif
            
            @if(session('error'))
                showNotification('{{ session("error") }}', 'error');
            @endif
            
            @if(session('warning'))
                showNotification('{{ session("warning") }}', 'warning');
            @endif
            
            @if(session('info'))
                showNotification('{{ session("info") }}', 'info');
            @endif
        });
    </script>
</body>
</html>