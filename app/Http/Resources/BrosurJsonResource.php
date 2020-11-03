<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrosurJsonResource extends JsonResource
{

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
            'alamat_jalan'      => $this->isEnabled($this->alamat_jalan),
            'alamat_nomor'      => $this->isEnabled($this->alamat_nomor),
            'alamat_rt'         => $this->isEnabled($this->alamat_rt),
            'alamat_rw'         => $this->isEnabled($this->alamat_rw),
            'alamat_kelurahan'  => $this->isEnabled($this->alamat_kelurahan),
            'alamat_kecamatan'  => $this->isEnabled($this->alamat_kecamatan),
            'catatan'           => $this->isEnabled($this->catatan),
            'lat'               => $this->isEnabled($this->lat),
            'lang'              => $this->isEnabled($this->lang),
            'brosur_kondisi'    => $this->isEnabled($this->brosur_kondisi),
            'brosur_respon'     => $this->isEnabled($this->brosur_respon),            
            'created_at'        => $this->isEnabled($this->diffForHumans($this->created_at)),
            'updated_at'        => $this->isEnabled($this->diffForHumans($this->updated_at)),

            'nama'              => $this->isEnabled($this->nama),   
            'telepon'           => $this->isEnabled($this->telepon),   
            'peran'             => $this->isEnabled($this->peran),   

        ];
    }
}