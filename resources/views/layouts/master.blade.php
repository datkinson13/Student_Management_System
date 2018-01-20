<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials.header')
    @yield('page-header')
</head>
<body>
    @include('layouts.partials.nav')
    <div class="container-fluid" style = "padding-top: 20px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                @include('layouts.partials.sidebar')
            </nav>
            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                @yield('content')
            </main>
        </div>
    </div>
</body>
@include('layouts.partials.footer');
@yield('page-script')
</html>
