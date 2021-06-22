<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat_tugas;
use App\Models\Tugas;
use App\Models\Tugas_asn;
use DB;

class SuratTugasController extends Controller
{
    //
	public function index(){
		$surat_tugas = DB::table('surat_tugas')->select('surat_tugas.id', 'surat_tugas.nomor', DB::raw('count(tugas.id) as jumlah_tugas'), DB::raw('count(tugas_asn.id) as jumlah_asn'))->leftJoin('tugas', 'tugas.surat_tugas_id', '=', 'surat_tugas.id')->leftJoin('tugas_asn', 'tugas_asn.surat_id', '=', 'surat_tugas.id')->groupBy('surat_tugas.id', 'surat_tugas.nomor')->get();
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

	public function tugas_surat_tugas(Request $request){
		$data_tugas = Tugas::where('surat_tugas_id', $request->id_surat)->get();
		$tugas = array();
		$i=0;
		foreach($data_tugas as $data){
			$tugas[$i]['id'] = $data->id;
			$tugas[$i]['nama'] = $data->nama;
			$i++;
		}
		return response()->json([
			'message' => "Behasil",
			'status' => 200,
			'tugas' => $tugas
		], 200);
	}

	public function tambah_tugas_surat_tugas(Request $request){
		$tugas = new Tugas;
		$tugas->id = $this->autocode('TGS');
		$tugas->nama = $request->tugas;
		$tugas->surat_tugas_id = $request->id_surat_tugas;
		$tugas->save();

		return response()->json([
			'message' => "Behasil",
			'status' => 200,
		], 200);
	}

	public function hapus_tugas_surat_tugas(Request $request){
		Tugas::find($request->id_tugas)->delete();
		return response()->json([
			'message' => "Behasil",
			'status' => 200,
		], 200);
	}

	public function ubah_tugas_surat_tugas(Request $request){
		$tugas = Tugas::find($request->id_tugas);
		if(empty($tugas)){
			return response()->json([
				'message' => "id tidak ditemukan",
				'status' => 200,
			], 200);
		}
		$tugas->nama = $request->tugas;
		$tugas->save();
		return response()->json([
			'message' => "Behasil",
			'status' => 200,
		], 200);
	}

	public function asn_bertugas($id){
		$asn = Tugas_asn::where('surat_id', $id)->get();
		$data_asn = array();
		$i=0;
		foreach($asn as $data){
			$data_asn[$i]['id'] = $data->id;
			$data_asn[$i]['nama'] = $data->asn->biodata_asn->nama;
			$data_asn[$i]['bidang'] = $data->asn->jabatan_asn->opd_jabatan->bidang->nama_bidang;
			$data_asn[$i]['sub_bidang'] = $data->asn->jabatan_asn->opd_jabatan->sub_bidang->nama_sub_bidang;
			$i++;
		}
		return response()->json([
			'message' => "Behasil",
			'status' => 200,
			'asn' => $data_asn
		], 200);
	}
}
