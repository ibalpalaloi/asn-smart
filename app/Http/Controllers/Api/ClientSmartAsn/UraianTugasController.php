<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Uraian_tugas;
use DB;

class UraianTugasController extends Controller
{
    //
    public function index(Request $request){
		$user = $request->user();
		$asn = DB::table('opd_jabatan')->select('opd_jabatan.id_jabatan', 'asn.id as id_asn')->join('jabatan_asn', 'jabatan_asn.id_jabatan', '=', 'opd_jabatan.id')->join('asn', 'asn.id', '=', 'jabatan_asn.id_asn')->where('nip', $user->nip)->first();
		$jabatan_tugas = DB::table('jabatan_tugas')->select('id','uraian')->where('id_jabatan', $asn->id_jabatan)->get();
		$bulan_now = intval(date('m'));
		$tahun_now = date('Y');

		$uraian_tugas = DB::table('uraian_tugas')->select('tanggal', DB::raw('count(tanggal) as jumlah_tugas'))->groupBy('tanggal')->where('id_asn', $asn->id_asn)->where(DB::raw('month(tanggal)'), $bulan_now)->where(DB::raw('year(tanggal)'), $tahun_now)->get();
		$tanggal = DB::table('uraian_tugas')->select(DB::raw('year(tanggal) as tahun'))->where('id_asn', $asn->id_asn)->orderBy('tahun', 'desc')->distinct()->get();
		// $uraian_tugas = $asn->id_asn;
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			// 'asn' => $asn
			'jabatan_tugas' => $jabatan_tugas,
			'uraian_tugas'=>$uraian_tugas,
			'tanggal' => $tanggal
		], 200);
    }

	public function store(Request $request){
		$user = $request->user();
		$asn = DB::table('opd_jabatan')->select('opd_jabatan.id_jabatan', 'asn.id as id_asn')->join('jabatan_asn', 'jabatan_asn.id_jabatan', '=', 'opd_jabatan.id')->join('asn', 'asn.id', '=', 'jabatan_asn.id_asn')->where('nip', $user->nip)->first();
    	$db = new Uraian_tugas;
    	$db->id = $this->autocode('URT');
    	$db->tanggal = $request->tanggal;
    	$db->waktu_mulai = $request->waktu_mulai;
    	$db->waktu_akhir = $request->waktu_akhir;
    	$db->kategori_tugas = $request->kategori_tugas; 
    	$db->uraian_tugas = $request->uraian_tugas;
    	$db->id_asn = $asn->id_asn;
    	$db->save();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
		],200);
	}

	public function update(Request $request){
		$user = $request->user();
		$asn = DB::table('opd_jabatan')->select('opd_jabatan.id_jabatan', 'asn.id as id_asn')->join('jabatan_asn', 'jabatan_asn.id_jabatan', '=', 'opd_jabatan.id')->join('asn', 'asn.id', '=', 'jabatan_asn.id_asn')->where('nip', $user->nip)->first();
    	$db = Uraian_tugas::where('id', $request->id)->first();
    	$db->tanggal = $request->tanggal;
    	$db->waktu_mulai = $request->waktu_mulai;
    	$db->waktu_akhir = $request->waktu_akhir;
    	$db->kategori_tugas = $request->kategori_tugas; 
    	$db->uraian_tugas = $request->uraian_tugas;
    	$db->save();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
		],200);
	}

	public function delete(Request $request){
		Uraian_tugas::find($request->id)->delete();
		return response()->json([
			'message' => "Data berhasil dihapus",
			'status' => 200,
		],200);
	}


	public function detail($tanggal, Request $request){
		$user = $request->user();
		$asn = DB::table('opd_jabatan')->select('opd_jabatan.id_jabatan', 'asn.id as id_asn')->join('jabatan_asn', 'jabatan_asn.id_jabatan', '=', 'opd_jabatan.id')->join('asn', 'asn.id', '=', 'jabatan_asn.id_asn')->where('nip', $user->nip)->first();
		$jabatan_tugas = DB::table('jabatan_tugas')->select('id','uraian')->where('id_jabatan', $asn->id_jabatan)->get();
		$detail_tugas = DB::table('uraian_tugas')->select()->where('id_asn', $asn->id_asn)->where('tanggal', $tanggal)->orderBy('waktu_mulai', 'asc')->get();
		// $uraian_tugas = $asn->id_asn;
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'jabatan_tugas' => $jabatan_tugas,
			'detail_tugas'=>$detail_tugas,
		], 200);		
	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}

	public function filter_tahun($bulan, $tahun, Request $request){
		$user = $request->user();
		$asn = DB::table('opd_jabatan')->select('opd_jabatan.id_jabatan', 'asn.id as id_asn')->join('jabatan_asn', 'jabatan_asn.id_jabatan', '=', 'opd_jabatan.id')->join('asn', 'asn.id', '=', 'jabatan_asn.id_asn')->where('nip', $user->nip)->first();
		$jabatan_tugas = DB::table('jabatan_tugas')->select('id','uraian')->where('id_jabatan', $asn->id_jabatan)->get();
		$uraian_tugas = DB::table('uraian_tugas')->select('tanggal', DB::raw('count(tanggal) as jumlah_tugas'))->groupBy('tanggal')->where('id_asn', $asn->id_asn)->where(DB::raw('month(tanggal)'), $bulan)->where(DB::raw('year(tanggal)'), $tahun)->get();
		$tanggal = DB::table('uraian_tugas')->select(DB::raw('year(tanggal) as tahun'))->where('id_asn', $asn->id_asn)->orderBy('tahun', 'desc')->distinct()->get();
		// $uraian_tugas = $asn->id_asn;
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'jabatan_tugas' => $jabatan_tugas,
			'uraian_tugas'=>$uraian_tugas,
			'tanggal' => $tanggal
		], 200);

	}
}
