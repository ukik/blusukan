<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Access\AuthorizationException;
use Closure;

class CsrfMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
          $request->header('csrf-token') !== auth()->payload()->get('csrf-token')
        ) {
            // throw new AuthorizationException('Akses dari luar situs ditolak !!');
            return response()->json([
                'message'   => 'Akses dari luar situs ditolak !!',
                'errors' => [
                    'csrf' => ['no csrf-token'],
                ],
            ], 403);
            // exit;
        }
        return $next($request);
    }
}