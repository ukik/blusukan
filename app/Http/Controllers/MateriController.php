<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\MateriModel;

use App\Http\Resources\MateriResourceCollection;
use App\Http\Resources\MateriJsonResource;

class MateriController extends Controller
{

    private $timeup = null;

    public function __construct() {

        $token = (\JWTAuth::getToken());

        if($token) {
            $user = \JWTAuth::getPayload(\JWTAuth::getToken());
            $this->timeup = strtotime($user['expired_at']) - strtotime(date('Y-m-d H:i:s'));        
        }
    }

    public function index()
    {

        // return MateriModel::paginate();

        // metode 1
        return new MateriResourceCollection(
            MateriModel::paginate()
        ); // untuk data banyak
     
    }

    public function show($id)
    {
        return (new MateriJsonResource(MateriModel::findOrFail($id)))    
            ->additional([
                'meta' => [
                    'logged'    => \Auth::check(),
                    'role'      => \Auth::check() ? \Auth::user()->peran : null,
                    'exp'       => config('jwt.ttl'),
                    'timeup'    => $this->timeup,
                ],
            ]);
    }

}
