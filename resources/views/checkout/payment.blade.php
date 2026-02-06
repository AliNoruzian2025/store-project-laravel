<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درگاه پرداخت - فروشگاه آنلاین</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #1f2937;
            --success: #10b981;
            --danger: #ef4444;
            --light: #f9fafb;
            --dark: #111827;
            --gray: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 1px 3px rgba(0,0,0,0.1);
            --radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            color: #333;
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
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .payment-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 25px;
            text-align: center;
        }

        .payment-header i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .payment-amount {
            font-size: 2rem;
            font-weight: bold;
            margin: 15px 0;
            color: white;
        }

        .payment-content {
            padding: 25px;
        }

        .payment-info {
            background: #f8fafc;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            border: 1px solid var(--border);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--gray);
        }

        .info-value {
            font-weight: 500;
        }

        .amount-display {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .amount-display span {
            font-weight: bold;
            color: var(--danger);
        }

        .bank-cards {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .bank-card {
            width: 50px;
            height: 35px;
            background: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 1.2rem;
            border: 1px solid #dee2e6;
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
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row .form-group {
            flex: 1;
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

        .payment-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #0da271;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .message {
            padding: 12px 15px;
            border-radius: var(--radius);
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: fadeIn 0.3s ease;
            font-size: 14px;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .security-note {
            text-align: center;
            margin-top: 15px;
            color: var(--gray);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <i class="fas fa-credit-card"></i>
            <h2>درگاه پرداخت امن</h2>
            <div class="payment-amount">
                {{ number_format($cart->total) }} تومان
            </div>
        </div>
        
        <div class="payment-content">
            <a href="{{ route('checkout.index') }}" class="back-link">
                <i class="fas fa-arrow-right"></i>
                بازگشت به انتخاب روش پرداخت
            </a>
            
            <div class="payment-info">
                <div class="info-row">
                    <span class="info-label">نام خریدار:</span>
                    <span class="info-value">{{ auth()->user()->full_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">شماره موبایل:</span>
                    <span class="info-value">{{ auth()->user()->mobile }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">تاریخ:</span>
                    <span class="info-value">{{ now()->format('Y/m/d H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">کد پیگیری:</span>
                    <span class="info-value">{{ $transaction->tracking_code }}</span>
                </div>
            </div>
            
            <div class="amount-display">
                مبلغ پرداختی: <span>{{ number_format($cart->total) }} تومان</span>
            </div>
            
            <div class="bank-cards">
                <div class="bank-card"><i class="fab fa-cc-mastercard"></i></div>
                <div class="bank-card"><i class="fab fa-cc-visa"></i></div>
                <div class="bank-card"><i class="fas fa-university"></i></div>
            </div>
            
            <form id="payment-form">
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
                
                <div id="message-container"></div>
                
                <div class="payment-actions">
                    <a href="{{ route('checkout.index') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i>
                        انصراف
                    </a>
                    
                    <button type="submit" class="btn btn-success" id="submit-btn">
                        <i class="fas fa-lock"></i>
                        پرداخت
                    </button>
                </div>
                
                <p class="security-note">
                    <i class="fas fa-shield-alt"></i>
                    پرداخت شما کاملاً امن است
                </p>
            </form>
        </div>
    </div>
    
    <script>
        // نمایش پیام
        function showMessage(message, type = 'success') {
            const container = document.getElementById('message-container');
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            messageDiv.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            
            container.innerHTML = '';
            container.appendChild(messageDiv);
            
            // حذف خودکار بعد از 3 ثانیه
            setTimeout(() => {
                if (messageDiv.parentElement) {
                    messageDiv.remove();
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
        
        // فرمت خودکار تاریخ انقضا
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
        document.getElementById('payment-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // اعتبارسنجی ساده
            const cardNumber = document.getElementById('card-number').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;
            
            if (!cardNumber.trim() || cardNumber.replace(/\D/g, '').length !== 16) {
                showMessage('لطفاً شماره کارت معتبر وارد کنید', 'error');
                document.getElementById('card-number').focus();
                return;
            }
            
            if (!expiryDate.trim() || !expiryDate.match(/^\d{2}\/\d{2}$/)) {
                showMessage('لطفاً تاریخ انقضای معتبر وارد کنید', 'error');
                document.getElementById('expiry-date').focus();
                return;
            }
            
            if (!cvv.trim() || cvv.length < 3 || cvv.length > 4) {
                showMessage('لطفاً کد CVV2 معتبر وارد کنید', 'error');
                document.getElementById('cvv').focus();
                return;
            }
            
            // نمایش لودینگ
            document.getElementById('loading').style.display = 'block';
            document.getElementById('submit-btn').disabled = true;
            
            try {
                // ارسال درخواست پرداخت
                const response = await fetch("{{ route('checkout.process-online') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        transaction_id: document.querySelector('input[name="transaction_id"]').value
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showMessage('پرداخت با موفقیت انجام شد! در حال انتقال...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    showMessage(data.message || 'خطا در پرداخت', 'error');
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('submit-btn').disabled = false;
                }
            } catch (error) {
                showMessage('خطا در ارتباط با سرور', 'error');
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submit-btn').disabled = false;
            }
        });
    </script>
</body>
</html>