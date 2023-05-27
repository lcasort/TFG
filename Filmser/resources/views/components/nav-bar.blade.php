<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top font-weight-normal">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('images/favicon.ico')}}" alt="Log in"/></a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{route('films')}}">Films</a>
                <a class="nav-link" href="{{route('series')}}">Series</a>
                @if (Route::has('login'))
                    @auth
                    <a class="nav-link" href="{{route('player.create')}}">Watched</a>
                    <a class="nav-link" href="{{route('game.create')}}">To Watch</a>
                    @endauth
                @endif
            </div>
            <div class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                      
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                    <a class="dropdown-item" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">Log out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                        <a href="{{ route('login') }}" class="nav-link" id="log-in-icon"><i class="fa-solid fa-person-walking-arrow-right"></i></a>
                    @endauth
                @endif
            </div>
      </div>
    </div>
</nav>