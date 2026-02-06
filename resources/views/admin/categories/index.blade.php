<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌بندی‌ها - پنل ادمین</title>
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
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            padding: 15px 30px;
        }
        
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
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
            font-size: 0.9rem;
        }
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
        
        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        /* استایل نوتیفیکیشن */
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
        
        .notification-hide {
            animation: slideOut 0.3s ease-in forwards;
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
        
        @keyframes slideOut {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100px);
                opacity: 0;
            }
        }
        
        .notification-close {
            margin-right: auto;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
        }
        
        .notification-close:hover {
            background-color: rgba(0,0,0,0.1);
        }
        
        /* بقیه استایل‌ها مانند قبل... */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: white;
            padding: 15px;
            border-radius: var(--radius);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        /* استایل فیلترها */
        .filters {
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .filter-form {
            width: 100%;
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            align-items: end;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        .input-with-icon, .select-with-icon {
            position: relative;
        }
        
        .input-with-icon i, .select-with-icon i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .input-with-icon input, .select-with-icon select {
            padding-right: 35px;
            width: 100%;
        }
        
        .filter-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }
        
        .search-btn, .reset-btn {
            height: 42px;
            min-width: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
        }
        
        /* برای صفحات کوچک‌تر */
        @media (max-width: 1024px) {
            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-actions {
                flex-direction: column;
            }
            
            .search-btn, .reset-btn {
                width: 100%;
            }
        }
        
        /* استایل جدول */
        .table-container {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .table-header {
            padding: 15px;
            background: #f8f9fa;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-secondary { background: #f3f4f6; color: #374151; }
        
        .actions {
            display: flex;
            gap: 5px;
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--gray);
        }
        
        /* استایل پاگینیشن */
        .pagination-container {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
        }
        
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }
        
        .pagination li {
            margin: 0;
        }
        
        .pagination li a,
        .pagination li span {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            transition: all 0.3s;
        }
        
        .pagination li a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .pagination li.active a {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            font-weight: 500;
        }
        
        .pagination li.disabled span,
        .pagination li.disabled a {
            color: var(--gray);
            cursor: not-allowed;
            background: #f8f9fa;
        }
        
        .pagination li.disabled a:hover {
            background: #f8f9fa;
            color: var(--gray);
            border-color: var(--border);
        }
        
        .pagination li:first-child a i,
        .pagination li:last-child a i {
            font-size: 0.9rem;
        }
        
        .product-count {
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            color: var(--gray);
        }
    </style>
</head>
<body>
    <!-- بخش نوتیفیکیشن‌ها -->
    <div id="notification-container"></div>

    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-folder"></i>
                مدیریت دسته‌بندی‌ها
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    دسته‌بندی جدید
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                <div class="stat-label">کل دسته‌بندی‌ها</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['active'] ?? 0 }}</div>
                <div class="stat-label">فعال</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['inactive'] ?? 0 }}</div>
                <div class="stat-label">غیرفعال</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['with_products'] ?? 0 }}</div>
                <div class="stat-label">دارای محصول</div>
            </div>
        </div>

        <!-- فیلترها -->
        <div class="filters">
            <form method="GET" action="{{ route('admin.categories.index') }}" id="search-form" class="filter-form">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>جستجو</label>
                        <div class="input-with-icon">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" class="form-control" placeholder="نام دسته‌بندی..." 
                                   value="{{ request('search') }}" id="search-input">
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label>وضعیت</label>
                        <div class="select-with-icon">
                            <i class="fas fa-info-circle"></i>
                            <select name="status" class="form-control" id="status-select">
                                <option value="">همه</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label>مرتب‌سازی</label>
                        <div class="select-with-icon">
                            <i class="fas fa-sort"></i>
                            <select name="sort" class="form-control" id="sort-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>جدیدترین</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>قدیمی‌ترین</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>نام (صعودی)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>نام (نزولی)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="filter-group filter-actions">
                        <button type="submit" class="btn btn-primary search-btn">
                            <i class="fas fa-search"></i> جستجو
                        </button>
                        @if(request()->hasAny(['search', 'status', 'sort']))
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline reset-btn">
                                <i class="fas fa-times"></i> پاک کردن
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div style="font-weight: 500; font-size: 1.1rem;">
                    لیست دسته‌بندی‌ها
                </div>
                <div style="font-size: 0.9rem; color: var(--gray);">
                    نمایش {{ $categories->firstItem() ?? 0 }} تا {{ $categories->lastItem() ?? 0 }} از {{ $categories->total() }} دسته‌بندی
                </div>
            </div>
            
            @if($categories->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>تعداد محصولات</th>
                            <th>تاریخ ایجاد</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 40px; height: 40px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-folder" style="color: #6c757d;"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $category->name }}</strong>
                                            @if($category->description)
                                                <div style="font-size: 0.8rem; color: var(--gray); margin-top: 3px;">
                                                    {{ Str::limit($category->description, 40) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="product-count">{{ $category->products_count ?? 0 }} محصول</span>
                                </td>
                                <td>
                                    {{ $category->created_at->format('Y/m/d') }}
                                    <div style="font-size: 0.8rem; color: var(--gray);">
                                        {{ $category->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $category->is_active ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm" title="ویرایش">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('admin.categories.toggleStatus', $category) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn {{ $category->is_active ? 'btn-warning' : 'btn-success' }} btn-sm" 
                                                    title="{{ $category->is_active ? 'غیرفعال' : 'فعال' }}">
                                                <i class="fas {{ $category->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirm('آیا از حذف دسته‌بندی «{{ $category->name }}» مطمئن هستید؟\n\n⚠️ توجه: محصولات این دسته‌بندی حذف نخواهند شد.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- پاگینیشن -->
                <div class="pagination-container">
                    @if($categories->hasPages())
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($categories->onFirstPage())
                                <li class="disabled" aria-disabled="true">
                                    <span><i class="fas fa-chevron-right"></i></span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $categories->previousPageUrl() }}" rel="prev">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                @if ($page == $categories->currentPage())
                                    <li class="active" aria-current="page">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($categories->hasMorePages())
                                <li>
                                    <a href="{{ $categories->nextPageUrl() }}" rel="next">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @else
                                <li class="disabled" aria-disabled="true">
                                    <span><i class="fas fa-chevron-left"></i></span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open" style="font-size: 3rem; margin-bottom: 10px;"></i>
                    <h3>دسته‌بندی‌ای یافت نشد</h3>
                    <p style="margin-top: 5px; color: var(--gray);">
                        @if(request()->hasAny(['search', 'status', 'sort']))
                            با فیلترهای جاری دسته‌بندی‌ای وجود ندارد.
                        @else
                            هنوز دسته‌بندی‌ای ثبت نشده است.
                        @endif
                    </p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                        ایجاد دسته‌بندی جدید
                    </a>
                </div>
            @endif
        </div>
    </div>
    
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
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // حذف خودکار بعد از 3 ثانیه
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.classList.add('notification-hide');
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
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

        // فقط جستجو با دکمه Enter
        document.getElementById('search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('search-form').submit();
            }
        });
    </script>
</body>
</html>