@extends('layouts.app')

@section('content')
<div id="fh5co-course" style=" background-color: #EBEBEB">
    <div class="container mt-5">
        <div class="row">
            <!-- Bagian Kiri -->
            <div class="col-md-6 col-sm-12 mr-12 mb-6 animate-box">
                <div class="card mb-4">
                    <div class="card-header py-4 px-4" style="background-color: rgb(138, 255, 138);">
                        <h1 class="semi-bold-text">{{ $berita->nama_berita }}</h1>
                        <h4><span class="posted_on">{{ $berita->tanggal_berita }}</span></h4>
                    </div>
                    <div class="card-body p-5">
                        @php
                            $filePath = storage_path('app/public/' . $berita->file_berita);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
    
                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ Storage::url($berita->file_berita) }}" class="img-fluid mb-3" alt="{{ $berita->nama_berita }}">
                        @elseif(in_array($fileExtension, ['']))
                        @else
                        @php
                            $filename = basename($berita->file_berita);
                        @endphp
                    
                            <a style="text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;" href="{{ url('berita') }}/{{ $berita->nama_berita }}/download/{{ $berita->id_berita }}" class="btn btn-secondary">
                                <i class="fa fa-file"></i> {{ $filename }}
                            </a>
                            
                        @endif
                        
                        <p class="text-justify" style="font-size: 14px">{{ $berita->text_berita }}</p>
                    </div>
                </div>
            </div>
    
            <!-- Bagian Kanan -->
            <div class="col-md-4 col-sm-12  animate-box">
                <div class="card mb-4">
                    <div class="card-header pt-4 pb-2 px-4" >
                        <h1 class="mb-4">Berita Lainnya</h1>
                    </div>
                    <div class="card-body p-3">
                        @foreach ($beritas as $beritaLain)
                            <div class="mb-3">
                                <div class="fh5co-blog">
                                    <div class="blog-img-holder">
                                        @php
                                            $filePath = storage_path('app/public/' . $beritaLain->file_berita);
                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp
        
                                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                            <a href="{{ url('berita') }}/{{ $beritaLain->id_berita }}/{{ $beritaLain->nama_berita }}" class="blog-img-holder" style="background-image: url({{ Storage::url($beritaLain->file_berita) }});"></a>
                                        @else
                                            <a href="{{ url('berita') }}/{{ $beritaLain->id_berita }}/{{ $beritaLain->nama_berita }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                                <div class="p-5 text-break">
                                                    <h4 style="color: black;" class="light-text">{{ $beritaLain->text_berita }}</h4>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="blog-text text-break">
                                        <h4 class="semi-bold-text">
                                            <a href="{{ url('berita') }}/{{ $beritaLain->id_berita }}/{{ $beritaLain->nama_berita }}" style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $beritaLain->nama_berita }}</a>
                                        </h4>
                                        <span class="posted_on">{{ $beritaLain->tanggal_berita }}</span>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 <!-- Bagian Kanan -->
 {{-- <div class="col-md-4 col-xl-5 col-sm-12 animate-box">
    <div class="card mb-4">
        <div class="card-header pt-4 pb-2 px-4" >
            <h1 class="mb-4">Berita Lainnya</h1>
        </div>
        <div class="card-body p-3">
            
            <div class="row">
            @foreach ($beritas as $beritaLain)
                <div class="col-md-12 col-xl-6 mb-3">
                    <div class="fh5co-blog">
                        <div class="blog-img-holder">
                            @php
                                $filePath = storage_path('app/public/' . $beritaLain->file_berita);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <a href="{{ url('edit') }}/berita/{{ $beritaLain->id_berita }}" class="blog-img-holder" style="background-image: url({{ Storage::url($beritaLain->file_berita) }});"></a>
                            @else
                                <a href="{{ url('edit') }}/berita/{{ $beritaLain->id_berita }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                    <div class="p-5 text-break">
                                        <h4 style="color: black;" class="light-text">{{ $beritaLain->text_berita }}</h4>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="blog-text text-break">
                            <h4 class="semi-bold-text">
                                <a href="{{ url('edit') }}/berita/{{ $beritaLain->id_berita }}" style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $beritaLain->nama_berita }}</a>
                            </h4>
                            <span class="posted_on">{{ $beritaLain->tanggal_berita }}</span>
                        </div> 
                    </div>
                </div>
            @endforeach
            </div>
            
        </div>
    </div>
</div> --}}