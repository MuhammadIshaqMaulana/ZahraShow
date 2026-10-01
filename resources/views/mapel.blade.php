@extends('layouts.app')

@section('content')
<aside id="fh5co-hero">
    <div class="flexslider animate-box">
        <ul class="slides">
            <li style="background-image: url({{ asset('images/perpus-keliling.jpg') }});">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1 class="heading-section">Mata Pelajaran</h1>
                                <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="fh5co-course" style=" background-color: #EBEBEB">
    <div class="container">
        <div class="row">
            @foreach($gurus as $guru)
            @foreach($subs as $subkelas)
           @foreach($mapels as $mapel)
           @if($mapel->id_subkelas === $subkelas->id_subkelas && $mapel->id_guru === $guru->id_guru)
					<div class="col-md-6 animate-box">
						<div class="course">


							
							<a href="{{ url('materi') }}/{{ $mapel->id_mapel }}" class=" px-5 py-2 course-img d-flex align-items-center justify-content-center" 
								style="background-image: url({{ asset('images/perpus-keliling-black.jpg') }}); font-size:28px; text-decoration: none; color: white;">
								{{ $mapel->nama_mapel }}
							</a>

							<div class="desc">
								<h3><a href="{{ url('materi') }}/{{ $mapel->id_mapel }}"style="text-decoration: none;">{{ $subkelas->nama_subkelas }}</a></h3>
								<h6><a href="{{ url('materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>ID Mata Pelajaran</strong> {{ $mapel->id_mapel }}</a></h6>
								<h6><a href="{{ url('materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Guru</strong> {{ $guru->nama_guru }}</a></h6>
                                <h6><a href="{{ url('materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Tahun Ajaran</strong> {{ $subkelas->tahun_ajaran }}</a></h6>
                                <h6><a href="{{ url('materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Semester</strong> {{ $subkelas->semester }}</a></h6>
							
							</div>
						</div>
					</div>
                @endif
				@endforeach
				@endforeach
				@endforeach

        </div>
    </div>
</div>
@endsection
