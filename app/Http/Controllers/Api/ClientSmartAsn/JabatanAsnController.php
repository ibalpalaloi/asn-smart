<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan_asn;
use DB;

class JabatanAsnController extends Controller
{
    //
	public function select_bidang(Request $request){
		$sub_bidang = DB::table('sub_bidang')->select('id','nama_sub_bidang')->where('bidang_id', $request->id_bidang)->get();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'sub_bidang' => $sub_bidang
		], 200);
	}

	public function select_sub_bidang(Request $request){
		$jabatan = DB::table('jabatan')->select('opd_jabatan.id', 'jabatan.nama')->join('opd_jabatan', 'opd_jabatan.id_jabatan', '=', 'jabatan.id')->where('opd_jabatan.sub_bidang_id', $request->id_sub_bidang)->get();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'jabatan' => $jabatan
		], 200);
	}

	public function store(Request $request){
		// $user = $request->user();
		// $biodata = DB::table('biodata_asn')->select('biodata_asn.*', 'asn.id as id_asn', 'kecamatan.id as id_kecamatan', 'kecamatan.nama as kecamatan', 'kabupaten_kota.id as id_kab', 'kabupaten_kota.nama as kabupaten')->join('asn', 'asn.biodata_asn_id', '=', 'biodata_asn.id')->join('users', 'users.nip', '=', 'asn.nip')->join('kecamatan', 'kecamatan.id', '=', 'biodata_asn.kecamatan')->join('kabupaten_kota', 'kabupaten_kota.id', '=', 'kecamatan.kabupaten_kota_id')->where('users.id', $user->id)->first();
		// if ($biodata){			
			$db = new Jabatan_asn;
			$db->id = $this->autocode('JAN');
			$db->id_asn = $request->id;
			$db->id_jabatan = $request->jabatan_pelaksana;
			$db->save();
			return response()->json([
				'message' => "Data berhasil",
				'status' => 200,
			],200);
		// }
		// else {
		// }


	}

	public function update(Request $request){
		$db = Jabatan_asn::where("id", $request->id)->first();
		$db->id_jabatan = $request->jabatan_pelaksana;
		$db->save();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
		],200);
	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}
}
