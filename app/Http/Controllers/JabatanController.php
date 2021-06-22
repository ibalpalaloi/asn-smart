<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opd_jabatan;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Jabatan_tugas;
use DB;

class JabatanController extends Controller
{
    //
	public function index(){
		// $jabatan = DB::table('jabatan')->select('jabatan.id', 'jabatan.nama', 'jabatan.ikhtisar', DB::raw('count(jabatan_tugas.id) as tugas_jabatan'))->leftJoin('jabatan_tugas', 'jabatan_tugas.id_jabatan', '=', 'jabatan.id')->groupBy('jabatan.id', 'jabatan.nama', 'ikhtisar')->get();
		$jabatan = Jabatan::all();
		// dd($jabatan[1]->jabatan_tugas);
    	    	// dd($jabatan);
		return view('jabatan/index', compact('jabatan'));
	}

	public function store(Request $request){
		$db = new Jabatan;
		$db->id = $this->autocode('JBT');
		$db->nama = $request->nama;
		$db->ikhtisar = $request->ikhtisar;
		$db->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil ditambah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
	}

	public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}

	public function get_jabatan($id){
		$jabatan = Jabatan::where('id', $id)->first();
		return response()->json(array('jabatan'=> $jabatan));
	}

	public function update(Request $request){
		// dd($request);
		$jabatan = Jabatan::find($request->id_jabatan);
		$jabatan->nama = $request->nama;
		$jabatan->ikhtisar =$request->ikhtisar;
		$jabatan->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil diubah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);     
	}

	public function delete(Request $request){
		// Jabatan::find($request->id)->delete();
		// return back();
        $jabatan = Jabatan_tugas::where('jabatan_id', $request->id)->first();
        if ($jabatan){
            $notification = array(
                'message' => 'Silahkan hapus data jabatan tugas terlebih dahulu',
                'color' => "#dc3545",
                'icon' => "fas fa-times-circle",
                'header' => "Gagal",
                'kode-notif' => 403
            ); 
            return back()->with($notification);                 
        }
        else {
            Jabatan::find($request->id)->delete();
            $notification = array(
                'kode-notif' => 'berhasil',
                'message' => 'Data berhasil dihapus',
                'color' => "#28a745",
                'icon' => "fas fa-check-circle",
                'header' => "Berhasil"
            ); 
            return back()->with($notification);                 
        }


	}

}
