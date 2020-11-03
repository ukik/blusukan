<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\WargaAlasanJsonResource;

class WargaJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    protected function diffForHumans($value) {
        if(!$value) {
            return null;
        }
        return $value->diffForHumans();
    }    

    protected function isEnabled($value) {
        return $this->when($value !== null, $value);
    }

    public function toArray($request)
    {
        return [
            'id'                => $this->isEnabled($this->id),
            'uuid'              => $this->isEnabled($this->uuid),
            'user_id'           => $this->isEnabled($this->user_id),
            'nama'              => $this->isEnabled($this->nama),
            'kartu_keluarga'    => $this->isEnabled($this->kartu_keluarga),
            'nik'               => $this->isEnabled($this->nik),
            'telepon'           => $this->isEnabled($this->telepon),
            'whatsapp'          => $this->isEnabled($this->whatsapp),
            'tempat_lahir'      => $this->isEnabled($this->tempat_lahir),
            'tanggal_lahir'     => $this->isEnabled($this->tanggal_lahir),
            'umur'              => $this->isEnabled($this->umur),
            'agama'             => $this->isEnabled($this->agama),
            'perkawinan'        => $this->isEnabled($this->perkawinan),
            'kelamin'           => $this->isEnabled($this->kelamin),
            'alamat_jalan'      => $this->isEnabled($this->alamat_jalan),
            'alamat_nomor'      => $this->isEnabled($this->alamat_nomor),
            'alamat_rt'         => $this->isEnabled($this->alamat_rt),
            'alamat_rw'         => $this->isEnabled($this->alamat_rw),
            'alamat_kelurahan'  => $this->isEnabled($this->alamat_kelurahan),
            'alamat_kecamatan'  => $this->isEnabled($this->alamat_kecamatan),
            'disabilitas'       => $this->isEnabled($this->disabilitas),
            'nomer_tps'         => $this->isEnabled($this->nomer_tps),
            'pekerjaan'         => $this->isEnabled($this->pekerjaan),
            'pilihan'           => $this->isEnabled($this->pilihan),
            'catatan'           => $this->isEnabled($this->catatan),

            'lat'               => $this->isEnabled($this->lat),
            'lang'              => $this->isEnabled($this->lang),

            'antusiasme'        => $this->isEnabled($this->antusiasme),

            'created_at'     => $this->isEnabled($this->diffForHumans($this->created_at)),
            'updated_at'     => $this->isEnabled($this->diffForHumans($this->updated_at)),
            
            'alasan'            => new WargaAlasanJsonResource($this->alasan),
            // 'alasan' => (new WargaAlasanJsonResource($this->alasan()))
            //     ->first([
            //         // 'id',
            //         // 'warga_uuid',
            //         'idealisme',
            //         'pragmatisme',
            //         'created_at',
            //         'updated_at',
            //     ]),

            'nama'              => $this->isEnabled($this->nama),   
            'telepon'           => $this->isEnabled($this->telepon),   
            'peran'             => $this->isEnabled($this->peran),   
            
        ];
    }
}