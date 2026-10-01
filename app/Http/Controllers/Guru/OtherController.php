<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherController extends Controller
{
    public function tabeledit($nama, Request $request)
{
    if (Auth::user()->role === 'admin') {
        $roles = DB::select('select distinct role from users');
        $kelases = DB::select('select * from kelases');
        $subkelases = DB::select('select * from subkelases');
        $users = DB::select('select * from users');
        $nama_subkelas = DB::select('select nama_subkelas from subkelases');


        if ($nama == 'guru') {
            $gurusQuery = DB::table('gurus')->whereNull('deleted_at');

            if ($request->has('id_guru')) {
                $gurusQuery->where('id_guru', 'LIKE', '%' . $request->id_guru . '%');
            }
            if ($request->has('niy')) {
                $gurusQuery->where('niy', 'LIKE', '%' . $request->niy . '%');
            }
            if ($request->has('nama_guru')) {
                $gurusQuery->where('nama_guru', 'LIKE', '%' . $request->nama_guru . '%');
            }
            if ($request->has('jabatan')) {
                $gurusQuery->where('jabatan', 'LIKE', '%' . $request->jabatan . '%');
            }

            // Filter by status
            if ($request->has('status')) {
                if ($request->status == 'aktif') {
                    $gurusQuery->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw('users.username = gurus.id_guru');
                    });
                } elseif ($request->status == 'nonaktif') {
                    $gurusQuery->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw('users.username = gurus.id_guru');
                    });
                }
            }

            $gurus = $gurusQuery->paginate(10);

            // Determine status and role
            foreach ($gurus as $guru) {
                $user = DB::table('users')->where('username', $guru->id_guru)->first();
                if ($user) {
                    $guru->status = 'aktif';
                    $guru->role = $user->role;
                } else {
                    $guru->status = 'nonaktif';
                    $guru->role = '-';
                }
            }

            return view('guru.tabeledit', compact('kelases', 'nama', 'subkelases', 'nama_subkelas', 'gurus', 'users', 'roles'));
        }

        if ($nama == 'subkelas') {
            $subsQuery = DB::table('subkelases')->whereNull('deleted_at');

            if ($request->has('id_subkelas')) {
                $subsQuery->where('id_subkelas', 'LIKE', '%' . $request->id_subkelas . '%');
            }
            if ($request->has('id_kelas')) {
                $subsQuery->where('id_kelas', 'LIKE', '%' . $request->id_kelas . '%');
            }
            if ($request->has('nama_subkelas')) {
                $subsQuery->where('nama_subkelas', 'LIKE', '%' . $request->nama_subkelas . '%');
            }
            if ($request->has('tahun_ajaran')) {
                $subsQuery->where('tahun_ajaran', 'LIKE', '%' . $request->tahun_ajaran . '%');
            }
            if ($request->has('semester')) {
                $subsQuery->where('semester', 'LIKE', '%' . $request->semester . '%');
            }

            $subs = $subsQuery->paginate(10);

            return view('guru.tabeledit', compact('kelases', 'nama', 'subkelases', 'nama_subkelas', 'subs'));
        }

        if ($nama == 'siswa') {
            $siswasQuery = DB::table('siswas')->whereNull('deleted_at');

            if ($request->has('nisn')) {
                $siswasQuery->where('nisn', 'LIKE', '%' . $request->nisn . '%');
            }
            if ($request->has('nama_siswa')) {
                $siswasQuery->where('nama_siswa', 'LIKE', '%' . $request->nama_siswa . '%');
            }
            if ($request->has('nama_subkelas')) {
                $siswasQuery->whereExists(function ($query) use ($request) {
                    $query->select(DB::raw(1))
                        ->from('subkelases')
                        ->whereRaw('subkelases.id_subkelas = siswas.id_subkelas')
                        ->where('subkelases.nama_subkelas', 'LIKE', '%' . $request->nama_subkelas . '%');
                });
            }

            // Filter by status
            if ($request->has('status')) {
                if ($request->status == 'aktif') {
                    $siswasQuery->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw('users.username = siswas.nisn');
                    });
                } elseif ($request->status == 'nonaktif') {
                    $siswasQuery->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw('users.username = siswas.nisn');
                    });
                }
            }

            $siswas = $siswasQuery->paginate(10);

            // Determine status
            foreach ($siswas as $siswa) {
                $siswa->status = DB::table('users')->where('username', $siswa->nisn)->exists() ? 'aktif' : 'nonaktif';
            }

            return view('guru.tabeledit', compact('kelases', 'nama', 'subkelases', 'nama_subkelas', 'siswas'));
        }
    }
}

}
