<?php
namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function post_login(Request $request){
        Validator::make($request->all(), [
            'nip' => 'required',
            'password' => 'required',
        ])->validate();

        if(Auth::attempt(['nip' => $request->nip, 'password' => $request->password])){
            return redirect()->route('dashboard');
        }else{
            dd('gagal');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
