<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = DB::table('pengumumans')->whereNull('deleted_at')->orderByDesc('tanggal_pengumuman')->paginate(6);
        return view('guru.pengumuman', compact('pengumumans'));
    }




}
