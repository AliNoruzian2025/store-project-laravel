<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد کاربر جدید - پنل ادمین</title>
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
        
        .form-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border);
            color: var(--dark);
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
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        .password-strength {
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0%;
            transition: all 0.3s;
        }
        
        .strength-weak { background: #e74c3c; }
        .strength-fair { background: #f39c12; }
        .strength-good { background: #3498db; }
        .strength-strong { background: #2ecc71; }
        
        .password-requirements {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 10px;
        }
        
        .requirement {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 3px;
        }
        
        .requirement.valid {
            color: var(--success);
        }
        
        .requirement.valid::before {
            content: '✓';
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
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* استایل‌های اضافی */
        .form-help {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 5px;
            display: block;
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        
        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .radio-label input[type="radio"] {
            width: 18px;
            height: 18px;
        }
    </style>
</head>
<body>
    <!-- هدر -->
    <header class="header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-user-plus"></i>
                ایجاد کاربر جدید
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به لیست
                </a>
            </div>
        </div>
    </header>

    <!-- فرم ایجاد کاربر -->
    <div class="form-container">
        <div class="form-card">
            <h2 class="form-title">اطلاعات کاربر جدید</h2>
            
            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: var(--radius); margin-bottom: 25px;">
                    <ul style="margin: 0; padding-right: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm">
                @csrf
                
                <div class="form-grid">
                    <!-- نام -->
                    <div class="form-group">
                        <label class="form-label required">نام</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') error @enderror" 
                               value="{{ old('first_name') }}" required placeholder="نام کاربر">
                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- نام خانوادگی -->
                    <div class="form-group">
                        <label class="form-label required">نام خانوادگی</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') error @enderror" 
                               value="{{ old('last_name') }}" required placeholder="نام خانوادگی کاربر">
                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- شماره موبایل -->
                    <div class="form-group">
                        <label class="form-label required">شماره موبایل</label>
                        <input type="text" name="mobile" class="form-control @error('mobile') error @enderror" 
                               value="{{ old('mobile') }}" required placeholder="09xxxxxxxxx" dir="ltr">
                        @error('mobile')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <span class="form-help">شماره موبایل باید با 09 شروع شود و 11 رقم باشد</span>
                    </div>
                    
                    <!-- نقش -->
                    <div class="form-group">
                        <label class="form-label required">نقش کاربر</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="role" value="user" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                                <span>کاربر عادی</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                                <span>مدیر</span>
                            </label>
                        </div>
                        @error('role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- رمز عبور -->
                    <div class="form-group">
                        <label class="form-label required">رمز عبور</label>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') error @enderror" 
                               required minlength="8">
                        <div class="password-strength">
                            <div class="strength-meter" id="passwordStrength"></div>
                        </div>
                        <div class="password-requirements">
                            <div class="requirement" id="reqLength">حداقل ۸ کاراکتر</div>
                            <div class="requirement" id="reqUppercase">حاوی حروف بزرگ</div>
                            <div class="requirement" id="reqLowercase">حاوی حروف کوچک</div>
                            <div class="requirement" id="reqNumber">حاوی عدد</div>
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- تأیید رمز عبور -->
                    <div class="form-group">
                        <label class="form-label required">تأیید رمز عبور</label>
                        <input type="password" name="password_confirmation" id="passwordConfirm" 
                               class="form-control" required minlength="8">
                        <span class="error-message" id="passwordMatchError" style="display: none;">رمز عبورها مطابقت ندارند</span>
                    </div>
                    
                    <!-- آدرس -->
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">آدرس</label>
                        <textarea name="address" class="form-control @error('address') error @enderror" 
                                  rows="3" placeholder="آدرس کامل کاربر">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- کد پستی -->
                    <div class="form-group">
                        <label class="form-label">کد پستی</label>
                        <input type="text" name="postal_code" class="form-control @error('postal_code') error @enderror" 
                               value="{{ old('postal_code') }}" placeholder="۱۰ رقم" dir="ltr">
                        @error('postal_code')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="reset" class="btn btn-outline">
                        <i class="fas fa-redo"></i>
                        بازنشانی فرم
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        ایجاد کاربر
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // بررسی قدرت رمز عبور
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordConfirm = document.getElementById('passwordConfirm');
        const passwordMatchError = document.getElementById('passwordMatchError');
        
        // المنت‌های شرایط رمز عبور
        const reqLength = document.getElementById('reqLength');
        const reqUppercase = document.getElementById('reqUppercase');
        const reqLowercase = document.getElementById('reqLowercase');
        const reqNumber = document.getElementById('reqNumber');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // بررسی شرایط
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            
            // آپدیت وضعیت شرایط
            updateRequirement(reqLength, hasLength);
            updateRequirement(reqUppercase, hasUppercase);
            updateRequirement(reqLowercase, hasLowercase);
            updateRequirement(reqNumber, hasNumber);
            
            // محاسبه قدرت
            if (hasLength) strength++;
            if (hasUppercase) strength++;
            if (hasLowercase) strength++;
            if (hasNumber) strength++;
            
            // نمایش قدرت
            updateStrengthMeter(strength);
            
            // بررسی مطابقت رمز عبور
            checkPasswordMatch();
        });
        
        passwordConfirm.addEventListener('input', checkPasswordMatch);
        
        function updateRequirement(element, isValid) {
            if (isValid) {
                element.classList.add('valid');
            } else {
                element.classList.remove('valid');
            }
        }
        
        function updateStrengthMeter(strength) {
            let width = 0;
            let className = '';
            
            switch(strength) {
                case 0:
                    width = 0;
                    className = 'strength-weak';
                    break;
                case 1:
                    width = 25;
                    className = 'strength-weak';
                    break;
                case 2:
                    width = 50;
                    className = 'strength-fair';
                    break;
                case 3:
                    width = 75;
                    className = 'strength-good';
                    break;
                case 4:
                    width = 100;
                    className = 'strength-strong';
                    break;
            }
            
            passwordStrength.style.width = width + '%';
            passwordStrength.className = 'strength-meter ' + className;
        }
        
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirm.value;
            
            if (confirmPassword.length > 0 && password !== confirmPassword) {
                passwordMatchError.style.display = 'block';
                passwordConfirm.classList.add('error');
            } else {
                passwordMatchError.style.display = 'none';
                passwordConfirm.classList.remove('error');
            }
        }
        
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
        
        // بررسی قبل از ارسال فرم
        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirm.value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('رمز عبور و تأیید رمز عبور مطابقت ندارند.');
                passwordInput.focus();
            }
        });
    </script>
</body>
</html>