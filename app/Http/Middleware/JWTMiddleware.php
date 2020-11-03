<?php
namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTMiddleware
{

    public function handle($request, \Closure $next, $guard = null)
    {
        if (!$token = JWTAuth::getToken()) {
            // return response()->json(['token' => 'token_not_provided'], 200); // 400
            
            return response()
                ->json('token_not_provided')
                ->header('Content-Type', 'application/json')
                ->setStatusCode(200);     
            //exit;   
        }

        try {

            $user = JWTAuth::authenticate($token);
            // $authuser = JWTAuth::toUser(JWTAuth::getToken());
            // $user = JWTAuth::parseToken()->authenticate();
            // $payload = JWTAuth::parseToken()->getPayload();

            if (!$user) {

                return response()
                    ->json('invalid_credentials')
                    ->header('Content-Type', 'application/json')
                    ->setStatusCode(200);      
                //exit;        
            }

            $response = $next($request);
   
            return $response;
            
        } catch (JWTException $e) {

            return response()
                ->json('could_not_create_token')
                ->header('Content-Type', 'application/json')
                ->setStatusCode(200);
            exit;

        } catch (TokenExpiredException $e) {

            return response()
                ->json('token_expired')
                ->header('Content-Type', 'application/json')
                ->setStatusCode(200);
            exit;

        } catch (TokenInvalidException $e) {

            return response()
                ->json('token_invalid')
                ->header('Content-Type', 'application/json')
                ->setStatusCode(200);        
            exit;

        } catch (JWTException $e) {

            return response()
                ->json('token_absent')
                ->header('Content-Type', 'application/json')
                ->setStatusCode(200);         
            exit;
        }
    }

    public function terminate($request, $response)
    {
        return "protocol clear";
    }
}
