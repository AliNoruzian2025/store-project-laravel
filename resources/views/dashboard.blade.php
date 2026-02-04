<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری - فروشگاه ما</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* فقط استایل‌های داشبورد، بدون هدر فروشگاه */
        :root {
            --primary: #4361ee;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .dashboard-wrapper {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary), #7209b7);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .dashboard-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        /* بقیه استایل‌های داشبورد ... */
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        @auth
            <div class="dashboard-header">
                <h1>👋 سلام {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                <p>خوش آمدید به پنل کاربری شما</p>
            </div>
            
            <div class="user-info">
                <!-- اطلاعات کاربر -->
                <div class="info-card">
                    <i class="fas fa-user"></i>
                    <h3>اطلاعات شخصی</h3>
                    <p><strong>نام:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                    <p><strong>موبایل:</strong> {{ auth()->user()->mobile }}</p>
                </div>
                
                <!-- بقیه کارت‌ها -->
            </div>
            
            <div class="dashboard-actions">
                <a href="{{ url('/') }}" class="btn-primary">
                    <i class="fas fa-home"></i>
                    بازگشت به فروشگاه
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        خروج از حساب
                    </button>
                </form>
            </div>
        @else
            <div style="text-align: center; padding: 100px 20px;">
                <h2>لطفاً ابتدا وارد حساب کاربری خود شوید</h2>
                <a href="{{ route('login') }}" style="display: inline-block; margin-top: 20px; padding: 12px 30px; background: var(--primary); color: white; text-decoration: none; border-radius: 8px;">
                    ورود به حساب
                </a>
            </div>
        @endauth
    </div>
</body>
</html>