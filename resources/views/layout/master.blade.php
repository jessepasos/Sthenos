
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Sthenos // @yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
</head>
<body>

    <a href="#" class="btn btn-dark btn-lg toggle menu-toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a href="#" class="btn btn-light btn-lg pull-right toggle menu-close"><i class="fa fa-times"></i></a>
            <li class="sidebar-placeholder">
                &#032;
            </li>
            <li>
                <a href="#top" class="menu-scroll"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#about" class="menu-scroll"><i class="fa fa-question" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#education" class="menu-scroll"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#portfolio" class="menu-scroll"><i class="fa fa-folder-o" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#contact" class="menu-scroll"><i class="fa fa-at" aria-hidden="true"></i></a>
            </li>
        </ul>
    </nav>


    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/sthenos.js') }}"></script>

</body>
</html>
