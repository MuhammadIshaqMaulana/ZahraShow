<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'pengumumans';

    protected $fillable = [
        'id_pengumuman',
        'nama_pengumuman',
        'tanggal_pengumuman',
        'file_pengumuman',
    ];
}
