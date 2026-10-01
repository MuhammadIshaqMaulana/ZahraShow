<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'kelases';

    protected $fillable = [
        'id_kelas',
        'nama_kelas',
    ];


    // public function kelas(){ // 1 kelas hasMany siswa
    //     return $this->hasMany('App\Models\Siswa','id_kelas', 'id_kelas');
    // }


}
