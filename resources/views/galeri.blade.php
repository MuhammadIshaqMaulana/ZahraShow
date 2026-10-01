@extends('layouts.app')

@section('content')

<!-- slider -->
<aside id="fh5co-hero">
    <div class="flexslider animate-box">
        <ul class="slides">
            <li style="background-image: url({{ asset('images/futsal2.jpg') }});">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1 class="heading-section">Galeri</h1>
                                <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="fh5co-blog" style="background-color: #EBEBEB">
    <div class="container">
        <div class="row">
            @foreach ($galeris as $galeri)
            <div class="col-lg-4 col-md-4">
                <div class="fh5co-blog animate-box">
                    <div class="blog-img-holder">
                        <a href="{{ Storage::url($galeri->file_galeri) }}" class="blog-img-holder" style="background-image: url({{ Storage::url($galeri->file_galeri) }});" data-lightbox="galeri" data-title="{{ $galeri->nama_galeri }}"><img class="img-fluid imgheight item" src=""></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $galeris->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
