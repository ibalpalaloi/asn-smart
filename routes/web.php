<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\SuperAdmin_DataUser_Controller;
use App\Http\Controllers\Admin_Asn_Controller;
use App\Http\Controllers\Admin_Struktur_Opd_Controller;
use App\Http\Controllers\Jabatan_Opd_Controller;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\Jabatan_Tugas_Controller;
use App\Http\Controllers\GetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', function(){ 
    return view('auth.login');
})->name('login');

Route::post('post_login', [AuthController::class, 'post_login'])->name('post_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    // dashboard
    Route::get('dashboard', [Dashboard_Controller::class, 'dashboard'])->name('dashboard');

    // data admin
    Route::get('data_admin', [SuperAdmin_DataUser_Controller::class, 'data_admin'])->name('data_admin');
    Route::get('tambah_user', [SuperAdmin_DataUser_Controller::class, 'tambah_user'])->name('tambah_user');
    Route::post('simpan_data_admin', [SuperAdmin_DataUser_Controller::class, 'simpan_data_admin'])->name('simpan_data_admin');

    // data asn
    Route::get('data_asn', [Admin_Asn_Controller::class, 'data_asn'])->name('data_asn');
    Route::get('tambah_asn', [Admin_Asn_Controller::class, 'tambah_asn'])->name('tambah_asn');
    Route::post('/post_tambah_asn', [Admin_Asn_Controller::class, 'post_tambah_asn'])->name('post_tambah_asn');

    // Struktur
    // Route::post('bidang/select_bidang', [Admin_Struktur_Opd_Controller::class, 'select_bidang']);
    Route::get('struktur', [Admin_Struktur_Opd_Controller::class, 'bidang'])->name('struktur-bidang');

    // Sturktur - Bidang
    Route::post('struktur/post-delete-bidang', [Admin_Struktur_Opd_Controller::class, 'hapus_bidang']);
    Route::post('struktur/post-ubah-bidang', [Admin_Struktur_Opd_Controller::class, 'ubah_bidang']);
    Route::post('struktur/post-tambah-bidang', [Admin_Struktur_Opd_Controller::class, 'tambah_bidang']);

    // Sturktur - Sub Bidang
    Route::post('struktur/post-delete-sub-bidang', [Admin_Struktur_Opd_Controller::class, 'hapus_sub_bidang']);
    Route::post('struktur/post-ubah-sub-bidang', [Admin_Struktur_Opd_Controller::class, 'ubah_sub_bidang']);
    Route::post('struktur/post-tambah-sub-bidang', [Admin_Struktur_Opd_Controller::class, 'tambah_sub_bidang']);

    // jabatan opd
    Route::get('/daftar_jabatan_opd', [Jabatan_Opd_Controller::class, 'daftar_jabatan_opd'])->name('daftar_jabatan_opd');
    Route::get('/hapus_opd_jabatan/{id}', [Jabatan_Opd_Controller::class, 'hapus_opd_jabatan']);

    // jabatan tugas
    Route::post('/jabatan/{id}/tugas/store', [Jabatan_Tugas_Controller::class, 'store']);
    Route::get('/jabatan/{id}/tugas', [Jabatan_Tugas_Controller::class, 'index']);

    Route::get('/get_uraian/{id}', [Jabatan_Tugas_Controller::class, 'get_uraian'])->name('get_uraian_tugas');
    Route::post('/ubah_uraian', [Jabatan_Tugas_Controller::class, 'ubah_uraian'])->name('ubah_uraian');
    Route::get('/hapus_uraian/{id}', [Jabatan_Tugas_Controller::class, 'hapus_uraian'])->name('hapus_uraian');

    // jabatan 
    Route::post('/jabatan/delete', [JabatanController::class, 'delete']);
    Route::post('/jabatan/update', [JabatanController::class, 'update']);
    Route::post('/jabatan/store', [JabatanController::class, 'store']);
    Route::get('/jabatan', [JabatanController::class, 'index']);


    Route::post('/post_opd_jabatan', [Jabatan_Opd_Controller::class, 'post_opd_jabatan']);
    Route::get('/jabatan/{id}', [JabatanController::class, 'get_jabatan']);
    Route::get('/hapus_jabatan/{id}', [JabatanController::class, 'hapus_jabatan'])->name('hapus_jabatan');

    // Get
    Route::get('/get_sub_bidang/{id}', [GetController::class, 'get_sub_bidang'])->name('get_sub_bidang');
    Route::get('/get_jabatan_sub_bidang/{id}', [GetController::class, 'get_jabatan_sub_bidang'])->name('get_jabatan_sub_bidang');
    Route::get('/get_detail_asn/{id}', [GetController::class, 'get_detail_asn'])->name('get_detail_asn');
});

