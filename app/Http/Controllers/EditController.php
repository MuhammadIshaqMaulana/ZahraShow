<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\Subkelas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    public function index($nama, $id)
    {
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

        if ($nama === 'mapel') {
            $nfk = 'id_subkelas';
            $nfk2 = 'id_guru';


            $nfid = 'id_subkelas';
            $nfnama = 'nama_subkelas';
            $foreign2 = DB::table('gurus')->whereNull('deleted_at')->get();
        } 
        else if ($nama === 'materi') {
            $nfk = 'id_mapel';
        }
        else if ($nama === 'siswa') {
            $nid = 'nisn';
            $nfk = 'id_subkelas';
        }

        if ($nama === 'subkelas' || $nama === 'kelas') {
            $namas = $nama . 'es';
        } 
        if ($nama === 'subkelas') {
            $nfk = 'id_kelas';
            $foreign = DB::table('kelases')->whereNull('deleted_at')->get();
        } 

        if ($nama === 'guru') {
            $data = DB::table($namas)->where('id_guru', $id)->first();
        } 
        elseif ($nama === 'siswa') {
            $data = DB::table($namas)->where('nisn', $id)->first();
        } 


        else {
            $data = DB::table($namas)->where($nid, $id)->first();
        }
        

        if ($nama === 'guru') {
            $data = DB::table($namas)->where('id_guru', $id)->first();
            $isUserExists = DB::table('users')->where('username', $data->id_guru)->exists();
        } 
        elseif ($nama === 'siswa') {
            $data = DB::table($namas)->where('nisn', $id)->first();
            $foreign = DB::table('subkelases')->whereNull('deleted_at')->get();
            $isUserExists = DB::table('users')->where('username', $data->nisn)->exists();
        } 
        else {
            $data = DB::table($namas)->where($nid, $id)->first();
            $isUserExists = false;
        }

        return view('edit', compact('data', 'nama', 'foreign', 'foreign2', 'id', 'namas', 'nfk', 'nfk2', 'nid', 'nnama', 'ntext', 'nfile', 'isUserExists'));
    }

    public function update($nama, $id, Request $request)
{
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

    if ($nama === 'mapel') {
        $nfk = 'id_subkelas';
        $nfk2 = 'id_guru';
    } 
    else if ($nama === 'materi') {
        $nfk = 'id_mapel';
    }
    else if ($nama === 'siswa') {
        $nid = 'nisn';
        $nfk = 'id_subkelas';
    }

    if ($nama === 'subkelas' || $nama === 'kelas') {
        $namas = $nama . 'es';
    } 

    $data = [
        $nnama => $request->input($nnama),
    ];

    if ($nama === 'guru') {
        $data['niy'] = $request->input('niy');
        $data['jabatan'] = $request->input('jabatan');
        $data['updated_at'] = Carbon::now();
    }
    if ($nama === 'subkelas') {
        $data['id_kelas'] = $request->input('id_kelas');
        $data['updated_at'] = Carbon::now();
    }
    if ($nama === 'siswa') {
        $data['id_subkelas'] = $request->input('id_subkelas');
        $data['updated_at'] = Carbon::now();
    }

    // if ($nama === 'mapel' || $nama === 'materi') {
    //     // $data[$nfk] = $request->input($nfk);
    // }
    if ($nama === 'mapel') {
        $data['id_guru'] = $request->input('id_guru');
        $data['updated_at'] = Carbon::now();
    }
    if ($nama === 'materi') {
        $data['urutan_materi'] = $request->input('urutan_materi');
        $data['updated_at'] = Carbon::now();
    }

    if ($nama === 'berita' || $nama === 'pengumuman') {
        $data[$ntext] = $request->input($ntext);
        $data['updated_at'] = Carbon::now();
    }

    if ($request->hasFile($nfile)) {
        if ($nama === 'guru') {
            $existingFile = DB::table($namas)->where('id_guru', $id)->value($nfile);
        } else {
            $existingFile = DB::table($namas)->where($nid, $id)->value($nfile);
        }

        if ($existingFile && Storage::exists('public/'.$existingFile)) {
            Storage::delete('public/'.$existingFile);
        }

        $file = $request->file($nfile);
        $originalName = $file->getClientOriginalName();
        $sanitizedFileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
        $filePath = $namas . '/' . $id . '/' . $sanitizedFileName;
        Storage::disk('public')->put($filePath, file_get_contents($file));
        $data[$nfile] = $filePath;
    } elseif ($request->has('deletefile')) {
        if ($nama === 'guru') {
            $existingFile = DB::table($namas)->where('id_guru', $id)->value($nfile);
        } else {
            $existingFile = DB::table($namas)->where($nid, $id)->value($nfile);
        }

        if ($existingFile && Storage::exists('public/'.$existingFile)) {
            Storage::delete('public/'.$existingFile);
        }
        $data[$nfile] = null;
    }

    if ($nama === 'guru') {
        DB::table($namas)->where('id_guru', $id)->update($data);
        DB::table('users')->where('username', $id)->update([
            'name' => $request->input($nnama),
            'role' => $request->input('role'),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    } 

    elseif ($nama === 'siswa') {
        DB::table($namas)->where($nid, $id)->update($data);
        DB::table('users')->where('username', $id)->update([
            'name' => $request->input($nnama),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    } 

    else {
        DB::table($namas)->where($nid, $id)->update($data);
    }


    // if($nama === 'guru'){
    //     DB::table('users')->update([
    //     'role' => $request->input('role'),

    //     'created_at' => Carbon::now(),
    //     'updated_at' => Carbon::now(),
    // ]);
    // }

    return redirect()->route('edit.index', [$nama, $id])->with('success', 'Perubahan Berhasil');
}


    public function delete($nama, $id)
    {
        $namas = $nama . 's';
        $nid = 'id_' . $nama;
        $nfile = 'file_' . $nama;

        if ($nama === 'subkelas' || $nama === 'kelas') {
            $namas = $nama . 'es';
        } 

        //---------------------*Delete Files*------------------------------------
        
        // if($nama === 'mapel' || $nama === 'kelas' || $nama === 'subkelas' || $nama === 'user' ){

        // }

        
        // else {
        //     $existingFile = DB::table($namas)->where($nid, $id)->value($nfile);
        // }

        // if($nama === 'mapel' || $nama === 'kelas' || $nama === 'subkelas' || $nama === 'user' ){
            
        // }
        // else{
        //     if ($existingFile && Storage::exists('public/'.$existingFile)) {
        //     Storage::delete('public/'.$existingFile);
        // }
        // }


        //---------------------*Hard Delete*------------------------------------
        // if ($nama === 'siswa') {
        //     DB::table('users')->where('username', $id)->delete();
        // } 

        // elseif ($nama === 'guru') {
        //     DB::table('users')->where('username', $id)->delete();
        // } 
        
        // else {
        //     DB::table($namas)->where($nid, $id)->delete();
        // }


        //---------------------*Soft Delete*------------------------------------

        if ($nama === 'siswa') {
            DB::table('users')->where('username', $id)->delete();
        } 

        elseif ($nama === 'guru') {
            DB::table('users')->where('username', $id)->delete();
        } 
        
        else {
            $modelClass = 'App\\Models\\' . ucfirst($nama);
            $modelClass::where($nid, $id)->delete();
        }
        




        if($nama === 'materi'){
            return redirect(url('guru/mapel/' . Auth::user()->username))->with('success', 'Data berhasil dihapus');
        }
        elseif($nama === 'subkelas'){
            return redirect(url('guru/edittabel/' . $nama))->with('success', 'Data berhasil dihapus');
        }
        elseif($nama === 'siswa' || $nama === 'guru'){
            return redirect(url('guru/edittabel/' . $nama))->with('success', 'Akun Berhasil Dinonaktifkan');
        }


        else{
            return redirect(url('guru/' . $nama))->with('success', 'Data berhasil dihapus');   
        }

    }


    public function active($nama, $id, $nnama, Request $request)
    {
    


    
        if($nama === 'guru'){
            DB::table('users')->insert([
            'name' => $nnama,
            'username' => $id,
            'role' => $request->input('role'),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
            'password' => Hash::make($id),
        ]);
        }
        elseif($nama === 'siswa'){
            DB::table('users')->insert([
            'name' => $nnama,
            'username' => $id,
            'role' => 'siswa',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
            'password' => Hash::make($id),
        ]);
        }
        
    
        return redirect(url('guru/edittabel/' . $nama))->with('success', 'Akun Berhasil Diaktifkan');
    }
    


}
