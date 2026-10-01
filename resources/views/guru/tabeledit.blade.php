@extends('guru.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
    .accordion-button.collapsed::after {
        background: url("your.svg");
    }

    .accordion-button:not(.collapsed)::after {
        background: url("your.svg");
    }

    .accordion-header .edit-button {
        margin-left: auto;
        background-color: #28a745;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .accordion-header .edit-button:hover {
        background-color: #218838;
    }
</style>

<aside id="fh5co-hero">
    <div class="flexslider animate-box">
        <ul class="slides">
            <li style="background-image: url({{ asset('images/perpus-keliling.jpg') }});">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                @if ($nama === 'guru')
                                <h1 class="heading-section">Tabel {{ $nama }} dan karyawan</h1>
                                @else
                                <h1 class="heading-section">Tabel {{ $nama }}</h1>
                                @endif
                                <h2>SMP ISLAM AZ - ZAHRAH 1 PALEMBANG</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

@if(Auth::user()->role === 'admin')
<div id="fh5co-course" style="background-color: #EBEBEB">
    <div>
        @if($nama == 'guru')
        <form method="GET" action="{{ route('tabeledit', ['nama_tabel' => 'guru']) }}">
            <div class="row px-3 py-3">
                <div class="col">
                    <input id="id_guru" type="text" class="form-control" placeholder="ID Guru" name="id_guru" value="{{ request('id_guru') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="niy" type="text" class="form-control" placeholder="NIY" name="niy" value="{{ request('niy') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_guru" type="text" class="form-control" placeholder="Nama" name="nama_guru" value="{{ request('nama_guru') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="jabatan" type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="{{ request('jabatan') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="role" type="text" class="form-control" placeholder="Role" name="role" value="{{ request('role') }}" maxlength="700">
                </div>
                <div class="col">
                    <select id="status" class="form-control" name="status">
                        <option value="">Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </div>
        </form>
        <div class="row pb-3 px-3 row-cols-auto">
            <div class="col">
                <a href="{{ url('guru/beranda') }}" class="btn btn-warning">kembali</a>
            </div>
            <div class="col">
                <a href="{{ url('upload/guru') }}" class="btn btn-success">Tambah Guru</a>
            </div>
        </div>

        <div class="px-3 py-3">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID Guru</th>
                    <th>NIY</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Role</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                @foreach ($gurus as $guru)
                <tr>
                    <td>{{ $guru->id_guru }}</td>
                    <td>{{ $guru->niy }}</td>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>{{ $guru->jabatan }}</td>
                    <?php $foundRole = false; ?>
                    @foreach($users as $user)
                    @if($guru->id_guru === $user->username)
                    <td>{{ $user->role }}</td>
                    <?php $foundRole = true; ?>
                    @break
                    @endif
                    @endforeach
                    @if(!$foundRole)
                    <td>-</td>
                    @endif
                    <td>
                        <img class="img-responsive" src="{{ Storage::url($guru->file_guru) }}" style="height: 50px;" alt="avatar">
                    </td>
                    <td>{{ $guru->status }}</td>
                    <td><a href="{{ url('edit') }}/guru/{{ $guru->id_guru }}" class="btn btn-success" style="color: #EBEBEB">Edit</a></td>
                </tr>
                @endforeach
            </table>
            {{ $gurus->appends(request()->input())->links() }}
        </div>
        @elseif($nama == 'subkelas')
        <form method="GET" action="{{ route('tabeledit', ['nama_tabel' => 'subkelas']) }}">
            <div class="row px-3 py-3">
                <div class="col">
                    <input id="id_subkelas" type="text" class="form-control" placeholder="ID SubKelas" name="id_subkelas" value="{{ request('id_subkelas') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="id_kelas" type="text" class="form-control" placeholder="ID Kelas" name="id_kelas" value="{{ request('id_kelas') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_subkelas" type="text" class="form-control" placeholder="Nama SubKelas" name="nama_subkelas" value="{{ request('nama_subkelas') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="tahun_ajaran" type="text" class="form-control" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="semester" type="text" class="form-control" placeholder="Semester" name="semester" value="{{ request('semester') }}" maxlength="700">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </div>
        </form>
        <div class="row pb-3 px-3 row-cols-auto">
            <div class="col">
                <a href="{{ url('guru/beranda') }}" class="btn btn-warning">kembali</a>
            </div>
            <div class="col">
                <a href="{{ url('upload/subkelas') }}" class="btn btn-success">Tambah Kelas</a>
            </div>
        </div>

        <div class="px-3 py-3">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID SubKelas</th>
                    <th>ID Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Edit</th>
                </tr>
                @foreach ($subs as $subkelas)
                <tr>
                    <td>{{ $subkelas->id_subkelas }}</td>
                    <td>{{ $subkelas->id_kelas }}</td>
                    <td>{{ $subkelas->nama_subkelas }}</td>
                    <td>{{ $subkelas->tahun_ajaran }}</td>
                    <td>{{ $subkelas->semester }}</td>
                    <td><a href="{{ url('edit') }}/subkelas/{{ $subkelas->id_subkelas }}" class="btn btn-success" style="color: #EBEBEB">Edit</a></td>
                </tr>
                @endforeach
            </table>
            {{ $subs->appends(request()->input())->links() }}
        </div>
        @elseif($nama == 'siswa')
        <form method="GET" action="{{ route('tabeledit', ['nama_tabel' => 'siswa']) }}">
            <div class="row px-3 py-3">
                <div class="col">
                    <input id="nisn" type="text" class="form-control" placeholder="NISN" name="nisn" value="{{ request('nisn') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_siswa" type="text" class="form-control" placeholder="Nama Siswa" name="nama_siswa" value="{{ request('nama_siswa') }}" maxlength="700">
                </div>
                <div class="col">
                    <input id="nama_subkelas" type="text" class="form-control" placeholder="Nama Subkelas" name="nama_subkelas" value="{{ request('nama_subkelas') }}" maxlength="700">
                </div>
                <div class="col">
                    <select id="status" class="form-control" name="status">
                        <option value="">Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </div>
        </form>
        <div class="row pb-3 px-3 row-cols-auto">
            <div class="col">
                <a href="{{ url('guru/beranda') }}" class="btn btn-warning">kembali</a>
            </div>
            <div class="col">
                <a href="{{ url('upload/siswa') }}" class="btn btn-success">Tambah Siswa</a>
            </div>
        </div>

        <div class="px-3 py-3">
            <table class="table table-striped table-hover">
                <tr>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                @foreach($subkelases as $subkelas)
                @foreach ($siswas as $siswa)
                @if($siswa->id_subkelas == $subkelas->id_subkelas)
                <tr>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $subkelas->nama_subkelas }}</td>
                    <td>
                        <img class="img-responsive" src="{{ Storage::url($siswa->file_siswa) }}" style="height: 50px;" alt="avatar">
                    </td>
                    <td>{{ $siswa->status }}</td>
                    <td><a href="{{ url('edit') }}/siswa/{{ $siswa->nisn }}" class="btn btn-success" style="color: #EBEBEB">Edit</a></td>
                </tr>
                @endif
                @endforeach
                @endforeach
            </table>
            {{ $siswas->appends(request()->input())->links() }}
        </div>
        @endif
    </div>
</div>
@endif
@endsection
