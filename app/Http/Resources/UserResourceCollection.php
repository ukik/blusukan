<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\UserResource as UserJsonResource;

use Tymon\JWTAuth\Facades\JWTAuth;

class UserResourceCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => UserJsonResource::collection($this->collection),
            // 'links' => [
            //     'self' => 'link-value',
            // ],            
        ];
    }

    public function with($request)
    {

        $timeup = null;
        
        if(\Auth::check()) {
            $token = (\JWTAuth::getToken());
            $user = \JWTAuth::getPayload(\JWTAuth::getToken());
            $timeup = strtotime($user['expired_at']) - strtotime(date('Y-m-d H:i:s'));    
        }

        return [
            'meta' => [
                // 'key'       => 'top-level',
                'logged'    => \Auth::check(),
                'role'      => \Auth::check() ? \Auth::user()->peran : null,
                'exp'       => config('jwt.ttl'),
                'timeup'    => $timeup,                
            ],
        ];
    }    
}