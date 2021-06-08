<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opd_jabatan;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Sub_bidang;
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
        $j=0;
        $data_sub_bidang;
        foreach($bidang as $data){
            $data_bidang[$i]['nama_bidang'] = $data->nama_bidang;
            $data_bidang[$i]['id'] = $data->id;
            $data_bidang[$i]['jabatan'] = Opd_jabatan::where([['bidang_id', $data->id], ['sub_bidang_id', '0']])->get();
            
            foreach($data->sub_bidang as $sub_bidang){
                $data_sub_bidang[$j]['nama_sub_bidang'] = $sub_bidang->nama_sub_bidang;
                $data_sub_bidang[$j]['id'] = $sub_bidang->id;
                $data_sub_bidang[$j]['jabatan'] = Opd_jabatan::where('sub_bidang_id', $sub_bidang->id)->get();
                $j++;
            }
            $i++;
        }
        return view('opd_jabatan.daftar_jabatan', compact('data_jabatan', 'data_bidang', 'jabatan_real', 'data_sub_bidang'));
    }

    public function post_opd_jabatan(Request $request){
        $jenis = $request->jenis;
        if($jenis == "bidang"){
            $id_bidang = $request->id_bidang;
            $id_sub_bidang = 0;
        }
        else{
            $id_sub_bidang = $request->id_bidang;
            $sub_bidang = Sub_bidang::find($id_sub_bidang);
            $id_bidang = $sub_bidang->bidang->id;
        }
        $opd_jabatan = new Opd_jabatan;
        $opd_jabatan->jabatan_id = $request->jabatan;
        $opd_jabatan->opd_id = Auth()->user()->opd_user->opd_id;
        $opd_jabatan->bidang_id = $id_bidang;
        $opd_jabatan->sub_bidang_id = $id_sub_bidang;
        $opd_jabatan->save();

        return back();
    }
}
