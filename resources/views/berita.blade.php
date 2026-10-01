@extends('layouts.app')

@section('content')
	
<aside id="fh5co-hero">
    <div class="flexslider animate-box">
        <ul class="slides">
            <li style="background-image: url({{ asset('images/lomba-pahlawan-mc.jpg') }});">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1 class="heading-section">Berita</h1>
                                <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="fh5co-blog">
    <div class="container">
        <div class="row">
            @foreach ($beritas as $berita)
                <div class="col-lg-4 col-md-4">
                    <div class="fh5co-blog animate-box">
                        <div class="blog-img-holder">
                            @php
                                $filePath = storage_path('app/' . $berita->file_berita);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <a href="{{ url('berita') }}/{{ $berita->id_berita }}/{{ $berita->nama_berita }}" class="blog-img-holder" style="background-image: url({{ Storage::url($berita->file_berita) }});"></a>
                            @else
                                <a href="{{ url('berita') }}/{{ $berita->id_berita }}/{{ $berita->nama_berita }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                    <div class="p-5 text-break">
                                        <h4 style="color: black;" class="light-text">{{ $berita->text_berita }}</h4>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="blog-text text-break">
                            <h4 class="semi-bold-text"><a href="{{ url('edit') }}/berita/{{ $berita->id_berita }}" 
                                style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $berita->nama_berita }}</a></h4>
                            <span class="posted_on">{{ $berita->tanggal_berita }}</span>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
