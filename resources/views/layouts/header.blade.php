<header>
    <div class="container">
        <div class="header-wrap">
            <div class="header-top d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="/"><img src="{{asset('img/logo-katalog-barbershop.png')}}" height="50px" alt=""></a>
                </div>
                <div class="main-menubar">
                    <nav>
                        <a href="/">Home</a>
                        @auth
                            <a href="/barbershop">Barbershops</a>
                        @else
                            <a href="/barbershopguest">Barbershops</a>
                        @endauth
                        <a href="/peta">Map</a>
                        @auth
                        <a href="/dashboard">Dashboard</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" 
                            tabindex="-1" class="menu-item">Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <a href="/login">Sign In</a>
                        @endauth
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>