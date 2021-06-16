<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat_tugas;
use DB;

class SuratTugasController extends Controller
{
    //
	public function index(){
		$surat_tugas = DB::table('surat_tugas')->select('surat_tugas.id', 'surat_tugas.nomor', DB::raw('count(tugas.id) as jumlah_tugas'), DB::raw('count(tugas_asn.id) as jumlah_asn'))->leftJoin('tugas', 'tugas.id_surat', '=', 'surat_tugas.id')->leftJoin('tugas_asn', 'tugas_asn.id_surat', '=', 'surat_tugas.id')->groupBy('surat_tugas.id', 'surat_tugas.nomor')->get();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'surat_tugas' => $surat_tugas
		], 200);
	}

	public function store(Request $request){
		$db = new Surat_tugas;
		$db->id = $this->autocode('STG');
		$db->nomor = $request->nomor;
		$db->id_opd = $request->id_opd;
		$db->status = $request->status;
		$db->upload_berkas  = $request->upload_berkas;
		$db->username = $request->username;
		$db->save();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
		], 200);

	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}  


}
