<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index($nama, Request $request)
    {
        if($request->user()->role === 'admin'){
            $namas = $nama . 's';
            $nfk = 'foreign_key';
            $nid = 'id_' . $nama;
            $nnama = 'nama_' . $nama;
            $ntext = 'text_' . $nama;
            $nfile = 'file_' . $nama;
            $foreign = [];
            $nfid = '';
            $nfnama = '';

            if($nama === 'mapel'){
                $nfk = 'id_kelas';
                $foreign = DB::select('select * from kelases');
                $nfid = 'id_kelas';
                $nfnama = 'nama_kelas';
            }
            else if($nama === 'materi'){
                $nfk = 'id_mapel';
                $foreign = DB::select('select * from mapels');
                $nfid = 'id_mapel';
                $nfnama = 'nama_mapel';
            }
            

            return view('upload', compact('nama', 'namas', 'nfk', 'foreign', 'nfid', 'nfnama', 'nid', 'nnama', 'ntext', 'nfile'));
        }
        
        if($request->user()->role === 'guru'){
            $namas = $nama . 's';
            $nfk = 'foreign_key';
            $nid = 'id_' . $nama;
            $nnama = 'nama_' . $nama;
            $ntext = 'text_' . $nama;
            $nfile = 'file_' . $nama;
            $foreign = [];
            $nfid = '';
            $nfnama = '';

            if($nama === 'mapel'){
                $nfk = 'id_kelas';
                $foreign = DB::select('select * from kelases');
                $nfid = 'id_kelas';
                $nfnama = 'nama_kelas';
            }
            else if($nama === 'materi'){
                $nfk = 'id_mapel';
                $foreign = DB::select('select * from mapels');
                $nfid = 'id_mapel';
                $nfnama = 'nama_mapel';
            }
            

            return view('upload', compact('nama', 'namas', 'nfk', 'foreign', 'nfid', 'nfnama', 'nid', 'nnama', 'ntext', 'nfile'));
        }
        
    }

    public function upload($nama, $id, Request $request)
    {
        $namas = $nama . 's';
        $nfk = 'foreign_key';
        $nid = 'id_' . $nama;
        $nnama = 'nama_' . $nama;
        $ntext = 'text_' . $nama;
        $nfile = 'file_' . $nama;

        if($nama === 'mapel'){
            $nfk = 'id_kelas';
        }

        else if($nama === 'materi'){
            $nfk = 'id_mapel';
        }



        $data = [
            $nnama => $request->input($nnama),
        ];

        if($nama === 'guru'){
            $data['niy'] = $request->input($nid);
            $data['jabatan'] = $request->input('jabatan');
            $data['pend_terakhir'] = $request->input('pend_terakhir');
        }
        elseif($nama === 'siswa'){
            $data['nisn'] = $request->input($nid);
        }
        else{
            $data[$nid] = $request->input($nid);
        }

        if($nama === 'berita' || $nama === 'pengumuman'){
            $data[$ntext] = $request->input($ntext);
        }

        if($nama === 'mapel' || $nama === 'materi'){
            $data[$nfk] = $request->input($nfk);
        }


        // Handle file upload
        if ($request->hasFile($nfile)) {

            // Store new file with original name
            $file = $request->file($nfile);
            $filePath = $namas . '/' . $id . '/' . $file->getClientOriginalName();
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data[$nfile] = $filePath;


        } 


        DB::table($namas)->insert($data);

        return redirect()->route('upload.index' , $nama)->with('success', 'Upload Berhasil');
    }

}

// namespace App\Http\Controllers\Upload;

// use App\Http\Controllers\Controller;
// use App\Models\Berita;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class UpBeritaController extends Controller
// {
//     public function index()
//     {
//         return view('upload/upberita');
//     }

//     public function store(Request $request): RedirectResponse
//     {
//         // Validasi input form
//         $request->validate([
//             'id_berita' => 'required|string|max:255',
//             'nama_berita' => 'required|string|max:255',
//             'text_berita' => 'required|string',
//             'file_berita' => 'required|file|mimes:jpg,jpeg,png|max:2048', // tambahkan validasi file jika diperlukan
//         ]);

//         if ($request->hasFile('file_berita')) {
//             // Simpan file dengan disk dan folder yang sesuai
//             $filePath = $request->file('file_berita')->store('berita_files', 'public'); 

//             Berita::create([
//                 'id_berita' => $request->id_berita,
//                 'nama_berita' => $request->nama_berita,
//                 'text_berita' => $request->text_berita,
//                 'file_berita' => $filePath,
//             ]);

//             return redirect(route('upberita'))->with('success', 'File Ter-upload');
//         }

//         return redirect(route('upberita'))->with('danger', 'Mohon Upload Filenya');
//     }
// }

