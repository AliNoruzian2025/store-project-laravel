<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل کاربر - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Vazirmatn', sans-serif; background: #f5f7fa; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .card { background: white; border-radius: 10px; padding: 30px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-title { margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; color: #2c3e50; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 500; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Vazirmatn'; }
        button { background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        .nav-tabs { display: flex; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; }
        .tab-btn { padding: 10px 20px; border: none; background: none; cursor: pointer; border-bottom: 2px solid transparent; }
        .tab-btn.active { border-bottom-color: #3498db; color: #3498db; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>پروفایل کاربر</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="nav-tabs">
            <button class="tab-btn active" onclick="showTab('profile')">اطلاعات شخصی</button>
            <button class="tab-btn" onclick="showTab('password')">تغییر رمز عبور</button>
        </div>
        
        <!-- تب اطلاعات شخصی -->
        <div id="profile-tab" class="tab-content">
            <div class="card">
                <h2 class="card-title">ویرایش اطلاعات شخصی</h2>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>شماره موبایل</label>
                        <input type="text" value="{{ $user->mobile }}" disabled>
                        <small>شماره موبایل قابل تغییر نیست</small>
                    </div>
                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" required>
                    </div>
                    <div class="form-group">
                        <label>نام خانوادگی</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required>
                    </div>
                    <div class="form-group">
                        <label>آدرس</label>
                        <textarea name="address" rows="3">{{ $user->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>کد پستی</label>
                        <input type="text" name="postal_code" value="{{ $user->postal_code }}" maxlength="10">
                    </div>
                    <button type="submit">ذخیره تغییرات</button>
                </form>
            </div>
        </div>
        
        <!-- تب تغییر رمز عبور -->
        <div id="password-tab" class="tab-content" style="display: none;">
            <div class="card">
                <h2 class="card-title">تغییر رمز عبور</h2>
                <form action="{{ route('user.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>رمز عبور فعلی</label>
                        <input type="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>رمز عبور جدید</label>
                        <input type="password" name="password" required minlength="8">
                    </div>
                    <div class="form-group">
                        <label>تکرار رمز عبور جدید</label>
                        <input type="password" name="password_confirmation" required minlength="8">
                    </div>
                    <button type="submit">تغییر رمز عبور</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function showTab(tabName) {
            // مخفی کردن همه تب‌ها
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // حذف کلاس active از همه دکمه‌ها
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // نمایش تب انتخاب شده
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // فعال کردن دکمه انتخاب شده
            event.target.classList.add('active');
        }
    </script>
</body>
</html>