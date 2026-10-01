<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = DB::table('gurus')->whereNull('deleted_at')->get();
        return view('guru', compact('gurus'));
        
    }
}
