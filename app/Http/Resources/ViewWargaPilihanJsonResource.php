<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewWargaPilihanJsonResource extends JsonResource
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
            'pilihan0'      => $this->isEnabled($this->pilihan0),
            'pilihan1'      => $this->isEnabled($this->pilihan1),
            'pilihan2'      => $this->isEnabled($this->pilihan2),
            'pilihan3'      => $this->isEnabled($this->pilihan3),
        ];
    }


}





