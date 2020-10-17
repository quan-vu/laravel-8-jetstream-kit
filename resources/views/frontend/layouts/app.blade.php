<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/style-starter.css')}}">
</head>

<body>
    <header class="w3l-header">
        @include('frontend.layouts.header')
    </header>

    <main class="main-area">
        @yield('content')
    </main>

    <footer class="w3l-footer-16">
        @include('frontend.layouts.footer')
    </footer>

    <!-- JavaScript -->
    <script src="{{asset('theme/assets/js/theme-change.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap.min.js')}}"></script>
    
    <script>
        $(function () {
            // disable body scroll which navbar is in active
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>

    @stack('scripts')

</body>

</html>