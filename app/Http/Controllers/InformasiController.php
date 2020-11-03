<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\InformasiModel;

use App\Http\Resources\InformasiResourceCollection;
use App\Http\Resources\InformasiJsonResource;

class InformasiController extends Controller
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
        return new InformasiResourceCollection(
            InformasiModel::paginate()
        ); // untuk data banyak
     
    }

    public function show($id)
    {
        return (new InformasiJsonResource(InformasiModel::findOrFail($id)))    
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
