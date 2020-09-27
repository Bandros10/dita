<?php

namespace App\Http\Controllers;

use App\Models\bersih;
use App\Models\tawasul;
use App\Models\literasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class absenController extends Controller
{
    public function absen(){
        $tawasul = tawasul::all();
        $bersih = bersih::all();
        $literasi = literasi::all();
        // dd($bersih);
        return view('absen.data_absen',compact('tawasul','bersih','literasi'));
    }

    public function tugas_destroy_taw($id){
        $tawasul = tawasul::findOrFail($id);
        if (!empty($tawasul->tugas)) {
            File::delete(public_path('uploads/product/' . $tawasul->tugas));
        }
        $tawasul->delete();
        return redirect('home')->with('sukses','tugas berhasil di hapus');
    }

    public function tugas_destroy_ber($id){
        $bersih = bersih::findOrFail($id);
        if (!empty($bersih->tugas)) {
            File::delete(public_path('uploads/product/' . $bersih->tugas));
        }
        $bersih->delete();
        return redirect('home')->with('sukses','tugas berhasil di hapus');
    }

    public function tugas_destroy_lit($id){
        $literasi = literasi::findOrFail($id);
        if (!empty($literasi->tugas)) {
            File::delete(public_path('uploads/product/' . $literasi->tugas));
        }
        $literasi->delete();
        return redirect('home')->with('sukses','tugas berhasil di hapus');
    }
}
