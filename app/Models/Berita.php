<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{

    use SoftDeletes;
    use HasFactory;
    protected $table = 'beritas';

    protected $fillable = [
        'id_berita',
        'nama_berita',
        'text_berita',
        'tanggal_berita',
        'file_berita',
    ];
}
