<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به فروشگاه</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border: #dee2e6;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        .auth-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 25px 30px;
            text-align: center;
        }

        .auth-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .auth-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .auth-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 14px 45px 14px 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
            background: #f8f9fa;
            text-align: right;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
            background: #fffafa;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:disabled {
            background: var(--gray);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .auth-links {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .auth-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .auth-link:hover {
            color: var(--secondary);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-error {
            background: linear-gradient(to right, #ffeaea, #fff0f0);
            color: var(--danger);
            border: 1px solid #ffcccc;
            border-right: 4px solid var(--danger);
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .password-toggle {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 480px) {
            .auth-body {
                padding: 20px;
            }
            
            .auth-header {
                padding: 20px;
            }
            
            .auth-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1><i class="fas fa-store"></i> فروشگاه ما</h1>
            <p>به حساب کاربری خود وارد شوید</p>
        </div>
        
        <div class="auth-body">
            @if($errors->any())
                <div class="alert alert-error shake">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form id="login-form" method="POST" action="{{ route('do.login') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">شماره موبایل</label>
                    <div class="input-with-icon">
                        <i class="fas fa-mobile-alt input-icon"></i>
                        <input type="text" name="mobile" id="mobile-input" class="form-input @error('mobile') error @enderror" 
                               placeholder="مثال: ۰۹۱۲۳۴۵۶۷۸۹" maxlength="11"
                               value="{{ old('mobile') }}" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">رمز عبور</label>
                    <div class="input-with-icon">
                        <!-- فقط دکمه چشم وجود دارد -->
                        <input type="password" name="password" id="password-input" class="form-input @error('password') error @enderror" 
                               placeholder="رمز عبور خود را وارد کنید" required>
                        <button type="button" class="password-toggle" id="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn" id="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>ورود به حساب</span>
                </button>
            </form>
            
            <div class="auth-links">
                <a href="{{ route('password.forgot') }}" class="auth-link">
                    <i class="fas fa-key"></i>
                    <span>فراموشی رمز عبور</span>
                </a>
                <a href="{{ route('register') }}" class="auth-link">
                    <i class="fas fa-user-plus"></i>
                    <span>ثبت‌نام جدید</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password-input');
            const passwordToggle = document.getElementById('password-toggle');
            
            // نمایش/مخفی کردن رمز عبور
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // اعتبارسنجی ساده موبایل قبل از ارسال
            const form = document.getElementById('login-form');
            const mobileInput = document.getElementById('mobile-input');
            
            form.addEventListener('submit', function(e) {
                const mobile = mobileInput.value.trim();
                
                // اعتبارسنجی شماره موبایل
                if (!/^09\d{9}$/.test(mobile)) {
                    e.preventDefault();
                    showInlineError('شماره موبایل نامعتبر است. لطفاً شماره درست را وارد کنید', mobileInput);
                    return;
                }
            });
            
            function showInlineError(message, inputElement) {
                // حذف خطاهای قبلی
                const existingError = inputElement.parentNode.querySelector('.inline-error');
                if (existingError) existingError.remove();
                
                // اضافه کردن خطای جدید
                const errorDiv = document.createElement('div');
                errorDiv.className = 'inline-error';
                errorDiv.style.cssText = 'color: var(--danger); font-size: 13px; margin-top: 5px; animation: slideDown 0.3s ease;';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                
                inputElement.parentNode.appendChild(errorDiv);
                inputElement.classList.add('error');
                inputElement.focus();
                
                // لرزش
                errorDiv.classList.add('shake');
                setTimeout(() => errorDiv.classList.remove('shake'), 500);
            }
        });
    </script>
</body>
</html>