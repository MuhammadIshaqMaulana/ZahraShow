<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = DB::table('pengumumans')->whereNull('deleted_at')->orderByDesc('tanggal_pengumuman')->paginate(6);
        return view('pengumuman', compact('pengumumans'));
    }



    public function pengumumandetail($id)
    {
        // Ambil pengumuman berdasarkan ID
        $pengumuman = DB::table('pengumumans')->whereNull('deleted_at')->where('id_pengumuman', $id)->first();
        
        // Ambil semua pengumuman kecuali pengumuman yang sedang dibuka
        $pengumumans = DB::table('pengumumans')->whereNull('deleted_at')->where('id_pengumuman', '!=', $id)->orderByDesc('tanggal_pengumuman')->paginate(2);
        
        // Tampilkan view dengan data pengumuman
        return view('pengumumandetail', compact('pengumuman', 'pengumumans'));
    }

    // Method untuk mengunduh file
    public function download($nama, $id)
    {
        // // Pastikan file ada di storage
        // if (Storage::disk('public')->exists($file)) {
        //     // Unduh file
        //     return Storage::disk('public')->download($file);
        // } else {
        //     // File tidak ditemukan
        //     return redirect()->back()->with('error', 'File tidak ditemukan.');
        // }
        $pengumuman = DB::table('pengumumans')->whereNull('deleted_at')->where('id_pengumuman', $id)->first();
        
        if ($pengumuman && Storage::disk('public')->exists($pengumuman->file_pengumuman)) {
            // Unduh file
            return Storage::disk('public')->download($pengumuman->file_pengumuman);
        } else {
            // File tidak ditemukan
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }



    }

}

