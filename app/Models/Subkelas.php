<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subkelas extends Model
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table = 'subkelases';

    protected $fillable = [
        'id_subkelas',
        'id_kelas',
        'nama_subkelas',
        'tahun_ajaran',
        'semester',
    ];


    // public function kelas(){ // 1 kelas hasMany siswa
    //     return $this->hasMany('App\Models\Siswa','id_kelas', 'id_kelas');
    // }


}
