<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {

        $beritas = DB::table('beritas')->whereNull('deleted_at')->orderByDesc('tanggal_berita')->paginate(3);
        $galeris = DB::table('galeris')->whereNull('deleted_at')->orderByDesc('id_galeri')->paginate(3);
        return view('welcome', compact('galeris', 'beritas'));
    }
}
