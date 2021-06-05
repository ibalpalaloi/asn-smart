<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opd_jabatan;
use App\Models\Bidang;

class Jabatan_Opd_Controller extends Controller
{
    //

    public function daftar_jabatan(){
        $jabatan = Opd_jabatan::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $bidang = Bidang::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $data_jabatan;
        $data_bidang;
        $i=0;
        foreach($jabatan as $data){
            $data_jabatan[$i]['nama_jabatan'] = $data->nama_jabatan;
            $data_jabatan[$i]['nama_bidang'] = $data->bidang->nama_bidang;
            if($data->id_sub_bidang == 0){
                $data_jabatan[$i]['nama_sub_bidang'] = "-";
            }
            else{
                $data_jabatan[$i]['nama_sub_bidang'] = $data->sub_bidang->nama_sub_bidang;
            }
            $i++;
        }
        $i=0;
        foreach($bidang as $data){
            $data_bidang[$i]['nama_bidang'] = $data->nama_bidang;
            $data_bidang[$i]['id'] = $data->id;
            $i++;
        }
        return view('opd_jabatan.daftar_jabatan', compact('data_jabatan', 'data_bidang'));
    }

    public function post_opd_jabatan(Request $request){
        $opd_jabatan = new Opd_jabatan;
        $opd_jabatan->nama_jabatan = $request->nama_jabatan;
        $opd_jabatan->opd_id = Auth()->user()->opd_user->opd_id;
        $opd_jabatan->bidang_id = $request->bidang;
        $opd_jabatan->save();

        return back();
    }
}
