<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\BrosurRequest;

use Illuminate\Http\Request;

use App\BrosurModel;
use App\ViewBrosurModel;

use App\Http\Resources\BrosurResourceCollection;
use App\Http\Resources\BrosurJsonResource;

class BrosurController extends Controller
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
        return new BrosurResourceCollection(
            BrosurModel::paginate()
        ); // untuk data banyak
     
    }

    public function peta_tanggal($tanggal)
    {

        return new BrosurResourceCollection(
            ViewBrosurModel::where('created_at', $tanggal)->get()
        ); // untuk data banyak
     
    }    

    public function formulir(BrosurRequest $request)
    {

        if($request->callback == 'unauthorized') {
            return response()->json([ 'message' => 'Maaf akun ini tidak tersedia X !!' ], 422);
        }

        $faker = \Faker\Factory::create();

        $uuid = request()->uuid;
        $uuid = $uuid ? $uuid : $faker->uuid;

        $form_warga = [
            'uuid'                  => $uuid,
            'user_id'             => \Auth::user()->id,
            'alamat_jalan'          => request()->alamat_jalan,
            'alamat_nomor'          => request()->alamat_nomor,
            'alamat_rt'             => request()->alamat_rt,
            'alamat_rw'             => request()->alamat_rw,
            'alamat_kelurahan'      => request()->alamat_kelurahan,
            'alamat_kecamatan'      => request()->alamat_kecamatan,
            'catatan'               => request()->catatan,
            'geolocation'           => request()->geolocation,
            'brosur_kondisi'       => request()->brosur_kondisi,
            'brosur_respon'        => request()->brosur_respon,
        ];

        $table_warga = BrosurModel::updateOrCreate(
            [ 'uuid'  => $uuid ],
            $form_warga
        ); // hasilnya true

        // untuk data single <new WargaJsonResource(BrosurModel::first())>
        return (new BrosurJsonResource(BrosurModel::whereUuid($uuid)->first()))    
            ->additional([
                'meta' => [
                    'logged'    => \Auth::check(),
                    'role'      => \Auth::check() ? \Auth::user()->peran : null,
                    'exp'       => config('jwt.ttl'),
                    'timeup'    => $this->timeup,
                ],
            ]);
    }

    public function show($id)
    {
        return (new BrosurJsonResource(BrosurModel::findOrFail($id)))    
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
