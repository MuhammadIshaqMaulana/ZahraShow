@extends('layouts.app')

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
				


				@foreach ($pengumumans as $pengumuman)
                <div class="col-lg-4 col-md-4">
                    <div class="fh5co-blog animate-box">
                        <div class="blog-img-holder">
                            @php
                                $filePath = storage_path('app/' . $pengumuman->file_pengumuman);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <a href="{{ url('pengumuman') }}/{{ $pengumuman->id_pengumuman }}/{{ $pengumuman->nama_pengumuman }}" class="blog-img-holder" style="background-image: url({{ Storage::url($pengumuman->file_pengumuman) }});"></a>
                            @else
                                <a href="{{ url('pengumuman') }}/{{ $pengumuman->id_pengumuman }}/{{ $pengumuman->nama_pengumuman }}" style="background-image: url({{ asset('images/light_gray.jpg') }}); text-decoration: none; border: 1px solid #e7e7e7; overflow: hidden;" class="blog-img-holder">
                                    <div class="p-5 text-break">
                                        <h4 style="color: black;" class="light-text">{{ $pengumuman->text_pengumuman }}</h4>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="blog-text text-break">
                            <h4 class="semi-bold-text"><a href="{{ url('pengumuman') }}/{{ $pengumuman->id_pengumuman }}/{{ $pengumuman->nama_pengumuman }}" 
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



			</div>
		</div>
	</div>


	@endsection