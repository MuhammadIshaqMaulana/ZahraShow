<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

    <!-- Other CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/293b66ac39.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    
    <style>
        .photo-gallery {
            color:#313437;
            background-color:#fff;
        }

        .photo-gallery p {
            color:#7d8285;
        }

        .photo-gallery h2 {
            font-weight:bold;
            margin-bottom:40px;
            padding-top:40px;
            color:inherit;
        }

        @media (max-width:767px) {
        .photo-gallery h2 {
            margin-bottom:25px;
            padding-top:25px;
            font-size:24px;
        }
        }

        .photo-gallery .intro {
            font-size:16px;
            max-width:500px;
            margin:0 auto 40px;
        }

        .photo-gallery .intro p {
            margin-bottom:0;
        }

        .photo-gallery .photos {
            padding-bottom:20px;
        }

        .photo-gallery .item {
            padding-bottom:30px;
        }

        .photo-gallery .height {
            height:200px;
            padding-top: 150px;
            padding-bottom: 150px;
        }

        .photo-gallery .imgheight {
            height:750px;
        }

        .containers {
            overflow: hidden;
        }

        .cards {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .cards.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-primary {
            position: relative;
            overflow: hidden;
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #ffcc00;
            transform: translateY(0);
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
            text-decoration: none;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: #000;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease-in-out;
            z-index: -1;
        }

        .btn-primary:hover::before {
            transform: scaleX(1);
            left: 0;
        }

        /* Custom class for light text */
        .light-text {
            font-weight: 300;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .semi-bold-text {
            font-weight: 550;
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.cards').each(function(index) {
                var cards = $(this);
                setTimeout(function() {
                    cards.addClass('animate');
                }, index * 200); // Menambahkan jeda waktu 200ms antara setiap animasi
            });
        });
    </script>
    
    <!-- Script old --> 
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body>
    <div id="page" class="py-2">
        <nav class="fh5co-nav" role="navigation">
            <div class="top-menu">
                <div class="px-5">
                    <div class="row">
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/logo.png') }}" style="border-radius: 50%; width: 60px; height: 60px;"  alt="Logo">
                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-12 pb-2">
                                    <div class="row">
                                        <div class="col">
                                            <div id="fh5co-logo" style="transform: translate(4px, 10px);"><a>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG<span></span></a></div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex">
                                                <ul class="navbar-nav ms-auto">
                                                    @guest
                                                        @if (Route::has('login'))
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                            </li>
                                                        @endif
                                                    @else
                                                    <div class="row row-cols-auto flex-row-reverse">
                                                        <div class="col d-flex align-items-center justify-content-center">
                                                            <div class="dropdown show">
                                                                <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <img src="{{ asset('images/person1.jpg') }}" alt="Avatar" style="border-radius: 50%; width: 30px; height: 30px;">
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                                                    <a class="dropdown-item" href="{{ route('mapel') }}">Mata Pelajaran</a>
                                                                    <a class="dropdown-item" href="{{ route('pengumuman') }}">Pengumuman</a>
                                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault();
                                                                       document.getElementById('logout-form').submit();">
                                                                        {{ __('Logout') }}
                                                                    </a>
                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col d-flex align-items-center justify-content-center">
                                                            <li class="nav-item">
                                                                <div class="row" style="display: inline-flex; flex-direction: column;">
                                                                    <div class="col">
                                                                        <a>
                                                                            <font size="2">{{ Auth::user()->name }}</font>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col d-flex align-items-center justify-content-center">
                                                                        <p>
                                                                            <font size="1">{{ Auth::user()->niy }}</font>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                    @endguest
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <ul>
                                        <li class="active"><a href="{{ url('beranda') }}">Beranda</a></li>
                                        <li><a href="{{ url('berita') }}">Berita</a></li>
                                        <li><a href="{{ url('guru') }}">Guru</a></li>
                                        <li><a href="{{ route('ppdb') }}">PPDB</a></li>
                                        <li><a href="{{ url('kontak') }}">Kontak</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <main class="py-4">
                    @yield('content')

                    <!-- lightbox galeri -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
                </main>
            </div>
        </nav>
    </div>

    <footer id="fh5co-footer" role="contentinfo" style="background-image: {{ asset('images/img_bg_4.jpg') }};">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h2 style="color: #ffffff;">SMP AZ - ZAHRAH 1 PALEMBANG</h2>
                </div>
                <div class="col-md-8 fh5co-widget">
                    <ul class="fh5co-footer-links">
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-map-marker"></i> Komplek Perumahan Bukit Sejahtera Palembang, Sumatera Selatan 30146</h4><br>
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-phone-alt"></i> Telp. 0711 – 446964/5560017</h4><br>
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-envelope"></i> azzahrah.2009@yahoo.com</h4>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- jQuery Easing -->
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <!-- Stellar Parallax -->
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <!-- Carousel -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Flexslider -->
    <script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
    <!-- countTo -->
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup-options.js') }}"></script>
    <!-- Count Down -->
    <script src="{{ asset('js/simplyCountdown.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

        // default example
        simplyCountdown('.simply-countdown-one', {
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate()
        });

        // jQuery example
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            enableUtc: false
        });
    </script>

    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
</html>
