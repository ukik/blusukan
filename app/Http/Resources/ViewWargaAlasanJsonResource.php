<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewWargaAlasanJsonResource extends JsonResource
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
            'warga_total'   => $this->warga_total,
            'idealisme'     => $this->isEnabled($this->idealisme),
            'pragmatisme'   => $this->isEnabled($this->pragmatisme),
        ];
    }


}