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
    
    /* حذف margin-top از هدر و کانتینر */
    .header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 12px 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .page-title {
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .header-actions {
        display: flex;
        gap: 8px;
    }
    
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
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }
    
    .btn-outline:hover {
        background: var(--primary);
        color: white;
    }
    
    .btn-danger {
        background: var(--danger);
        color: white;
    }
    
    .btn-warning {
        background: var(--warning);
        color: white;
    }
    
    .btn-success {
        background: var(--success);
        color: white;
    }
    
    /* حذف margin-top از کانتینر اصلی */
    .container {
        max-width: 1200px;
        margin: 0 auto 20px;
        padding: 0 20px;
    }
    
    .profile-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-top: 5px;
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--primary), #7209b7);
        padding: 20px 30px;
        color: white;
        text-align: center;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: 3px solid white;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        margin: 0 auto 10px;
    }
    
    .profile-name {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }
    
    .profile-meta {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 8px;
        flex-wrap: wrap;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.8rem;
        opacity: 0.9;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 15px;
        margin: 15px;
    }
    
    .info-card {
        background: white;
        padding: 15px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }
    
    .card-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
    }
    
    .card-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    
    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }
    
    .info-list {
        list-style: none;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--border);
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        color: var(--gray);
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .info-value {
        color: var(--dark);
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .badge {
        padding: 3px 8px;
        border-radius: 15px;
        font-size: 0.75rem;
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
    
    .action-buttons {
        display: flex;
        gap: 10px;
        padding: 15px 20px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
    }
    
    /* استایل‌های آمار سفارشات */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 15px;
    }
    
    .stat-card {
        background: white;
        padding: 15px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        text-align: center;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: white;
        font-size: 1rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--dark);
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: var(--gray);
        font-size: 0.8rem;
    }
    
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            margin: 10px;
        }
        
        .header-content {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
        
        .header {
            padding: 10px 20px;
        }
        
        .profile-header {
            padding: 15px 20px;
        }
        
        .profile-meta {
            gap: 10px;
        }
        
        .action-buttons {
            padding: 10px;
            justify-content: center;
        }
        
        .btn {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
    }
</style>
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
                        <span>عضو شده در {{ $user->created_at->format('Y/m/d') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- کارت‌های اطلاعات -->
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
                            <span class="info-label">وضعیت پروفایل</span>
                            <span class="info-value">
                                <span class="badge {{ $user->address ? 'badge-active' : 'badge-inactive' }}">
                                    <i class="fas {{ $user->address ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-left: 5px;"></i>
                                    {{ $user->address ? 'تکمیل‌شده' : 'ناقص' }}
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
                        <h3 class="card-title">اطلاعات حساب</h3>
                    </div>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">تاریخ ایجاد حساب</span>
                            <span class="info-value">{{ $user->created_at->format('Y/m/d H:i') }}</span>
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
            
            <!-- آمار سفارشات -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon" style="background: var(--success);">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3 class="card-title">آمار سفارشات</h3>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #3498db;">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="stat-number">۰</div>
                            <div class="stat-label">کل سفارشات</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #2ecc71;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-number">۰</div>
                            <div class="stat-label">تکمیل شده</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #f39c12;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-number">۰</div>
                            <div class="stat-label">در حال بررسی</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #e74c3c;">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-number">۰</div>
                            <div class="stat-label">لغو شده</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- اقدامات -->
            <div class="action-buttons">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    ویرایش اطلاعات
                </a>
                
                @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.users.toggleStatus', $user) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn {{ $user->address ? 'btn-warning' : 'btn-success' }}">
                            <i class="fas {{ $user->address ? 'fa-user-minus' : 'fa-user-plus' }}"></i>
                            {{ $user->address ? 'حذف آدرس' : 'افزودن آدرس' }}
                        </button>
                    </form>
                @endif
                
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

    <script>
        function copyMobileNumber() {
            const mobile = "{{ $user->mobile }}";
            navigator.clipboard.writeText(mobile).then(() => {
                alert('شماره موبایل کپی شد: ' + mobile);
            });
        }
    </script>
</body>
</html>