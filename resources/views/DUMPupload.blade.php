@extends('guru.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

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
                            <h4 style="font-weight: bolder;">{{ $nama }}</h4>
                        </div>

                        <form id="uploadForm" method="POST" action="{{ url('upload') }}/{{ $nama }}/" enctype="multipart/form-data">
                            @csrf
                            

                            <div class="row mb-3">
                                <label for="{{ $nid }}" class="col-form-label ">ID {{ $nama }}</label>
                                <div class="col">
                                    @if ($nama === 'guru' || $nama === 'siswa')
                                        <input id="nidInput" type="text" class="form-control" name="{{ $nid }}" value="{{ old($nid) }}" autofocus maxlength="11">
                                        @else
                                            <input id="nidInput" type="text" class="form-control" name="{{ $nid }}" value="{{ old($nid) }}" autofocus maxlength="5">
                                    @endif
                                </div>
                            </div>
                            @if ($nama === 'guru')
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-form-label ">Jabatan</label>
                                    <div class="col">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" autofocus maxlength="25">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pend_terakhir" class="col-form-label ">Pendidikan Terakhir</label>
                                    <div class="col">
                                        <input id="pend_terakhir" type="text" class="form-control" name="pend_terakhir" value="{{ old('pend_terakhir') }}" autofocus maxlength="50">
                                    </div>
                                </div>
                            @endif


                            @if ($nama === 'mapel' || $nama === 'materi')

                                <select class="form-select" for="{{ $nfk }}" id="{{ $nfk }}" type="text" name="{{ $nfk }}" aria-label="Default select example">
                                    <option selected>{{ $nfk }}</option>
                                    
                                    @foreach($foreign as $foreign)
                                        <option id="{{ $nfk }}" type="text" name="{{ $nfk }}" value="{{ $foreign->$nfid }}">{{ $foreign->$nfid }} - {{ $foreign->$nfnama }}</option>
                                    @endforeach
                                </select>

                            @endif

                            <div class="row mb-3">
                                <label for="{{ $nnama }}" class="col-form-label ">Nama</label>
                                <div class="col">
                                    <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ old($nnama) }}" maxlength="100">
                                </div>
                            </div>
                              
                            @if ($nama === 'berita' || $nama === 'pengumuman')
                                <div class="mb-3">
                                    <label for="{{ $ntext }}" class="form-label">Teks</label>
                                    <textarea id="{{ $ntext }}" type="text" class="form-control" name="{{ $ntext }}" rows="5">{{ old($ntext) }}</textarea>
                                </div>
                            @endif

                            @if ($nama !== 'mapel')
                                <div class="mb-3">
                                    <label for="{{ $nfile }}" class="form-label">File</label>
                                    <input class="form-control" type="file" name="{{ $nfile }}" id="{{ old($nfile) }}">
                                </div>
                                    
                                <div class="mb-3">
                                    <p>Tipe file yang diterima : gambar .jpg .jpeg .png</p>
                                </div>
                            @endif

                            <div class="row mb-0 mt-5">
                                <div class="col offset">
                                    <div class="row flex-row-reverse row-cols-auto">
                                      
                                        <div class="col pr-2">
                                            @if ($nama === 'galeri')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/beranda'">Kembali</button>

                                            @elseif($nama === 'materi')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/materi/{{ $foreign->$nfk }}'">Kembali</button>

                                                
                                                @else
                                                    <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/{{ $nama }}'">Kembali</button>
                                            @endif
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
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        var nid = document.getElementById('nidInput').value;
        this.action = this.action + nid;
    });
</script>

@endsection
