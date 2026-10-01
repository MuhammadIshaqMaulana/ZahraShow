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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/293b66ac39.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
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
            padding-bottom:50px;
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
            transition: transform 0.2s ease-in-out;
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
        .staff {
            border: 1px solid #000; /* Border hitam tipis */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan dengan sedikit transparansi */
            padding: 10px; /* Menambahkan padding agar konten tidak terlalu menempel pada border */
            margin-bottom: 20px; /* Memberikan sedikit jarak antar staff */
            background-color: #fff; /* Menambahkan background putih agar bayangan lebih terlihat */
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
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body>
    <?php
        use Illuminate\Support\Facades\DB;       
    ?>
    
    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <div class="top-menu">
                <div>
                       @guest
                @if (Route::has('login'))
                    <div>
                @endif
                @else
                    @if (Auth::user()->role == 'siswa')
                        <div style=" border-top: 15px solid #008022;">
                    @elseif (Auth::user()->role == 'guru')
                        <div style="border-top: 15px solid #c2b800;">
                    @elseif (Auth::user()->role === 'admin')
                        <div style=" border-top: 15px solid #004d80;">

                    @endif
                @endguest
                    
                    <div class="pl-3 pr-5">
                        <div class="row">
                            <div class="col-md-2 col-xl-1  d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/logo_hd.png') }}" style="border-radius: 50%; width: 70px; img-fluid height: 70px;"  alt="Logo">
                            </div>
                            <div class="col-md-10 col-xl-11">
                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <div class="row">
                                            <div class="col">
                                                <div id="fh5co-logo" style="transform: translate(0px, 18px); font-size: 32px"><a>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG<span></span></a></div>
                                                <div style="transform: translate(0px, 28px); font-size: 13px"><a>Jalan Telaga Kompleks Masjid Raya Taqwa Kelurahan 30 Ilir Kecamatan Ilir Barat II Palembang 30144<span></span></a></div>
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
                                                            <?php
                                                                if(Auth::user()->role === 'siswa'){
                                                                    $data = DB::table('siswas')->where('nisn', Auth::user()->username)->first();
                                                                    $kelas = DB::table('subkelases')->where('id_subkelas', $data->id_subkelas)->first();

                                                                }
                                                                elseif(Auth::user()->role === 'guru' || Auth::user()->role === 'admin'){
                                                                    $data = DB::table('gurus')->where('id_guru', Auth::user()->username)->first();
                                                                }
                                                                else{}
                    
                                                            ?>
                                                        <div class="row row-cols-auto flex-row-reverse">
                                                            <div class="col d-flex align-items-center justify-content-center">
                                                                <div class="dropdown show">
                                                                    <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        @if (Auth::user()->role == 'siswa')
                                                                            <img src="{{ Storage::url($data->file_siswa) }}" alt="Avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                                                                        @elseif (Auth::user()->role == 'guru' || Auth::user()->role === 'admin')
                                                                            <img src="{{ Storage::url($data->file_guru) }}" alt="Avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                                                                        @else
                                                                            <img src="{{ asset('images/person1.jpg') }}" alt="Avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                                                                        @endif
                                                                    </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              
                                                                    <div class="dropdown-item">
                                                                        <div class=" d-flex align-items-center justify-content-center">
                                                                            @if (Auth::user()->role == 'siswa')
                                                                            <img src="{{ Storage::url($data->file_siswa) }}" alt="Avatar" style="border-radius: 10%; width: 70px; height: 70px;">
                                                                        @elseif (Auth::user()->role == 'guru' || Auth::user()->role === 'admin')
                                                                            <img src="{{ Storage::url($data->file_guru) }}" alt="Avatar" style="border-radius: 10%; width: 70px; height: 70px;">
                                                                        @else
                                                                            <img src="{{ asset('images/person1.jpg') }}" alt="Avatar" style="border-radius: 10%; width: 70px; height: 70px;">
                                                                        @endif
                                                                        </div>
                                                                        
                                                                       <div class="col d-flex align-items-center justify-content-center">
                                                                            <li class="nav-item">
                                                                                <div class="row" style="display: inline-flex; flex-direction: column;">
                                                                                    <div class="col d-flex justify-content-center">
                                                                                        <a class="semi-bold-text">
                                                                                            <font size="4">{{ Auth::user()->name }}</font>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col d-flex align-items-center justify-content-center">
                                                                                        @if (Auth::user()->role == 'siswa')
                                                                                            <p style="text-align: center"><font size="2">{{ Auth::user()->username }}<br>{{ $kelas->nama_subkelas }}</font></p>
                                                                                            
                                                                                        @elseif (Auth::user()->role == 'guru' || Auth::user()->role === 'admin')
                                                                                            <p style="text-align: center"><font size="2">{{ Auth::user()->username }}<br>{{ $data->jabatan }}</font></p>
                                                                                            
                                                                                        @endif
                                                                                    </div>
                                                                     
                                                                                </div>
                                                                            </li>
                                                                        </div> 
                                                                    </div>
                                                                    
                                                                    @if (Auth::user()->role == 'admin')
                                                                    <a class="dropdown-item" href="{{ url('/') }}">Beralih Ke Mode User</a>
                                                                    <a class="dropdown-item" href="{{ url('guru/edittabel/siswa') }}">Edit Siswa</a>
                                                                    <a class="dropdown-item" href="{{ url('guru/edittabel/guru') }}">Edit Guru</a>
                                                                    <a class="dropdown-item" href="{{ url('guru/edittabel/subkelas') }}">Edit Kelas</a>
                                                                    @endif



                                                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Ubah Password</a>
                                                                    <a class="dropdown-item" href="{{ url('guru') }}/mapel/{{ Auth::user()->username }}">Mata Pelajaran</a>
                                                                    <a class="dropdown-item" href="{{ route('gurupengumuman') }}">Pengumuman</a>
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
                                                                    <div class="col d-flex justify-content-center">
                                                                        <a class="semi-bold-text">
                                                                            <font size="4">{{ Auth::user()->name }}</font>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col d-flex align-items-center justify-content-center">

                                                                        @if (Auth::user()->role == 'siswa')
                                                                            <p><font size="2">{{ Auth::user()->username }}</font></p>
                                                                        @elseif (Auth::user()->role == 'guru' || Auth::user()->role === 'admin')
                                                                            <p><font size="2">{{ Auth::user()->username }}</font></p>
                                                                        @endif
                                                                        
                                                                        
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
                                <div class="col-12 text-right" style="transform: translate(0px, -5px);">
                                    <ul>
                                        @if (Auth::user()->role == 'guru')
                                            <li class="active"><a style="font-size: 18px" href="{{ url('beranda') }}">Beranda</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('berita') }}">Berita</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('galeri') }}">Galeri</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('guru') }}">Guru</a></li>
                                            <li><a style="font-size: 18px" href="{{ route('ppdb') }}">PPDB</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('kontak') }}">Kontak</a></li>
                                            
                                        @elseif (Auth::user()->role === 'admin')
                                            <li class="active"><a style="font-size: 18px" href="{{ url('guru/beranda') }}">Beranda</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('guru/berita') }}">Berita</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('guru/galeri') }}">Galeri</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('guru/guru') }}">Guru</a></li>
                                            <li><a style="font-size: 18px" href="{{ route('guruppdb') }}">PPDB</a></li>
                                            <li><a style="font-size: 18px" href="{{ url('guru/kontak') }}">Kontak</a></li>
                                            
                                        @endif
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <main class="pt-4" style="transform: translate(0px, -20px);">
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
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-map-marker"></i> Jalan Telaga Kompleks Masjid Raya Taqwa Kelurahan 30 Ilir Kecamatan Ilir Barat II Palembang 30144</h4><br>
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-phone-alt"></i> Telp. 0711 - 374345</h4><br>
                        <h4 style="color: #ffffff;"><i aria-hidden="true" class="fas fa-envelope"></i> smpi_az_zahrahlplg@yahoo.com</h4>
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
    <!-- Main -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
</html>


