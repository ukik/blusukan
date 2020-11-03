<?php

namespace App\Policies;

// use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

// use App\Exceptions\JobUnitNotAvailableException;
use Illuminate\Auth\Access\AuthorizationException;

class AuthPolicy {
	use HandlesAuthorization;

	public function __construct() {
		//
	}

	public function view(User $user)
	{
	    return false;
	}

	public function before($user, $ability,Request $request)
	{
	    // if (!yourconditiontrue) {
	         if ($request->ajax()) {
	            return response('Unauthorized.', 401);
	        } else {
	            return abort('403');
	        }
	    // }
	}	

	protected function deny( $message = 'Jobs Unit Not Available' )
	{
	    // dd('ok');
	    throw new AuthorizationException( $message );
	}

	// public function update(User $user, Post $post) {
	// 	return $user->ownsPost($post);
	// }

	// public function destroy(User $user, Post $post) {
	// 	return $user->ownsPost($post);
	// }

	// public function like(User $user, Post $post) {
	// 	return !$user->ownsPost($post);
	// }
}
