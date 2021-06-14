<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DaerahController extends Controller
{
    //
	public function select_kab(Request $request){
		$kecamatan = DB::table('kecamatan')->select('id','nama')->where('kabupaten_kota_id', $request->id_kab)->get();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'kecamatan' => $kecamatan
		], 200);

	}
}
