<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WargaAlasanJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

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
            'idealisme'     => $this->isEnabled($this->idealisme),
            'pragmatisme'   => $this->isEnabled($this->pragmatisme),
            'created_at'    => $this->when($this->created_at !== null, $this->diffForHumans($this->created_at)),
            'updated_at'    => $this->when($this->updated_at !== null, $this->diffForHumans($this->updated_at)),
        ];
    }


}