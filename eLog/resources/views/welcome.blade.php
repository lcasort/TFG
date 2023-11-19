<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            body {padding: 0;margin: 0;}
            .fade-in-text {font-family: 'Montserrat', sans-serif;letter-spacing: 3px;font-size: 15px;animation: fadeIn 5s;}
            .description {background-color: #292f3d;}
            .fade-in-div {font-size: 25px;animation: fadeIn 7s;}
            .fade-in-buttons {font-size: 15px;animation: fadeIn 9s;}
            .btn-outline-light {border-color: #6b757d;}
            footer .border-bottom {border-bottom: 1px solid #6b757d !important;}
            footer a:hover {color: #95f6cd;}
            @keyframes fadeIn {0% { opacity: 0; }100% { opacity: 1; }}
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative w-100 sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto pt-6 lg:pt-8 w-100">
                <div class="flex justify-center flex-column pt-6 pb-2">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="h-10 fill-current text-gray-500"
                        src="{{asset('/img/logo/logo_light.png')}}"
                        alt="eLog" />
                    </div>
                    
                    <div class="fade-in-text d-flex justify-content-center text-muted">
                        <p>CHECK IN WITH YOURSELF</p>
                    </div>
                </div>

                <div class="description mt-16 w-100">
                    <div class="fade-in-div text-muted h-auto text-center p-6">
                        <p>
                            Check your mood, track your habits, practice meditation <br/>
                            and write your own personal journal entries.
                        </p>
                    </div>

                    <div class="p-6">
                        @if (Route::has('login'))
                            <div class="fade-in-buttons d-flex justify-content-center">
                                @auth
                                    <!-- TODO: Redirect to index page (logged). -->
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-light text-muted mx-4">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-light text-muted mx-4">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center text-muted mt-16 px-0 w-100">
                    <footer class="py-2 my-4">
                        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                            @if (Route::has('login'))
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link px-2 text-body-secondary">Login</a></li>
                            @endif
                            @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link px-2 text-body-secondary">Register</a></li>
                            @endif
                            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Contact</a></li>
                        </ul>
                        <p class="text-center text-body-secondary">© 2023 eLog, Inc</p>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
