<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index($idmapel)
    {

        $materis = DB::table('materis')->whereNull('deleted_at')->orderBy('urutan_materi')->where('id_mapel', $idmapel)->get();
        $mapels = DB::table('mapels')->where('id_mapel', $idmapel)->whereNull('deleted_at')->first();
        $subs = DB::table('subkelases')->whereNull('deleted_at')->get();

        return view('guru.materi', compact('materis', 'mapels', 'subs', 'idmapel'));
    }
}
