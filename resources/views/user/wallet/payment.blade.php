<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --success: #2ecc71;
            --danger: #e74c3c;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .payment-container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .payment-header {
            background: var(--dark);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .payment-header i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--light);
        }
        
        .payment-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            color: white;
        }
        
        .payment-content {
            padding: 30px;
        }
        
        .payment-info {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .payment-info p {
            margin: 10px 0;
            color: var(--dark);
        }
        
        .payment-form {
            margin-top: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .row {
            display: flex;
            gap: 15px;
        }
        
        .row .form-group {
            flex: 1;
        }
        
        .payment-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .bank-cards {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .bank-card {
            width: 60px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 1.5rem;
            border: 1px solid #dee2e6;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .notification {
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            max-width: 500px;
            margin: 0 auto;
            padding: 15px 20px;
            border-radius: 10px;
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
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .amount-display {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: var(--dark);
        }
        
        .amount-display span {
            font-weight: bold;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div id="notification-container"></div>
    
    <div class="payment-container">
        <div class="payment-header">
            <i class="fas fa-credit-card"></i>
            <h2>درگاه پرداخت امن</h2>
            <div class="payment-amount">
                {{ number_format($transaction->amount) }} تومان
            </div>
            <p>شارژ کیف پول</p>
        </div>
        
        <div class="payment-content">
            <a href="{{ route('user.wallet.index') }}" class="back-link">
                <i class="fas fa-arrow-right"></i>
                بازگشت به کیف پول
            </a>
            
            <div class="payment-info">
                <p><i class="fas fa-user"></i> {{ auth()->user()->full_name }}</p>
                <p><i class="fas fa-mobile"></i> {{ auth()->user()->mobile }}</p>
                <p><i class="fas fa-calendar"></i> تاریخ: {{ now()->format('Y/m/d H:i') }}</p>
                <p><i class="fas fa-receipt"></i> کد پیگیری: {{ $transaction->tracking_code }}</p>
            </div>
            
            <div class="amount-display">
                مبلغ پرداختی: <span>{{ number_format($transaction->amount) }} تومان</span>
            </div>
            
            <div class="bank-cards">
                <div class="bank-card"><i class="fab fa-cc-mastercard"></i></div>
                <div class="bank-card"><i class="fab fa-cc-visa"></i></div>
                <div class="bank-card"><i class="fas fa-university"></i></div>
            </div>
            
            <form id="payment-form" method="POST" action="{{ route('user.wallet.pay') }}">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                
                <div class="form-group">
                    <label class="form-label">شماره کارت</label>
                    <input type="text" 
                           id="card-number"
                           class="form-control" 
                           placeholder="مثال: 6037-****-****-****"
                           required>
                </div>
                
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">تاریخ انقضا (ماه/سال)</label>
                        <input type="text" 
                               id="expiry-date"
                               class="form-control" 
                               placeholder="مثال: 12/25"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">کد CVV2</label>
                        <input type="password" 
                               id="cvv"
                               class="form-control" 
                               placeholder="مثال: 123"
                               required>
                    </div>
                </div>
                
                <div class="loading" id="loading">
                    <div class="loading-spinner"></div>
                    <p>در حال اتصال به درگاه پرداخت...</p>
                </div>
                
                <div class="payment-actions">
                    <a href="{{ route('user.wallet.index') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i>
                        انصراف
                    </a>
                    
                    <button type="submit" class="btn btn-success" id="submit-btn">
                        <i class="fas fa-lock"></i>
                        پرداخت
                    </button>
                </div>
                
                <p style="text-align: center; margin-top: 15px; color: #666; font-size: 0.9rem;">
                    <i class="fas fa-shield-alt"></i>
                    پرداخت شما کاملاً امن است
                </p>
            </form>
        </div>
    </div>
    
    <script>
        // تابع نمایش نوتیفیکیشن
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notification-container');
            
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            
            container.appendChild(notification);
            
            // حذف خودکار بعد از 3 ثانیه
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // فرمت خودکار شماره کارت
        document.getElementById('card-number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // فقط اعداد
            if (value.length > 0) {
                value = value.match(/.{1,4}/g).join('-'); // فرمت XXXX-XXXX-XXXX-XXXX
            }
            e.target.value = value;
        });
        
        // فرمت خودکار تاریخ انقضا (بدون اعتبارسنجی)
        document.getElementById('expiry-date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // فقط اعداد
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4); // فرمت MM/YY
            }
            e.target.value = value;
        });
        
        // فقط اعداد برای CVV
        document.getElementById('cvv').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, ''); // فقط اعداد
        });
        
        // مدیریت فرم پرداخت
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // اعتبارسنجی ساده (فقط پر بودن فیلدها)
            const cardNumber = document.getElementById('card-number').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;
            
            if (!cardNumber.trim()) {
                showNotification('لطفاً شماره کارت را وارد کنید', 'error');
                document.getElementById('card-number').focus();
                return;
            }
            
            if (!expiryDate.trim()) {
                showNotification('لطفاً تاریخ انقضا را وارد کنید', 'error');
                document.getElementById('expiry-date').focus();
                return;
            }
            
            if (!cvv.trim()) {
                showNotification('لطفاً کد CVV2 را وارد کنید', 'error');
                document.getElementById('cvv').focus();
                return;
            }
            
            // نمایش لودینگ
            document.getElementById('loading').style.display = 'block';
            document.getElementById('submit-btn').disabled = true;
            
            // شبیه‌سازی تاخیر درگاه بانکی
            setTimeout(() => {
                // ارسال درخواست پرداخت
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('پرداخت با موفقیت انجام شد! کیف پول شما شارژ شد.', 'success');
                        setTimeout(() => {
                            window.location.href = "{{ route('user.wallet.index') }}";
                        }, 1500);
                    } else {
                        showNotification(data.message || 'خطا در پرداخت', 'error');
                        document.getElementById('loading').style.display = 'none';
                        document.getElementById('submit-btn').disabled = false;
                    }
                })
                .catch(error => {
                    showNotification('خطا در ارتباط با سرور', 'error');
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('submit-btn').disabled = false;
                });
            }, 2000);
        });
        
        // نمایش پیام‌های session
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showNotification('{{ session("success") }}', 'success');
            @endif
            
            @if(session('error'))
                showNotification('{{ session("error") }}', 'error');
            @endif
        });
    </script>
</body>
</html>