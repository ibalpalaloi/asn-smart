<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata_asn;
use App\Models\Asn;

class Admin_Asn_Controller extends Controller
{
    //
    public function data_asn(){
        $asn = Asn::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $data_asn;
        $i = 0;
        foreach($asn as $data){
            $data_asn[$i]['id_asn'] = $data->id;
            $data_asn[$i]['nama'] = $data->biodata_asn->nama;
            $data_asn[$i]['nip'] = $data->nip;
            $data_asn[$i]['jenis_kelamin'] = $data->biodata_asn->jenis_kelamin;
            $data_asn[$i]['tgl_lahir'] = $data->biodata_asn->tgl_lahir;
            $i++;
        }
        return view('asn.data_asn', compact('data_asn'));
    }

    public function tambah_asn(){
    }
}
