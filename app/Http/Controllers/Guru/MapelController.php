<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index($id, Request $request)
    {
        if (Auth::user()->role === 'admin') {
            // Retrieve filters from request
            $id_mapel = $request->input('id_mapel');
            $nama_subkelas = $request->input('nama_subkelas');
            $nama_guru = $request->input('nama_guru');
            $nama_mapel = $request->input('nama_mapel');
            $tahun_ajaran = $request->input('tahun_ajaran');
            $semester = $request->input('semester');

            // Build query with filters
            $query = DB::table('mapels')
                ->join('subkelases', 'mapels.id_subkelas', '=', 'subkelases.id_subkelas')
                ->join('gurus', 'mapels.id_guru', '=', 'gurus.id_guru')
                ->select('mapels.*', 'subkelases.nama_subkelas', 'subkelases.tahun_ajaran', 'subkelases.semester', 'gurus.nama_guru')
                ->whereNull('mapels.deleted_at')    // Ensure soft-deleted mapels are excluded
                ->whereNull('subkelases.deleted_at') // Ensure soft-deleted subkelases are excluded
                ->whereNull('gurus.deleted_at');     // Ensure soft-deleted gurus are excluded

            if ($id_mapel) {
                $query->where('mapels.id_mapel', 'like', '%' . $id_mapel . '%');
            }
            if ($nama_subkelas) {
                $query->where('subkelases.nama_subkelas', 'like', '%' . $nama_subkelas . '%');
            }
            if ($nama_guru) {
                $query->where('gurus.nama_guru', 'like', '%' . $nama_guru . '%');
            }
            if ($nama_mapel) {
                $query->where('mapels.nama_mapel', 'like', '%' . $nama_mapel . '%');
            }
            if ($tahun_ajaran) {
                $query->where('subkelases.tahun_ajaran', 'like', '%' . $tahun_ajaran . '%');
            }
            if ($semester) {
                $query->where('subkelases.semester', 'like', '%' . $semester . '%');
            }

            // Paginate the results
            $mapels = $query->paginate(10);

            return view('guru.mapel', compact('mapels', 'id'));
        }

        if (Auth::user()->role === 'guru') {
            $mapels = DB::table('mapels')
                ->where('id_guru', $id)
                ->whereNull('deleted_at') // Ensure soft-deleted mapels are excluded
                ->get();
            $subs = DB::table('subkelases')
                ->whereNull('deleted_at') // Ensure soft-deleted subkelases are excluded
                ->get();
            $gurus = DB::table('gurus')
                ->whereNull('deleted_at') // Ensure soft-deleted gurus are excluded
                ->get();

            return view('guru.mapel', compact('mapels', 'subs', 'id', 'gurus'));
        }
    }
}
