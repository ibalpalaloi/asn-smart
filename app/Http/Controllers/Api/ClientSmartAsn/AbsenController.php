<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AbsenController extends Controller
{
	public function jadwal_absen(Request $request){
		$user = $request->user();
		$id_login = $user->id;
		try {
			$timestamp = time(); 
			$hari = date('D', $timestamp); 
			if ($hari == 'Fri'){
				$jumat = "Ya";				
			}
			else {
				$jumat = "Tidak";								
			}
			// $query['status'] = 200;
			$jadwal = DB::table('jadwal_absens')->select('jam_awal', 'jam_akhir', 'status_absen')->where('status', 'Hadir')->where('jumat', $jumat)->get();

			// cek status absen 
			$timestamp = time();
			$current_date = date('Y-m-d', $timestamp); 			
			$query['data'] = array();
			$i = 0;
			foreach ($jadwal as $row) {
				$status_absen = DB::table('absens')->select('id', 'waktu', 'status')->where('id_login', $id_login)->where('tanggal', $current_date)->where('status_absen', $row->status_absen)->first();
				$query['data'][$i]["jam_awal"] = $row->jam_awal;
				$query['data'][$i]["jam_akhir"] = $row->jam_akhir;
				$query['data'][$i]["status_absen"] = $row->status_absen;
				if ($status_absen){
					$query['data'][$i]["keterangan"] = "$status_absen->status";
					$query['data'][$i]['waktu_absen'] = $status_absen->waktu;
				}
				else {
					$query['data'][$i]["keterangan"] = "belum_absen";					
					$query['data'][$i]['waktu_absen'] = "00:00:00";

				}

				$i++;
			}
			return response()->json([
				'success' => true,
				'data' => $query,
			],200);

		}
		catch (Exception $e){
			return response()->json([
				'success' => false,
				'message' => 'Internal Error',
			], 500);

		}		
	}

}
