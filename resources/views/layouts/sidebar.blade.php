
<div class="sidebar" data-image="{{ asset('img/sidebar-background.jpg') }}" data-color="orange">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/" class="simple-text">
                Katalog Barbershop
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fa fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            @if(auth()->user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="fa fa-handshake-o"></i>
                    <p>Mitra</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/barbershop">
                    <i class="fa fa-scissors"></i>
                    <p>Barbershops</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pending">
                    <i class="fa fa-clock-o"></i>
                    <p>Menunggu Verifikasi</p>
                </a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/barbershop">
                        <i class="fa fa-scissors"></i>
                        <p>Barbershop Saya</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>