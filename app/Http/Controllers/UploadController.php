<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index($nama, Request $request)
    {
        if ($request->user()->role === 'admin' || $request->user()->role === 'guru') {
            $namas = $nama . 's';
            $nfk = 'foreign_key';
            $nfk2 = '2nd_foreign_key';
            $nid = 'id_' . $nama;
            $nnama = 'nama_' . $nama;
            $ntext = 'text_' . $nama;
            $nfile = 'file_' . $nama;
            $foreign = [];
            $foreign2 = [];
            $nfid = '';
            $nfnama = '';

            if ($nama === 'subkelas' || $nama === 'kelas') {
                $namas = $nama . 'es';
            } 

            if ($nama === 'mapel') {
                $nfk = 'id_subkelas';
                $nfk2 = 'id_guru';

                $foreign = DB::table('subkelases')->whereNull('deleted_at')->get();
                $foreign2 = DB::table('gurus')->whereNull('deleted_at')->get();
                $nfid = 'id_subkelas';
                $nfnama = 'nama_subkelas';
            } else if ($nama === 'materi') {
                $nfk = 'id_mapel';
                $foreign = DB::table('mapels')->whereNull('deleted_at')->get();
                $foreign2 = DB::table('subkelases')->whereNull('deleted_at')->get();
                $nfid = 'id_mapel';
                $nfnama = 'nama_mapel';
            }
            else if ($nama === 'siswa') {
                $nfk = 'id_subkelas';
                $foreign = DB::table('subkelases')->whereNull('deleted_at')->get();
                $nfid = 'id_subkelas';
                $nfnama = 'nama_subkelas';
            }

            return view('upload', compact('nama', 'namas', 'nfk', 'nfk2', 'foreign', 'foreign2', 'nfid', 'nfnama', 'nid', 'nnama', 'ntext', 'nfile'));
        }
    }

    public function upload($nama, Request $request)
{
    $namas = $nama . 's';
    $nid = 'id_' . $nama;
    $nfk = 'foreign_key';
    $nfk2 = '2nd_foreign_key';
    $nnama = 'nama_' . $nama;
    $ntext = 'text_' . $nama;
    $nfile = 'file_' . $nama;

    if ($nama === 'subkelas' || $nama === 'kelas') {
        $namas = $nama . 'es';
    } 

    $data = [
        $nnama => $request->input($nnama),
    ];

    if (!in_array($namas, ['mapels', 'users', 'kelases', 'subkelases'])) {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
    }

    if ($nama === 'mapel') {
        $nfk = 'id_subkelas';
        $nfk2 = 'id_guru';
    } else if ($nama === 'materi') {
        $nfk = 'id_mapel';
    }

    if ($nama === 'guru') {
        $data['id_guru'] = $request->input($nid);
        $data['niy'] = $request->input('niy');
        $data['jabatan'] = $request->input('jabatan');
   
    } elseif ($nama === 'siswa') {
        $data['nisn'] = $request->input($nid);
        $data['id_subkelas'] = $request->input('id_subkelas');
    }

    if ($nama === 'subkelas') {
        $data['id_kelas'] = $request->input('id_kelas');
        $data['tahun_ajaran'] = $request->input('tahun_ajaran');
        $data['semester'] = $request->input('semester');
    }

    if ($nama === 'berita') {
        $data[$ntext] = $request->input($ntext);
        $data['tanggal_berita'] = Carbon::now();
    }

    if ($nama === 'pengumuman') {
        $data[$ntext] = $request->input($ntext);
        $data['tanggal_pengumuman'] = Carbon::now();
    }

    if ($nama === 'mapel') {
        $data[$nfk] = $request->input($nfk);
        $data[$nfk2] = $request->input($nfk2);
        
        $data['id_guru'] = $request->input('id_guru');
    } else if ($nama === 'materi') {
        $data[$nfk] = $request->input($nfk);
        $data['urutan_materi'] = $request->input('urutan_materi');
    }

    // Insert data tanpa file path untuk mendapatkan auto increment ID
    if (!in_array($nama, ['guru', 'kelas', 'siswa'])) {
        $recordId = DB::table($namas)->insertGetId($data);

        // Handle file upload jika ada
        if ($request->hasFile($nfile)) {
            $file = $request->file($nfile);
            $originalName = $file->getClientOriginalName();
            $sanitizedFileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $filePath = $namas . '/' . $recordId . '/' . $sanitizedFileName;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            
            // Update record dengan file path
            DB::table($namas)->where($nid, $recordId)->update([$nfile => $filePath]);
        }
    } else {
        // Handle file upload jika ada
        if ($request->hasFile($nfile)) {
            $file = $request->file($nfile);
            $originalName = $file->getClientOriginalName();
            $sanitizedFileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $filePath = $namas . '/' . $request->input($nid) . '/' . $sanitizedFileName;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data[$nfile] = $filePath;
        }

        DB::table($namas)->insert($data);
    }


    if($nama === 'guru'){
        DB::table('users')->insert([
        'name' => $request->input($nnama),
        'username' => $request->input('id_guru'),
        'role' => $request->input('role'),

        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
        'password' => Hash::make($request->input('id_guru')),
    ]);
    }
    elseif($nama === 'siswa'){
        DB::table('users')->insert([
        'name' => $request->input($nnama),
        'username' => $request->input($nid),
        'role' => 'siswa',

        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
        'password' => Hash::make($request->input($nid)),
    ]);
    }
    

    return redirect()->route('upload.index', $nama)->with('success', 'Upload Berhasil');
}

}
