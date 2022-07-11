<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.style')
    @stack('style')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            @include('layouts.sidebar')
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')
           
        </div>
    </div>

    <script src="{{asset('assets/js/app.js')}}"></script>
    @stack('script')
</body>

</html>