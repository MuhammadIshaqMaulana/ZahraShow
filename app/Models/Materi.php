<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'materis';

    protected $fillable = [
        'id_materi',
        'id_mapel',
        'nama_materi',
        'file_materi', 
    ];
}
