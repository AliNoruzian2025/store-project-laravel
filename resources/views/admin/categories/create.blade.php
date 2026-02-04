<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد دسته جدید - پنل ادمین</title>
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
            justify-content: flex-end;
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
                <i class="fas fa-plus-circle"></i>
                ایجاد دسته جدید
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
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">نام دسته <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" 
                           placeholder="مثال: لبنیات" required autofocus>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <span>دسته فعال باشد</span>
                    </label>
                    <small style="display: block; margin-top: 5px; color: var(--gray); font-size: 0.85rem;">
                        اگر غیرفعال باشد، در سایت نمایش داده نمی‌شود.
                    </small>
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                        انصراف
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        ذخیره دسته
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>