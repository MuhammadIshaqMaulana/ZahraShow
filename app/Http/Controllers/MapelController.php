<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index($id)
    {
        $siswas = DB::table('siswas')->whereNull('deleted_at')->where('nisn', $id)->first();

        $mapels = DB::table('mapels')->whereNull('deleted_at')->where('id_subkelas', $siswas->id_subkelas)->get();
        $gurus = DB::table('gurus')->whereNull('deleted_at')->get();

        $subs = DB::table('subkelases')->whereNull('deleted_at')->get();

        return view('mapel', compact('mapels', 'subs', 'gurus'));
        
    }
}
