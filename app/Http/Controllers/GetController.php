<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_bidang;
use App\Models\Opd_jabatan;
use App\Models\Asn;

class GetController extends Controller
{
    //
    public function get_sub_bidang($id){
        $sub_bidang = Sub_bidang::where('bidang_id', $id)->get();
        return response()->json(['sub_bidang'=>$sub_bidang]);
    }

    public function get_jabatan_sub_bidang($id){
        $jabatan = Opd_jabatan::where([ 
            ['opd_id', Auth()->user()->opd_user->opd_id],
            ['sub_bidang_id', $id]
        ])->get();

        $data_jabatan = array();
        $i=0;
        foreach($jabatan as $data){
            $data_jabatan[$i]['id'] = $data->id;
            $data_jabatan[$i]['nama_jabatan'] = $data->jabatan->nama;
            $i++;
        }

        return response()->json(['data_jabatan'=>$data_jabatan]);
    }

    public function get_detail_asn($id){
        $asn = Asn::find($id);
        return response()->json(['asn'=>$asn]);
    }
}
