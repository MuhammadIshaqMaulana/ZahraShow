<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'galeris';

    protected $fillable = [
        'id_galeri',
        'nama_galeri',
        'file_galeri',
    ];

}
