<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش کاربر - پنل ادمین</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --success: #2ecc71;
            --danger: #e74c3c;
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
            max-width: 800px;
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
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        /* فرم */
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .form-card {
            background: white;
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        
        .user-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border);
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
        }
        
        .user-info h2 {
            margin-bottom: 5px;
            font-size: 1.5rem;
        }
        
        .user-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .user-stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
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
        
        .form-label.required::after {
            content: ' *';
            color: var(--danger);
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
        
        .form-control.error {
            border-color: var(--danger);
        }
        
        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        .action-left, .action-right {
            display: flex;
            gap: 10px;
        }
        
        .form-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 10px;
        }
        
        .tab-btn {
            padding: 10px 20px;
            background: none;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            color: var(--gray);
            transition: all 0.3s;
        }
        
        .tab-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* ریسپانسیو */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .action-left, .action-right {
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .user-header {
                flex-direction: column;
                text-align: center;
            }
            
            .user-stats {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-user-edit"></i>
                ویرایش کاربر
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به لیست
                </a>
            </div>
        </div>
    </header>

    <!-- فرم ویرایش کاربر -->
    <div class="form-container">
        <div class="form-card">
            <!-- هدر کاربر -->
            <div class="user-header">
                <div class="user-avatar">
                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                </div>
                <div class="user-info">
                    <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <p>ID: #{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <div class="user-stats">
                        <div class="stat-item">
                            <i class="fas fa-mobile-alt"></i>
                            <span>{{ $user->mobile }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-user-tag"></i>
                            <span>{{ $user->role == 'admin' ? 'مدیر' : 'کاربر' }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $user->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: var(--radius); margin-bottom: 25px;">
                    <ul style="margin: 0; padding-right: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: var(--radius); margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                    {{ session('success') }}
                    <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 1.2rem; cursor: pointer;">×</button>
                </div>
            @endif
            
            <!-- تب‌ها -->
            <div class="form-tabs">
                <button type="button" class="tab-btn active" onclick="showTab('info-tab')">
                    <i class="fas fa-user"></i>
                    اطلاعات کاربر
                </button>
                <button type="button" class="tab-btn" onclick="showTab('password-tab')">
                    <i class="fas fa-key"></i>
                    تغییر رمز عبور
                </button>
            </div>
            
            <!-- تب اطلاعات کاربر -->
            <div id="info-tab" class="tab-content active">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-grid">
                        <!-- نام -->
                        <div class="form-group">
                            <label class="form-label required">نام</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') error @enderror" 
                                   value="{{ old('first_name', $user->first_name) }}" required>
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- نام خانوادگی -->
                        <div class="form-group">
                            <label class="form-label required">نام خانوادگی</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') error @enderror" 
                                   value="{{ old('last_name', $user->last_name) }}" required>
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- شماره موبایل -->
                        <div class="form-group">
                            <label class="form-label required">شماره موبایل</label>
                            <input type="text" name="mobile" class="form-control @error('mobile') error @enderror" 
                                   value="{{ old('mobile', $user->mobile) }}" required dir="ltr">
                            @error('mobile')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- نقش -->
                        <div class="form-group">
                            <label class="form-label required">نقش کاربر</label>
                            <select name="role" class="form-control @error('role') error @enderror" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>کاربر عادی</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدیر</option>
                            </select>
                            @error('role')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- آدرس -->
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">آدرس</label>
                            <textarea name="address" class="form-control @error('address') error @enderror" 
                                      rows="3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- کد پستی -->
                        <div class="form-group">
                            <label class="form-label">کد پستی</label>
                            <input type="text" name="postal_code" class="form-control @error('postal_code') error @enderror" 
                                   value="{{ old('postal_code', $user->postal_code) }}" dir="ltr">
                            @error('postal_code')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <div class="action-left">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                                <i class="fas fa-times"></i>
                                انصراف
                            </a>
                        </div>
                        <div class="action-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                ذخیره تغییرات
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- تب تغییر رمز عبور -->
            <div id="password-tab" class="tab-content">
                <form method="POST" action="{{ route('admin.users.changePassword', $user) }}" id="changePasswordForm">
                    @csrf
                    
                    <div class="form-grid">
                        <!-- رمز عبور جدید -->
                        <div class="form-group">
                            <label class="form-label required">رمز عبور جدید</label>
                            <input type="password" name="password" id="newPassword" 
                                   class="form-control @error('password') error @enderror" 
                                   required minlength="8">
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- تأیید رمز عبور -->
                        <div class="form-group">
                            <label class="form-label required">تأیید رمز عبور</label>
                            <input type="password" name="password_confirmation" id="confirmPassword" 
                                   class="form-control" required minlength="8">
                            <span class="error-message" id="passwordMatchError" style="display: none;">رمز عبورها مطابقت ندارند</span>
                        </div>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 15px; border-radius: var(--radius); margin: 20px 0;">
                        <h4 style="margin-bottom: 10px; color: var(--dark);">
                            <i class="fas fa-info-circle"></i>
                            نکات مهم
                        </h4>
                        <ul style="color: var(--gray); font-size: 0.9rem; padding-right: 20px;">
                            <li>رمز عبور باید حداقل ۸ کاراکتر باشد</li>
                            <li>توصیه می‌شود از ترکیب حروف، اعداد و نمادها استفاده کنید</li>
                            <li>پس از تغییر رمز عبور، کاربر باید با رمز جدید وارد شود</li>
                        </ul>
                    </div>
                    
                    <div class="form-actions">
                        <div class="action-left">
                            <button type="button" class="btn btn-outline" onclick="showTab('info-tab')">
                                <i class="fas fa-arrow-right"></i>
                                بازگشت
                            </button>
                        </div>
                        <div class="action-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key"></i>
                                تغییر رمز عبور
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- بخش حذف کاربر -->
            <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #fee2e2;">
                <h3 style="color: var(--danger); margin-bottom: 15px;">
                    <i class="fas fa-exclamation-triangle"></i>
                    ناحیه خطر
                </h3>
                <!-- ادامه از کد قبلی -->
                    <div style="background: #fee2e2; padding: 20px; border-radius: var(--radius);">
                        <h4 style="color: #991b1b; margin-bottom: 10px;">حذف کاربر</h4>
                        <p style="color: #991b1b; margin-bottom: 15px; font-size: 0.9rem;">
                            <i class="fas fa-exclamation-circle"></i>
                            توجه: این عمل قابل بازگشت نیست. پس از حذف کاربر، تمام اطلاعات مربوط به وی از سیستم پاک خواهد شد.
                        </p>
                        
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                              id="deleteForm"
                              onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <div style="display: flex; gap: 10px;">
                                <input type="password" 
                                       id="deletePassword" 
                                       placeholder="برای تأیید، رمز عبور خود را وارد کنید" 
                                       style="flex: 1; padding: 10px; border: 1px solid #fca5a5; border-radius: var(--radius);"
                                       required>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    حذف کاربر
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // مدیریت تب‌ها
        function showTab(tabId) {
            // مخفی کردن همه تب‌ها
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // غیرفعال کردن همه دکمه‌های تب
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // نمایش تب انتخاب شده
            document.getElementById(tabId).classList.add('active');
            
            // فعال کردن دکمه تب مربوطه
            event.target.classList.add('active');
        }
        
        // بررسی مطابقت رمز عبور در تب تغییر رمز
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordMatchError = document.getElementById('passwordMatchError');
        
        function checkPasswordMatch() {
            if (confirmPassword.value && newPassword.value !== confirmPassword.value) {
                passwordMatchError.style.display = 'block';
                confirmPassword.classList.add('error');
                return false;
            } else {
                passwordMatchError.style.display = 'none';
                confirmPassword.classList.remove('error');
                return true;
            }
        }
        
        newPassword.addEventListener('input', checkPasswordMatch);
        confirmPassword.addEventListener('input', checkPasswordMatch);
        
        // فرم تغییر رمز عبور
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            if (!checkPasswordMatch()) {
                e.preventDefault();
                alert('رمز عبور و تأیید رمز عبور مطابقت ندارند.');
            }
        });
        
        // فرمت خودکار موبایل
        document.querySelector('input[name="mobile"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('9')) {
                value = '0' + value;
            }
            e.target.value = value.substring(0, 11);
        });
        
        // فرمت خودکار کد پستی
        document.querySelector('input[name="postal_code"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value.substring(0, 10);
        });
        
        // تایید حذف کاربر
        function confirmDelete() {
            const userFullName = "{{ $user->first_name }} {{ $user->last_name }}";
            const password = document.getElementById('deletePassword').value;
            
            if (!password) {
                alert('لطفاً رمز عبور خود را برای تأیید حذف وارد کنید.');
                return false;
            }
            
            return confirm(`آیا از حذف کاربر "${userFullName}" اطمینان دارید؟\nاین عمل قابل بازگشت نیست و تمام اطلاعات کاربر پاک خواهد شد.`);
        }
        
        // اعتبارسنجی فرم حذف
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            const password = document.getElementById('deletePassword').value;
            if (!password) {
                e.preventDefault();
                alert('لطفاً رمز عبور خود را وارد کنید.');
                return false;
            }
            
            // در اینجا می‌توانید رمز عبور ادمین را بررسی کنید
            // این قسمت نیاز به پیاده‌سازی در سمت سرور دارد
        });
    </script>
</body>
</html>