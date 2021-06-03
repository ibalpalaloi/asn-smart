<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Opd;
use App\Models\Opd_user;

use Illuminate\Http\Request;

class SuperAdmin_DataUser_Controller extends Controller
{
    //
    public function data_admin(){
        $user = User::where('roles', 'admin')->get();
        $opd = Opd::all();
        $data_user;
        $data_opd;
        $i = 0;
        foreach($user as $data){
            $data_user[$i]['nama'] = $data->name;
            $data_user[$i]['nip'] = $data->nip;
            $data_user[$i]['role'] = $data->roles;
            $data_user[$i]['opd'] = $data->opd_user->opd->nama_opd;
            $i++;
        }

        $i = 0;
        foreach($opd as $data){
            $data_opd[$i]['id'] = $data->id;
            $data_opd[$i]['nama'] = $data->nama_opd;
            $i++;
        }
        return view('data_user.data_user', compact('data_user', 'data_opd'));
    }

    public function simpan_data_admin(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'password' => 'required',
            'id_opd' => 'required',
        ]);

        $user = new User;
        $user->name = $request->nama;
        $user->nip = $request->nip;
        $user->password = bcrypt($request->password);
        $user->roles = "admin";
        $user->save();

        $opd_user = new Opd_user;
        $opd_user->user_id = $user->id;
        $opd_user->opd_id = $request->id_opd;
        $opd_user->save();

        return redirect()->route('data_admin');
    }
}
