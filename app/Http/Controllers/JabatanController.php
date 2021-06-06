<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opd_jabatan;
use App\Models\Bidang;
use App\Models\Jabatan;
use DB;

class JabatanController extends Controller
{
    //
	public function index(){
		$jabatan = DB::table('jabatan')->select('jabatan.id', 'jabatan.nama', 'jabatan.ikhtisar', DB::raw('count(jabatan_tugas.id) as tugas_jabatan'))->leftJoin('jabatan_tugas', 'jabatan_tugas.id_jabatan', '=', 'jabatan.id')->groupBy('jabatan.id', 'jabatan.nama', 'ikhtisar')->get();
    	    	// dd($jabatan);
		return view('jabatan/index', compact('jabatan'));
	}

	public function store(Request $request){
		$db = new Jabatan;
		$db->id = $this->autocode('JBT');
		$db->nama = $request->nama;
		$db->ikhtisar = $request->ikhtisar;
		$db->save();
		return back();
	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}


}
