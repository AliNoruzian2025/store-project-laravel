<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش دسته - پنل ادمین</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --danger: #e74c3c;
            --dark: #2b2d42;
            --gray: #6c757d;
            --border: #dee2e6;
            --radius: 8px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            color: var(--dark);
        }
        
        .header {
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            color: white;
            padding: 15px 30px;
        }
        
        .header-content {
            max-width: 800px;
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
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
        .btn-danger { background: var(--danger); color: white; }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .form-card {
            background: white;
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .category-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .category-meta {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        .error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-edit"></i>
                ویرایش دسته
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به لیست
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="form-card">
            <div class="category-info">
                <div>
                    <strong>{{ $category->name }}</strong>
                    <div class="category-meta">
                        Slug: <code>{{ $category->slug }}</code> | 
                        ایجاد شده در: {{ $category->created_at->format('Y/m/d') }}
                    </div>
                </div>
                <div>
                    <span style="padding: 4px 8px; border-radius: 15px; font-size: 0.8rem; 
                          background: {{ $category->is_active ? '#d1fae5' : '#fee2e2' }};
                          color: {{ $category->is_active ? '#065f46' : '#991b1b' }};">
                        {{ $category->is_active ? 'فعال' : 'غیرفعال' }}
                    </span>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">نام دسته <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <span>دسته فعال باشد</span>
                    </label>
                </div>
                
                <div class="form-actions">
                    <div>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                              style="display: inline;"
                              onsubmit="return confirm('حذف این دسته؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                حذف دسته
                            </button>
                        </form>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                            انصراف
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            ذخیره تغییرات
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>