@extends('guru.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
    .accordion-button.collapsed::after {
        background: url("your.svg");
    }

    .accordion-button:not(.collapsed)::after {
        background: url("your.svg");
    }

    .accordion-header .edit-button {
        margin-left: auto;
        background-color: #28a745;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .accordion-header .edit-button:hover {
        background-color: #218838;
    }
</style>

<aside id="fh5co-hero">
    <div class="flexslider animate-box">
        <ul class="slides">
            <li style="background-image: url({{ asset('images/perpus-keliling.jpg') }});">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1 class="heading-section">Siswa</h1>
                                <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

@if(Auth::user()->role === 'admin')
<div id="fh5co-course" style="background-color: #EBEBEB">
    <div>


        @foreach($tahun as $thn)
        <div class="accordion accordion-flush" id="{{ $thn->tahun_ajaran }}12345{{ $thn->semester }}">
            <div class="accordion-item px-3">
                <h2 class="accordion-header d-flex align-items-center">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $thn->tahun_ajaran }}{{ $thn->semester }}" aria-expanded="false" aria-controls="{{ $thn->tahun_ajaran }}{{ $thn->semester }}">
                    Tahun Ajaran {{ $thn->tahun_ajaran }} Semester {{ $thn->semester }}
                    </button>
                </h2>

                <div id="{{ $thn->tahun_ajaran }}{{ $thn->semester }}" style="-webkit-transition: none; transition: none;" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">



                        @foreach ($kelases as $kelas)
                        
                        <div class="accordion-item px-3" style="-webkit-transition: none; transition: none;">
                            <h2 class="accordion-header d-flex align-items-center">
                                <button style="-webkit-transition: none; transition: none;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $kelas->id_kelas }}{{ $thn->tahun_ajaran }}{{ $thn->semester }}" aria-expanded="false" aria-controls="{{ $kelas->id_kelas }}{{ $thn->tahun_ajaran }}{{ $thn->semester }}">
                                    {{ $kelas->nama_kelas }}
                                </button>
                            </h2>



                            <div id="{{ $kelas->id_kelas }}{{ $thn->tahun_ajaran }}{{ $thn->semester }}" style="-webkit-transition: none; transition: none;" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">



                                    
                                        @foreach ($subkelases as $subkelas)
                                        @if($subkelas->id_kelas === $kelas->id_kelas && $subkelas->tahun_ajaran === $thn->tahun_ajaran && $subkelas->semester === $thn->semester)
                                            <div class="accordion-item px-3 mt-8">
                                                <h2 class="accordion-header">
                                                    <a href="{{ url('guru') }}/{{ $thn->tahun_ajaran }}/{{ $thn->semester }}/{{ $subkelas->id_subkelas }}" style="text-decoration: none;">
                                                        <button class="no-accordion-button accordion-button collapsed" style="background-color: rgb(2, 104, 0); color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#tambah" aria-expanded="false" aria-controls="tambah">
                                                            {{ $subkelas->nama_subkelas }}
                                                        </button>
                                                    </a>
                                                </h2>
                                            </div>
                                        @endif
                                        @endforeach
                                    




                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="accordion-item px-3 mt-8">
            <h2 class="accordion-header">
                <a href="{{ url('upload/siswa') }}" style="text-decoration: none;">
                    <button class="no-accordion-button accordion-button collapsed" style="background-color: rgb(2, 104, 0); color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#tambah" aria-expanded="false" aria-controls="tambah">
                        Tambah Siswa
                    </button>
                </a>
            </h2>
        </div> --}}

        
    </div>
</div>






@endif
@endsection
