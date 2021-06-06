<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opd_jabatan;
use App\Models\Bidang;
use App\Models\Jabatan;
use DB;

class Jabatan_Opd_Controller extends Controller
{
    //

    public function daftar_jabatan_opd(){
        $jabatan = Opd_jabatan::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $bidang = Bidang::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $jabatan_real = DB::table('jabatan')->get(); 
        $data_jabatan = array();
        $data_bidang = array();
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
        return view('opd_jabatan.daftar_jabatan', compact('data_jabatan', 'data_bidang', 'jabatan_real'));
    }

    public function post_opd_jabatan(Request $request){
        // dd($request);
        $opd_jabatan = new Opd_jabatan;
        $opd_jabatan->id_jabatan = $request->jabatan;
        $opd_jabatan->opd_id = Auth()->user()->opd_user->opd_id;
        $opd_jabatan->bidang_id = $request->bidang;
        $opd_jabatan->sub_bidang_id = $request->sub_bidang;
        $opd_jabatan->save();

        return back();
    }
}
