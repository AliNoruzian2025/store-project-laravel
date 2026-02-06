<!-- هدر -->
<header class="header">
    <div class="header-container">
        <!-- لوگو -->
        <a href="{{ url('/') }}" class="logo">
            <i class="fas fa-store"></i>
            <h1>VENUS</h1>
            <div class="logo-subtitle">Tracing the path of beauty</div>
        </a>

        <!-- اکشن‌ها -->
        <div class="header-actions">
            <!-- نمایش کیف پول برای کاربران لاگین کرده -->
            @auth
                @if(auth()->user()->getWalletBalance() > 0)
                    <div class="wallet-balance">
                        <i class="fas fa-wallet"></i>
                        {{ number_format(auth()->user()->getWalletBalance()) }} تومان
                    </div>
                @endif
                
                <!-- سبد خرید -->
                <button class="action-btn cart-btn" onclick="window.location.href='/cart'">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                </button>

                <!-- کاربر -->
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
        <form class="search-form" method="GET" action="{{ route('home') }}">
            <input type="text" 
                   class="search-input" 
                   name="q" 
                   placeholder="جستجوی محصولات..."
                   value="">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</header>