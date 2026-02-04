<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محصولات - پنل ادمین</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid var(--border);
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
        
        .price {
            font-weight: bold;
        }
        
        .discount-price {
            text-decoration: line-through;
            color: var(--gray);
            font-size: 0.9rem;
            display: block;
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
        
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .pagination li {
            margin: 0 5px;
        }
        
        .pagination li a {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--primary);
        }
        
        .pagination li.active a {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .pagination li.disabled a {
            color: var(--gray);
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-box"></i>
                مدیریت محصولات
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    محصول جدید
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: var(--radius); margin-bottom: 15px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: var(--radius); margin-bottom: 15px;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                <div class="stat-label">کل محصولات</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['active'] ?? 0 }}</div>
                <div class="stat-label">فعال</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['featured'] ?? 0 }}</div>
                <div class="stat-label">ویژه</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $stats['with_discount'] ?? 0 }}</div>
                <div class="stat-label">تخفیف‌دار</div>
            </div>
        </div>

        <div class="filters">
            <form method="GET" action="{{ route('admin.products.index') }}" id="search-form">
                <div class="form-group">
                    <label>جستجو</label>
                    <input type="text" name="search" class="form-control" placeholder="نام محصول..." 
                           value="{{ request('search') }}" id="search-input">
                </div>
                
                <div class="form-group">
                    <label>دسته‌بندی</label>
                    <select name="category_id" class="form-control" id="category-select">
                        <option value="">همه دسته‌ها</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>وضعیت</label>
                    <select name="status" class="form-control" id="status-select">
                        <option value="">همه</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                        <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>ویژه</option>
                        <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>تمام شده</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="height: 42px;">
                        <i class="fas fa-search"></i> جستجو
                    </button>
                    @if(request()->hasAny(['search', 'category_id', 'status']))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="height: 42px;">
                            <i class="fas fa-times"></i> پاک کردن
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div>لیست محصولات</div>
                <div style="font-size: 0.9rem; color: var(--gray);">
                    {{ $products->total() }} محصول
                </div>
            </div>
            
            @if($products->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>محصول</th>
                            <th>قیمت</th>
                            <th>موجودی</th>
                            <th>دسته</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div style="display: flex; gap: 10px; align-items: center;">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                             class="product-image" 
                                             onerror="this.src='https://via.placeholder.com/60?text=No+Image'">
                                        <div>
                                            <strong>{{ $product->name }}</strong>
                                            @if($product->description)
                                                <div style="font-size: 0.8rem; color: var(--gray); margin-top: 3px;">
                                                    {{ Str::limit($product->description, 30) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($product->discount_price)
                                        <span class="discount-price">{{ number_format($product->price) }} تومان</span>
                                        <span class="price" style="color: var(--danger);">
                                            {{ number_format($product->discount_price) }} تومان
                                        </span>
                                    @else
                                        <span class="price">{{ number_format($product->price) }} تومان</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="badge badge-success">{{ $product->stock }} عدد</span>
                                    @else
                                        <span class="badge badge-danger">تمام شده</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge badge-secondary">{{ $product->category->name }}</span>
                                    @else
                                        <span class="badge badge-secondary">بدون دسته</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 3px;">
                                        <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $product->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                        @if($product->is_featured)
                                            <span class="badge badge-warning">ویژه</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('admin.products.toggleStatus', $product) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn {{ $product->is_active ? 'btn-warning' : 'btn-success' }} btn-sm" 
                                                    title="{{ $product->is_active ? 'غیرفعال' : 'فعال' }}">
                                                <i class="fas {{ $product->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.products.toggleFeatured', $product) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn {{ $product->is_featured ? 'btn-secondary' : 'btn-info' }} btn-sm"
                                                    title="{{ $product->is_featured ? 'عادی' : 'ویژه' }}">
                                                <i class="fas {{ $product->is_featured ? 'fa-star' : 'fa-star' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirm('آیا از حذف محصول «{{ $product->name }}» مطمئن هستید؟')">
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
                    @if($products->hasPages())
                        <div class="pagination">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 10px;"></i>
                    <h3>محصولی یافت نشد</h3>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                        ایجاد اولین محصول
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <script>
        // فیلترهای خودکار
        document.getElementById('category-select').addEventListener('change', function() {
            document.getElementById('search-form').submit();
        });

        document.getElementById('status-select').addEventListener('change', function() {
            document.getElementById('search-form').submit();
        });

        // جستجو با Enter
        document.getElementById('search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('search-form').submit();
            }
        });
    </script>
</body>
</html>