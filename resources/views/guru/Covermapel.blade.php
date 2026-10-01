
@extends('guru.app')

@section('content')
	
	<aside id="fh5co-hero">
		<div class="flexslider animate-box">
			<ul class="slides">
		   	<li style="background-image: url({{ asset('images/perpus-keliling.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
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


				{{-- @foreach ($subkelases as subkelas) --}}
				<div>
					@foreach($mapels as $mapel)



						<div class="col-md-6 animate-box">
							<div class="course">


								@if(Auth::user()->role == 'guru')
								<a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" class=" px-5 py-2 course-img d-flex align-items-center justify-content-center" 
									style="background-image: url({{ asset('images/perpus-keliling-black.jpg') }}); font-size:28px; text-decoration: none; color: white;">
									{{ $mapel->nama_mapel }}
								</a>
									@elseif(Auth::user()->role == 'admin')
									<a href="{{ url('edit') }}/mapel/{{ $mapel->id_mapel }}" class=" px-5 py-2 course-img d-flex align-items-center justify-content-center" 
										style="background-image: url({{ asset('images/perpus-keliling-black.jpg') }}); font-size:28px; text-decoration: none; color: white;">
										{{ $mapel->nama_mapel }}
									</a>
									@endif
								


								<div class="desc">
									@if(Auth::user()->role == 'guru')
									<h3><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}"style="text-decoration: none;">Kelas {{ $mapel->id_subkelas }}</a></h3>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);">{{ $mapel->id_mapel }}</a></h6>
									<h6><a href="{{ url('guru/materi') }}/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);">{{ $mapel->tahun_ajaran }}</a></h6>
									@elseif(Auth::user()->role == 'admin')
									<h3><a href="{{ url('edit') }}/mapel/{{ $mapel->id_mapel }}"style="text-decoration: none;">{{ $mapel->id_subkelas }}</a></h3>
									<h6><a href="{{ url('edit') }}/mapel/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);">{{ $mapel->id_mapel }}</a></h6>
									<h6><a href="{{ url('edit') }}/mapel/{{ $mapel->id_mapel }}" style="text-decoration: none; color: rgb(90, 90, 90);">{{ $mapel->tahun_ajaran }}</a></h6>
									
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
					
				{{-- @endforeach --}}
				
				






				{{-- @foreach ($galeris as $galeris)
				<div class="col-lg-4 col-md-4">
					<div class="fh5co-blog animate-box">
						<a href="{{ url('edit') }}/galeri/{{ $galeris->id_galeri }}" class="blog-img-holder" style="background-image: url({{ Storage::url($galeris->file_galeri) }});"><img class="img-fluid imgheight item" src=""></a>
					</div>
				</div>
			@endforeach --}}

								
				{{-- untuk add --}}
				@if(Auth::user()->role == 'admin')
								
								
				<div class="col-md-6 animate-box">
					<div class="course">
						<a href="{{ url('upload') }}/mapel" class="course-img  d-flex align-items-center justify-content-center " style="background-image: url({{ asset('images/gray_bg.jpg') }});">
							<img class="p-1" src="{{ asset('images/add_icon.png') }}" style="width: 30px">
						</a>
						<div class="desc">
							<h3><a href="{{ url('upload') }}/mapel">Tambah</a></h3>
						</div>
					</div>
				</div>
				@endif

			
			</div>
		</div>
	</div>
	@endsection