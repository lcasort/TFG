<div class="container-fluid align-self-start">
    <div class="row flex-nowrap">
        <div class="col-auto px-sm-2 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <!-- Logo and collapse button -->
                <div class="d-flex flex-row align-items-center py-3">
                    <a href="{{ route("dashboard") }}" class="d-flex align-items-center mb-md-0 me-md-auto text-white text-decoration-none">
                        <img class="nav-bar-logo"
                            src="{{asset('/img/logo/logo_light.png')}}"
                            alt="eLog" />
                    </a>
                    {{-- <a href="#" class="collapse-button">
                        <i class="fa-solid fa-bars"></i>
                    </a> --}}
                </div>
                <!-- Pages -->
                <div class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start py-3" id="menu">
                    <div class="nav-item">
                        <a href="{{ route("dashboard") }}" class="nav-link align-middle px-0 d-flex flex-row">
                            <div class="text-center icon pr-3">
                                <i class="fa-regular fa-window-restore"></i>
                            </div>
                            <div><span class="ms-1 d-none d-sm-inline">Dashboard</span></div>
                        </a>
                    </div>
                    <div class="nav-item">
                        <!-- TODO: Link this to the mood individual view page. -->
                        <a href="#" class="nav-link align-middle px-0 d-flex flex-row">
                            <div class="text-center icon pr-3">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                            <div><span class="ms-1 d-none d-sm-inline">Mood</span></div>
                        </a>
                    </div>
                    <div class="nav-item">
                        <!-- TODO: Link this to the habits individual view page. -->
                        <a href="#" class="nav-link align-middle px-0 d-flex flex-row">
                            <div class="text-center icon pr-3">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <div><span class="ms-1 d-none d-sm-inline">Habits</span></div>
                        </a>
                    </div>
                    <div class="nav-item">
                        <!-- TODO: Link this to the journal individual view page. -->
                        <a href="#" class="nav-link align-middle px-0 d-flex flex-row">
                            <div class="text-center icon pr-3">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </div>
                            <div><span class="ms-1 d-none d-sm-inline">Journal</span></div>
                        </a>
                    </div>
                </div>

                <!-- User's profile and logout -->
                <div class="btn-group d-flex flex-row align-items-center justify-content-around w-100 pb-3 text-muted">
                    <div class="user-button pr-3 flex-grow-1">
                        <a class="btn btn-outline-light w-100" href="{{ route('profile.edit') }}">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="logout-button" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
