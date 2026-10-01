<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UploadController;

use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\MateriController;

//------------------- defult ------------------//
Route::get('/', [App\Http\Controllers\BerandaController::class, 'index']);
Route::get('/beranda', [App\Http\Controllers\BerandaController::class, 'index'])->name('dashboard');

// --------------------  DEMO / SHOWCASE LOGIN  -------------------------- //
// Quick "log in as admin / guru / siswa" used by the dropdown under the Login
// button on the public site (config/demo.php + the navbar in layouts/app.blade.php).
Route::post('/demo-login', [App\Http\Controllers\DemoLoginController::class, 'store'])->name('demo.login');

Route::middleware('auth')->group(function () {
    Route::get('/ubah-password', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/ubah-password', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/ubah-password', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//------------------- defult ------------------//




// --------------------  Guru Punya  -------------------------- //

Route::get('/guru/beranda', [App\Http\Controllers\Guru\BerandaController::class, 'index'])->name('guruberanda')->middleware(['auth', 'admin']);
Route::get('/guru/berita', [App\Http\Controllers\Guru\BeritaController::class, 'index'])->middleware(['auth', 'admin'])->name('guruberita');
Route::get('/guru/galeri', [App\Http\Controllers\Guru\GaleriController::class, 'index'])->middleware(['auth', 'admin'])->name('gurugaleri');
Route::get('/guru/guru', [App\Http\Controllers\Guru\GuruController::class, 'index'])->middleware(['auth', 'admin'])->name('guruguru');
Route::get('/guru/kontak', [App\Http\Controllers\Guru\KontakController::class, 'index'])->middleware(['auth', 'admin'])->name('gurukontak');
Route::get('/guru/mapel/{id}', [App\Http\Controllers\Guru\MapelController::class, 'index'])->name('gurumapel')->middleware(['auth', 'guruadmin']);
Route::get('/guru/materi/{id_mapel}', [App\Http\Controllers\Guru\MateriController::class, 'index'])->middleware(['auth', 'guruadmin'])->name('gurumateri');
Route::get('/guru/pengumuman', [App\Http\Controllers\Guru\PengumumanController::class, 'index'])->middleware(['auth', 'admin'])->name('gurupengumuman');
Route::get('/guru/ppdb', [App\Http\Controllers\Guru\PPDBController::class, 'index'])->middleware(['auth', 'admin'])->name('guruppdb');





// Route::get('/guru/editsiswa', [App\Http\Controllers\Guru\OtherController::class, 'siswa'])->name('editsiswa')->middleware(['auth', 'admin']);
// Route::get('/guru/editguru', [App\Http\Controllers\Guru\OtherController::class, 'guru'])->name('editguru')->middleware(['auth', 'admin']);


Route::get('/guru/edittabel/{nama_tabel}', [App\Http\Controllers\Guru\OtherController::class, 'tabeledit'])->name('tabeledit')->middleware(['auth', 'admin']);






Route::get('/guru/editkelas', [App\Http\Controllers\Guru\OtherController::class, 'kelas'])->name('editguru')->middleware(['auth', 'admin']);








Route::get('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('pengumuman')->middleware(['auth', 'verified']);
Route::get('/profilsekolah', [App\Http\Controllers\ProfilSekolahController::class, 'index'])->name('profilsekolah');
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/galeri', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri');


Route::get('/mapel/{id}', [App\Http\Controllers\MapelController::class, 'index'])->name('mapel')->middleware(['auth', 'verified']);
Route::get('/materi/{id_mapel}', [App\Http\Controllers\MateriController::class, 'index'])->name('materi')->middleware(['auth', 'verified']);
Route::get('/ppdb', [App\Http\Controllers\PPDBController::class, 'index'])->name('ppdb');
Route::get('/guru', [App\Http\Controllers\GuruController::class, 'index'])->name('guru');
Route::get('/kontak', [App\Http\Controllers\KontakController::class, 'index'])->name('kontak');

// Route::get('profile', [ProfileController::class,'edit'])->name('profile');
// Route::post('profile', [App\Http\Controllers\ProfileController::class,'update']);

// ----------------------------  UPLOADS  ------------------------------- //

Route::get('upload/{nama_tabel}', [App\Http\Controllers\UploadController::class, 'index'])->name('upload.index')->middleware(['auth', 'guruadmin']);
Route::post('upload/{nama_tabel}/{id}', [App\Http\Controllers\UploadController::class, 'upload'])->name('upload.upload')->middleware(['auth', 'guruadmin']);

// ----------------------------  EDIT  ------------------------------- //

Route::get('edit/{nama_tabel}/{id}', [App\Http\Controllers\EditController::class, 'index'])->name('edit.index')->middleware(['auth', 'guruadmin']);
Route::put('update/{nama}/{id}', [App\Http\Controllers\EditController::class, 'update'])->name('edit.update')->middleware(['auth', 'guruadmin']);
Route::delete('delete/{nama}/{id}', [App\Http\Controllers\EditController::class, 'delete'])->name('edit.delete')->middleware(['auth', 'guruadmin']);
Route::post('active/{nama}/{id}/{nnama}', [App\Http\Controllers\EditController::class, 'active'])->name('edit.active')->middleware(['auth', 'guruadmin']);


// ----------------------------  detail  ------------------------------- //

Route::get('/berita/{id}/{nama_berita}', [App\Http\Controllers\BeritaController::class, 'beritadetail'])->name('beritadetail');
Route::get('/berita/{nama_berita}/download/{id}', [App\Http\Controllers\BeritaController::class, 'download'])->name('berita.download');

Route::get('/pengumuman/{id}/{nama_pengumuman}', [App\Http\Controllers\PengumumanController::class, 'pengumumandetail'])->name('pengumumandetail')->middleware(['auth', 'verified']);
Route::get('/pengumuman/{nama_pengumuman}/download/{id}', [PengumumanController::class, 'download'])->name('pengumuman.download')->middleware(['auth', 'verified']);



// Route untuk mendownload materi
Route::get('/materi/download/{id}', [MateriController::class, 'download'])->name('materi.download')->middleware(['auth', 'verified']);



