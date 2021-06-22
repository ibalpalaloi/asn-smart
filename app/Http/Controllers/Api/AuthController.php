<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    //
	public function post_login(Request $request){
		$user = User::where('nip', $request->nip)->first();
		if (!$user || !Hash::check($request->password, $user->password)){
			return response()->json([
				'message' => 'UNAUTHRIZATION',
				'status' => 401,
			], 401);
		}
		$token = $user->createToken('token-name')->plainTextToken;

		return response()->json([
			'message' => 'success',
			'status' => 200,
			'user' => $user,
			'nama' => $user->name,	
			'token' => $token,
		],200);
	}

	public function logout(Request $request){
		$user = $request->user();
		$user->currentAccessToken()->delete();

		// $user = $request->user();
		// id user 106
		// $user->currentAccessToken()->id;
		// Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
		// $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
		return response()->json([
			'message' => "Berhasil logout",
			'status' => 200,
		], 200);
	}
}
