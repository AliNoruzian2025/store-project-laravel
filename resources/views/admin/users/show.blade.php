<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات کاربر - پنل ادمین</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #dee2e6;
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
        
        /* هدر */
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        /* دکمه‌ها */
        .btn {
            padding: 10px 20px;
            border-radius: var(--radius);
            border: none;
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }
        
        /* کانتینر اصلی */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        /* کارت پروفایل */
        .profile-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .profile-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 4px solid white;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }
        
        .profile-name {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .profile-meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* کارت‌های اطلاعات */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: white;
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border);
        }
        
        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .info-list {
            list-style: none;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: var(--gray);
            font-weight: 500;
        }
        
        .info-value {
            color: var(--dark);
            font-weight: 500;
        }
        
        /* بج */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .badge-admin {
            background: #e6d4ff;
            color: #6b21a8;
        }
        
        .badge-user {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-active {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* فعالیت‌ها */
        .activity-timeline {
            position: relative;
            padding-right: 30px;
        }
        
        .activity-timeline::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border);
        }
        
        .activity-item {
            position: relative;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .activity-item::before {
            content: '';
            position: absolute;
            right: -36px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--primary);
        }
        
        .activity-time {
            color: var(--gray);
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        
        .activity-text {
            color: var(--dark);
        }
        
        /* ریسپانسیو */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .profile-meta {
                flex-direction: column;
                gap: 10px;
            }
            
            .header-actions {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* استایل‌های اضافی */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 10px;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        
        .status-online {
            background: var(--success);
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
        }
        
        .status-offline {
            background: var(--gray);
            box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.2);
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-user-circle"></i>
                جزئیات کاربر
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به لیست
                </a>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    ویرایش کاربر
                </a>
            </div>
        </div>
    </header>

    <!-- محتوای اصلی -->
    <div class="container">
        <!-- کارت پروفایل -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                </div>
                <h1 class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <div class="profile-meta">
                    <div class="meta-item">
                        <i class="fas fa-id-card"></i>
                        <span>ID: #{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-user-tag"></i>
                        <span>{{ $user->role == 'admin' ? 'مدیر' : 'کاربر عادی' }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>عضو شده در {{ $user->created_at->format('Y/m/d H:i') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- کارت‌های اطلاعات -->
            <div style="padding: 30px;">
                <div class="info-grid">
                    <!-- اطلاعات شخصی -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h3 class="card-title">اطلاعات شخصی</h3>
                        </div>
                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-label">نام کامل</span>
                                <span class="info-value">{{ $user->first_name }} {{ $user->last_name }}</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">نقش</span>
                                <span class="info-value">
                                    <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-user' }}">
                                        {{ $user->role == 'admin' ? 'مدیر' : 'کاربر' }}
                                    </span>
                                </span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">وضعیت</span>
                                <span class="info-value">
                                    <span class="badge {{ $user->address ? 'badge-active' : 'badge-inactive' }}">
                                        <i class="fas {{ $user->address ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-left: 5px;"></i>
                                        {{ $user->address ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- اطلاعات تماس -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-address-card"></i>
                            </div>
                            <h3 class="card-title">اطلاعات تماس</h3>
                        </div>
                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-label">شماره موبایل</span>
                                <span class="info-value" dir="ltr">{{ $user->mobile }}</span>
                            </li>
                            @if($user->address)
                                <li class="info-item">
                                    <span class="info-label">آدرس</span>
                                    <span class="info-value">{{ $user->address }}</span>
                                </li>
                            @endif
                            @if($user->postal_code)
                                <li class="info-item">
                                    <span class="info-label">کد پستی</span>
                                    <span class="info-value" dir="ltr">{{ $user->postal_code }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    
                    <!-- اطلاعات حساب -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h3 class="card-title">آمار حساب</h3>
                        </div>
                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-label">تاریخ ایجاد حساب</span>
                                <span class="info-value">{{ $user->created_at->format('Y/m/d H:i') }}
</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">آخرین به‌روزرسانی</span>
                                <span class="info-value">{{ $user->updated_at->format('Y/m/d H:i') }}</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">وضعیت تأیید</span>
                                <span class="info-value">
                                    <span class="badge badge-active">
                                        <i class="fas fa-check" style="margin-left: 5px;"></i>
                                        تأیید شده
                                    </span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- فعالیت‌های اخیر (نمونه) -->
                <div class="info-card" style="margin-top: 20px;">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3 class="card-title">فعالیت‌های اخیر</h3>
                    </div>
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-time">امروز - ۱۴:۳۰</div>
                            <div class="activity-text">ورود به حساب کاربری</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-time">دیروز - ۱۱:۱۵</div>
                            <div class="activity-text">به‌روزرسانی اطلاعات پروفایل</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-time">۳ روز پیش - ۰۹:۴۵</div>
                            <div class="activity-text">ثبت سفارش جدید</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-time">۱ هفته پیش - ۱۶:۲۰</div>
                            <div class="activity-text">ایجاد حساب کاربری</div>
                        </div>
                    </div>
                </div>
                
                <!-- اقدامات -->
                <div style="display: flex; gap: 15px; margin-top: 30px; padding-top: 20px; border-top: 2px solid var(--border);">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        ویرایش اطلاعات
                    </a>
                    
                    <form method="POST" action="{{ route('admin.users.toggleStatus', $user) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn {{ $user->address ? 'btn-warning' : 'btn-success' }}">
                            <i class="fas {{ $user->address ? 'fa-ban' : 'fa-check' }}"></i>
                            {{ $user->address ? 'غیرفعال کردن' : 'فعال کردن' }}
                        </button>
                    </form>
                    
                    <a href="tel:{{ $user->mobile }}" class="btn btn-outline">
                        <i class="fas fa-phone"></i>
                        تماس با کاربر
                    </a>
                    
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                          style="display: inline;"
                          onsubmit="return confirm('آیا از حذف کاربر {{ $user->first_name }} {{ $user->last_name }} اطمینان دارید؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            حذف کاربر
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- اطلاعات اضافی (در صورت نیاز) -->
        <div class="info-grid">
            <!-- کارت خلاصه -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--success);">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="card-title">آمار سفارشات</h3>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <div style="font-size: 2.5rem; font-weight: bold; color: var(--dark); margin-bottom: 10px;">۰</div>
                    <div style="color: var(--gray);">سفارشات تکمیل شده</div>
                </div>
            </div>
            
            <!-- کارت وضعیت -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--info);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="card-title">وضعیت حساب</h3>
                </div>
                <ul class="info-list">
                    <li class="info-item">
                        <span class="info-label">آخرین ورود</span>
                        <span class="info-value">---</span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">تعداد ورودها</span>
                        <span class="info-value">---</span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">وضعیت آنلاین</span>
                        <span class="info-value">
                            <span class="status-indicator">
                                <span class="status-dot status-offline"></span>
                                آفلاین
                            </span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // به‌روزرسانی وضعیت آنلاین (نمونه)
        function updateOnlineStatus() {
            // در اینجا می‌توانید وضعیت آنلاین کاربر را بررسی کنید
            // به عنوان نمونه، همیشه آفلاین نشان داده می‌شود
        }
        
        // بارگذاری اولیه
        document.addEventListener('DOMContentLoaded', function() {
            updateOnlineStatus();
        });
        
        // کپی شماره موبایل
        function copyMobileNumber() {
            const mobile = "{{ $user->mobile }}";
            navigator.clipboard.writeText(mobile).then(() => {
                alert('شماره موبایل کپی شد: ' + mobile);
            });
        }
    </script>
</body>
</html>