<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\WargaRequest;

use Illuminate\Http\Request;

use App\WargaAlasanModel;
use App\WargaKegiatanModel;
use App\WargaMinatModel;
use App\WargaModel;

use App\ViewWargaModel;

use App\Http\Resources\WargaResourceCollection;
use App\Http\Resources\WargaJsonResource;

class WargaController extends Controller
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
        return new WargaResourceCollection(
            WargaModel::
                // with(['alasan:id,warga_uuid,pragmatisme'])
                // ->select(['uuid','agama'])
                // ->paginate(100)         
                paginate()
        ); // untuk data banyak
     
    }

    public function peta_tanggal($tanggal)
    {

        return new WargaResourceCollection(
            ViewWargaModel::where('created_at', $tanggal)->get()
        ); // untuk data banyak
     
    }        

    public function formulir(WargaRequest $request)
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
            'nama'                  => request()->nama,
            'kartu_keluarga'        => request()->kartu_keluarga,
            'nik'                   => request()->nik,
            'telepon'               => request()->telepon,
            'whatsapp'              => request()->whatsapp,
            'tempat_lahir'          => request()->tempat_lahir,
            'tanggal_lahir'         => request()->tanggal_lahir,
            'umur'                  => request()->umur,
            'agama'                 => request()->agama,
            'perkawinan'            => request()->perkawinan,
            'kelamin'               => request()->kelamin,
            'alamat_jalan'          => request()->alamat_jalan,
            'alamat_nomor'          => request()->alamat_nomor,
            'alamat_rt'             => request()->alamat_rt,
            'alamat_rw'             => request()->alamat_rw,
            'alamat_kelurahan'      => request()->alamat_kelurahan,
            'alamat_kecamatan'      => request()->alamat_kecamatan,
            'disabilitas'           => request()->disabilitas,
            'nomer_tps'             => request()->nomer_tps,
            'pekerjaan'             => request()->pekerjaan,
            'pilihan'               => request()->pilihan,
            'catatan'               => request()->catatan,
            'geolocation'           => request()->geolocation,
            'antusiasme'            => request()->antusiasme,
        ];

        $table_warga = WargaModel::updateOrCreate(
            [ 'uuid'  => $uuid ],
            $form_warga
        ); // hasilnya true

        WargaAlasanModel::updateOrCreate(
            [ "warga_uuid" => $uuid ],
            [
                'warga_uuid'    => $uuid,
                'idealisme'     => request()->alasan['idealisme'],
                'pragmatisme'   => request()->alasan['pragmatisme'],
            ]
        ); // hasilnya true        

        $form_kegiatan = [
            'warga_uuid'  => $uuid,
            'kegiatan0' => request()->kegiatan['kegiatan0'],
            'kegiatan1' => request()->kegiatan['kegiatan1'],
            'kegiatan2' => request()->kegiatan['kegiatan2'],
            'kegiatan3' => request()->kegiatan['kegiatan3'],
            'kegiatan4' => request()->kegiatan['kegiatan4'],
            'kegiatan5' => request()->kegiatan['kegiatan5'],
            'kegiatan6' => request()->kegiatan['kegiatan6'],
            'kegiatan7' => request()->kegiatan['kegiatan7'],
            'kegiatan8' => request()->kegiatan['kegiatan8'],
        ];

        WargaKegiatanModel::updateOrCreate(
            [ 'warga_uuid'  => $uuid ],
            $form_kegiatan
        ); // hasilnya true

        $form_minat = [
            'warga_uuid'  => $uuid,
            'minat0'    => request()->minat['minat0'],
            'minat1'    => request()->minat['minat1'],
            'minat2'    => request()->minat['minat2'],
            'minat3'    => request()->minat['minat3'],
            'minat4'    => request()->minat['minat4'],
            'minat5'    => request()->minat['minat5'],
            'minat6'    => request()->minat['minat6'],
            'minat7'    => request()->minat['minat7'],
            'minat8'    => request()->minat['minat8'],
            'minat9'    => request()->minat['minat9'],
            'minat10'   => request()->minat['minat10'],
            'minat11'   => request()->minat['minat11'],
            'minat12'   => request()->minat['minat12'],
        ];

        WargaMinatModel::updateOrCreate(
            [ 'warga_uuid'  => $uuid ],
            $form_minat
        ); 

        // untuk data single <new WargaJsonResource(WargaModel::first())>
        return (new WargaJsonResource(WargaModel::whereUuid($uuid)->first()))    
            ->additional([
                'meta' => [
                    'logged'    => \Auth::check(),
                    'role'      => \Auth::check() ? \Auth::user()->peran : null,
                    'exp'       => config('jwt.ttl'),
                    'timeup'    => $this->timeup,
                ],
            ]);

        // metode 1
        return new WargaResourceCollection(
            WargaModel::
                // with(['alasan:id,warga_uuid,pragmatisme'])
                // ->select(['uuid','agama'])
                // ->paginate(100)         
                paginate()
        ); // untuk data banyak

        // metode 2
        return WargaJsonResource::collection(
            WargaModel::
                with(['alasan:id,warga_uuid,pragmatisme'])
                ->select(['uuid'])
                ->get()
        );

        // return WargaJsonResource::collection(WargaModel::get());    // untuk data banyak

    }

    public function show($id)
    {
        return (new WargaJsonResource(WargaModel::findOrFail($id)))    
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
