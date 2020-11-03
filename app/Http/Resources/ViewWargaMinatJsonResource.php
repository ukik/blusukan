<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewWargaMinatJsonResource extends JsonResource
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
            'warga_total'    => $this->warga_total,
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
        ];
    }


}