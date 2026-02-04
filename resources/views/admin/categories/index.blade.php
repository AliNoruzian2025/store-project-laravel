<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌بندی‌ها</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #dee2e6;
            --radius: 8px;
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
        
        .header {
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            color: white;
            padding: 15px 30px;
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
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
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
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
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
        
        .filters {
            background: white;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
        }
        
        .form-group {
            flex: 1;
            min-width: 200px;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
        }
        
        .table {
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
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
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
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-tags"></i>
                مدیریت دسته‌بندی‌ها
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    دسته جدید
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: var(--radius); margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: var(--radius); margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

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
        </div>

        <div class="filters">
            <div class="form-group">
                <label>جستجو</label>
                <input type="text" name="search" class="form-control" placeholder="نام دسته..." 
                       value="{{ request('search') }}" onchange="this.form.submit()">
            </div>
            
            <div class="form-group">
                <label>وضعیت</label>
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">همه</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                </select>
            </div>
            
            <form method="GET" action="{{ route('admin.categories.index') }}" style="display: contents;"></form>
        </div>

        <div class="table">
            <div class="table-header">
                <div>لیست دسته‌بندی‌ها</div>
                <div style="font-size: 0.9rem; color: var(--gray);">
                    {{ $categories->total() }} دسته‌بندی
                </div>
            </div>
            
            @if($categories->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>Slug</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                    @if($category->products_count)
                                        <div style="font-size: 0.8rem; color: var(--gray);">
                                            {{ $category->products_count }} محصول
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <code style="font-size: 0.8rem;">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $category->is_active ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $category->created_at->format('Y/m/d') }}
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('admin.categories.toggleStatus', $category) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn {{ $category->is_active ? 'btn-warning' : 'btn-success' }} btn-sm">
                                                <i class="fas {{ $category->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirm('حذف {{ $category->name }}؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="padding: 15px; border-top: 1px solid var(--border);">
                    {{ $categories->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open" style="font-size: 3rem; margin-bottom: 10px;"></i>
                    <h3>دسته‌بندی‌ای یافت نشد</h3>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                        ایجاد اولین دسته‌بندی
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>