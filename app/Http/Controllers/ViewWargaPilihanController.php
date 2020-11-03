<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ViewWargaPilihanModel;

use App\Http\Resources\ViewWargaPilihanResourceCollection;
use App\Http\Resources\ViewWargaPilihanJsonResource;

class ViewWargaPilihanController extends Controller
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
        return new ViewWargaPilihanResourceCollection(
            ViewWargaPilihanModel::paginate()
        ); // untuk data banyak
     
    }

    public function show($id)
    {
        return (new ViewWargaPilihanJsonResource(ViewWargaPilihanModel::findOrFail($id)))    
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
