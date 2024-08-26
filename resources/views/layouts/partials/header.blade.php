<header>
    <div class="top-header">
        <div class="left-top-header">
            <div class="hotline">
                <i class="fa-solid fa-phone"></i>
                <a href="#" class="hotline-title">19006750</a>
            </div>
            <div class="email-support">
                <i class="fa-regular fa-envelope"></i>
                <a href="#" class="email-support">support@sapo.vn</a>
            </div>
        </div>
        <div class="mid-top-header"></div>
        <div class="right-top-header">
            @auth
                <p>Chào mừng, {{ Auth::user()->username }} <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                </form>
            @endauth

            @guest
                <div class="login">
                    <i class="fa-solid fa-user"></i>
                    <a href="{{ route('login') }}" class="login">Đăng nhập</a>
                </div>
                <div class="register">
                    <i class="fa-solid fa-user-plus"></i>
                    <a href="{{ route('register') }}" class="register">Đăng ký</a>
                </div>
            @endguest

        </div>
    </div>
    <div class="bottom-header">
        <div class="left-bottom-header">
            <button class="navbar-toggler" id="navbar-toggler">
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
            </button>
            <a href="/" class="logo">
                <img src="//bizweb.dktcdn.net/100/047/633/themes/887206/assets/logo.png?1676252851087" alt="DKT Store">
            </a>
            <button class="navbar-toggler none-button">
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
            </button>
        </div>
        <div class="mid-bottom-header">
            <form action="/search" class="search-form">
                <input type="text" placeholder="Nhập từ khóa tìm kiếm..." class="search-input">
                <button class="btn-search btn ">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="right-bottom-header">
            <div class="loved-products">
                <span class="icon">
                    <i class="fa-regular fa-heart"></i>
                </span>
                <span class="loved-count">0</span>
                <span class="loved-text">Yêu thích</span>
            </div>
            <div class="cart">
                @auth
                <span class="icon">
                    <a href="{{ route('cart.show') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                </span>
                <span class="cart-count">0</span>
                <span class="cart-text">Sản phẩm</span>
                @endauth

                @guest
                <span class="icon">
                    <a href="{{ route('login') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                </span>
                <span class="cart-count">0</span>
                <span class="cart-text">Sản phẩm</span>
                    @endguest
            </div>
        </div>
    </div>
</header>

