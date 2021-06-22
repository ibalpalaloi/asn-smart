<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

class CekBiodata
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $biodata = DB::table('biodata_asn')->select('biodata_asn.*', 'asn.id as id_asn', 'kecamatan.id as id_kecamatan', 'kecamatan.nama as kecamatan', 'kabupaten_kota.id as id_kab', 'kabupaten_kota.nama as kabupaten')->join('asn', 'asn.biodata_asn_id', '=', 'biodata_asn.id')->join('users', 'users.nip', '=', 'asn.nip')->join('kecamatan', 'kecamatan.id', '=', 'biodata_asn.kecamatan')->join('kabupaten_kota', 'kabupaten_kota.id', '=', 'kecamatan.kabupaten_kota_id')->where('users.id', $user->id)->first();
        if ($biodata) {
            return $next($request);            
        }
        else {
            return response()->json([
                'message' => "Data tidak berhasil",
                'status' => 403,
            ],403);         

        }
    }
}
