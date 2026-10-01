
@extends('guru.app')

@section('content')

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use Illuminate\Support\Facades\Auth;
?>
	
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond@^4/dist/filepond.js" defer></script>

<div class="container">
    <div class="row justify-content-center align-item-center">
        <div class="col-4 py-5">
            <div class="row shadow">
                <div class="card-none-color p-5">

                        <div class="card-body">
                            
                            @if (session()->has('success'))
                                <div class="bg-green-400 text-sm text-green-700 m-2 p-2">
                                {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('danger'))
                                <div class="bg-red-400 text-sm text-red-700 m-2 p-2">
                                {{ session('danger') }}
                                </div>
                            @endif
                            <div class="text-left p-3 mb-3" style=" background-color: #EBEBEB">
                                <h4 style="font-weight: bolder;">{{ $nama }} - {{ $data->$nid }}</h4>
                            </div>



                            <form method="POST" action="{{ url('update') }}/{{ $nama }}/{{ $data->$nid }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                  <label for="{{ $nid }}" class="col-form-label ">ID {{ $nama }}</label>
                                  <div class="col">
                                    <input id="{{ $nid }}" type="text" class="form-control " name="{{ $nid }}" value="{{ $data->$nid }}"disabled readonly>
                            
                                  </div>
                                </div>



                                @if ($nama === 'mapel' || $nama === 'materi')
                                    <div class="row mb-3">
                                        <label for="{{ $nfk }}" class="col-form-label ">ID {{ $nfk }}</label>
                                        <div class="col">
                                            <input id="{{ $nfk }}" type="text" class="form-control " name="{{ $nfk }}" value="{{ $data->$nfk }}" autofocus>
                                        </div>
                                    </div>
                                @endif



                                <div class="row mb-3">
                                  <label for="{{ $nnama }}" class="col-form-label ">Nama</label>
                                  <div class="col">
                                    <input id="{{ $nnama }}" type="text" class="form-control " name="{{ $nnama }}" value="{{ $data->$nnama }}">
                                  </div>
                                </div>
                              
                                
                                @if ($nama === 'berita')
                                  <div class="mb-3">
                                    <label for="{{ $ntext }}" class="form-label">Teks</label>
                                    <textarea id="{{ $ntext }}" type="text" class="form-control" name="{{ $ntext }}" rows="5">{{ $data->$ntext }}</textarea>
                                  </div>
                                @endif


                                @if ($nama === 'mapel')
                                  <p></p>

                                  @else


                                  <div class="mb-3">
                                    <label for="{{ $nfile }}" class="form-label">File</label>
                                    <input class="filepond" type="file" name="{{ $nfile }}" id="{{ $nfile }}" value="{{ $data->$nfile }}">
                                  </div>

                                  <div class="mb-3">
                                    <input type="checkbox" id="deletefile" name="deletefile" value="yes">
                                    <label for="deletefile"> Hapus File Lama</label><br>
                                  </div>
                                    
                                  </div>

                              
                                <div class="mb-3">
                                  <p>Tipe file yang diterima : gambar .jpg .jpeg .png</p>
                                </div>
                              
                                @endif


                                <div class="row mb-0 mt-5">
                                  <div class="col offset">
                                    <div class="row flex-row-reverse row-cols-auto">
                                      <div class="col pr-2">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                      </div>
                                      <div class="col pr-2">
                                        <button type="submit" class="btn" style="background-color: #EBEBEB">Kembali</button>
                                      </div>
                                      <div class="col pr-2">
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </form>
                              
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Select the file input and use FilePond with it
      const inputElement = document.querySelector('.filepond');
      FilePond.create(inputElement);
      FilePond.setOptions({
        server: {
          url: '{{ url('upload') }}/{{ $nama }}/{{ $data->$nid }}', 
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        }
      });

  });
  </script>

@endsection




















{{-- @foreach (${$nama}s as ${$nama}s)


					<div class="col-lg-4 col-md-4">
						<div class="fh5co-blog animate-box">
							<a href="#" class="blog-img-holder" style="background-image: url({{ asset('images/person2.jpg') }});"></a>
							<div class="blog-text text-break">
								<h3><a href="{{ url('edit') }}/('{$nama}')/{{ ${$nama}s->{{ $nid }} }}">{{ ${$nama}s->{{ $nnama }} }}</a></h3>
								<span class="posted_on">{{ ${$nama}s->tanggal_{$nama} }}</span>
								<p style="   overflow: hidden;
								text-overflow: ellipsis;
								display: -webkit-box;
								-webkit-line-clamp: 2; /* number of lines to show */
										line-clamp: 2;
								-webkit-box-orient: vertical;">{{ ${$nama}s->{{ $ntext }} }}</p>
							</div> 
						</div>
					</div>
				
				@endforeach


@endsection --}}
































{{-- 

@extends('layouts.app')

@section('content')
<div class="containers container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb"> <!-- navbar navigasi path web kita --> 
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12">
            <div class="cards card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('uploads') }}/{{ $barang->gambar }}" class="rounded mx-auto d-block" width="500">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2 class="mb-3">{{ $barang->nama_barang }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{ ($barang->stok) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ ($barang->deskripsi) }}</td>
                                    </tr>

                                        <tr>
                                            <td>Jumlah Beli</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{url('pesan')}}/{{$barang->id}}" method="post">
                                                    @csrf
                                                    <input type="text" name="jumlah_pesan" class="form-control" required="">
                                                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i>Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
