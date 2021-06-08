<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientSmartAsn\BiodataController;
use App\Http\Controllers\Api\ClientSmartAsn\DaerahController;
use App\Http\Controllers\Api\ClientSmartAsn\JabatanAsnController;
use App\Http\Controllers\Api\ClientSmartAsn\UraianTugasController;
use App\Http\Controllers\Api\ClientSmartAsn\AbsenController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:sanctum'], function(){
	// Absen
	Route::get('/absen/jadwal-absen', [AbsenController::class, 'jadwal_absen']);
	// Uraian Tugas
	Route::post('/uraian-tugas/store', [UraianTugasController::class, 'store']);
	Route::get('/uraian-tugas/{bulan}/{tahun}', [UraianTugasController::class, 'filter_tahun']);
	Route::get('/uraian-tugas/{tanggal}', [UraianTugasController::class, 'detail']);
	Route::get('/uraian-tugas', [UraianTugasController::class, 'index']);

	//Jabatan
	Route::post('/jabatan/update/', [JabatanAsnController::class, 'update']);
	Route::post('/jabatan/store/', [JabatanAsnController::class, 'store']);
	Route::post('/jabatan/select_sub_bidang/', [JabatanAsnController::class, 'select_sub_bidang']);
	Route::post('/jabatan/select_bidang/', [JabatanAsnController::class, 'select_bidang']);


	Route::post('/biodata/store', [BiodataController::class, 'store']);
	Route::post('/biodata/select_kab/', [DaerahController::class, 'select_kab']);
	Route::get('/biodata', [BiodataController::class, 'index']);
	Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/post_login', [AuthController::class, 'post_login']);