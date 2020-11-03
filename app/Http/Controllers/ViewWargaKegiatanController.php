<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ViewWargaKegiatanModel;

use App\Http\Resources\ViewWargaKegiatanResourceCollection;
use App\Http\Resources\ViewWargaKegiatanJsonResource;

class ViewWargaKegiatanController extends Controller
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

        // metode 1
        return new ViewWargaKegiatanResourceCollection(
            ViewWargaKegiatanModel::paginate()
        ); // untuk data banyak
     
    }

    public function show($id)
    {
        return (new ViewWargaKegiatanJsonResource(ViewWargaKegiatanModel::findOrFail($id)))    
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
