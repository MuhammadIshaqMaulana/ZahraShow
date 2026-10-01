<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class galeriController extends Controller
{
    public function index()
    {

        $galeris = DB::table('galeris')->whereNull('deleted_at')->orderByDesc('id_galeri')->paginate(6);

        return view('guru.galeri', compact('galeris'));
    }
}
