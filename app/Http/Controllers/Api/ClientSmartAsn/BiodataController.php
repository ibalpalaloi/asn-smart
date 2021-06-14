<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata_asn;
use DB;

class BiodataController extends Controller
{
    //
    public function index(Request $request){
		$user = $request->user();
		$biodata = DB::table('biodata_asn')->select('biodata_asn.*', 'kecamatan.id as id_kecamatan', 'kecamatan.nama as kecamatan', 'kabupaten_kota.id as id_kab', 'kabupaten_kota.nama as kabupaten')->join('asn', 'asn.biodata_asn_id', '=', 'biodata_asn.id')->join('users', 'users.nip', '=', 'asn.nip')->join('kecamatan', 'kecamatan.id', '=', 'biodata_asn.kecamatan')->join('kabupaten_kota', 'kabupaten_kota.id', '=', 'kecamatan.kabupaten_kota_id')->where('users.id', $user->id)->first();
		// dd($user);
		$kabupaten = DB::table('kabupaten_kota')->select('id', 'nama')->where("provinsi_id", '72')->get();
		$kecamatan = DB::table('kecamatan')->select('id', 'nama')->where('kabupaten_kota_id', $biodata->id_kab)->get();
		$opd = DB::table('asn')->select('opd.id', 'opd.nama_opd')->join('opd', 'opd.id', '=', 'asn.opd_id')->where('asn.biodata_asn_id', $biodata->id)->first();
		$bidang = DB::table('bidang')->select('id', 'nama_bidang')->where('opd_id', $opd->id)->get();
        $jabatan_asn = DB::table('jabatan_asn')->select('jabatan_asn.id', 'jabatan_asn.id_jabatan', 'opd_jabatan.sub_bidang_id', 'opd_jabatan.bidang_id', 'jabatan.nama as jabatan', 'bidang.nama_bidang', 'sub_bidang.nama_sub_bidang')->join('opd_jabatan', 'opd_jabatan.id', '=', 'jabatan_asn.id_jabatan')->where('jabatan_asn.id_asn', $biodata->id)->leftJoin('jabatan', 'jabatan.id', '=', 'opd_jabatan.id_jabatan')->leftJoin('bidang', 'bidang.id', '=', 'opd_jabatan.bidang_id')->leftJoin('sub_bidang', 'sub_bidang.id', '=', 'opd_jabatan.sub_bidang_id')->first();
        if ($jabatan_asn){
            $sub_bagian_selected = DB::table('sub_bidang')->select('id', 'nama_sub_bidang')->where('sub_bidang.bidang_id', $jabatan_asn->bidang_id)->get();
            $jabatan_selected = DB::table('opd_jabatan')->select('opd_jabatan.id', 'jabatan.nama')->join('jabatan', 'jabatan.id', '=', 'opd_jabatan.id_jabatan')->where('opd_jabatan.sub_bidang_id', $jabatan_asn->sub_bidang_id)->get();
        }
        else {
            $sub_bagian_selected = "";
            $jabatan_selected = "";
        }
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'biodata' => $biodata,
			'kabupaten' => $kabupaten,
			'kecamatan' => $kecamatan,
			'opd' =>$opd,
			'bidang' => $bidang,
            'jabatan_asn' => $jabatan_asn,
            'sub_bagian_selected' => $sub_bagian_selected,
            'jabatan_selected' => $jabatan_selected
		], 200);

    }

    public function store(Request $request){
    	// dd($request->json());
    	// echo $request->id;
    	$db = Biodata_asn::where('id', $request->id)->first();
    	$db->nama = $request->nama;
    	$db->nip = $request->nip;
    	$db->tempat_lahir = $request->tempat_lahir;
    	$db->tgl_lahir = $request->tgl_lahir;
    	$db->email = $request->email;
    	$db->no_hp = $request->no_hp;
    	$db->jenis_kelamin = $request->jenis_kelamin;
    	$db->agama = $request->agama;
    	$db->gol_darah = $request->gol_darah;
    	$db->alamat = $request->alamat;
    	$db->rt = $request->rt;
    	$db->rw = $request->rw;
    	$db->kecamatan = $request->kecamatan;
    	$db->save();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
		],200);
    }
}
