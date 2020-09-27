<?php

namespace App\Http\Controllers;

use App\Models\bersih;
use App\Models\tawasul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class absenController extends Controller
{
    public function absen(){
        $tawasul = tawasul::all();
        $bersih = bersih::all();
        // dd($bersih);
        return view('absen.data_absen',compact('tawasul','bersih'));
    }
}
