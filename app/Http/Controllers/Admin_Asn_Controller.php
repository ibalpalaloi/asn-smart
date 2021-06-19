<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata_asn;
use App\Models\Bidang;
use App\Models\Asn;
use App\Models\Jabatan_asn;

class Admin_Asn_Controller extends Controller
{
    //

    public function autocode($kode){
		$timestamp = time(); 
		$random = rand(10, 100);
		$current_date = date('mdYs'.$random, $timestamp); 
		return $kode."-".$current_date;
	}

    public function data_asn(){
        $asn = Asn::where('opd_id', Auth()->user()->opd_user->opd_id)->get();
        $data_asn = array();
        $i = 0;
        foreach($asn as $data){
            $data_asn[$i]['id_asn'] = $data->id;
            $data_asn[$i]['nama'] = $data->biodata_asn->nama;
            $data_asn[$i]['nip'] = $data->nip;
            $data_asn[$i]['jenis_kelamin'] = $data->biodata_asn->jenis_kelamin;
            $data_asn[$i]['tgl_lahir'] = $data->biodata_asn->tgl_lahir;
            $i++;
        }
        return view('asn.data_asn', compact('data_asn'));
    }

    public function tambah_asn(){
        $bidang = Bidang::all();
        return view('asn.tambah_asn', compact('bidang'));
    }

    public function post_tambah_asn(Request $request){
        $biodata = new Biodata_asn;
        $biodata->id = $this->autocode('BIO');
        $biodata->nama = $request->nama;
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tgl_lahir = $request->tgl_lahir;
        $biodata->alamat = $request->alamat;
        $biodata->rt = $request->rt;
        $biodata->rw = $request->rw;
        $biodata->kelurahan =  $request->kelurahan;
        $biodata->kecamatan = $request->kecamatan;
        $biodata->no_hp = $request->no_hp;
        $biodata->email = $request->email;
        $biodata->nip = $request->nip;
        $biodata->agama = $request->agama;
        $biodata->gol_darah = $request->gol_darah;
        $biodata->save();

        $asn = new Asn;
        $asn->id = $this->autocode('ASN');
        $asn->biodata_asn_id = $biodata->id;
        $asn->nip = $request->nip;
        $asn->opd_id = Auth()->user()->opd_user->opd_id;
        $asn->save();

        $jabatan_asn = new Jabatan_asn;
        $jabatan_asn->id = $this->autocode('JBT_ASN');
        $jabatan_asn->opd_jabatan_id = $request->jabatan;
        $jabatan_asn->id_asn = $asn->id;
        $jabatan_asn->save();

        return redirect('/data_asn');
    }
}
