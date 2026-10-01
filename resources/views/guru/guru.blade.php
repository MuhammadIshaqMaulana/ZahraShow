@extends('guru.app')

@section('content')
	
	<aside id="fh5co-hero">
		<div class="flexslider  animate-box">
			<ul class="slides">
		   	<li style="background-image: url({{ asset('images/fotbar-lapangan-1.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">Guru</h1>
								   <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>
	
	
	<div id="fh5co-staff" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>PIMPINAN</h2>
				</div>

				@foreach ($gurus as $guru)
				@if($guru->jabatan == 'Kepala Sekolah')
					<div class="col-6 animate-box text-center mb-3">
						<div class="row d-flex align-items-center justify-content-center">
							<div class="col-6">
								<div class="staff ">
									<div class=" d-flex align-items-center justify-content-center mb-2">
										<img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 400px; widht: 310px; background-position: center bottom; background-repeat: no-repeat; 
										overflow: hidden; object-fit: cover;" alt="Foto bersama">
									</div>
										

									<span>{{ $guru->jabatan }}</span>
									<h3><a href="{{ Storage::url($guru->file_guru) }}" class="blog-img-holder" data-lightbox="photos" data-title="{{ $guru->nama_guru }}">{{ $guru->nama_guru }}</a></h3>
									{{-- <p>{{ $guru->pend_terakhir }}</p> --}}
								</div>
							</div>
						</div>
						
					</div>
				@endif
				@endforeach

				@foreach ($gurus as $guru)
				@if($guru->jabatan == 'Wakil Kepala Sekolah')
					<div class="col-6 animate-box text-center">
						<div class="row d-flex align-items-center justify-content-center">
							<div class="col-6">
								<div class="staff ">
									<div class=" d-flex align-items-center justify-content-center mb-2">
										<img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 400px; widht: 310px; background-position: center bottom; background-repeat: no-repeat; 
										overflow: hidden; object-fit: cover;" alt="Foto bersama">
									</div>
										

									<span>{{ $guru->jabatan }}</span>
									<h3><a href="{{ Storage::url($guru->file_guru) }}" class="blog-img-holder" data-lightbox="photos" data-title="{{ $guru->nama_guru }}">{{ $guru->nama_guru }}</a></h3>
									{{-- <p>{{ $guru->pend_terakhir }}</p> --}}
								</div>
							</div>
						</div>
						
					</div>
				@endif
				@endforeach

			</div>
		</div>
	</div>

	<div id="fh5co-staff" style=" background-color: #EBEBEB" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>Data Guru</h2>
				</div>

				@foreach ($gurus as $guru)
				@if($guru->jabatan == 'GTY' || $guru->jabatan == 'GTT')
					<div class="col-md-3 animate-box text-center">
						<div class="staff ">
							<div class=" d-flex align-items-center justify-content-center mb-2">
								<img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 360px; widht: 290px; background-position: center bottom; background-repeat: no-repeat; 
								overflow: hidden; object-fit: cover;" alt="Foto bersama">
							</div>
								

							<span>{{ $guru->jabatan }}</span>
							<h3><a href="{{ Storage::url($guru->file_guru) }}" class="blog-img-holder" data-lightbox="photos" data-title="{{ $guru->nama_guru }}">{{ $guru->nama_guru }}</a></h3>
							{{-- <p>{{ $guru->pend_terakhir }}</p> --}}
						</div>
					</div>
				@endif
				@endforeach

			</div>
		</div>
	</div>

	<div id="fh5co-staff" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>Data Pegawai</h2>
				</div>

				@foreach ($gurus as $guru)
				@if($guru->jabatan != 'Kepala Sekolah' && $guru->jabatan != 'Wakil Kepala Sekolah' && $guru->jabatan != 'GTY' && $guru->jabatan != 'GTT' && $guru->jabatan != 'Satuan Pengaman' && $guru->jabatan != 'Petugas Kebersihan')
					<div class="col-md-3 animate-box text-center">
						<div class="staff ">
							<div class=" d-flex align-items-center justify-content-center mb-2">
								<img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 360px; widht: 290px; background-position: center bottom; background-repeat: no-repeat; 
								overflow: hidden; object-fit: cover;" alt="Foto bersama">
							</div>
								

							<span>{{ $guru->jabatan }}</span>
							<h3><a href="{{ Storage::url($guru->file_guru) }}" class="blog-img-holder" data-lightbox="photos" data-title="{{ $guru->nama_guru }}">{{ $guru->nama_guru }}</a></h3>
							{{-- <p>{{ $guru->pend_terakhir }}</p> --}}
						</div>
					</div>
				@endif
				@endforeach



			</div>
		</div>
	</div>

	<div id="fh5co-staff" style=" background-color: #EBEBEB" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>Satuan Pengaman & Petugas Kebersihan</h2>
				</div>

				@foreach ($gurus as $guru)
				@if($guru->jabatan == 'Satuan Pengaman' || $guru->jabatan == 'Petugas Kebersihan')
					<div class="col-md-3 animate-box text-center">
						<div class="staff ">
							<div class=" d-flex align-items-center justify-content-center mb-2">
								<img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 360px; widht: 290px; background-position: center bottom; background-repeat: no-repeat; 
								overflow: hidden; object-fit: cover;" alt="Foto bersama">
							</div>
								
			
							<span>{{ $guru->jabatan }}</span>
							<h3><a href="{{ Storage::url($guru->file_guru) }}" class="blog-img-holder" data-lightbox="photos" data-title="{{ $guru->nama_guru }}" >{{ $guru->nama_guru }} </a></h3>
							{{-- <p>{{ $guru->pend_terakhir }}</p> --}}
						</div>
					</div>
				@endif
				@endforeach

			

			</div>
		</div>
	</div>
@endsection
