@extends('guru.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    function confirmDelete(nama, action) {
        let message = (nama === 'guru' || nama === 'siswa') 
            ? `Apakah anda yakin ingin ${action} akun?` 
            : "Apakah anda yakin ingin menghapus?";

        if (confirm(message)) {
            // Create hidden input field for 'role' if action is 'Aktifkan'
            if (action.startsWith('Aktifkan')) {
                
                let form = document.getElementById('delete-form');
                let roleInput = document.createElement('input');
                roleInput.type = 'hidden';
                roleInput.name = 'role';
                roleInput.value = action === 'Aktifkan Sbg Admin' ? 'admin' : 'guru';
                form.appendChild(roleInput);
            }

            document.getElementById('delete-form').submit();
            return true;
        }
        return false;
    }



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
                            @if($nama === 'guru')
                                <h4 style="font-weight: bolder;">{{ $nama }} - {{ $data->id_guru }}</h4>
                            @else
                                <h4 style="font-weight: bolder;">{{ $nama }} - {{ $data->$nid }}</h4>
                            @endif
                        </div>
                        @if($nama === 'guru')
                            <form method="POST" id="uploadForm" action="{{ url('update') }}/{{ $nama }}/{{ $data->id_guru }}" enctype="multipart/form-data">
                        @else
                            <form method="POST" id="uploadForm" action="{{ url('update') }}/{{ $nama }}/{{ $data->$nid }}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            @method('PUT')

                            @if($nama === 'guru')
                                <div class="row mb-3">
                                    <label for="niy" class="col-form-label">NIY</label>
                                    <div class="col">
                                        <input id="niy" type="text" class="form-control" name="niy" value="{{ $data->niy }}" required maxlength="11">
                                    </div>
                                </div>
                            @endif

                            @if ($nama === 'siswa')
                                {{-- <div class="row mb-3">
                                    <label for="id_subkelas" class="col-form-label">ID Subkelas</label>
                                    <div class="col">
                                        <input id="id_subkelas" type="text" class="form-control" name="id_subkelas" value="{{ $data->id_subkelas }}" disabled>
                                    </div>
                                </div> --}}
            
                            <div class="mb-3">
                                <label for="id_subkelas" class="form-label">Kelas Siswa</label>
                                <select required class="form-select" id="id_subkelas" name="id_subkelas" aria-label="Default select example">
                                    <option selected></option>
                                    @foreach($foreign as $foreignI)
                                    

                                        <option value="{{ $foreignI->id_subkelas }}">{{ $foreignI->id_subkelas }} - {{ $foreignI->nama_subkelas }} - Tahun Ajaran {{ $foreignI->tahun_ajaran }} Semester {{ $foreignI->semester }}</option>

                                    
                                    @endforeach
                                </select>
                            </div>
                            
                            @elseif ($nama === 'subkelas')
                            <div class="mb-3">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select required class="form-select" id="id_kelas" name="id_kelas" aria-label="Default select example">
                                    <option selected></option>
                                    @foreach($foreign as $foreignItem)
                                    

                                        <option value="{{ $foreignItem->id_kelas }}">{{ $foreignItem->nama_kelas }}</option>

                                    
                                    @endforeach
                                </select>
                            </div>
                            @endif


                                @if($nama === 'subkelas')
                                    <div class="row mb-3">
                                    <label for="tahun_ajaran" class="col-form-label ">Tahun Ajaran</label>
                                    <div class="col">
                                        <input id="tahun_ajaran" type="text" class="form-control" name="tahun_ajaran" value="{{ $data->tahun_ajaran }}" required maxlength="10">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="semester" class="col-form-label ">Semester</label>
                                    <div class="col">
                                        <input id="semester" type="text" class="form-control" name="semester" value="{{ $data->semester }}" required maxlength="1">
                                    </div>
                                </div>
                            
                                @endif


                            @if ($nama === 'guru' && $isUserExists)
                            <label for="role" class="form-label">Role Guru</label>
                                <select required class="form-select" id="role" name="role" aria-label="Default select example">
                                    <option selected></option>
                            
                                        <option value="guru">Guru</option>
                                        <option value="admin">Admin</option>
                                </select>
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-form-label">Jabatan</label>
                                    <div class="col">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}" autofocus required maxlength="25">
                                    </div>
                                </div>
                                
                            @endif


                            @if ($nama === 'mapel')
                                <div class="mb-3">
                                    <label for="id_guru" class="form-label">Guru</label>
                                    <select required class="form-select" id="id_guru" name="id_guru" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($foreign2 as $foreignItem2)
                                        

                                            <option value="{{ $foreignItem2->id_guru }}">{{ $foreignItem2->id_guru }} - {{ $foreignItem2->nama_guru }}</option>

                                        
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($nama === 'materi')
                                <div class="row mb-3">
                                    <label for="urutan_materi" class="col-form-label">Urutan Materi</label>
                                    <div class="col">
                                        <input id="urutan_materi" type="text" class="form-control" name="urutan_materi" value="{{ $data->urutan_materi }}" required maxlength="5">
                                    </div>
                                </div>
                            @endif



                            @if(in_array($nama, ['berita', 'pengumuman', 'galeri', 'materi', 'mapel']))
                            <div class="row mb-3">
                                <label for="{{ $nnama }}" class="col-form-label">Judul {{ $nama }}</label>
                                <div class="col">
                                    <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ $data->$nnama }}" required autofocus maxlength="100">
                                </div>
                            </div>
                            @else
                                <div class="row mb-3">
                                    <label for="{{ $nnama }}" class="col-form-label">Nama {{ $nama }}</label>
                                    <div class="col">
                                        <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ $data->$nnama }}" required autofocus maxlength="100">
                                    </div>
                                </div>
                            @endif




                            @if ($nama === 'berita' || $nama === 'pengumuman')
                                <div class="row mb-3">
                                    <label for="{{ $ntext }}" class="col-form-label">Teks {{ $nama }}</label>
                                    <div class="col">
                                        <textarea id="{{ $ntext }}" class="form-control" name="{{ $ntext }}" rows="3">{{ $data->$ntext }}</textarea>
                                    </div>
                                </div>
                            @endif

                            {{-- @if($nama !== 'kelas' && $nama !== 'subkelas' && $nama !== 'user' && $nama !== 'mapel' && $nama !== 'subkelas')
                            @if ($data->$nfile !== null)
                                <div class="row mb-3">
                                    <div class="col">
                                        <input id="deletefile" type="checkbox" name="deletefile" value="1">
                                        <label for="deletefile">Hapus file</label>
                                    </div>
                                </div>
                            @endif
                            @endif --}}


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




                            
{{-- 
                            <div class="row mb-3">
                                <label for="{{ $nfile }}" class="col-form-label">File {{ $nama }}</label>
                                <div class="col">
                                    <input id="{{ $nfile }}" type="file" class="form-control" name="{{ $nfile }}" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.ppt,.pptx">
                                </div>
                            </div> --}}




                        <div class="row mb-0 mt-5">
                            <div class="col offset">
                                <div class="row row-cols-auto">


                                    <div class="col pr-1">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    </div>


                                    @if($nama === 'guru')
                                        @if ($isUserExists)
                                            <form id="delete-form" method="POST" action="{{ url('delete') }}/{{ $nama }}/{{ $data->id_guru }}" enctype="multipart/form-data">
                                                @csrf
                                        @method('DELETE')
                                        @else
                                            <form id="delete-form" method="POST" action="{{ url('active') }}/{{ $nama }}/{{ $data->id_guru }}/{{ $data->nama_guru }}">
                                                @csrf
                                                    
                                        @endif
                                    @elseif($nama === 'siswa')
                                        @if ($isUserExists)
                                            <form id="delete-form" method="POST" action="{{ url('delete') }}/{{ $nama }}/{{ $data->nisn }}" enctype="multipart/form-data">
                                                @csrf
                                        @method('DELETE')
                                        @else
                                            <form id="delete-form" method="POST" action="{{ url('active') }}/{{ $nama }}/{{ $data->nisn }}/{{ $data->nama_siswa }}">
                                                @csrf
                                        @endif
                                    @else

                                        <form id="delete-form" method="POST" action="{{ url('delete') }}/{{ $nama }}/{{ $data->$nid }}">
                                            @csrf
                                        @method('DELETE')
                                    @endif
                                        

                                    {{-- <div class="col pr-2">
                                        @if($nama === 'siswa' || $nama === 'guru')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}')">Nonaktifkan</button>
                                        @else
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}')">Hapus</button>
                                        @endif
                                    </div>
                                    </form> --}}

                                    <div class="col pr-1 ">
                                        @if($nama === 'siswa' || $nama === 'guru')
                                        @if ($isUserExists)
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}', 'Nonaktifkan')">Nonaktifkan</button>
                                        @else
                                            @if($nama === 'siswa')
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}', 'Aktifkan')">Aktifkan</button>
                                            @elseif($nama === 'guru')
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}', 'Aktifkan Sbg Admin')">Aktifkan Sbg Admin</button>
                                                <div class="col pr-1 ">
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}', 'Aktifkan Sbg Guru')">Aktifkan Sbg Guru</button>
                                                </div>
                                            @endif
                                        @endif

                                        @else
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $nama }}', ' ')">Hapus</button>
                                        @endif
                                    </div>
                                    </form>


                                    <div class="col pr-2">
                                        @if($nama === 'materi')
                                        <a href="{{ url('guru') }}/{{ $nama }}/{{ $data->id_mapel }}" class="btn" style="background-color: #EBEBEB">Kembali</a>
                                        @elseif($nama === 'mapel')
                                        <a href="{{ url('guru') }}/{{ $nama }}/{{ Auth::user()->username }}" class="btn" style="background-color: #EBEBEB">Kembali</a>
                                      
                                        @elseif($nama === 'siswa' || $nama === 'subkelas' || $nama === 'guru')
                                        <a href="{{ url('guru') }}/edittabel/{{ $nama }}" class="btn" style="background-color: #EBEBEB">Kembali</a>
                                        @else
                                        <a href="{{ url('guru') }}/{{ $nama }}" class="btn" style="background-color: #EBEBEB">Kembali</a>
                                        @endif
                                    </div>
                                        




                                    
                                </div>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
