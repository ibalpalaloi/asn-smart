<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OPDController extends Controller
{
    //
    public function data_opd(){
		$opd = DB::table('opd')->select()->get();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'opd' => $opd
		], 200);

    }
}
