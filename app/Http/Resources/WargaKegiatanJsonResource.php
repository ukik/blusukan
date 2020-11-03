<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WargaKegiatanJsonResource extends JsonResource
{

    protected function isEnabled($value) {
        return $this->when($value !== null, $value);
    }    

    protected function diffForHumans($value) {
        if(!$value) {
            return null;
        }
        return $value->diffForHumans();
    }
    
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'warga_uuid'    => $this->warga_uuid,
            'kegiatan0'     => $this->isEnabled($this->kegiatan0),
            'kegiatan1'     => $this->isEnabled($this->kegiatan1),
            'kegiatan2'     => $this->isEnabled($this->kegiatan2),
            'kegiatan3'     => $this->isEnabled($this->kegiatan3),
            'kegiatan4'     => $this->isEnabled($this->kegiatan4),
            'kegiatan5'     => $this->isEnabled($this->kegiatan5),
            'kegiatan6'     => $this->isEnabled($this->kegiatan6),
            'kegiatan7'     => $this->isEnabled($this->kegiatan7),
            'kegiatan8'     => $this->isEnabled($this->kegiatan8),

            'created_at'    => $this->when($this->created_at !== null, $this->diffForHumans($this->created_at)),
            'updated_at'    => $this->when($this->updated_at !== null, $this->diffForHumans($this->updated_at)),
        ];
    }


}