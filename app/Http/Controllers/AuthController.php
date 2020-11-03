<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResourceCollection;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function index()
    {
    	
        // metode 1
        return new UserResourceCollection(
            User::paginate(2)
        ); // untuk data banyak
     
    }

	public function login(UserLoginRequest $request) {

		// dd($request->cookies);

        if($request->callback == 'unauthorized') {
            return response()->json([ 'message' => 'Maaf akun ini tidak tersedia X !!' ], 422);
        }

		$token = (\Session::get('token'));

		return (new UserResource(auth()->user()))
			->additional([
				'meta' => [
					'token' => $token,
					'exp'	=> config('jwt.ttl'),
				],
			])
	        ->response()
	        ->withCookie(
	            'token', 
	            auth()->getToken()->get(), 
	            config('jwt.ttl'), 
	            '/'
	        );		
	}

	public function user(Request $request) {

		$user = \JWTAuth::getPayload(\JWTAuth::getToken());
		$timeup = strtotime($user['expired_at']) - strtotime(date('Y-m-d H:i:s'));

		// return \Carbon\Carbon::parse($user['exp'])->format('Y-m-d H:i:s'); //->diffForHumans();
		// return date('Y-m-d H:i:s', $user['exp'])->diffForHumans();

		return (new UserResource($request->user()))
			->additional([
				'meta' => [
	                'logged'    => \Auth::check(),
	                'role'      => \Auth::check() ? \Auth::user()->peran : null,
	                'exp'		=> config('jwt.ttl'),
	                'timeup'	=> $timeup,
				],
			]);
	}

	public function logout() {
		auth()->logout();
	}
}
