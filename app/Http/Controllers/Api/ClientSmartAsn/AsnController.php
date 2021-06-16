<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asn;
use App\Models\Biodata_asn;
use App\Models\User;
use DB;
use Auth;
use Hash;
use Validator;



class AsnController extends Controller
{
    //
	public function daftar(Request $request){
		$db = new User;
		$db->id = $this->autocode('USR');
		$db->name = $request->nama;
		$db->nip = $request->nip;
		$db->roles = 'asn';
		$db->password = bcrypt($request->password);
		$db->save();


		$db = new Biodata_asn;
		$biodata_asn  = $this->autocode('BDT');
		$db->id = $biodata_asn;
		$db->nama = $request->nama;
		$db->no_hp = $request->nomor_handphone;
		$db->email = $request->email;
		$db->nip = $request->nip;
		$db->save();

		$db = new Asn;
		$db->id = $this->autocode('ASN');
		$db->biodata_asn_id = $biodata_asn;
		$db->nip = $request->nip;
		$db->opd_id = $request->id_opd;
		$db->save();

		return response()->json([
			'message' => 'success',
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
