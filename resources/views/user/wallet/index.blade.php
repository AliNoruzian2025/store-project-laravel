<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کیف پول - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --danger: #e74c3c;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --radius: 10px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .back-btn {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .wallet-balance-card {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            border-radius: var(--radius);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            text-align: center;
        }
        
        .balance-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 15px 0;
        }
        
        .charge-form {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
        }
        
        .amount-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .amount-btn {
            padding: 10px 20px;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .amount-btn:hover {
            background: #e9ecef;
            border-color: var(--primary);
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: var(--radius);
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            width: 100%;
            font-size: 1rem;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }
        
        .transactions {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
        }
        
        .positive { color: var(--success); }
        .negative { color: var(--danger); }
        .status-completed { color: var(--success); font-weight: 500; }
        
        .notification {
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            max-width: 500px;
            margin: 0 auto;
            padding: 15px 20px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
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
    </style>
</head>
<body>
    <!-- نوتیفیکیشن‌ها -->
    <div id="notification-container"></div>
    
    <div class="container">
        <div class="header">
            <h1>کیف پول</h1>
            <a href="{{ route('user.dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                بازگشت به داشبورد
            </a>
        </div>
        
        <div class="wallet-balance-card">
            <h2>موجودی کیف پول</h2>
            <div class="balance-amount">{{ number_format($wallet->balance) }} تومان</div>
            <p>آخرین بروزرسانی: {{ now()->format('Y/m/d H:i') }}</p>
        </div>
        
        <div class="charge-form">
            <h2 style="margin-bottom: 20px; color: var(--dark);">شارژ کیف پول</h2>
            <form method="POST" action="{{ route('user.wallet.charge') }}" id="charge-form">
                @csrf
                <div class="form-group">
                    <label for="amount">مبلغ شارژ (تومان)</label>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           class="form-control" 
                           min="1000" 
                           max="10000000" 
                           step="1000" 
                           placeholder="حداقل ۱,۰۰۰ تومان"
                           required>
                </div>
                
                <div class="amount-buttons">
                    <button type="button" class="amount-btn" onclick="setAmount(10000)">۱۰,۰۰۰ تومان</button>
                    <button type="button" class="amount-btn" onclick="setAmount(50000)">۵۰,۰۰۰ تومان</button>
                    <button type="button" class="amount-btn" onclick="setAmount(100000)">۱۰۰,۰۰۰ تومان</button>
                    <button type="button" class="amount-btn" onclick="setAmount(200000)">۲۰۰,۰۰۰ تومان</button>
                </div>
                
                <button type="submit" class="btn btn-success" style="margin-top: 20px;">
                    <i class="fas fa-credit-card"></i>
                    پرداخت از طریق درگاه
                </button>
                
                <p style="text-align: center; margin-top: 15px; color: #666; font-size: 0.9rem;">
                    پس از کلیک، به صفحه درگاه پرداخت منتقل خواهید شد
                </p>
            </form>
        </div>
        
        <div class="transactions">
            <h2 style="margin-bottom: 20px; color: var(--dark);">آخرین تراکنش‌های موفق</h2>
            @if($transactions->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>تاریخ</th>
                            <th>نوع</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                            <th>کد رهگیری</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('Y/m/d H:i') }}</td>
                                <td>{{ $transaction->type_text }}</td>
                                <td class="positive">
                                    {{ number_format($transaction->amount) }} تومان
                                </td>
                                <td class="status-completed">
                                    {{ $transaction->status_text }}
                                </td>
                                <td>{{ $transaction->tracking_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('user.wallet.transactions') }}" style="color: var(--primary); text-decoration: none;">
                        مشاهده همه تراکنش‌ها
                    </a>
                </div>
            @else
                <div style="text-align: center; padding: 40px; color: #6c757d;">
                    <i class="fas fa-receipt" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <p>هیچ تراکنشی یافت نشد</p>
                </div>
            @endif
        </div>
    </div>
    
    <script>
        // تابع نمایش نوتیفیکیشن
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notification-container');
            
            container.innerHTML = '';
            
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            
            container.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // بررسی پیام‌های session و نمایش آن‌ها
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showNotification('{{ session("success") }}', 'success');
            @endif
            
            @if(session('error'))
                showNotification('{{ session("error") }}', 'error');
            @endif
        });
        
        // تنظیم مبلغ شارژ
        function setAmount(amount) {
            document.getElementById('amount').value = amount;
        }
        
        // مدیریت فرم شارژ
        document.getElementById('charge-form').addEventListener('submit', function(e) {
            const amount = document.getElementById('amount').value;
            
            if (amount < 1000) {
                e.preventDefault();
                showNotification('حداقل مبلغ شارژ ۱,۰۰۰ تومان است', 'error');
                return;
            }
            
            // تایید قبل از رفتن به درگاه
            if (!confirm(`آیا از پرداخت مبلغ ${new Intl.NumberFormat().format(amount)} تومان اطمینان دارید؟\n\nپس از تایید به درگاه پرداخت منتقل خواهید شد.`)) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>