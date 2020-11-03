<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WargaMinatJsonResource extends JsonResource
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
            'minat0'        => $this->isEnabled($this->minat0),
            'minat1'        => $this->isEnabled($this->minat1),
            'minat2'        => $this->isEnabled($this->minat2),
            'minat3'        => $this->isEnabled($this->minat3),
            'minat4'        => $this->isEnabled($this->minat4),
            'minat5'        => $this->isEnabled($this->minat5),
            'minat6'        => $this->isEnabled($this->minat6),
            'minat7'        => $this->isEnabled($this->minat7),
            'minat8'        => $this->isEnabled($this->minat8),
            'minat9'        => $this->isEnabled($this->minat9),
            'minat10'       => $this->isEnabled($this->minat10),
            'minat11'       => $this->isEnabled($this->minat11),
            'minat12'       => $this->isEnabled($this->minat12),

            'created_at'    => $this->when($this->created_at !== null, $this->diffForHumans($this->created_at)),
            'updated_at'    => $this->when($this->updated_at !== null, $this->diffForHumans($this->updated_at)),
        ];
    }


}