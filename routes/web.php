<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\SuperAdmin_DataUser_Controller;
use App\Http\Controllers\Admin_Asn_Controller;
use App\Http\Controllers\Admin_Struktur_Opd_Controller;
use App\Http\Controllers\Jabatan_Opd_Controller;

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

    // Struktur
    Route::get('bidang', [Admin_Struktur_Opd_Controller::class, 'bidang'])->name('struktur-bidang');
    Route::post('/post_tambah_sub_bidang', [Admin_Struktur_Opd_Controller::class, 'post_tambah_sub_bidang']);
    Route::post('/post_ubah_bidang', [Admin_Struktur_Opd_Controller::class, 'post_ubah_bidang']);
    Route::post('/post_ubah_sub_bidang', [Admin_Struktur_Opd_Controller::class, 'post_ubah_sub_bidang']);
    Route::get('/hapus_sub_bidang/{id}', [Admin_Struktur_Opd_Controller::class, 'hapus_sub_bidang'])->name('hapus_sub_bidang');
    Route::get('/hapus_bidang/{id}', [Admin_Struktur_Opd_Controller::class, 'hapus_bidang'])->name('hapus_bidang');
    Route::post('/post_tambah_bidang/{id}', [Admin_Struktur_Opd_Controller::class, 'tambah_bidang']);

    // jabatan opd
    Route::get('/daftar_jabatan', [Jabatan_Opd_Controller::class, 'daftar_jabatan'])->name('daftar_jabatan');
    Route::post('/post_opd_jabatan', [Jabatan_Opd_Controller::class, 'post_opd_jabatan']);
});

