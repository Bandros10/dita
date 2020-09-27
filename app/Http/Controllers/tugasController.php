<?php

namespace App\Http\Controllers;

use App\Models\bersih;
use App\Models\tawasul;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class tugasController extends Controller
{
    public function tawasul_index(){
        return view('tri.tawasul');
    }
    public function bersih_index(){
        return view('tri.bersih');
    }

    private function saveFile($name,$tugas){
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = Str::slug($name) . time() . '.'. $tugas->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        $path = public_path('uploads/product');

        //cek jika uploads/product bukan direktori / folder
        if(!File::isDirectory($path)){
            //maka folder tersebut dibuat
            File::makeDirectory($path,0777,true,true);
        }
        //simpan gambar yang diuplaod ke folrder uploads/produk
        Image::make($tugas)->save($path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
    }

    public function tawasul_add(Request $req){
        // dd($req->all());
        try{
            $tugas = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('tugas')) {
                //maka menjalankan method saveFile()
                $tugas = $this->saveFile($req->name_siswa, $req->file('tugas'));
            }
            $tawasul = tawasul::create([
                'nama_siswa' => $req->nama_siswa,
                'kelas' => $req->kelas,
                'wali_kelas' => $req->wali_kelas,
                'tugas' => $tugas,
                'absen' => $req->absen
            ]);
            return redirect('home')->with('sukses','tugas berhasil di input');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function bersih_add(Request $req){
        // dd($req->all());
        // try{
            $tugas = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('tugas')) {
                //maka menjalankan method saveFile()
                $tugas = $this->saveFile($req->name_siswa, $req->file('tugas'));
            }
            $tawasul = bersih::create([
                'nama_siswa' => $req->nama_siswa,
                'kelas' => $req->kelas,
                'wali_kelas' => $req->wali_kelas,
                'tugas' => $tugas,
                'absen' => $req->absen
            ]);
            return redirect('home');
        // }catch(\Exception $e){
        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }
    }
}
