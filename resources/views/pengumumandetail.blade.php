@extends('layouts.app')

@section('content')
<div id="fh5co-course" style=" background-color: #EBEBEB">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 mr-12 mb-6 animate-box">
                <div class="card mb-4">
                    <div class="card-header py-4 px-4" style="background-color: rgb(138, 255, 138);">
                        <h1 class="semi-bold-text">{{ $pengumuman->nama_pengumuman }}</h1>
                        <h4><span class="posted_on">{{ $pengumuman->tanggal_pengumuman }}</span></h4>
                    </div>
                    <div class="card-body p-5">
                        @php
                            $filePath = storage_path('app/public/' . $pengumuman->file_pengumuman);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ Storage::url($pengumuman->file_pengumuman) }}" class="img-fluid mb-3" alt="{{ $pengumuman->nama_pengumuman }}">
                        @elseif(in_array($fileExtension, ['']))
                        @else
                            <div class="mb-3">






                                {{-- {{ route('materi.download', ['id' => $materi->id_materi]) }} --}}
                                {{-- {{ url('update') }}/{{ $nama }}/{{ $data->$nid }}


                                {{ url('pengumuman') }}/{{ $pengumuman->nama_pengumuman }}/'download'/{{ $pengumuman->id_pengumuman }} --}}

                                @php
                                $filename = basename($pengumuman->file_pengumuman);
                                @endphp
                                <div>
                                    <a style="text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;" href="{{ url('pengumuman') }}/{{ $pengumuman->nama_pengumuman }}/download/{{ $pengumuman->id_pengumuman }}"  class="btn btn-secondary">
                                    <i class="fa fa-file"></i> {{ $filename }}
                                </a>
                                </div>
                                
                                
                            </div>
                        @endif

                        <p class="text-justify" style="font-size: 14px">{{ $pengumuman->text_pengumuman }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 animate-box">
                <div class="card mb-4">
                    <div class="card-header pt-4 pb-2 px-4">
                        <h1 class="mb-4">Pengumuman Lainnya</h1>
                    </div>
                    <div class="card-body p-3">
                        @foreach ($pengumumans as $pengumumanLain)
                            <div class="mb-3">
                                <div class="fh5co-blog">
                                    <div class="blog-img-holder">
                                        @php
                                            $filePath = storage_path('app/public/' . $pengumumanLain->file_pengumuman);
                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                            <a href="{{ url('pengumuman') }}/{{ $pengumumanLain->id_pengumuman }}/{{ $pengumumanLain->nama_pengumuman }}" class="blog-img-holder" style="background-image: url({{ Storage::url($pengumumanLain->file_pengumuman) }});"></a>
                                        @else
                                            <a href="{{ url('pengumuman') }}/{{ $pengumumanLain->id_pengumuman }}/{{ $pengumumanLain->nama_pengumuman }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                                <div class="p-5 text-break">
                                                    <h4 style="color: black;" class="light-text">{{ $pengumumanLain->text_pengumuman }}</h4>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="blog-text text-break">
                                        <h4 class="semi-bold-text">
                                            <a href="{{ url('pengumuman') }}/{{ $pengumumanLain->id_pengumuman }}/{{ $pengumumanLain->nama_pengumuman }}" style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $pengumumanLain->nama_pengumuman }}</a>
                                        </h4>
                                        <span class="posted_on">{{ $pengumumanLain->tanggal_pengumuman }}</span>
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
