<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function admin_index(){
        $user = User::latest()->get();
        // dd($user);
        return view('admin/index',compact('user'));
    }

    public function admin_store(Request $req){
        $user = DB::table('users')->insert(
            ['name' => $req->name,
            'email' => $req->email,
            'role' => $req->role,
            'password' => bcrypt($req->password),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ]);
        return redirect()->back()->with('sukses','data berhasil di tambah');
    }

    public function admin_hapus($id){
        $hapus = User::findOrFail($id);
        $hapus->delete();
        return redirect()->back()->with('sukses','data berhasil di hapus');
    }
}
