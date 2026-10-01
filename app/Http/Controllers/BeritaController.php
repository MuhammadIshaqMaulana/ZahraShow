<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritas = DB::table('beritas')->whereNull('deleted_at')->orderByDesc('tanggal_berita')->paginate(6);



        return view('berita', compact('beritas'));
    }

    public function beritadetail($id)
    {
        // Ambil berita berdasarkan ID
        $berita = DB::table('beritas')->whereNull('deleted_at')->where('id_berita', $id)->first();
        
        // Ambil semua berita kecuali berita yang sedang dibuka
        $beritas = DB::table('beritas')->whereNull('deleted_at')->where('id_berita', '!=', $id)->orderByDesc('tanggal_berita')->paginate(2);
        
        // Tampilkan view dengan data berita
        return view('beritadetail', compact('berita', 'beritas'));
    }

    // Method untuk mengunduh file
    public function download($nama, $id)
    {

        $berita = DB::table('beritas')->whereNull('deleted_at')->where('id_berita', $id)->first();
        
        if ($berita && Storage::disk('public')->exists($berita->file_berita)) {
            // Unduh file
            return Storage::disk('public')->download($berita->file_berita);
        } else {
            // File tidak ditemukan
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }




    }


}
    
