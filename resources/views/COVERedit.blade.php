@extends('guru.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
function confirmDelete() {
    if (confirm("Apakah anda yakin ingin menghapus?")) {
        document.getElementById('delete-form').submit();
        return true;
    }
    return false;
}
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
                                <h4 style="font-weight: bolder;">{{ $nama }} - {{ $data->niy }}</h4>
                            @else
                                <h4 style="font-weight: bolder;">{{ $nama }} - {{ $data->$nid }}</h4>
                            @endif
                        </div>
                        @if($nama === 'guru')
                            <form method="POST" action="{{ url('update') }}/{{ $nama }}/{{ $data->niy }}" enctype="multipart/form-data">
                        @else
                            <form method="POST" action="{{ url('update') }}/{{ $nama }}/{{ $data->$nid }}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            @method('PUT')

                            @if($nama === 'guru')
                                <div class="row mb-3">
                                    <label for="niy" class="col-form-label">NIY</label>
                                    <div class="col">
                                        <input id="niy" type="text" class="form-control" name="niy" value="{{ $data->niy }}" disabled readonly>
                                    </div>
                                </div>
                            @endif

                            @if ($nama === 'guru')
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-form-label">Jabatan</label>
                                    <div class="col">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}" autofocus maxlength="25">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pend_terakhir" class="col-form-label">Pendidikan Terakhir</label>
                                    <div class="col">
                                        <input id="pend_terakhir" type="text" class="form-control" name="pend_terakhir" value="{{ $data->pend_terakhir }}" autofocus maxlength="50">
                                    </div>
                                </div>
                            @endif

                            @if ($nama === 'mapel' || $nama === 'materi')
                                <div class="row mb-3">
                                    <label for="{{ $nfk }}" class="col-form-label">{{ $nfk }}</label>
                                    <div class="col">
                                        <input id="{{ $nfk }}" type="text" class="form-control" name="{{ $nfk }}" value="{{ $data->$nfk }}" disabled readonly>
                                    </div>
                                </div>
                            @endif



                            @if(in_array($nama, ['berita', 'pengumuman', 'galeri', 'materi', 'mapel']))
                            <div class="row mb-3">
                                <label for="{{ $nnama }}" class="col-form-label">Judul {{ $nama }}</label>
                                <div class="col">
                                    <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ $data->$nnama }}" autofocus maxlength="100">
                                </div>
                            </div>
                            @else
                                <div class="row mb-3">
                                    <label for="{{ $nnama }}" class="col-form-label">Nama {{ $nama }}</label>
                                    <div class="col">
                                        <input id="{{ $nnama }}" type="text" class="form-control" name="{{ $nnama }}" value="{{ $data->$nnama }}" autofocus maxlength="100">
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

                            @if ($data->$nfile !== null)
                                <div class="row mb-3">
                                    <div class="col">
                                        <input id="deletefile" type="checkbox" name="deletefile" value="1">
                                        <label for="deletefile">Hapus file</label>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="{{ $nfile }}" class="col-form-label">File {{ $nama }}</label>
                                <div class="col">
                                    <input id="{{ $nfile }}" type="file" class="form-control" name="{{ $nfile }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <p>Maksimal Ukuran File : 10mb</p>
                            </div>
{{-- 
                            <div class="row mb-3">
                                <label for="{{ $nfile }}" class="col-form-label">File {{ $nama }}</label>
                                <div class="col">
                                    <input id="{{ $nfile }}" type="file" class="form-control" name="{{ $nfile }}" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.ppt,.pptx">
                                </div>
                            </div> --}}




                            <div class="row mb-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>

                        <!-- Form for Deleting the Record -->
                        @if($nama === 'guru')
                            <form id="delete-form" method="POST" action="{{ url('delete') }}/{{ $nama }}/{{ $data->niy }}">
                        @else
                            <form id="delete-form" method="POST" action="{{ url('delete') }}/{{ $nama }}/{{ $data->$nid }}">
                        @endif
                            @csrf
                            @method('DELETE')

                            <div class="row mb-3">
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Hapus</button>
                                </div>
                            </div>
                        </form>
                        @if($nama === 'mapel' || $nama === 'materi')
                        <a href="{{ url('guru') }}/{{ $nama }}/{{ $data->$nid }}" class="btn btn-dark">Kembali</a>
                        @else
                        <a href="{{ url('guru') }}/{{ $nama }}" class="btn btn-dark">Kembali</a>
                        @endif


  




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
