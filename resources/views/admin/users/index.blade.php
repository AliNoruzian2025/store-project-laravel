<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران - پنل ادمین</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
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
            max-width: 1400px;
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
        
        .btn-success {
            background: var(--success);
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
        .admin-container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        /* آمار */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.2rem;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .icon-users { background: #3498db; }
        .icon-admin { background: #9b59b6; }
        .icon-address { background: #2ecc71; }
        .icon-no-address { background: #f39c12; }
        
        /* فیلترها و جستجو */
        .filters-section {
            background: white;
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .filter-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 10px;
        }
        
        /* جدول کاربران */
        .table-container {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--dark);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: right;
            border-bottom: 2px solid var(--border);
            font-weight: 600;
            color: var(--dark);
        }
        
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-details h4 {
            margin-bottom: 5px;
            font-size: 1rem;
        }
        
        .user-details p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
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
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        
        /* صفحه‌بندی */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 20px;
            gap: 5px;
        }
        
        .page-item {
            margin: 0 2px;
        }
        
        .page-link {
            display: block;
            padding: 8px 15px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .page-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .page-item.active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .page-item.disabled .page-link {
            color: var(--gray);
            cursor: not-allowed;
            background: #f8f9fa;
        }
        
        /* مودال */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.show {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: var(--radius);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
        }
        
        /* ریسپانسیو */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-sm {
                width: 100%;
                justify-content: center;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .header-actions {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .btn {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
        
        /* استایل‌های اضافی */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        .sort-link {
            color: var(--dark);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .sort-link:hover {
            color: var(--primary);
        }
        
        .text-success {
            color: var(--success);
        }
        
        .text-danger {
            color: var(--danger);
        }
        
        .text-warning {
            color: var(--warning);
        }
        
        .text-info {
            color: var(--info);
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-users-cog"></i>
                مدیریت کاربران
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به داشبورد
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    کاربر جدید
                </a>
            </div>
        </div>
    </header>

    <!-- کانتینر اصلی -->
    <div class="admin-container">
        <!-- اعلان‌ها -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: var(--radius); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                {{ session('success') }}
                <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 1.2rem; cursor: pointer;">×</button>
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: var(--radius); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                {{ session('error') }}
                <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 1.2rem; cursor: pointer;">×</button>
            </div>
        @endif

        <!-- آمار -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                <div class="stat-label">کل کاربران</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon icon-admin">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stat-number">{{ $stats['admins'] ?? 0 }}</div>
                <div class="stat-label">مدیران</div>
            </div>
            
            <!-- تغییر: به جای آدرس، وضعیت فعال/غیرفعال -->
            <div class="stat-card">
                <div class="stat-icon" style="background: #2ecc71;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-number">{{ $stats['active'] ?? User::where('role', '!=', 'admin')->whereNotNull('address')->count() }}</div>
                <div class="stat-label">کاربران تکمیل‌شده</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #f39c12;">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-number">{{ $stats['inactive'] ?? User::where('role', '!=', 'admin')->whereNull('address')->count() }}</div>
                <div class="stat-label">کاربران ناقص</div>
            </div>
        </div>

        <!-- فیلترها و جستجو -->
        <div class="filters-section">
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="filters-grid">
                    <div class="form-group">
                        <label class="form-label">جستجو</label>
                        <input type="text" name="search" class="form-control" placeholder="جستجو بر اساس نام، نام خانوادگی یا موبایل..." value="{{ request('search') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">نقش</label>
                        <select name="role" class="form-control">
                            <option value="">همه نقش‌ها</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>مدیر</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>کاربر عادی</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">وضعیت پروفایل</label>
                        <select name="status" class="form-control">
                            <option value="">همه وضعیت‌ها</option>
                            <option value="with_address" {{ request('status') == 'with_address' ? 'selected' : '' }}>تکمیل‌شده (دارای آدرس)</option>
                            <option value="without_address" {{ request('status') == 'without_address' ? 'selected' : '' }}>ناقص (بدون آدرس)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">مرتب‌سازی بر اساس</label>
                        <select name="sort" class="form-control">
                            <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>تاریخ عضویت</option>
                            <option value="first_name" {{ request('sort') == 'first_name' ? 'selected' : '' }}>نام</option>
                            <option value="last_name" {{ request('sort') == 'last_name' ? 'selected' : '' }}>نام خانوادگی</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">ترتیب</label>
                        <select name="order" class="form-control">
                            <option value="desc" {{ request('order', 'desc') == 'desc' ? 'selected' : '' }}>نزولی (جدیدترین)</option>
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>صعودی (قدیمی‌ترین)</option>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                        اعمال فیلترها
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        پاک کردن فیلترها
                    </a>
                </div>
            </form>
        </div>

        <!-- جدول کاربران -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">لیست کاربران</div>
                <div>
                    <span style="color: var(--gray); font-size: 0.9rem;">
                        @if($users->count() > 0)
                            نمایش {{ $users->firstItem() }} تا {{ $users->lastItem() }} از {{ $users->total() }} کاربر
                        @endif
                    </span>
                </div>
            </div>
            
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>اطلاعات تماس</th>
                            <th>نقش</th>
                            <th>وضعیت پروفایل</th>
                            <th>تاریخ عضویت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                        </div>
                                        <div class="user-details">
                                            <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                                            <p>ID: #{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div style="margin-bottom: 5px;">
                                            <i class="fas fa-mobile-alt" style="margin-left: 5px;"></i>
                                            {{ $user->mobile }}
                                        </div>
                                        @if($user->address)
                                            <div style="color: var(--gray); font-size: 0.9rem;">
                                                <i class="fas fa-map-marker-alt" style="margin-left: 5px;"></i>
                                                {{ Str::limit($user->address, 30) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-user' }}">
                                        <i class="fas {{ $user->role == 'admin' ? 'fa-crown' : 'fa-user' }}" style="margin-left: 5px;"></i>
                                        {{ $user->role == 'admin' ? 'مدیر' : 'کاربر' }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge badge-admin">
                                            <i class="fas fa-crown" style="margin-left: 5px;"></i>
                                            مدیر سیستم
                                        </span>
                                    @else
                                        <span class="badge {{ $user->address ? 'badge-active' : 'badge-inactive' }}">
                                            <i class="fas {{ $user->address ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-left: 5px;"></i>
                                            {{ $user->address ? 'تکمیل‌شده' : 'ناقص' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->created_at->format('Y/m/d') }}
                                    <br>
                                    <small style="color: var(--gray);">
                                        {{ $user->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                            ویرایش
                                        </a>
                                        
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm" style="background: var(--info);">
                                            <i class="fas fa-eye"></i>
                                            مشاهده
                                        </a>
                                        
                                        @if($user->role !== 'admin')
                                            <form method="POST" action="{{ route('admin.users.toggleStatus', $user) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn {{ $user->address ? 'btn-warning' : 'btn-success' }} btn-sm">
                                                    <i class="fas {{ $user->address ? 'fa-user-minus' : 'fa-user-plus' }}"></i>
                                                    {{ $user->address ? 'حذف آدرس' : 'افزودن آدرس' }}
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirmDelete('{{ $user->first_name }} {{ $user->last_name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h3>کاربری یافت نشد</h3>
                    <p>هیچ کاربری با فیلترهای اعمال شده مطابقت ندارد.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary" style="margin-top: 15px;">
                        نمایش همه کاربران
                    </a>
                </div>
            @endif
            
            <!-- صفحه‌بندی -->
            @if($users->hasPages())
                <div style="padding: 20px; border-top: 1px solid var(--border);">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
        
        <!-- اطلاعات پایین صفحه -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding: 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow);">
            <div style="color: var(--gray); font-size: 0.9rem;">
                <i class="fas fa-info-circle" style="margin-left: 5px;"></i>
                کاربران "تکمیل‌شده": دارای آدرس | کاربران "ناقص": بدون آدرس
            </div>
            <div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    ایجاد کاربر جدید
                </a>
            </div>
        </div>
    </div>

    <script>
        // تایید حذف کاربر
        function confirmDelete(userName) {
            return confirm(`آیا از حذف کاربر "${userName}" اطمینان دارید؟\nاین عمل قابل بازگشت نیست.`);
        }
        
        // تایید تغییر وضعیت
        function confirmToggleStatus(userName, action) {
            return confirm(`آیا می‌خواهید ${action} برای کاربر "${userName}" انجام دهید؟`);
        }
        
        // کپی شماره موبایل
        function copyMobileNumber(phone) {
            navigator.clipboard.writeText(phone).then(() => {
                alert('شماره موبایل کپی شد: ' + phone);
            });
        }
        
        // جستجوی سریع
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            let searchTimeout;
            
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (e.target.value.length >= 2) {
                        // جستجوی سریع
                        console.log('جستجو: ', e.target.value);
                    }
                }, 500);
            });
        });
    </script>
</body>
</html>