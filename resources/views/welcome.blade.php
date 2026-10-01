@extends('layouts.app')

@section('content')

		<!-- slider -->
		<aside id="fh5co-hero">
		<div class="flexslider animate-box">
			<ul class="slides">
			<li style="background-image: url({{ asset('images/fotbar-lapangan-1.jpg') }});">
				<div class="overlay-gradient"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
							<div class="slider-text-inner">
								<div style="background-color: white;" class="pt-3 ">
									<h1 class="bold-text" style="background-color: white; font-weight: 700; px-5
									font-family: 'sans-serif', sans-serif; color: black; font-size: 40px;">SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h1>

									<h2 style="font-size: 25px; font-weight: 700;
									font-family: 'sans-serif', sans-serif; letter-spacing: 2.5px; background-color: white; color: rgb(21, 160, 0); transform: translate(0px, -16px);">TERAKREDITASI "A"</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>	
		   	<li style="background-image: url({{ asset('images/gapura.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
								<div style="background-color: white;" class="pt-3 ">
									<h1 class="bold-text" style="background-color: white; font-weight: 700; px-5
									font-family: 'sans-serif', sans-serif; color: black; font-size: 40px;">SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h1>

									<h2 style="font-size: 25px; font-weight: 700;
									font-family: 'sans-serif', sans-serif; letter-spacing: 2.5px; background-color: white; color: rgb(21, 160, 0); transform: translate(0px, -16px);">TERAKREDITASI "A"</h2>
								</div>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url({{ asset('images/gedung-3.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
								<div style="background-color: white;" class="pt-3 ">
									<h1 class="bold-text" style="background-color: white; font-weight: 700; px-5
									font-family: 'sans-serif', sans-serif; color: black; font-size: 40px;">SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h1>

									<h2 style="font-size: 25px; font-weight: 700;
									font-family: 'sans-serif', sans-serif; letter-spacing: 2.5px; background-color: white; color: rgb(21, 160, 0); transform: translate(0px, -16px);">TERAKREDITASI "A"</h2>
								</div>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   		   	
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-about">
		<div class="container animate-box">
			<div class="row">
				<div class="col-md-6">
					<img class="img-responsive" src="{{ asset('images/gedung-3.jpg') }}" style="height: 400px; background-position: center bottom; background-repeat: no-repeat; 
					overflow: hidden; min-height: 100%; min-width: 100%; object-fit: cover;" alt="Foto bersama">
				</div>
				<div class="col-md-6 animate-box">
					<h2>Selamat Datang di SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
					<p style="">SMP Islam Azzahrah 1 Palembang berada di lokasi strategis di tengan 
						kota Palembang dengan Gedung 4 lantai yang asri dengan fasilitas ruang 
						kelas full AC, Laboratorium IPA, Laboratorium Komputer dan Internet 
						(Hotspot), lab. Bahasa, Perpustakaan, sarana olahraga, sarana ibadah, 
						kantin dan catering. Menerapkan Kurikulum Nasional ditambah dengan program 
						Pembinaan Iman dan Taqwa Tadarus Quran, Tahfizul Quran, Pembiasaan 
						Dhuha dan kultum, Muhodhorah (latihan Pidato), Malam Bina Iman dan Taqwa. 
						Program Pembinaan Bakat : Dai, Karate, Pramuka, PMR, Hadroh, Seni Tari, 
						Futsal, Tilawah, kegiatan Hydroponik.</p>
					
				</div>
			</div>
			
			
		</div>
	</div>

	<div id="fh5co-course" style=" background-color: #EBEBEB">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12  text-center fh5co-heading">
					<h2>VISI & MISI</h2>
				</div>
				<div class="col-md-6 ">
					<div class="card text-bg-success">
						<div class="card-header "><h2 class="card-title" style="color: #EBEBEB;">VISI</h2></div>
						<div class="card-body">
							<p style="">“Terbentuknya Peserta Didik Yang Intelek, Beriman, Berakhlak Mulia dan Berbudaya Lingkungan.”</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="card text-bg-success">
						<div class="card-header "><h2 class="card-title" style="color: #EBEBEB;">MISI</h2></div>
						<div class="card-body">
							<ul style="list-style-type: disc !important; padding-left:1em !important; margin-left:1em;">
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Melaksanakan pembelajaran dan pembinaan secara efektif dengan memperhatikan potensi setiap murid</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Mengembangkan kurikulum sesuai dengan kondisi sekolah</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Meningkatkan profesionalisme dan kompetensi pendidik dan tenaga kependidikan</p>
								</li> 
								<li style="list-style-type: disc !important; display: revert">
									<p style="" style="" class="card-text">Terciptanya Budaya Disiplin</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Melengkapi fasilitas pendidikan sesuai dengan kebutuhan</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Terwujudnya pembelajaran yang memadukan IPTEK dan IMTAQ</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Mendorong pengembangan potensi peserta didik yang kreatif, inovatif, berkualitas dan berakhlak mulia</p>
								</li>
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Mewujudkan sekolah sebagai wiyata mandala</p>
								</li>
								
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Menumbuhkan penghayatan, pengamalan iman dan taqwa</p>
								</li>
								
								<li style="list-style-type: disc !important; display: revert">
									<p style="" class="card-text">Mewujudkan sekolah yang berbudaya lingkungan sesuai dengan nilai-nilai dan karakter bangsa.</p>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="fh5co-course-categories">
		<div class="container">
			<div class="row animate-box">
				<div class="row">
					<div class="col-md-12  text-center fh5co-heading">
						<h2>Fasilitas</h2>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-regular fa-building"></i>
							</span>
							<div class="desc">
								<h3><a >Ruang Kelas</a></h3>
								<p>Full AC</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-solid fa-wifi"></i>
							</span>
							<div class="desc">
								<h3><a>Internet</a></h3>
								<p>Hotspot</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-solid fa-book"></i>
							</span>
							<div class="desc">
								<h3><a>kurikulum</a></h3>
								<p>Kurikulum Merdeka</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-solid fa-computer"></i>
							</span>
							<div class="desc">
								<h3><a>Laboratorium</a></h3>
								<p>3 ( Ipa, Bahasa, dan Komputer )</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-solid fa-book-open-reader"></i>
							</span>
							<div class="desc">
								<h3><a>Perpustakaan</a></h3>
								<p>1</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-solid fa-users"></i>
							</span>
							<div class="desc">
								<h3><a>Sarana</a></h3>
								<p>Olahraga, Ibadah, dan Kantin</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-regular fa-clock"></i>
							</span>
							<div class="desc">
								<h3><a>Penyelenggaraan</a></h3>
								<p>Pagi</p>
							</div>
						</div>
					</div>			
					{{-- <div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services">
							<span class="icon">
								<i class="fa-regular fa-building"></i>
							</span>
							<div class="desc">
								<h3><a>Ruang Kelas</a></h3>
								<p>11</p>
							</div>
						</div>
					</div> --}}


					

				</div>
			</div>
			
		</div>
	</div>
	
	<div id="fh5co-blog" style=" background-color: #EBEBEB">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>Ekstrakurikuler</h2>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/karate.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Karate</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/futsal.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Futsal</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/kegiatan-siswa.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Tahfizh</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/hadroh.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Hadroh</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/lomba-pahlawan-mc.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Da'i</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/tilawah-3.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Tilawah</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/pmr.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>PMR</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/pramuka.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Pramuka</a></h3>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="fh5co-blog">
						<a class="blog-img-holder" style="background-image: url({{ asset('images/tari.jpg') }});">
						</a>
						<div class="blog-text text-break" style="background-color: white;">
							<h3><a>Tari</a></h3>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>



	<div id="fh5co-blog">
		<div class="container">
			<div class="row">
				<div class="col-md-12  text-center fh5co-heading">
					<h2>Berita</h2>
				</div>
				@foreach ($beritas as $beritas)
					<div class="col-lg-4 col-md-4">
						<div class="fh5co-blog animate-box">
							<div class="blog-img-holder">
								
								@php
									$filePath = storage_path('app/' . $beritas->file_berita);
									$fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
								@endphp
	
								@if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
									<a href="{{ url('berita') }}/{{ $beritas->id_berita }}/{{ $beritas->nama_berita }}" class="blog-img-holder" style="background-image: url({{ Storage::url($beritas->file_berita) }});"></a>
								@else
									<a href="{{ url('berita') }}/{{ $beritas->id_berita }}/{{ $beritas->nama_berita }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
										<div class="p-5 text-break">
											<h4 style="color: black; text-align: justify;
											text-justify: inter-word;" class="light-text">{{ $beritas->text_berita }}</h4>
										</div>
									</a>
								@endif
							</div>
							<div class="blog-text text-break">
								<h4 class="semi-bold-text"><a href="{{ url('edit') }}/berita/{{ $beritas->id_berita }}" 
									style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $beritas->nama_berita }}</a></h4>
								<span class="posted_on">{{ $beritas->tanggal_berita }}</span>
							</div> 
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>


	<div id="fh5co-blog" style=" background-color: #EBEBEB">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center fh5co-heading">
					<h2>Galeri</h2>
				</div>
			


			@foreach ($galeris as $galeris)
				<div class="col-lg-4 col-md-4">
					<div class="fh5co-blog animate-box">
						<div class="blog-img-holder">
						<a href="{{ Storage::url($galeris->file_galeri) }}" class="blog-img-holder" style="background-image: url({{ Storage::url($galeris->file_galeri) }});" data-lightbox="galeri" data-title="{{ $galeris->nama_galeri }}"><img class="img-fluid imgheight item" src=""></a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		</div>
	</div>
			

@endsection

