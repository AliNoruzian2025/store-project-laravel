<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازیابی رمز عبور - فروشگاه</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
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
            max-width: 450px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        .auth-header {
            background: linear-gradient(to right, var(--warning), #ff6b35);
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

        .form-step {
            display: none;
            animation: slideIn 0.3s ease;
        }

        .form-step.active {
            display: block;
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
            padding: 14px 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--warning);
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
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

        .input-with-icon .form-input {
            padding-right: 16px;
            padding-left: 45px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--warning), #ff6b35);
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
            box-shadow: 0 6px 12px rgba(255, 107, 53, 0.2);
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

        .btn-outline {
            background: white;
            color: var(--warning);
            border: 2px solid var(--warning);
        }

        .btn-outline:hover {
            background: var(--warning);
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-group .btn {
            flex: 1;
        }

        /* پیام‌ها - پایین‌تر از دکمه‌ها */
        .messages-container {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            display: none;
            transition: var(--transition);
        }

        .messages-container.visible {
            display: block;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: none;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            animation: fadeIn 0.3s ease;
        }

        .alert-error {
            background: #fee;
            color: #721c24;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #e8f8ef;
            color: #28a745;
            border: 1px solid #b8e0c7;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .alert-info {
            background: #e7f1ff;
            color: #0d6efd;
            border: 1px solid #b6d4fe;
        }

        .alert-user-error {
            background: #e7f1ff !important;
            color: #0d6efd !important;
            border: 1px solid #b6d4fe !important;
        }

        .timer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
            padding: 12px 16px;
            background: var(--light);
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .timer {
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
            color: var(--warning);
            background: white;
            padding: 4px 12px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .timer.expired {
            color: var(--danger);
        }

        .resend-link {
            color: var(--warning);
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .resend-link:hover {
            color: #ff6b35;
        }

        .resend-link.disabled {
            color: var(--gray);
            cursor: not-allowed;
        }

        .password-requirements {
            font-size: 12px;
            color: var(--gray);
            margin-top: 5px;
            line-height: 1.5;
        }

        .auth-links {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
        }

        .auth-link {
            color: var(--warning);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .auth-link:hover {
            color: #ff6b35;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease;
        }

        @media (max-width: 480px) {
            .auth-body {
                padding: 20px;
            }
            
            .auth-header {
                padding: 20px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .messages-container {
                margin-top: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1><i class="fas fa-key"></i> بازیابی رمز عبور</h1>
            <p>رمز عبور خود را فراموش کرده‌اید؟</p>
        </div>
        
        <div class="auth-body">
            <!-- Step 1: Mobile Number -->
            <div class="form-step active" id="step1">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span>لطفاً شماره موبایل حساب خود را وارد کنید</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label">شماره موبایل</label>
                    <div class="input-with-icon">
                        <i class="fas fa-mobile-alt input-icon"></i>
                        <input type="text" id="mobile-input" class="form-input" 
                               placeholder="09xxxxxxxxx" maxlength="11" required>
                    </div>
                </div>
                
                <div class="btn-group">
                    <button class="btn" id="send-otp-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>ارسال کد تایید</span>
                    </button>
                    <button class="btn btn-outline" id="go-to-otp-from-step1" style="display: none;">
                        <i class="fas fa-arrow-left"></i>
                        <span>بازگشت به تایید کد</span>
                    </button>
                </div>
                
                <!-- پیام‌ها - پایین‌تر از دکمه -->
                <div class="messages-container" id="messages-container-1">
                    <div class="alert alert-error" id="error-message" style="display: none;"></div>
                    <div class="alert alert-success" id="success-message" style="display: none;"></div>
                    <div class="alert alert-user-error" id="user-error-message" style="display: none;"></div>
                    <div class="alert alert-warning" id="warning-message-1" style="display: none;"></div>
                    <div class="alert alert-info" id="info-message-1" style="display: none;"></div>
                </div>
                
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="fas fa-arrow-right"></i>
                        <span>بازگشت به صفحه ورود</span>
                    </a>
                </div>
            </div>
            
            <!-- Step 2: OTP Verification -->
            <div class="form-step" id="step2">
                <div class="alert alert-warning" id="otp-info">
                    <i class="fas fa-info-circle"></i>
                    <span>کد تایید به شماره <strong id="display-mobile"></strong> ارسال شد</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label">کد تایید ۷ رقمی</label>
                    <div class="input-with-icon">
                        <i class="fas fa-shield-alt input-icon"></i>
                        <input type="text" id="otp-input" class="form-input" 
                               placeholder="۷ رقمی" maxlength="7" required>
                    </div>
                </div>
                
                <div class="timer-container">
                    <div class="timer" id="timer">۰۲:۰۰</div>
                    <a href="#" class="resend-link disabled" id="resend-link">
                        <i class="fas fa-redo"></i>
                        <span>ارسال مجدد کد</span>
                    </a>
                </div>
                
                <div class="btn-group">
                    <button class="btn" id="verify-otp-btn">
                        <i class="fas fa-check-circle"></i>
                        <span>تایید کد</span>
                    </button>
                    <button class="btn btn-outline" id="back-to-mobile">
                        <i class="fas fa-arrow-right"></i>
                        <span>تغییر شماره</span>
                    </button>
                </div>
                
                <!-- پیام‌ها - پایین‌تر از دکمه‌ها -->
                <div class="messages-container" id="messages-container-2">
                    <div class="alert alert-error" id="error-message-2" style="display: none;"></div>
                    <div class="alert alert-success" id="success-message-2" style="display: none;"></div>
                    <div class="alert alert-warning" id="warning-message-2" style="display: none;"></div>
                </div>
            </div>
            
            <!-- Step 3: New Password -->
            <div class="form-step" id="step3">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>کد تایید صحیح است. لطفاً رمز عبور جدید خود را وارد کنید</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label">رمز عبور جدید</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password-input" class="form-input" 
                               placeholder="حداقل ۷ کاراکتر" required>
                    </div>
                    <div class="password-requirements">
                        رمز عبور باید حداقل ۷ کاراکتر و ترکیبی از حروف و اعداد باشد
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">تکرار رمز عبور جدید</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password-confirm-input" class="form-input" 
                               placeholder="رمز عبور را مجدداً وارد کنید" required>
                    </div>
                </div>
                
                <button class="btn" id="reset-password-btn">
                    <i class="fas fa-save"></i>
                    <span>ذخیره رمز جدید</span>
                </button>
                
                <div class="btn-group">
                    <button class="btn btn-outline" id="back-to-otp">
                        <i class="fas fa-arrow-right"></i>
                        <span>بازگشت</span>
                    </button>
                </div>
                
                <!-- پیام‌ها - پایین‌تر از دکمه‌ها -->
                <div class="messages-container" id="messages-container-3">
                    <div class="alert alert-error" id="error-message-3" style="display: none;"></div>
                    <div class="alert alert-success" id="success-message-3" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // متغیرهای اصلی
        let currentStep = 1;
        let mobileNumber = '';
        let timerInterval = null;
        let timeLeft = 120;
        let otpSent = false;
        let lastSentMobile = '';
        let otpRequestTime = null;
        let otpCooldown = 120; // 2 دقیقه
        let remainingCooldown = 0;
        let isFromPasswordRecovery = false;
        
        // ذخیره وضعیت در localStorage
        function saveState() {
            const state = {
                mobileNumber: mobileNumber,
                lastSentMobile: lastSentMobile,
                otpSent: otpSent,
                otpRequestTime: otpRequestTime,
                timeLeft: timeLeft,
                isFromPasswordRecovery: true,
                timerRunning: timerInterval !== null
            };
            localStorage.setItem('passwordRecoveryState', JSON.stringify(state));
        }
        
        // بازیابی وضعیت از localStorage
        function restoreState() {
            const savedState = localStorage.getItem('passwordRecoveryState');
            if (savedState) {
                try {
                    const state = JSON.parse(savedState);
                    mobileNumber = state.mobileNumber || '';
                    lastSentMobile = state.lastSentMobile || '';
                    otpSent = state.otpSent || false;
                    otpRequestTime = state.otpRequestTime || null;
                    timeLeft = state.timeLeft || 120;
                    isFromPasswordRecovery = state.isFromPasswordRecovery || false;
                    
                    // اگر کد قبلاً ارسال شده بود
                    if (lastSentMobile && otpSent) {
                        // بررسی وضعیت تایمر
                        const remainingCooldown = checkOtpCooldown();
                        if (remainingCooldown > 0) {
                            // مخفی کردن دکمه بازگشت به تایید کد در صورت لزوم
                            const goToOtpBtn = document.getElementById('go-to-otp-from-step1');
                            if (goToOtpBtn && document.getElementById('mobile-input').value === lastSentMobile) {
                                goToOtpBtn.style.display = 'flex';
                                document.getElementById('send-otp-btn').disabled = true;
                            }
                        }
                    }
                } catch (e) {
                    console.error('Error restoring state:', e);
                }
            }
        }
        
        // تابع بررسی کول‌داون
        function checkOtpCooldown() {
            if (otpRequestTime) {
                const now = Date.now();
                const elapsedSeconds = Math.floor((now - otpRequestTime) / 1000);
                const remainingTime = otpCooldown - elapsedSeconds;
                
                if (remainingTime > 0) {
                    return remainingTime;
                }
            }
            return 0;
        }
        
        // Step Navigation
        function goToStep(step) {
            document.querySelectorAll('.form-step').forEach(s => {
                s.classList.remove('active');
            });
            document.getElementById(`step${step}`).classList.add('active');
            currentStep = step;
            
            setTimeout(() => {
                const firstInput = document.querySelector(`#step${step} input`);
                if (firstInput) firstInput.focus();
            }, 100);
        }
        
        // Timer Functions
        function startTimer(forceRestart = false) {
            clearInterval(timerInterval);
            
            // محاسبه زمان باقی‌مانده از کول‌داون
            const remainingCooldown = checkOtpCooldown();
            if (remainingCooldown > 0 && !forceRestart) {
                timeLeft = remainingCooldown;
            } else {
                timeLeft = 120;
                if (forceRestart) {
                    otpRequestTime = Date.now();
                }
            }
            
            updateTimerDisplay();
            document.getElementById('timer').classList.remove('expired');
            document.getElementById('resend-link').classList.add('disabled');
            
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                // ذخیره وضعیت هر 5 ثانیه
                if (timeLeft % 5 === 0) {
                    saveState();
                }
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('timer').classList.add('expired');
                    document.getElementById('resend-link').classList.remove('disabled');
                    otpRequestTime = null; // ریست کردن کول‌داون
                    saveState();
                }
            }, 1000);
            
            saveState();
        }
        
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            const timerDisplay = document.getElementById('timer');
            if (timerDisplay) {
                timerDisplay.textContent = 
                    `${minutes.toString().padStart(2, '۰')}:${seconds.toString().padStart(2, '۰')}`;
            }
        }
        
        // توابع نمایش پیام
        function showError(message, step = currentStep) {
            const errorDiv = document.getElementById(`error-message${step > 1 ? '-' + step : ''}`);
            const successDiv = document.getElementById(`success-message${step > 1 ? '-' + step : ''}`);
            const warningDiv = document.getElementById(`warning-message-${step}`);
            const userErrorDiv = document.getElementById('user-error-message');
            const infoDiv = document.getElementById(`info-message-${step}`);
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            
            // نمایش container
            if (messagesContainer) {
                messagesContainer.classList.add('visible');
            }
            
            // مخفی کردن سایر پیام‌ها
            if (successDiv) successDiv.style.display = 'none';
            if (warningDiv) warningDiv.style.display = 'none';
            if (userErrorDiv) userErrorDiv.style.display = 'none';
            if (infoDiv) infoDiv.style.display = 'none';
            
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i><span>${message}</span>`;
            errorDiv.style.display = 'flex';
            errorDiv.classList.add('shake');
            
            setTimeout(() => {
                errorDiv.classList.remove('shake');
            }, 500);
            
            setTimeout(() => {
                errorDiv.style.display = 'none';
                hideMessagesContainerIfEmpty(step);
            }, 6000);
        }
        
        function showSuccess(message, step = currentStep) {
            const successDiv = document.getElementById(`success-message${step > 1 ? '-' + step : ''}`);
            const errorDiv = document.getElementById(`error-message${step > 1 ? '-' + step : ''}`);
            const warningDiv = document.getElementById(`warning-message-${step}`);
            const userErrorDiv = document.getElementById('user-error-message');
            const infoDiv = document.getElementById(`info-message-${step}`);
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            
            // نمایش container
            if (messagesContainer) {
                messagesContainer.classList.add('visible');
            }
            
            // مخفی کردن سایر پیام‌ها
            if (errorDiv) errorDiv.style.display = 'none';
            if (warningDiv) warningDiv.style.display = 'none';
            if (userErrorDiv) userErrorDiv.style.display = 'none';
            if (infoDiv) infoDiv.style.display = 'none';
            
            successDiv.innerHTML = `<i class="fas fa-check-circle"></i><span>${message}</span>`;
            successDiv.style.display = 'flex';
            
            setTimeout(() => {
                successDiv.style.display = 'none';
                hideMessagesContainerIfEmpty(step);
            }, 3000);
        }
        
        function showWarning(message, step = currentStep) {
            const warningDiv = document.getElementById(`warning-message-${step}`);
            const errorDiv = document.getElementById(`error-message${step > 1 ? '-' + step : ''}`);
            const successDiv = document.getElementById(`success-message${step > 1 ? '-' + step : ''}`);
            const userErrorDiv = document.getElementById('user-error-message');
            const infoDiv = document.getElementById(`info-message-${step}`);
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            
            if (warningDiv) {
                // نمایش container
                if (messagesContainer) {
                    messagesContainer.classList.add('visible');
                }
                
                // مخفی کردن سایر پیام‌ها
                if (errorDiv) errorDiv.style.display = 'none';
                if (successDiv) successDiv.style.display = 'none';
                if (userErrorDiv) userErrorDiv.style.display = 'none';
                if (infoDiv) infoDiv.style.display = 'none';
                
                warningDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i><span>${message}</span>`;
                warningDiv.style.display = 'flex';
                
                setTimeout(() => {
                    warningDiv.style.display = 'none';
                    hideMessagesContainerIfEmpty(step);
                }, 4000);
            }
        }
        
        function showUserError(message, step = 1) {
            const userErrorDiv = document.getElementById('user-error-message');
            const errorDiv = document.getElementById('error-message');
            const successDiv = document.getElementById('success-message');
            const warningDiv = document.getElementById(`warning-message-${step}`);
            const infoDiv = document.getElementById(`info-message-${step}`);
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            
            // نمایش container
            if (messagesContainer) {
                messagesContainer.classList.add('visible');
            }
            
            // مخفی کردن سایر پیام‌ها
            if (errorDiv) errorDiv.style.display = 'none';
            if (successDiv) successDiv.style.display = 'none';
            if (warningDiv) warningDiv.style.display = 'none';
            if (infoDiv) infoDiv.style.display = 'none';
            
            userErrorDiv.innerHTML = `<i class="fas fa-info-circle"></i><span>${message}</span>`;
            userErrorDiv.style.display = 'flex';
            
            setTimeout(() => {
                userErrorDiv.style.display = 'none';
                hideMessagesContainerIfEmpty(step);
            }, 5000);
        }
        
        function showInfo(message, step = currentStep) {
            const infoDiv = document.getElementById(`info-message-${step}`);
            const errorDiv = document.getElementById(`error-message${step > 1 ? '-' + step : ''}`);
            const successDiv = document.getElementById(`success-message${step > 1 ? '-' + step : ''}`);
            const warningDiv = document.getElementById(`warning-message-${step}`);
            const userErrorDiv = document.getElementById('user-error-message');
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            
            if (infoDiv) {
                // نمایش container
                if (messagesContainer) {
                    messagesContainer.classList.add('visible');
                }
                
                // مخفی کردن سایر پیام‌ها
                if (errorDiv) errorDiv.style.display = 'none';
                if (successDiv) successDiv.style.display = 'none';
                if (warningDiv) warningDiv.style.display = 'none';
                if (userErrorDiv) userErrorDiv.style.display = 'none';
                
                infoDiv.innerHTML = `<i class="fas fa-info-circle"></i><span>${message}</span>`;
                infoDiv.style.display = 'flex';
                
                setTimeout(() => {
                    infoDiv.style.display = 'none';
                    hideMessagesContainerIfEmpty(step);
                }, 5000);
            }
        }
        
        // تابع برای مخفی کردن container اگر هیچ پیامی نمایش داده نمی‌شود
        function hideMessagesContainerIfEmpty(step) {
            const messagesContainer = document.getElementById(`messages-container-${step}`);
            if (!messagesContainer) return;
            
            // بررسی تمام پیام‌های داخل container
            const alerts = messagesContainer.querySelectorAll('.alert');
            let hasVisibleAlert = false;
            
            alerts.forEach(alert => {
                if (alert.style.display === 'flex') {
                    hasVisibleAlert = true;
                }
            });
            
            if (!hasVisibleAlert) {
                messagesContainer.classList.remove('visible');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const mobileInput = document.getElementById('mobile-input');
            const otpInput = document.getElementById('otp-input');
            const passwordInput = document.getElementById('password-input');
            const passwordConfirmInput = document.getElementById('password-confirm-input');
            
            const sendOtpBtn = document.getElementById('send-otp-btn');
            const verifyOtpBtn = document.getElementById('verify-otp-btn');
            const resetPasswordBtn = document.getElementById('reset-password-btn');
            const backToMobileBtn = document.getElementById('back-to-mobile');
            const backToOtpBtn = document.getElementById('back-to-otp');
            const resendLink = document.getElementById('resend-link');
            const goToOtpFromStep1Btn = document.getElementById('go-to-otp-from-step1');
            
            const displayMobile = document.getElementById('display-mobile');
            
            // بازیابی وضعیت ذخیره شده
            restoreState();
            
            // Step 1: Send OTP
            sendOtpBtn.addEventListener('click', function() {
                mobileNumber = mobileInput.value.trim();
                
                // بررسی کول‌داون
                remainingCooldown = checkOtpCooldown();
                if (remainingCooldown > 0 && mobileNumber === lastSentMobile) {
                    const minutes = Math.floor(remainingCooldown / 60);
                    const seconds = remainingCooldown % 60;
                    showWarning(`برای ارسال مجدد کد ${minutes}:${seconds.toString().padStart(2, '۰')} دقیقه صبر کنید`, 1);
                    return;
                }
                
                if (!/^09\d{9}$/.test(mobileNumber)) {
                    showError('لطفاً شماره موبایل معتبر وارد کنید (09xxxxxxxxx)', 1);
                    mobileInput.classList.add('error');
                    return;
                }
                
                mobileInput.classList.remove('error');
                sendOtpBtn.disabled = true;
                sendOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>در حال ارسال...</span>';
                
                fetch("{{ route('password.send-otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ mobile: mobileNumber })
                })
                .then(response => {
                    if (response.status === 404 || response.status === 400) {
                        // شماره ثبت‌نام نکرده
                        throw new Error('MOBILE_NOT_REGISTERED');
                    }
                    if (response.status === 422) {
                        throw new Error('MOBILE_NOT_FOUND');
                    }
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        lastSentMobile = mobileNumber;
                        otpSent = true;
                        otpRequestTime = Date.now();
                        isFromPasswordRecovery = true;
                        displayMobile.textContent = mobileNumber;
                        
                        // نمایش دکمه بازگشت به تایید کد
                        goToOtpFromStep1Btn.style.display = 'flex';
                        
                        goToStep(2);
                        startTimer(true);
                        showSuccess('کد تایید با موفقیت ارسال شد', 1);
                        
                        // ذخیره وضعیت
                        saveState();
                    } else {
                        showError(data.message || 'خطا در ارسال کد تایید', 1);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    if (error.message === 'MOBILE_NOT_REGISTERED') {
                        showUserError('این شماره موبایل در سیستم ثبت‌نام نکرده است. لطفاً ابتدا ثبت‌نام کنید.', 1);
                    } else if (error.message === 'MOBILE_NOT_FOUND') {
                        showUserError('این شماره موبایل در سیستم ثبت نشده است.', 1);
                    } else if (error.message.includes('network') || error.message.includes('fetch')) {
                        showError('خطا در ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید.', 1);
                    } else {
                        showError('خطا در ارسال کد تایید', 1);
                    }
                })
                .finally(() => {
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>ارسال کد تایید</span>';
                });
            });
            
            // Step 2: Verify OTP
            verifyOtpBtn.addEventListener('click', function() {
                const otp = otpInput.value.trim();
                
                if (!/^\d{7}$/.test(otp)) {
                    showError('لطفاً کد تایید ۷ رقمی را وارد کنید', 2);
                    otpInput.classList.add('error');
                    return;
                }
                
                otpInput.classList.remove('error');
                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>در حال بررسی...</span>';
                
                fetch("{{ route('password.verify-otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        mobile: mobileNumber,
                        otp: otp 
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        goToStep(3);
                        showSuccess('کد تایید صحیح است', 2);
                    } else {
                        showError('کد تایید اشتباه است', 2);
                        otpInput.value = '';
                        otpInput.focus();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('کد تایید اشتباه است', 2);
                    otpInput.value = '';
                    otpInput.focus();
                })
                .finally(() => {
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerHTML = '<i class="fas fa-check-circle"></i><span>تایید کد</span>';
                });
            });
            
            // Step 3: Reset Password
            resetPasswordBtn.addEventListener('click', function() {
                const password = passwordInput.value.trim();
                const passwordConfirm = passwordConfirmInput.value.trim();
                
                // Validation
                if (password.length < 7) {
                    showError('رمز عبور باید حداقل ۷ کاراکتر باشد', 3);
                    passwordInput.classList.add('error');
                    return;
                }
                
                if (!/(?=.*[A-Za-z])(?=.*\d)/.test(password)) {
                    showError('رمز عبور باید ترکیبی از حروف و اعداد باشد', 3);
                    passwordInput.classList.add('error');
                    return;
                }
                
                if (password !== passwordConfirm) {
                    showError('رمز عبور و تکرار آن مطابقت ندارند', 3);
                    passwordConfirmInput.classList.add('error');
                    return;
                }
                
                passwordInput.classList.remove('error');
                passwordConfirmInput.classList.remove('error');
                resetPasswordBtn.disabled = true;
                resetPasswordBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>در حال ذخیره...</span>';
                
                fetch("{{ route('password.reset') }}", {
                    method: 'POST',
                    headers: {                     'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    mobile: mobileNumber,
                    password: password,
                    password_confirmation: passwordConfirm
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showSuccess('رمز عبور با موفقیت تغییر کرد. در حال انتقال به صفحه ورود...', 3);
                    
                    // پاک کردن وضعیت ذخیره شده
                    localStorage.removeItem('passwordRecoveryState');
                    
                    // ریدایرکت بعد از ۲ ثانیه
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                } else {
                    showError(data.message || 'خطا در تغییر رمز عبور', 3);
                    resetPasswordBtn.disabled = false;
                    resetPasswordBtn.innerHTML = '<i class="fas fa-save"></i><span>ذخیره رمز جدید</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('خطا در تغییر رمز عبور', 3);
                resetPasswordBtn.disabled = false;
                resetPasswordBtn.innerHTML = '<i class="fas fa-save"></i><span>ذخیره رمز جدید</span>';
            });
        });
        
        // Navigation Buttons
        backToMobileBtn.addEventListener('click', function() {
            // نمایش دکمه بازگشت به تایید کد
            goToOtpFromStep1Btn.style.display = 'flex';
            
            // غیرفعال کردن دکمه ارسال اگر زمان کول‌داون باقی مانده
            remainingCooldown = checkOtpCooldown();
            if (mobileInput.value === lastSentMobile && remainingCooldown > 0) {
                sendOtpBtn.disabled = true;
                const minutes = Math.ceil(remainingCooldown / 60);
                showInfo(`می‌توانید پس از ${minutes} دقیقه مجدداً کد ارسال کنید`, 1);
            }
            
            goToStep(1);
            saveState();
        });
        
        backToOtpBtn.addEventListener('click', function() {
            goToStep(2);
        });
        
        // دکمه بازگشت از صفحه اول به صفحه تایید کد
        goToOtpFromStep1Btn.addEventListener('click', function() {
            if (lastSentMobile && otpSent) {
                mobileInput.value = lastSentMobile;
                displayMobile.textContent = lastSentMobile;
                sendOtpBtn.disabled = true;
                goToStep(2);
                
                // تایمر را ادامه بده
                startTimer();
            }
        });
        
        // Resend OTP
        resendLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (resendLink.classList.contains('disabled')) {
                return;
            }
            
            // ارسال مجدد کد
            mobileNumber = mobileInput.value.trim();
            sendOtpBtn.disabled = true;
            sendOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>در حال ارسال مجدد...</span>';
            
            fetch("{{ route('password.send-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ mobile: mobileNumber })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    otpRequestTime = Date.now(); // به روزرسانی زمان ارسال
                    startTimer(true);
                    showSuccess('کد تایید مجدداً ارسال شد', 2);
                    saveState();
                } else {
                    showError(data.message || 'خطا در ارسال مجدد کد', 2);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('خطا در ارسال مجدد کد', 2);
            })
            .finally(() => {
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>ارسال کد تایید</span>';
            });
        });
        
        // وقتی کاربر شماره را تغییر می‌دهد
        mobileInput.addEventListener('input', function() {
            const currentMobile = mobileInput.value.trim();
            remainingCooldown = checkOtpCooldown();
            
            // اگر کاربر همان شماره قبلی را زده
            if (currentMobile === lastSentMobile && remainingCooldown > 0 && isFromPasswordRecovery) {
                // بررسی اگر کاربر تازه از لاگین آمده
                const isComingFromLogin = document.referrer.includes('login');
                
                if (isComingFromLogin) {
                    // کد قبلاً ارسال شده، کاربر را به صفحه تایید کد ببر
                    setTimeout(() => {
                        showWarning('کد قبلاً برای این شماره ارسال شده است. در حال انتقال...', 1);
                        setTimeout(() => {
                            displayMobile.textContent = lastSentMobile;
                            sendOtpBtn.disabled = true;
                            goToStep(2);
                            startTimer();
                        }, 1500);
                    }, 500);
                    return;
                }
            }
            
            // اگر شماره تغییر کرده یا کول‌داون تمام شده، دکمه را فعال کن
            if (currentMobile !== lastSentMobile || remainingCooldown <= 0) {
                sendOtpBtn.disabled = false;
                goToOtpFromStep1Btn.style.display = 'none';
            } else if (currentMobile === lastSentMobile && remainingCooldown > 0) {
                sendOtpBtn.disabled = true;
                goToOtpFromStep1Btn.style.display = 'flex';
            }
            
            // اگر شماره معتبر نیست، همیشه فعال بماند
            if (!/^09\d{9}$/.test(currentMobile)) {
                sendOtpBtn.disabled = false;
                goToOtpFromStep1Btn.style.display = 'none';
            }
        });
        
        // وقتی کاربر از صفحه خارج می‌شود
        window.addEventListener('beforeunload', function() {
            saveState();
        });
        
        // وقتی کاربر به صفحه بازمی‌گردد
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // صفحه از cache لود شده
                setTimeout(() => {
                    restoreState();
                    
                    // اگر در مرحله 2 هستیم، تایمر را ادامه بده
                    if (currentStep === 2 && lastSentMobile && otpSent) {
                        startTimer();
                    }
                }, 100);
            }
        });
        
        // بررسی وضعیت اولیه هنگام لود صفحه
        setTimeout(() => {
            const currentMobile = mobileInput.value.trim();
            remainingCooldown = checkOtpCooldown();
            
            if (currentMobile === lastSentMobile && remainingCooldown > 0) {
                sendOtpBtn.disabled = true;
                goToOtpFromStep1Btn.style.display = 'flex';
            }
            
            // اگر از فراموشی رمز آمده‌ایم و شماره قبلی داریم
            if (isFromPasswordRecovery && lastSentMobile && otpSent && remainingCooldown > 0) {
                // بررسی URL قبلی
                const referrer = document.referrer;
                if (referrer.includes('login') && !referrer.includes('password')) {
                    // کاربر از لاگین آمده، مستقیم به صفحه تایید کد برو
                    mobileInput.value = lastSentMobile;
                    displayMobile.textContent = lastSentMobile;
                    sendOtpBtn.disabled = true;
                    goToStep(2);
                    startTimer();
                }
            }
        }, 500);
        
        // Allow Enter key to submit forms
        mobileInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendOtpBtn.click();
        });
        
        otpInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') verifyOtpBtn.click();
        });
        
        passwordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') resetPasswordBtn.click();
        });
        
        passwordConfirmInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') resetPasswordBtn.click();
        });
        
        // Focus on mobile input on load
        mobileInput.focus();
    });
</script>
</body>
</html>