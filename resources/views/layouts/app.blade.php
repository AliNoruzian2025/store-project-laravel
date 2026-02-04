<!-- هدر -->
<header class="header">
    <div class="header-container">
        <!-- لوگو -->
        <a href="{{ url('/') }}" class="logo">
            <i class="fas fa-store"></i>
            <h1>فروشگاه ما</h1>
        </a>

        <!-- اکشن‌ها -->
        <div class="header-actions">
            <!-- سبد خرید -->
            <button class="action-btn cart-btn" onclick="window.location.href='/cart'">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </button>

            <!-- کاربر -->
            @auth
                <a href="/dashboard" class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </a>
            @else
                <button class="action-btn" onclick="window.location.href='{{ route('login') }}'">
                    <i class="fas fa-user"></i>
                </button>
            @endauth
        </div>

        <!-- سرچ بار (بعد از اکشن‌ها) -->
        <form class="search-form">
            <input type="text" class="search-input" placeholder="جستجوی محصولات...">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</header>