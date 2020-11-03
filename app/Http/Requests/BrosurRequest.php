<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Validation\ValidationException;


class BrosurRequest extends FormRequest {

	/*
	Pastikan nilai kembalian dari method authorize() adalah true untuk memastikan pengguna dapat melanjutkan ke proses validasi. Method authorize() ini nantinya dapat digunakan dalam berbagai keperluan, semisal hanya pengguna yang sudah login yang dapat mengisi formulir dan melanjutkan proses validasi.
	*/

	public $callback = null;

	public function authorize() : bool {

		// return false;
		return \Auth::check();

	}

	public function rules() {

	    $rules = [
	        // 'nama' 				=> 'required',
	        'alamat_kecamatan' 	=> 'required',
	        'alamat_kelurahan' 	=> 'required',
	        'alamat_rt' 		=> 'required',
	        'alamat_nomor' 		=> 'required',
	        'alamat_jalan' 		=> 'required',
	        'lat'				=> 'required',
	        'lang'				=> 'required',
	        'brosur_kondisi'	=> 'required',
	        'brosur_respon'		=> 'required',
	    ];

	    if (request()->isMethod('post')) {
	        // $rules['name'] = 'required|max:100|email';
	    }

	    if (request()->isMethod('delete')) {
	        // $rules['id'] = 'required|int';
	    }

	    return $rules;
	}

	// i love this
	public function messages()
	{
	    $messages = [
	        // 'nama.required' 				=> 'Nama wajib diisi !!',
	        'alamat_kecamatan.required'  	=> 'Kecamatan wajib diisi !!',
	        'alamat_kelurahan.required'  	=> 'Kelurahan wajib diisi !!',
	        'alamat_rt.required'  			=> 'RT wajib diisi !!',
	        'alamat_nomor.required'  		=> 'Nomor wajib diisi atau 0 !!',
	        'alamat_jalan.required'  		=> 'Jalan wajib diisi !!',
	        'brosur_kondisi.required'  		=> 'Kondisi wajib dipilih !!',
	        'brosur_respon.required'  		=> 'Respon wajib dipilih !!',
	        'lat.required'  				=> 'Geolocation wajib diaktifkan di HP !!',
	        'lang.required'  				=> 'Geolocation wajib diaktifkan di HP !!',
	    ];

	    return $messages;
	}	

	# i love like this
    public function validateResolved()
    {

        $validator = $this->getValidatorInstance();

        if ($validator->fails())
        {
            $this->failedValidation($validator);
        }

        if (!$this->passesAuthorization()) // merujuk pada authorize() di atas
        {
			$this->callback = 'unauthorized';
        	// throw new AuthorizationException('Maaf akun ini tidak tersedia X !!');
            // $this->failedAuthorization();
        }
    }    
}
