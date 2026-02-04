<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش محصول - پنل ادمین</title>
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
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .form-text {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 5px;
        }
        
        .text-danger {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .checkbox-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        .image-preview {
            margin-top: 10px;
            text-align: center;
        }
        
        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            padding: 5px;
        }
        
        .required::after {
            content: " *";
            color: var(--danger);
        }
        
        .stock-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .stock-input {
            flex: 1;
        }
        
        .product-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            border-right: 4px solid var(--primary);
        }
        
        .info-row {
            display: flex;
            gap: 20px;
            margin-bottom: 5px;
            flex-wrap: wrap;
        }
        
        .info-label {
            font-weight: 500;
            min-width: 100px;
        }
        
        .info-value {
            color: var(--dark);
        }
        
        .slug {
            background: #e9ecef;
            padding: 3px 8px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-edit"></i>
                ویرایش محصول
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به لیست
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: var(--radius); margin-bottom: 15px;">
                <strong><i class="fas fa-exclamation-triangle"></i> خطاهای زیر رخ داد:</strong>
                <ul style="margin: 10px 0 0 20px; padding-right: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

        <!-- اطلاعات محصول -->
        <div class="product-info">
            <div class="info-row">
                <div>
                    <span class="info-label">شناسه:</span>
                    <span class="info-value">{{ $product->id }}</span>
                </div>
                <div>
                    <span class="info-label">اسلاگ:</span>
                    <span class="info-value slug">{{ $product->slug }}</span>
                </div>
                <div>
                    <span class="info-label">تاریخ ایجاد:</span>
                    <span class="info-value">{{ verta($product->created_at)->format('Y/m/d H:i') }}</span>
                </div>
                <div>
                    <span class="info-label">آخرین ویرایش:</span>
                    <span class="info-value">{{ verta($product->updated_at)->format('Y/m/d H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- فرم ویرایش -->
        <form method="POST" action="{{ route('admin.products.update', $product) }}" class="card" id="product-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="name">
                        نام محصول
                    </label>
                    <input type="text" id="name" name="name" class="form-control" 
                           value="{{ old('name', $product->name) }}" required maxlength="200">
                    <div class="form-text">حداکثر 200 کاراکتر</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="category_id">
                        دسته‌بندی
                    </label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">بدون دسته‌بندی</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="description">
                    توضیحات محصول
                </label>
                <textarea id="description" name="description" class="form-control" rows="4" maxlength="1000">{{ old('description', $product->description) }}</textarea>
                <div class="form-text">حداکثر 1000 کاراکتر</div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="price">
                        قیمت اصلی (تومان)
                    </label>
                    <input type="number" id="price" name="price" class="form-control" 
                           value="{{ old('price', $product->price) }}" min="0" max="999999999999" step="any" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="discount_price">
                        قیمت با تخفیف (تومان)
                    </label>
                    <input type="number" id="discount_price" name="discount_price" class="form-control" 
                           value="{{ old('discount_price', $product->discount_price) }}" min="0" max="999999999999" step="any">
                    <div class="form-text">در صورت نداشتن تخفیف خالی بگذارید</div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="stock">
                        موجودی (عدد)
                    </label>
                    <input type="number" id="stock" name="stock" class="form-control" 
                           value="{{ old('stock', $product->stock) }}" min="0" max="999999" required>
                    <div class="form-text">موجودی فعلی: {{ $product->stock }} عدد</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label required" for="image">
                        آدرس تصویر محصول
                    </label>
                    <input type="url" id="image" name="image" class="form-control" 
                           value="{{ old('image', $product->image) }}" required maxlength="500">
                    <div class="form-text">آدرس کامل تصویر محصول (URL) - حداکثر 500 کاراکتر</div>
                    
                    <div class="image-preview" id="image-preview">
                        @if($product->image)
                            <p>تصویر فعلی:</p>
                            <img src="{{ $product->image }}" alt="تصویر محصول" 
                                 onerror="this.style.display='none'; this.parentElement.innerHTML='<p style=color:var(--danger)><i class=fas fa-exclamation-circle></i> تصویر قابل نمایش نیست</p>'">
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">وضعیت محصول</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <span>فعال</span>
                        </label>
                        
                        <label class="checkbox-label">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <span>ویژه</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    بروزرسانی محصول
                </button>
                
                <button type="reset" class="btn btn-outline">
                    <i class="fas fa-undo"></i>
                    بازنشانی تغییرات
                </button>
                
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                    <i class="fas fa-times"></i>
                    انصراف
                </a>
                
                <button type="button" class="btn btn-danger" 
                        onclick="if(confirm('آیا از حذف این محصول مطمئن هستید؟')) { document.getElementById('delete-form').submit(); }">
                    <i class="fas fa-trash"></i>
                    حذف محصول
                </button>
            </div>
        </form>

        <!-- مدیریت موجودی -->
        <div class="card">
            <h3 style="margin-bottom: 15px; color: var(--dark);">
                <i class="fas fa-boxes"></i>
                مدیریت موجودی
            </h3>
            
            <div class="form-row">
                <form method="POST" action="{{ route('admin.products.increaseStock', $product) }}" class="form-group" style="margin-bottom: 0;">
                    @csrf
                    <div style="display: flex; gap: 10px; align-items: flex-end;">
                        <div style="flex: 1;">
                            <label class="form-label">افزایش موجودی</label>
                            <input type="number" name="quantity" class="form-control stock-input" value="1" min="1" max="999999" required>
                        </div>
                        <button type="submit" class="btn btn-success" style="height: 42px;">
                            <i class="fas fa-plus"></i>
                            افزایش
                        </button>
                    </div>
                </form>
                
                <form method="POST" action="{{ route('admin.products.decreaseStock', $product) }}" class="form-group" style="margin-bottom: 0;">
                    @csrf
                    <div style="display: flex; gap: 10px; align-items: flex-end;">
                        <div style="flex: 1;">
                            <label class="form-label">کاهش موجودی</label>
                            <input type="number" name="quantity" class="form-control stock-input" value="1" min="1" max="999999" required>
                        </div>
                        <button type="submit" class="btn btn-warning" style="height: 42px;">
                            <i class="fas fa-minus"></i>
                            کاهش
                        </button>
                    </div>
                </form>
            </div>
            
            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border);">
                <div class="info-row">
                    <div>
                        <span class="info-label">موجودی فعلی:</span>
                        <span class="info-value" style="font-weight: bold; color: {{ $product->stock > 0 ? 'var(--success)' : 'var(--danger)' }};">
                            {{ number_format($product->stock) }} عدد
                        </span>
                    </div>
                    <div>
                        <span class="info-label">وضعیت:</span>
                        <span class="info-value">
                            @if($product->stock > 10)
                                <span style="color: var(--success);">✅ موجود</span>
                            @elseif($product->stock > 0)
                                <span style="color: var(--warning);">⚠️ کم موجود</span>
                            @else
                                <span style="color: var(--danger);">❌ تمام شده</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- فرم حذف (مخفی) -->
        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" id="delete-form" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    
    <script>
        // پیش‌نمایش تصویر
        document.getElementById('image').addEventListener('input', function() {
            const preview = document.getElementById('image-preview');
            const imageUrl = this.value;
            
            if (imageUrl) {
                preview.innerHTML = `
                    <p>پیش‌نمایش:</p>
                    <img src="${imageUrl}" alt="پیش‌نمایش تصویر" 
                         onerror="this.style.display='none'; this.parentElement.innerHTML='<p style=color:var(--danger)><i class=fas fa-exclamation-circle></i> تصویر قابل نمایش نیست</p>'">
                `;
            } else {
                preview.innerHTML = '';
            }
        });
        
        // اعتبارسنجی قیمت تخفیف
        document.getElementById('discount_price').addEventListener('input', function() {
            const price = parseFloat(document.getElementById('price').value) || 0;
            const discount = parseFloat(this.value) || 0;
            
            if (discount > 0 && discount >= price) {
                this.setCustomValidity('قیمت تخفیف باید کمتر از قیمت اصلی باشد');
            } else {
                this.setCustomValidity('');
            }
        });
        
        // فرم تایید
        document.getElementById('product-form').addEventListener('submit', function(e) {
            const price = parseFloat(document.getElementById('price').value) || 0;
            const discount = parseFloat(document.getElementById('discount_price').value) || 0;
            
            if (discount > 0 && discount >= price) {
                e.preventDefault();
                alert('قیمت تخفیف باید کمتر از قیمت اصلی باشد');
                return false;
            }
            
            return true;
        });
        
        // مدیریت موجودی
        document.querySelectorAll('.stock-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.select();
            });
        });
    </script>
</body>
</html>