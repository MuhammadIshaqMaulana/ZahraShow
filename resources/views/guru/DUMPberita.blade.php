
@extends('guru.app')

@section('content')
	
	<aside id="fh5co-hero">
		<div class="flexslider animate-box">
			<ul class="slides">
		   	<li style="background-image: url({{ asset('images/person2.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
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

				@foreach ($beritas as $beritas)
					{{-- <div class="col-md-4">
						<div class="cards card m-1">
							<img class="card-img-top" src="{{ url('uploads') }}/{{ $beritas->gambar }}" height="200" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">{{ $beritas->nama_berita }}</h5>
								<p class="card-text"><strong>Harga :</strong> Rp. {{ number_format($beritas->harga) }} <br>
								<strong>Stok :</strong>
								@if($beritas->stok > 0)
									{{ $beritas->stok }}
								@else
									Out of Stock
								@endif
								<br>
								<hr>
								<strong>Keterangan : </strong> <br>
								{{ $beritas->deskripsi }}
								</p>
								<a href="{{ url('pesan') }}/{{ $beritas->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Beli</a>
							</div>
							</div>
					</div> --}}

					<div class="col-lg-4 col-md-4">
						<div class="fh5co-blog animate-box">
							<a href="{{ url('edit') }}/berita/{{ $beritas->id_berita }}" class="blog-img-holder" style="background-image: url({{ asset('images/person2.jpg') }});"></a>
							<div class="blog-text text-break">
								<h3><a href="{{ url('edit') }}/berita/{{ $beritas->id_berita }}">{{ $beritas->nama_berita }}</a></h3>
								<span class="posted_on">{{ $beritas->tanggal_berita }}</span>
								<p style="   overflow: hidden;
								text-overflow: ellipsis;
								display: -webkit-box;
								-webkit-line-clamp: 2; /* number of lines to show */
										line-clamp: 2;
								-webkit-box-orient: vertical;">{{ $beritas->text_berita }}</p>
							</div> 
						</div>
					</div>
				
				@endforeach


				
		
				
				{{-- untuk add --}}
				<div class="col-lg-4 col-md-4" >
					<div class="fh5co-blog animate-box ">
						<a href="{{ route('upberita') }}" style="background-image: url({{ asset('images/gray_bg.jpg') }});" class="blog-img-holder">
							<div class="row">
								<div class="col-12 d-flex align-items-center justify-content-center">
									<img class="imgheight item pt-5 mt-5 mb-5" src="{{ asset('images/add_icon.png') }}" style="width: 30px">
								</div>
								<div class="col-12 d-flex align-items-center justify-content-center">
									<h4 style="color: black">Tambah</h4>
								</div>
							</div>
						</a>
					</div>
				</div>

				
			</div>
		</div>
	</div>


	@endsection

{{-- 	
<div class="containers container">
	<div class="row justify-content-center">
		<div class="col-md-12 mb-5">
			<img src="{{ url('images/logo.png') }}" class="rounded mx-auto d-block" width="150" alt="">
		</div>
		<?php
		use App\Models\berita;
		$beritas = berita::paginate(20);
		?>
		@foreach ($beritas as $beritas)
			<div class="col-md-4">
				<div class="cards card m-1">
					<img class="card-img-top" src="{{ url('uploads') }}/{{ $beritas->gambar }}" height="200" alt="Card image cap">
					<div class="card-body">
					  <h5 class="card-title">{{ $beritas->nama_berita }}</h5>
					  <p class="card-text"><strong>Harga :</strong> Rp. {{ number_format($beritas->harga) }} <br>
						<strong>Stok :</strong>
						@if($beritas->stok > 0)
							{{ $beritas->stok }}
						@else
							Out of Stock
						@endif
						<br>
						<hr>
						<strong>Keterangan : </strong> <br>
						{{ $beritas->deskripsi }}
					  </p>
					  <a href="{{ url('pesan') }}/{{ $beritas->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Beli</a>
					</div>
				  </div>
			</div>
		@endforeach
	</div>
  </div> --}}