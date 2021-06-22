<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asn;

class GetController extends Controller
{
    //
    public function get_asn($id){
        $asn = Asn::where('opd_id', $id)->get();
        $data_asn = array();
        $i=0;
        foreach($asn as $data){
            $data_asn[$i]['id'] = $data->id;
            $data_asn[$i]['nama'] = $data->biodata_asn->nama;
            $data_asn[$i]['bidang'] = $data->jabatan_asn->opd_jabatan->bidang->nama_bidang;
            $data_asn[$i]['sub_bidang'] = $data->jabatan_asn->opd_jabatan->sub_bidang->nama_sub_bidang;
            $i++;
        }
        return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'asn' => $data_asn
		], 200);
    }
}
