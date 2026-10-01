<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GaleriController extends Controller
{
    public function index()
    {


        $galeris = DB::table('galeris')->whereNull('deleted_at')->orderByDesc('id_galeri')->paginate(6);
        return view('galeri', compact('galeris'));
    }
}
