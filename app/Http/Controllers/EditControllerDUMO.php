<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{

    public function index($nama, $id, Request $request){
        
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
        


        $data =  DB::table($namas)->where($nid, $id)->first();

        return view('edit', compact('data'))
        ->with('nama', $nama)
        ->with('id', $id)
        ->with('namas', $namas)
        ->with('nfk', $nfk)
        ->with('nid', $nid)
        ->with('nnama', $nnama)
        ->with('ntext', $ntext)
        ->with('nfile', $nfile);

    }

    public function update($nama, $id, Request $request){
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
        // $store = Storage::disk('local')->put('/', $request->file($nfile));

        // berita::update([
        //     
        //     $nfk => $request->$nfk,
        //     $nnama => $request->$nnama,
        //     $ntext => $request->$ntext,
            
        //     // 'tanggal_berita' => $nfile ??= null,
        //     $nfile => $store ??= null,
        // ]);

       
        $data = [
            $nnama => $request->$nnama,
            $ntext => $request->$ntext,
            $nfile => $path ?? $request->$nfile,
        ];
    
        DB::table($namas)->where($nid, $id)->update($data);


        // $find = Berita::where('id_berita', $id)->first();
        // // $data = Berita::find($id);

        // $data = [
        //     $nnama => $request->$nnama,
        //     $ntext => $request->$ntext,
        //     $nfile => $request->$nfile,
           
        // ];

        
        // DB::update('update ' . $namas . ' set ' . 
        //     $nnama . ' = ' . $request->$nnama . ', ' . 
        //     $ntext . ' = ' . $request->$ntext . ', ' . 
        //     $nfile . ' = ' . $request->$nfile . ' where ' . 
        //     $nid . ' = ' . $id 
        // );




        // // $data->$nnama = $request->input($nnama);
        // // $data->$ntext = $request->input($ntext);
        // // $data->$nfile = $request->input($nfile);

        // $find->update($data);

        
        // return redirect()->back()->with('status','Student Updated Successfully');
        // $input = $request->all(); //ini pakenya id doang, bukan id_berita
        // $data->update($input);


        
        $tmp = TemporaryFile::where('folder', $request->$nfile)->first();

        if ($tmp) {
            $modelClass = 'App\\Models\\' . ucfirst($nama);
            if (class_exists($modelClass)) {
                $model = DB::table($namas)->where($nid, $id);

                if ($model) {
                    $model->addMedia(storage_path('app/public/' . $namas . '/' . 'tmp/' . $request->input($nfile) . '/' . $tmp->filename))
                        ->toMediaCollection($namas);

                    rmdir(storage_path('app/public/' . $namas . '/' . 'tmp/' . $request->input($nfile)));

                    $tmp->delete();

                    return redirect(url('edit/' . $nama . '/' . $id))->with('success', 'File Ter-upload');
                }
            }
        }

        return redirect(url('edit/' . $nama . '/' . $id))->with('success', 'Perubahan Berhasil');
    }

    
}






// namespace App\Http\Controllers;
// use App\Models\Barang;
// use App\Models\Pesanan;
// use App\Models\PesananDetail;
// use App\Models\User;
// use Auth;
// use Carbon\Carbon;
// use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

// class PesanController extends Controller
// {
//     public function __construct() //function biar orang yg gak login gabisa akses home
//     {
//         $this->middleware('auth');
//     }

//     public function index($id){
//         $barang = Barang::where('id', $id)->first(); // id = $id. first = cuma ambil 1 data dari DB

//         return view('pesan.index', compact('barang'));
//     }

//     public function pesan(Request $request, $id){
//         $barang = Barang::where('id', $id)->first();

//         if($request->jumlah_pesan > $barang->stok){
//             Alert::error('Pesanan Gagal Disimpan', 'Jumlah Stok tidak cukup');
//             return redirect('pesan/'.$id);
//         }

//         else{
//             $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
//             if(empty($cek_pesanan)){
//                 // $tanggal = Carbon::now();
//                 $pesanan = new Pesanan;
//                 $pesanan->user_id = Auth::user()->id;
//                 $pesanan->tanggal = Carbon::now();
//                 $pesanan->status = 0;
//                 $pesanan->total_harga = 0;
//                 $pesanan->kode = mt_rand(100, 999);
//                 $pesanan->save();
//             }

//             $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

//             $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
//             if(empty($cek_pesanan_detail)){
//                 $pesanan_detail = new PesananDetail;
//                 $pesanan_detail->barang_id = $barang->id;
//                 $pesanan_detail->pesanan_id = $pesanan_baru->id;
//                 $pesanan_detail->jumlah = $request->jumlah_pesan;
//                 $pesanan_detail->total_harga = $barang->harga*$request->jumlah_pesan;
//                 $pesanan_detail->save();
//             }else{
//                 $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
//                 $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;
//                 $pesanan_detail->total_harga = $pesanan_detail->total_harga+($barang->harga*$request->jumlah_pesan);
//                 $pesanan_detail->update();
//             }

//             $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
//             $pesanan->total_harga = $pesanan->total_harga+($barang->harga*$request->jumlah_pesan);
//             $pesanan->update();

//             Alert::success('Pesanan Berhasil Disimpan', 'Silahkan Cek Keranjang Belanja');

//             return redirect('home');
//         }
//     }

//     public function check_out(){
//         $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
//         $pesanan_detail = [];

//         if(!empty($pesanan)){
//             $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
//         }

//         return view('pesan.check_out', compact('pesanan_detail'));
//     }

//     public function delete($id){
//         $pesanan_detail = PesananDetail::where('id', $id)->first();
//         $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
//         $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->total_harga;
//         $pesanan->update();
//         $pesanan_detail->delete();

//         Alert::error('Pesanan Berhasil Dihapus', '');
//         return redirect('check-out');
//     }

//     public function konfirmasi()
//     {

//         $user = User::where('id', Auth::user()->id)->first();

//         if(empty($user->alamat))
//         {
//             Alert::error('Error', 'Identitas Harap Dilengkapi');
//             return redirect('profile');
//         }

//         if(empty($user->nohp))
//         {
//             Alert::error('Error', 'Identitas Harap Dilengkapi');
//             return redirect('profile');
//         }

//         $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
//         $pesanan_id = $pesanan->id;
//         $pesanan->status = 1;
//         $pesanan->update();

//         $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan_id)->get();
//         foreach($pesanan_detail as $pesanan_detail){
//             $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
//             $barang->stok = $barang->stok - $pesanan_detail->jumlah;
//             $barang->update();
//         }

//         Alert::success('Check Out Pesanan Berhasil', '');
//         return redirect('check-out');
//     }
// }

