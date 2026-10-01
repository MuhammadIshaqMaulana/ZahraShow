<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index($idmapel)
    {
        $materis = DB::table('materis')->whereNull('deleted_at')->orderBy('urutan_materi')->where('id_mapel', $idmapel)->get();
        $mapels = DB::table('mapels')->whereNull('deleted_at')->where('id_mapel', $idmapel)->first();
        $subs = DB::table('subkelases')->whereNull('deleted_at')->get();

        return view('materi', compact('materis', 'mapels', 'subs', 'idmapel'));
    }

    // Method untuk mengunduh file materi
    public function download($id)
    {
        // Ambil materi berdasarkan ID
        $materi = DB::table('materis')->whereNull('deleted_at')->where('id_materi', $id)->first();
        
        if ($materi && Storage::disk('public')->exists($materi->file_materi)) {
            // Unduh file
            return Storage::disk('public')->download($materi->file_materi);
        } else {
            // File tidak ditemukan
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
