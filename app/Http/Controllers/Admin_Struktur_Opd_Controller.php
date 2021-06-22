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
        // dd($opd_id);
        $bidang = Bidang::where('opd_id', $opd_id)->get();
        return view('struktur.bidang', compact('bidang', 'opd_id'));
    }

    public function tambah_sub_bidang(Request $request){
        $sub_bidang = new Sub_bidang;
        $sub_bidang->bidang_id = $request->id_bidang;
        $sub_bidang->nama_sub_bidang = $request->sub_bidang;
        $sub_bidang->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil ditambah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
    }


    public function ubah_sub_bidang(Request $request){
        $sub_bidang = Sub_bidang::find($request->id_sub_bidang);
        $sub_bidang->nama_sub_bidang = $request->sub_bidang;
        $sub_bidang->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil diubah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
    }

    public function hapus_sub_bidang(Request $request){
        Sub_bidang::find($request->id)->delete();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil dihapus',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);  
    }

    public function select_bidang(Request $request){
        $sub_bidang = Sub_bidang::where('bidang_id', $request->id_bidang)->get();
        $option = "<option value='0'>Tanpa Sub Bidang</option>";
        foreach ($sub_bidang as $row) {
            $option .= "<option value='$row->id'>$row->nama_sub_bidang</option>";
        }
        echo $option;
    }


    public function tambah_bidang(Request $request){
        $bidang = new Bidang;
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->opd_id = $request->opd_id;
        $bidang->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil ditambah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
    }

    public function ubah_bidang(Request $request){
        $bidang = Bidang::find($request->id_bidang);
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil diubah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
    }

    public function hapus_bidang(Request $request){
        $sub_bidang = Sub_bidang::where('bidang_id', $request->id)->first();
        if ($sub_bidang){
            $notification = array(
                'message' => 'Silahkan hapus data sub bidang terlebih dahulu',
                'color' => "#dc3545",
                'icon' => "fas fa-times-circle",
                'header' => "Gagal",
                'kode-notif' => 403
            ); 
            return back()->with($notification);                 
        }
        else {
            Bidang::find($request->id)->delete();
            $notification = array(
                'kode-notif' => 'berhasil',
                'message' => 'Data berhasil dihapus',
                'color' => "#28a745",
                'icon' => "fas fa-check-circle",
                'header' => "Berhasil"
            ); 
            return back()->with($notification);                 
        }
    }

}
