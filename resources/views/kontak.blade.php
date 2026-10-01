
@extends('layouts.app')

@section('content')
	
	<aside id="fh5co-hero">
		<div class="flexslider animate-box">
			<ul class="slides">
				<li style="background-image: url({{ asset('images/gapura.jpg') }});">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
								<div class="slider-text-inner">
									<h1 class="heading-section">Kontak</h1>
									<h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
								</div>
							</div>
						</div>
					</div>
				</li>
		  	</ul>
	  	</div>
	</aside>



	
	<div class="container">
		<div class="row animate-box py-5 d-flex align-items-center justify-content-center">
			<div class="col-5 d-flex align-items-center justify-content-center px-5" style=" width: 660px; height: 750px;">
				<img src=" {{ asset('images/gedung-1.jpg') }} " style=" background-position: center center; background-repeat: no-repeat; overflow: hidden; min-height: 100%; min-width: 100%; object-fit: cover;" alt="gedung" >
			</div>
			<div class="col-5">
				<div class="d-flex align-items-center justify-content-center mb-3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d913.4262516086042!2d104.74408044690603!3d-2.988136773713895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b752cfbaed651%3A0xbe63ac8dcebd3db3!2sSEKOLAH%20MENENGAH%20PERTAMA%20(%20SMP)%20ISLAM%20AZZARAH!5e0!3m2!1sen!2sid!4v1715774588225!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<h2 class="semi-bold-text">Silakan Hubungi maupun kunjungi kami :</h2><br>
				<h3><i aria-hidden="true" class="fas fa-map-marker"></i>   Jalan Telaga Kompleks Masjid Raya Taqwa Kelurahan 30 Ilir Kecamatan Ilir Barat II Palembang 30144</h3><br>
				<h3><i aria-hidden="true" class="fas fa-phone-alt"></i>   Telp. 0711 - 374345</h3><br>
				<h3><i aria-hidden="true" class="fas fa-envelope"></i>   smpi_az_zahrahlplg@yahoo.com</h3>	
				
			</div>
		</div>
	</div>





	
	@endsection