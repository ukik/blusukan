<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    protected function isEnabled($value) {
        return $this->when($value !== null, $value);
    }    

    protected function diffForHumans($value) {
        if(!$value) {
            return null;
        }
        return $value->diffForHumans();
    }


	public function toArray($request) {
		return [
			'id' 			 => $this->id,
			'username' 		 => $this->isEnabled($this->username),
			'password' 		 => $this->isEnabled($this->password),
			'password_plain' => $this->isEnabled($this->password_plain),
			'nama' 			 => $this->isEnabled($this->nama),
			'telepon' 		 => $this->isEnabled($this->telepon),
			'whatsapp' 		 => $this->isEnabled($this->whatsapp),
			'peran' 		 => $this->isEnabled($this->peran),

			'created_at' 	 => $this->isEnabled($this->diffForHumans($this->created_at)),
			'updated_at' 	 => $this->isEnabled($this->diffForHumans($this->updated_at)),

			// 'csrf_token' 	 => auth()->payload()->get('csrf-token'),
		];
	}
}
