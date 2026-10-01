  {{-- <x-guest-layout>
    <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf 

        <!-- Email Address -->
         <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> 

        <!-- Password -->
         <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> 

        <!-- Remember Me -->
         <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>    --}}


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SMP AZ - ZAHRAH 1 PALEMBANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/293b66ac39.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.cards').each(function(index) {
                var cards = $(this);
                setTimeout(function() {
                cards.addClass('animate');
                }, index * 200); // Menambahkan jeda waktu 200ms antara setiap animasi
            });
        });

    </script>


  

    <style>
        .containers {
            overflow: hidden;
        }

        .cards {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .cards.animate {
            opacity: 1;
            transform: translateY(0);
        }
        .btn-primary {
      position: relative;
      overflow: hidden;
      display: inline-block;
      padding: 10px 20px;
      color: #fff;
      background-color: #ffcc00;
      transform: translateY(0);
      transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
      text-decoration: none;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background-color: #000;
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease-in-out;
      z-index: -1;
    }

    .btn-primary:hover::before {
      transform: scaleX(1);
      left: 0;
    }
    </style>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-item-center">
        <div class="col-xl-4 col-md-6 col-sm-8 py-5">
            <div class="row shadow">
                <div class="card-none-color p-5">

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" id="formUsername">
                                @csrf
                                <div class="text-center">
                                  <img src="{{ url('images/logo_hd.png') }}" class="img-fluid mb-3 ml-md-4 ml-sm-5" width="60px" alt="Logo">
                                  <h4 style="font-weight: bolder;">SMP AZ - ZAHRAH 1 PALEMBANG</h4>
                                </div>

                                {{-- Login Sebagai
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <label class="input-group-text" for="role">Role</label>
                                    </div>

                                    <select class="custom-select" id="role" name="role">
                                    <option selected value="siswa">Login Sebagai</option>
                                    <option value="siswa">Siswa</option>
                                    <option value="guru">Guru</option>
                 
                                    </select>
                                    
                                </div> --}}

                              
                                {{-- niy/nisn (USERNAME) --}}
                                <div class="row mb-3">
                                  <label for="username" class="col-form-label ">Username</label>
                              
                                  <div class="col">
                                    <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" maxlength="11" required autocomplete="username" autofocus>
                              
                                  @error('username')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>Username Atau Password Salah</strong>
                                    </span>
                                    @enderror
                                  </div>
                                </div>
                              
                                <div class="row mb-3">
                                  <label for="password" class="col-form-label">{{ __('Password') }}</label>
                              
                                  <div class="col">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                </div>



                              
                                <div class="row mb-0">
                                  <div class="col offset">
                                    <div class="row row-cols-auto">
                                      <div class="col pr-2">
                                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                      </div>
                                      <div class="col pr-2">
                                        <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('beranda') }}'">Kembali</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              
                                <script>
                                  const formUsername = document.getElementById('formUsername');
                                  const inputUsername = document.getElementById('username');
                              
                                  formUsername.addEventListener('submit', function(event) {
                                    // event.preventDefault(); // Mencegah form dari submit secara default
                              
                                    const usernameValue = inputUsername.value;
                                    const usernameLength = usernameValue.length;
                              
                                    if (usernameLength === 11) {
                                      inputUsername.name = "username"; // Mengubah nama form menjadi "guru"
                              
                                      // Buat dan tambahkan input tersembunyi untuk role
                                      const roleInput = document.createElement('input');
                                      roleInput.type = 'hidden';
                                      roleInput.name = 'role';
                                      roleInput.value = 'guru';
                                      formUsername.appendChild(roleInput);
                                    } 
                                    else if (usernameLength === 10) {
                                      inputUsername.name = "username"; // Mengubah nama form menjadi "siswa"
                              
                                      // Buat dan tambahkan input tersembunyi untuk role
                                      const roleInput = document.createElement('input');
                                      roleInput.type = 'hidden';
                                      roleInput.name = 'role';
                                      roleInput.value = 'siswa';
                                      formUsername.appendChild(roleInput);
                                    } 
                                    else {
                                      alert("Jumlah karakter username tidak sesuai (harus 10 atau 11).");
                                    }
                              
                                    // Lakukan tindakan selanjutnya berdasarkan nama form dan role yang telah diubah
                                    // ...
                                  });
                                </script>
                              </form>
                              
                            {{-- <div>
                                 @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                            </div> --}}


                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

{{-- <script>
          // ubah name username
    const selectElement = document.getElementById("role");
    const inputElement = document.getElementById("username");

    selectElement.addEventListener("change", function() {
    const selectedValue = this.value;
    const newPlaceholder = `${selectedValue}`;

        if (newPlaceholder === 'guru'){
                inputElement.name = 'niy';
        }

        else if (newPlaceholder === 'siswa'){
                inputElement.name = 'nisn';
        }

    });

</script> --}}

{{-- 
<script>
    const formUsername = document.getElementById('formUsername');
    const inputUsername = document.getElementById('username');

    formUsername.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form dari submit secara default

        const usernameValue = inputUsername.value;
        const usernameLength = usernameValue.length;

        if (usernameLength === 11) {
            inputUsername.name = "guru"; // Mengubah nama form menjadi "guru"
        } else if (usernameLength === 10) {
            inputUsername.name = "siswa"; // Mengubah nama form menjadi "siswa"
        } else {
            alert("Jumlah karakter username tidak sesuai (harus 10 atau 11).");
        }

        // Lakukan tindakan selanjutnya berdasarkan nama form yang telah diubah
        // ...
    });
</script> --}}


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca Jumlah String Input Username</title>
</head>
<body>
    <h1>Membaca Jumlah String Input Username</h1>
    <form id="formUsername">
        <label for="username">Username:</label>
        <input type="text" id="username">
        <button type="submit">Submit</button>
    </form>

    
</body>
</html>
 --}}


