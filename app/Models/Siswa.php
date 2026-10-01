<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Siswa extends Model
{
    use SoftDeletes;
    use  HasFactory, Notifiable;
    protected $table = 'siswas';

    protected $guard = 'siswa';

    protected $fillable = [
        'nisn',
        'id_subkelas',
        'nama_siswa',
        'file_siswa',
    ];
}
