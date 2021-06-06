<?php

namespace App\Http\Controllers\Api\ClientSmartAsn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class BiodataController extends Controller
{
    //
    public function index(Request $request){
		$user = $request->user();
		$biodata = DB::table('biodata_asn')->select('biodata_asn.*')->join('asn', 'asn.biodata_asn_id', '=', 'biodata_asn.id')->join('users', 'users.nip', '=', 'asn.nip')->where('users.id', $user->id)->first();
		// dd($user);
		// $user->currentAccessToken()->delete();
		return response()->json([
			'message' => "Data berhasil",
			'status' => 200,
			'biodata' => $biodata,
		], 200);

    }
}
