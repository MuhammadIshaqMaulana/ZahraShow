@extends('guru.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
    .no-accordion-button.collapsed::after {
        background: url("your.svg");
    }
    .no-accordion-button:not(.collapsed)::after {
        background: url("your.svg");
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



@if(Auth::user()->role === 'guru')
	<div id="fh5co-course" style=" background-color: #EBEBEB">
		<div class="container">
			<div class="row">
                @foreach($gurus as $guru)
                @foreach($subs as $subkelas)
			    @foreach($mapels as $mapel)
                @if($mapel->id_subkelas === $subkelas->id_subkelas && $mapel->id_guru === $guru->id_guru)
						<div class="col-md-6 animate-box">
							<div class="course">
	
	
								
								<a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" class=" px-5 py-2 course-img d-flex align-items-center justify-content-center" 
									style="background-image: url({{ asset('images/perpus-keliling-black.jpg') }}); font-size:28px; text-decoration: none; color: white;">
									{{ $mapel->nama_mapel }}
								</a>
	
								<div class="desc">
									<h3><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}"style="text-decoration: none;">{{ $subkelas->nama_subkelas }}</a></h3>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>ID Mata Pelajaran</strong> {{ $mapel->id_mapel }}</a></h6>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Guru</strong> {{ $guru->nama_guru }}</a></h6>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Tahun Ajaran</strong> {{ $subkelas->tahun_ajaran }}</a></h6>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);"><strong>Semester</strong> {{ $subkelas->semester }}</a></h6>
								
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
	@endif


@if(Auth::user()->role === 'admin')
<div id="fh5co-course" style=" background-color: #EBEBEB">
    <div class="container">
        <form method="GET" action="{{ url('guru/mapel') }}/{{ $id }}">
            <div class="row mb-3">
                <div class="col">
                    <input id="id_mapel" type="text" class="form-control" placeholder="ID Mata Pelajaran" name="id_mapel" value="{{ request()->input('id_mapel') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_subkelas" type="text" class="form-control" placeholder="Nama SubKelas" name="nama_subkelas" value="{{ request()->input('nama_subkelas') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_guru" type="text" class="form-control" placeholder="Nama Guru" name="nama_guru" value="{{ request()->input('nama_guru') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_mapel" type="text" class="form-control" placeholder="Nama Mata Pelajaran" name="nama_mapel" value="{{ request()->input('nama_mapel') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="tahun_ajaran" type="text" class="form-control" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ request()->input('tahun_ajaran') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="semester" type="text" class="form-control" placeholder="Semester" name="semester" value="{{ request()->input('semester') }}" maxlength="700">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </div>
        </form>

        <div class="row pb-3">
            <div class="col">
                <a href="{{ url('guru/beranda') }}" class="btn btn-warning">Kembali</a>
                <a href="{{ url('upload/mapel') }}" class="btn btn-success">Tambah Mata Pelajaran</a>
            </div>
        </div>

        <div class="px-3 py-3">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID Mata Pelajaran</th>
                    <th>Nama SubKelas</th>
                    <th>Nama Guru</th>
                    <th>Nama Pelajaran</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Edit</th>
                </tr>
                @foreach ($mapels as $mapel)
                    <tr>
                        <td>{{ $mapel->id_mapel }}</td>
                        <td>{{ $mapel->nama_subkelas }}</td>
                        <td>{{ $mapel->nama_guru }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        <td>{{ $mapel->tahun_ajaran }}</td>
                        <td>{{ $mapel->semester }}</td>
                        <td><a href="{{ url('edit') }}/mapel/{{ $mapel->id_mapel }}" class="btn btn-success" style="color: #EBEBEB">Edit</a></td>
                    </tr>
                @endforeach
            </table>
            {{ $mapels->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endif
@endsection
