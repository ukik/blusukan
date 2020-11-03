<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MateriJsonResource extends JsonResource
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
            'dilihat'       => $this->isEnabled($this->dilihat),
            'gambar'        => $this->isEnabled($this->gambar),
            'created_at'    => $this->when($this->created_at !== null, $this->diffForHumans($this->created_at)),
            'updated_at'    => $this->when($this->updated_at !== null, $this->diffForHumans($this->updated_at)),
        ];
    }

}
