@extends('guru.app')

@section('content')
	
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


<div id="fh5co-blog" style=" background-color: #EBEBEB">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-12 text-center fh5co-heading">
                <h2>Galeri</h2>
            </div>
        


        @foreach ($galeris as $galeri)
            <div class="col-lg-4 col-md-4">
                <div class="fh5co-blog animate-box">
                    <a href="{{ url('edit') }}/galeri/{{ $galeri->id_galeri }}" class="blog-img-holder" style="background-image: url({{ Storage::url($galeri->file_galeri) }});"><img class="img-fluid imgheight item" src=""></a>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $galeris->links() }}
            </div>
        </div>
    

                        
        {{-- untuk add --}}
        @if(Auth::user()->role == 'admin')
        <div class="col-lg-4 col-md-4" >
            <div class="fh5co-blog animate-box ">
                <a href="{{ url('upload') }}/galeri" style="background-image: url({{ asset('images/gray_bg.jpg') }});" class="blog-img-holder">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <img class="imgheight item pt-5 mt-5 mb-5" src="{{ asset('images/add_icon.png') }}" style="width: 30px">
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <h4 style=" text-align: justify;
                            text-justify: inter-word; color: black">Tambah</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endif
    </div>
    
    </div>
</div>


@endsection
