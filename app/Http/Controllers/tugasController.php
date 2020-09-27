<?php

namespace App\Http\Controllers;

use App\Models\bersih;
use App\Models\tawasul;
use App\Models\literasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function literasi_index(){
        return view('tri.literasi');
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
        // try{
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
        // }catch(\Exception $e){
        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }
    }

    public function bersih_add(Request $req){
        // dd($req->all());
        try{
            $tugas = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('tugas')) {
                //maka menjalankan method saveFile()
                $tugas = $this->saveFile($req->name_siswa, $req->file('tugas'));
            }
            $bersih = bersih::create([
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

    public function literasi_add(Request $req){
        // dd($req->all());
        try{
            $tugas = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('tugas')) {
                //maka menjalankan method saveFile()
                $tugas = $this->saveFile($req->name_siswa, $req->file('tugas'));
            }
            $literasi = literasi::create([
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

    public function tugas_kumpul($id){
        // dd($id);
        $edit_taw = DB::table('tawasuls')->where('nama_siswa',$id)->get();
        $edit_ber = DB::table('bersihs')->where('nama_siswa',$id)->get();
        $edit_lit = DB::table('literasis')->where('nama_siswa',$id)->get();
        // dd($edit_taw);
        return view('tri.tugas_kumpul',compact('edit_taw','edit_ber','edit_lit'));
    }

    public function tugas_edit($id){
        $tadarus = tawasul::findOrFail($id);
        return view('tri.tugas_edit_tad',compact('tadarus'));
    }

    public function tugas_edit_bersih($id){
        $bersih = bersih::findOrFail($id);
        return view('tri.tugas_edit_ber',compact('bersih'));
    }

    public function tugas_edit_literasi($id){
        $literasi = literasi::findOrFail($id);
        return view('tri.tugas_edit_lit',compact('literasi'));
    }

    public function tugas_update(Request $req,$id){
        // dd($req->all());
        $tadarus = tawasul::findOrFail($id);
        $tugas = $tadarus->tugas;

        if ($req->hasFile('tugas')) {
            //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
            !empty($tugas) ? File::delete(public_path('uploads/product/' . $tugas)):null;
            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
            $tugas = $this->saveFile($req->nama_siswa, $req->file('tugas'));
        }
        $tadarus->update([
            'nama_siswa' => $req->nama_siswa,
            'kelas' => $req->kelas,
            'wali_kelas' => $req->wali_kelas,
            'tugas' => $tugas,
            'absen' => $req->absen,
        ]);
        return redirect('home')->with('sukses','tugas berhasil di edit');
    }

    public function tugas_update_bersih(Request $req,$id){
        // dd($req->all());
        $bersih = bersih::findOrFail($id);
        $tugas = $bersih->tugas;

        if ($req->hasFile('tugas')) {
            //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
            !empty($tugas) ? File::delete(public_path('uploads/product/' . $tugas)):null;
            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
            $tugas = $this->saveFile($req->nama_siswa, $req->file('tugas'));
        }
        $bersih->update([
            'nama_siswa' => $req->nama_siswa,
            'kelas' => $req->kelas,
            'wali_kelas' => $req->wali_kelas,
            'tugas' => $tugas,
            'absen' => $req->absen,
        ]);
        return redirect('home')->with('sukses','tugas berhasil di edit');
    }

    public function tugas_update_literasi(Request $req,$id){
        // dd($req->all());
        $literasi = literasi::findOrFail($id);
        $tugas = $literasi->tugas;

        if ($req->hasFile('tugas')) {
            //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
            !empty($tugas) ? File::delete(public_path('uploads/product/' . $tugas)):null;
            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
            $tugas = $this->saveFile($req->nama_siswa, $req->file('tugas'));
        }
        $literasi->update([
            'nama_siswa' => $req->nama_siswa,
            'kelas' => $req->kelas,
            'wali_kelas' => $req->wali_kelas,
            'tugas' => $tugas,
            'absen' => $req->absen,
        ]);
        return redirect('home')->with('sukses','tugas berhasil di edit');
    }
}
