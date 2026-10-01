@extends('guru.app')

@section('content')

	
	<aside id="fh5co-hero">
		<div class="flexslider animate-box">
			<ul class="slides">
		   	<li style="background-image: url({{ asset('images/pemilihan-osis-banner.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">Pengumuman</h1>
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
				
				{{-- <div class="col-lg-4 col-md-4">
					<div class="fh5co-blog animate-box">
						<a href="#" class="blog-img-holder" style="background-image: url({{ asset('images/person2.jpg') }});"></a>
						<div class="blog-text">
							<h3><a href="#">Penandatanganan MOU dengan Mark Zuckerberg</a></h3>
							<span class="posted_on">21 April 2022</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ad odit minima corporis ab vel dolores. Facilis labore soluta earum, saepe nemo, fug....</p>
						</div> 
					</div>
				</div> --}}
				@if(Auth::user()->role == 'admin')
				@foreach ($pengumumans as $pengumuman)
                <div class="col-lg-4 col-md-4">
                    <div class="fh5co-blog animate-box">
                        <div class="blog-img-holder">
                            @php
                                $filePath = storage_path('app/' . $pengumuman->file_pengumuman);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <a href="{{ url('edit') }}/pengumuman/{{ $pengumuman->id_pengumuman }}" class="blog-img-holder" style="background-image: url({{ Storage::url($pengumuman->file_pengumuman) }});"></a>
                            @else
                                <a href="{{ url('edit') }}/pengumuman/{{ $pengumuman->id_pengumuman }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                    <div class="p-5 text-break">
                                        <h4 style="color: black;" class="light-text">{{ $pengumuman->text_pengumuman }}</h4>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="blog-text text-break">
                            <h4 class="semi-bold-text"><a href="{{ url('edit') }}/pengumuman/{{ $pengumuman->id_pengumuman }}" 
                                style="color: black; text-decoration: none; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: block;">{{ $pengumuman->nama_pengumuman }}</a></h4>
                            <span class="posted_on">{{ $pengumuman->tanggal_pengumuman }}</span>
                        </div> 
                    </div>
                </div>
            @endforeach
			<div class="row">
                <div class="col-md-12 text-center">
                    {{ $pengumumans->links() }}
                </div>
            </div>
			



				{{-- untuk add --}}
				
				<div class="col-lg-4 col-md-4" >
					<div class="fh5co-blog animate-box ">
						<a href="{{ url('upload') }}/pengumuman" style="background-image: url({{ asset('images/gray_bg.jpg') }});" class="blog-img-holder">
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
				@endif



			</div>
		</div>
	</div>


	@endsection