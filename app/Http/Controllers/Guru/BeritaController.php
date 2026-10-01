<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;	
use App\Models\Berita;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = DB::table('beritas')->whereNull('deleted_at')->orderByDesc('tanggal_berita')->paginate(6);
        return view('guru.berita', compact('beritas'));
        
    }

}
