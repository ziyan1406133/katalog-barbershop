
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"></a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav ml-auto">
                @if(auth()->user()->role == 'Admin')
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            @if(count($nav_pending) > 0)
                                <span class="notification">{{count($nav_pending)}}</span>
                            @endif  
                            <span class="d-lg-none">Notification</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(count($nav_pending) > 0)
                            @foreach($nav_pending as $pend)
                                <a class="dropdown-item" href="/barbershop/{{$pend->id}}">{{$pend->name}}</a>
                            @endforeach
                                <a class="dropdown-item" href="/pending">Lihat Semua Pending</a>
                            @else
                                <a class="dropdown-item" href="#">Tidak ada notifikasi</a>
                            @endif
                        </ul>
                    </li>
                @else
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            @if(count(auth()->user()->ditolak) > 0)
                                <span class="notification">{{count(auth()->user()->ditolak)}}</span>
                            @endif
                            <span class="d-lg-none">Notification</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(count(auth()->user()->ditolak) > 0)
                                @foreach(auth()->user()->ditolak as $tolak)
                                <a class="dropdown-item" href="/barbershop/{{$tolak->id}}">{{$tolak->name}}</a>
                                @endforeach
                                <a class="dropdown-item" href="/barbershop">Lihat Semua Barbershop</a>
                            @else
                                <a class="dropdown-item" href="#">Tidak ada notifikasi</a>
                            @endif
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                        <a class="nav-link" href="/user/{{auth()->user()->id}}">
                        <span class="no-icon">{{auth()->user()->username}}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link"href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" 
                        tabindex="-1" class="menu-item">
                        <span class="no-icon">Log out</span>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>