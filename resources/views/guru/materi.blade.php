
@extends('guru.app')

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
								@foreach($subs as $subkelas)
                                @if($mapels->id_subkelas === $subkelas->id_subkelas)
                                <h1 class="heading-section">{{ $subkelas->nama_subkelas }} - {{ $mapels->nama_mapel }}</h1>
                                @endif
                                @endforeach
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



				
				@foreach($materis as $materis)
					<div class="col-lg-4 col-md-4">
						<div class="fh5co-blog animate-box">
							<a href="{{ url('edit') }}/materi/{{ $materis->id_materi }}" class="blog-img-holder" style="background-image: url({{ asset('images/document_icon.png') }});"></a>
							<div class="blog-text">
								<h3><a href="{{ url('edit') }}/materi/{{ $materis->id_materi }}">{{ $materis->nama_materi }}</a></h3>
								<span class="posted_on"><h6><strong>Materi ke-</strong>{{ $materis->urutan_materi }}</h6></span><br>
								{{-- <span class="posted_on"><h6><strong>ID Materi </strong>{{ $materis->id_materi }}</span></h6><br> --}}
								<span class="posted_on">{{ $materis->updated_at }}</span>
								<a href="{{ route('materi.download', ['id' => $materis->id_materi]) }}" class="btn btn-success" >Download</a>
								<a href="{{ url('edit') }}/materi/{{ $materis->id_materi }}" class="btn btn-warning" >Edit</a>
							</div> 
						</div>
					</div>
				@endforeach
				



				{{-- untuk add --}}
				
				<div class="col-lg-4 col-md-4" >
					<div class="fh5co-blog animate-box ">
						<a href="{{ url('upload') }}/materi" style="background-image: url({{ asset('images/gray_bg.jpg') }});" class="blog-img-holder">
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