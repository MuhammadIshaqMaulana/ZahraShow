@extends('guru.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    var idGuruInput = document.getElementById('nidInputguru');
    var nisnInput = document.getElementById('nidInputsiswa');

    // Enforce character limits
    if (idGuruInput) {
        idGuruInput.addEventListener('input', function() {
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });
    }

    if (nisnInput) {
        nisnInput.addEventListener('input', function() {
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });
    }

    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        var errorMessages = [];

        if (idGuruInput && idGuruInput.value.length !== 11) {
            errorMessages.push('ID Guru harus tepat 11 karakter');
        }

        if (nisnInput && nisnInput.value.length !== 10) {
            errorMessages.push('NISN harus tepat 10 karakter');
        }

        if (errorMessages.length > 0) {
            alert(errorMessages.join('\n'));
            event.preventDefault();
        }
    });


    document.getElementById('uploadForm').addEventListener('submit', function(event) {
    var maxSize = {
        fileAvatar: 1 * 1024 * 1024,   // 1MB
        fileGaleri: 5 * 1024 * 1024,   // 5MB
        fileMateri: 10 * 1024 * 1024,  // 10MB
        fileOther: 10 * 1024 * 1024,   // 10MB
    };
    
    var allowedTypes = {
        fileAvatar: ['image/jpeg', 'image/png'],
        fileGaleri: ['image/jpeg', 'image/png'],
        fileMateri: ['application/pdf', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        
    };

    var fileInputs = ['fileAvatar', 'fileGaleri', 'fileMateri', 'fileOther'];

    for (var i = 0; i < fileInputs.length; i++) {
        var fileInput = document.getElementById(fileInputs[i]);
        if (fileInput && fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var id = fileInput.id;

            if (file.size > maxSize[id]) {
                alert('Ukuran file terlalu besar. Maksimum ' + (maxSize[id] / (1024 * 1024)) + ' MB.');
                event.preventDefault();
                return;
            }

            if (!allowedTypes[id].includes(file.type)) {
                alert('Tipe file tidak diizinkan.');
                event.preventDefault();
                return;
            }
        }
    }
});


});

</script>


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

                        <form id="uploadForm" method="POST" action="{{ url('upload') }}/{{ $nama }}/1" enctype="multipart/form-data">
                            @csrf

                            @if (!in_array($nama, ['berita', 'pengumuman', 'galeri', 'beranda', 'guru']))
                                <div class="row mb-3">
                                    
                                    <div class="col">
                                        @if ($nama === 'siswa' && Auth::user()->role === 'admin')
                                        <label for="{{ $nid }}" class="col-form-label ">NISN {{ $nama }}</label>
                                            <input id="nidInputsiswa" type="text" class="form-control" name="{{ $nid }}" value="{{ old($nid) }}" autofocus required maxlength="10">
                                        {{-- @elseif ($nama === 'mapel' || $nama === 'materi')
                                        <label for="{{ $nid }}" class="col-form-label ">ID {{ $nama }}</label>
                                            <input id="nidInput" type="text" class="form-control" name="{{ $nid }}" value="{{ old($nid) }}" autofocus maxlength="25">
                                        @else
                                        <label for="{{ $nid }}" class="col-form-label ">ID {{ $nama }}</label>
                                            <input id="nidInput" type="text" class="form-control" name="{{ $nid }}" value="{{ old($nid) }}" autofocus maxlength="5"> --}}
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($nama === 'guru')
                                <div class="row mb-3">
                                    <label for="id_guru" class="col-form-label">ID Guru</label>
                                    <div class="col">
                                        <input id="nidInputguru" type="text" class="form-control" name="id_guru" value="{{ old('id_guru') }}" autofocus required maxlength="11">
                                    </div>
                                </div>
                                <label for="role" class="form-label">Role Guru</label>
                                <select required class="form-select" id="role" name="role" aria-label="Default select example">
                                    <option selected></option>
                            
                                        <option value="guru">Guru</option>
                                        <option value="admin">Admin</option>
                                </select>
                                <div class="row mb-3">
                                    <label for="niy" class="col-form-label ">NIY</label>
                                    <div class="col">
                                        <input id="niy" type="text" class="form-control" name="niy" value="{{ old('niy') }}" autofocus required maxlength="11">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-form-label ">Jabatan</label>
                                    <div class="col">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" autofocus required maxlength="255">
                                    </div>
                                </div>
                                
                            @endif


                            @if(Auth::user()->role === 'admin' && $nama === 'siswa')
                                <div class="mb-3">
                                    <label for="id_subkelas" class="form-label">Kelas Siswa</label>
                                    <select required class="form-select" id="id_subkelas" name="id_subkelas" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($foreign as $foreignItem)
                                        

                                            <option value="{{ $foreignItem->$nfid }}">{{ $foreignItem->$nfid }} - {{ $foreignItem->$nfnama }} - Tahun Ajaran {{ $foreignItem->tahun_ajaran }} Semester {{ $foreignItem->semester }}</option>

                                        
                                        @endforeach
                                    </select>
                                </div>
                            @endif



                            @if ($nama === 'mapel' || $nama === 'materi')
                                @if(Auth::user()->role === 'guru')
                                <div class="mb-3">
                                    <label for="{{ $nfk }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $nfk)) }}</label>
                                    <select required class="form-select" id="{{ $nfk }}" name="{{ $nfk }}" aria-label="Default select example">
                                        <option selected></option>
                                        @if ($nama === 'mapel')
                                        @foreach($foreign as $foreignItem)
                                        @if($foreignItem->id_guru === Auth::user()->username)

                                            <option value="{{ $foreignItem->$nfid }}">{{ $foreignItem->$nfid }} - {{ $foreignItem->$nfnama }} - Tahun Ajaran {{ $foreignItem->tahun_ajaran }} Semester {{ $foreignItem->semester }}</option>

                                        @endif
                                        @endforeach
                                        @elseif ($nama === 'materi')
                                        @foreach($foreign as $foreignItem)
                                        @foreach($foreign2 as $foreignItem2)
                                        @if($foreignItem->id_guru === Auth::user()->username && $foreignItem2->id_subkelas === $foreignItem->id_subkelas)

                                            <option value="{{ $foreignItem->$nfid }}">{{ $foreignItem->$nfid }} - {{ $foreignItem->$nfnama }} - {{ $foreignItem2->nama_subkelas }} - {{ $foreignItem2->tahun_ajaran }} - {{ $foreignItem2->semester }}</option>

                                        @endif
                                        @endforeach
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                @if ($nama === 'materi')
                                        <label for="urutan_materi" class="col-form-label ">Urutan Materi</label>
                                            <input id="urutan_materi" type="text" class="form-control" name="urutan_materi" value="{{ old('urutan_materi') }}" autofocus required maxlength="5">
                                @endif
                                @endif
                                

                                @if(Auth::user()->role === 'admin')
                                <div class="mb-3">
                                    <label for="{{ $nfk }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $nfk)) }}</label>
                                    <select required class="form-select" id="{{ $nfk }}" name="{{ $nfk }}" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($foreign as $foreignItem)
                                        

                                            <option value="{{ $foreignItem->$nfid }}">{{ $foreignItem->$nfid }} - {{ $foreignItem->$nfnama }} - Tahun Ajaran {{ $foreignItem->tahun_ajaran }} Semester {{ $foreignItem->semester }}</option>

                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="{{ $nfk2 }}" class="form-label">ID Guru Yang Mengajar</label>
                                    <select required class="form-select" id="{{ $nfk2 }}" name="{{ $nfk2 }}" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($foreign2 as $foreignItem2)
                                        

                                            <option value="{{ $foreignItem2->id_guru }}">{{ $foreignItem2->id_guru }} - {{ $foreignItem2->nama_guru }}</option>

                                        
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            @endif

                            

                            @if(in_array($nama, ['berita', 'pengumuman', 'materi', 'mapel']))
                                <div class="row mb-3">
                                    <label for="{{ $nnama }}" class="col-form-label ">Judul {{ $nama }}</label>
                                    <div class="col">
                                        <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ old($nnama) }}" required maxlength="255">
                                    </div>
                                </div>
                                @elseif(in_array($nama, ['subkelas']))
                                <div class="mb-3">
                                    <label for="id_kelas" class="col-form-label ">ID Kelas</label>
                                    <select required class="form-select" id="id_kelas" name="id_kelas" aria-label="Default select example">
                                        <option selected></option>
                                       
                                            <option value="7">Kelas 7</option>
                                            <option value="8">Kelas 8</option>
                                            <option value="9">Kelas 9</option>

                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <label for="{{ $nnama }}" class="col-form-label ">Nama {{ $nama }}</label>
                                    <div class="col">
                                        <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ old($nnama) }}"  required maxlength="25">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tahun_ajaran" class="col-form-label ">Tahun Ajaran</label>
                                    <div class="col">
                                        <input id="tahun_ajaran" type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required maxlength="10">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="semester" class="col-form-label ">Semester</label>
                                    <div class="col">
                                        <input id="semester" type="text" class="form-control" name="semester" value="{{ old('semester') }}" required maxlength="1">
                                    </div>
                                </div>
                                @else
                                <div class="row mb-3">
                                    <label for="{{ $nnama }}" class="col-form-label ">Nama {{ $nama }}</label>
                                    <div class="col">
                                        <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ old($nnama) }}" required maxlength="255">
                                    </div>
                                </div>
                            @endif

                            

                            @if (in_array($nama, ['berita', 'pengumuman']))
                                <div class="mb-3">
                                    <label for="{{ $ntext }}" class="form-label">Teks {{ $nama }}</label>
                                    <textarea id="{{ $ntext }}" required class="form-control" name="{{ $ntext }}" rows="5">{{ old($ntext) }}</textarea>
                                </div>
                            @endif

                            @if ($nama !== 'mapel' && $nama !== 'subkelas' && $nama !== 'user' && $nama !== 'kelas')
                                {{-- <div class="mb-3">

                                    @if(in_array($nama, ['siswa', 'guru', 'galeri'])) --}}

                                    <div class="mb-3">
                                        @if (in_array($nama, ['siswa', 'guru']))
                                            <label for="{{ $nfile }}" class="form-label">Foto {{ $nama }}</label>
                                            <input class="form-control" type="file" name="{{ $nfile }}" id="fileAvatar">
                                            <p>File yang diterima : .jpg, .jpeg, .png</p><br>
                                            <p>Ukuran Foto Maks : 1Mb</p>
                                        @elseif (in_array($nama, ['galeri']))
                                            <label for="{{ $nfile }}" class="form-label">Foto {{ $nama }}</label>
                                            <input required class="form-control" type="file" name="{{ $nfile }}" id="fileGaleri">
                                            <p>File yang diterima : .jpg, .jpeg, .png</p><br>
                                            <p>Ukuran Foto Maks : 5Mb</p>
                                        @elseif($nama === 'materi')
                                            <label for="{{ $nfile }}" class="form-label">File {{ $nama }}</label>
                                            <input required class="form-control" type="file" name="{{ $nfile }}" id="fileMateri">
                                            <p>File yang diterima : .pdf, .pptx</p><br>
                                            <p>Ukuran file Maks : 10Mb</p>
                                        @else
                                            <label for="{{ $nfile }}" class="form-label">File {{ $nama }}</label>
                                            <input class="form-control" type="file" name="{{ $nfile }}" id="fileOther">
                                            <p>Ukuran file Maks : 10Mb</p>
                                        @endif
                                    </div>

                                    {{-- @endif --}}
                                </div>
                                
                            @endif

                            <div class="row mb-0 mt-5">
                                <div class="col offset">
                                    <div class="row flex-row-reverse row-cols-auto">
                                        <div class="col pr-2">
                                            

                                            {{-- @elseif($nama === 'materi')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/materi/{{ $foreign->$nfk }}'">Kembali</button> --}}
                                            @if($nama === 'materi')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/mapel/{{ Auth::user()->username }}'">Kembali</button>
                                            @elseif($nama === 'mapel')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru') }}/mapel/{{ Auth::user()->username }}'">Kembali</button>
                                            @elseif($nama === 'subkelas' || $nama === 'siswa' || $nama === 'guru')
                                                <button type="button" class="btn" style="background-color: #EBEBEB" onclick="window.location.href='{{ url('guru/edittabel/') }}/{{ $nama }}'">Kembali</button>
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

{{-- <script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        var nid = document.getElementById('nidInput');
        if (!nid) {
            if (['berita', 'pengumuman', 'galeri', 'beranda'].includes('{{ $nama }}')) {
                this.action = this.action + '1';
            }
        } else {
            this.action = this.action + nid.value;
        }
    });
</script> --}}

@endsection
