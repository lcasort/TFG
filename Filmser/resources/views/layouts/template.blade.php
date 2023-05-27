<!DOCTYPE html>
<html lang="lang={{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://kit.fontawesome.com/6848d54b74.js" crossorigin="anonymous"></script>
    @stack('child-scripts')
</head>
<body>
    <!-- header -->

    <!-- nav -->
    @include('components.nav-bar')

    <!-- main -->
    <main>
        <div>
            <h1 class="text-center display-4 mt-4">@yield('header')</h1>
            <hr class="hr-blurry mx-auto">
        </div>

        @yield('content')
    </main>

    <!-- footer -->
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{route('index')}}" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="{{route('films')}}" class="nav-link px-2 text-muted">Films</a></li>
            <li class="nav-item"><a href="{{route('series')}}" class="nav-link px-2 text-muted">Series</a></li>
        </ul>
        <p class="text-center text-muted">© 2023 Filmser, Inc.</p>
    </footer>

    <!-- scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>