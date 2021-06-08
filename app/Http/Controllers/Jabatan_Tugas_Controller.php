<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan_tugas;
use App\Models\Jabatan;
use DB;

class Jabatan_Tugas_Controller extends Controller
{
    //
    public function index($id){
    	$jabatan = DB::table('jabatan')->where('id', $id)->first();
    	$jabatan_tugas = Jabatan_tugas::where('id_jabatan', $id)->get();
 		return view('jabatan_tugas/index', compact('jabatan_tugas', 'jabatan'));   	
    }

	public function store(Request $request){
		$db = new Jabatan_tugas;
		$db->id = $this->autocode('JTG');
		$db->uraian = $request->uraian;
		$db->id_jabatan = $request->id_jabatan;
		$db->save();
		return back();
	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}

	public function get_uraian($id){
		$jabatan_tugas = Jabatan_tugas::find($id);
		return response()->json(array('jabatan_tugas'=> $jabatan_tugas));
	}

	public function ubah_uraian(Request $request){
		$uraian = Jabatan_tugas::find($request->id_uraian);
		$uraian->uraian = $request->uraian;
		$uraian->save();
		return back();
	}

	public function hapus_uraian($id){
		Jabatan_tugas::find($id)->delete();
		return back();
	}

}
