<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Sub_bidang;

class Admin_Struktur_Opd_Controller extends Controller
{
    //
    public function bidang(){
        $opd_id = Auth()->user()->opd_user->opd_id;
        $bidang = Bidang::where('opd_id', $opd_id)->get();
        return view('struktur.bidang', compact('bidang'));
    }

    public function post_tambah_sub_bidang(Request $request){
        $sub_bidang = new Sub_bidang;
        $sub_bidang->bidang_id = $request->id_bidang;
        $sub_bidang->nama_sub_bidang = $request->sub_bidang;
        $sub_bidang->save();

        return back();
    }

    public function post_ubah_bidang(Request $request){
        $bidang = Bidang::find($request->id_bidang);
        $bidang->nama_bidang = $request->bidang;
        $bidang->save();
        return back();
    }

    public function post_ubah_sub_bidang(Request $request){
        $sub_bidang = Sub_bidang::find($request->id_sub_bidang);
        $sub_bidang->nama_sub_bidang = $request->sub_bidang;
        $sub_bidang->save();

        return back();
    }

    public function hapus_sub_bidang($id){
        Sub_bidang::find($id)->delete();
        return back();
    }

    public function hapus_bidang($id){
        Bidang::find($id)->delete();
        return back();
    }

    public function tambah_bidang(Request $request){
        $bidang = new Bidang;
        $bidang->nama_bidang;
    }
}
