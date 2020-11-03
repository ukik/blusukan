<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Validation\ValidationException;


class WargaRequest extends FormRequest {

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
	        'nama' 				=> 'required',
	        'alamat_kecamatan' 	=> 'required',
	        'alamat_kelurahan' 	=> 'required',
	        'alamat_rt' 		=> 'required',
	        'pilihan'			=> 'required|in:ZS,BK,AH,GL',
	        'lat'				=> 'required',
	        'lang'				=> 'required',
	        'antusiasme'		=> 'required|in:1,2,3',
	    ];

	    if(request()->pilihan == 'ZS') {
	    	if(!request()->alasan['idealisme'] || !request()->alasan['pragmatisme']) {
	    		# salah satu saja
		        $rules['alasan.idealisme']	= 'required';
		        // $rules['minat.pragmatisme']	= 'required';
	    	}
	    }

    	if(
    		!request()->minat['minat0'] || 
    		!request()->minat['minat1'] || 
    		!request()->minat['minat2'] || 
    		!request()->minat['minat3'] || 
    		!request()->minat['minat4'] || 
    		!request()->minat['minat5'] || 
    		!request()->minat['minat6'] || 
    		!request()->minat['minat7'] || 
    		!request()->minat['minat8'] || 
    		!request()->minat['minat9'] || 
    		!request()->minat['minat10'] || 
    		!request()->minat['minat11'] || 
    		!request()->minat['minat12']  
    	) {
    		# salah satu saja
	        $rules['minat.minat0']	= 'required';
    	}

    	if(
    		!request()->kegiatan['kegiatan0'] || 
    		!request()->kegiatan['kegiatan1'] || 
    		!request()->kegiatan['kegiatan2'] || 
    		!request()->kegiatan['kegiatan3'] || 
    		!request()->kegiatan['kegiatan4'] || 
    		!request()->kegiatan['kegiatan5'] || 
    		!request()->kegiatan['kegiatan6'] || 
    		!request()->kegiatan['kegiatan7'] || 
    		!request()->kegiatan['kegiatan8']  
    	) {
    		# salah satu saja
	        $rules['kegiatan.kegiatan0'] = 'required';
    	}


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
	        'nama.required' 				=> 'Nama wajib diisi !!',
	        'alamat_kecamatan.required'  	=> 'Kecamatan wajib diisi !!',
	        'alamat_kelurahan.required'  	=> 'Kelurahan wajib diisi !!',
	        'alamat_rt.required'  			=> 'RT wajib diisi !!',
	        'pilihan.required'  			=> 'Pilihan wajib dipilih minimal satu !!',

	        'lat.required'  				=> 'Geolocation wajib diaktifkan di HP !!',
	        'lang.required'  				=> 'Geolocation wajib diaktifkan di HP !!',

	        'antusiasme.required'  			=> 'Antusiasme wajib dipilih !!',

	        'alasan.idealisme.required'  	=> 'Alasan wajib dipilih minimal satu !!',
	        'kegiatan.kegiatan0.required'  	=> 'Kegiatan wajib dipilih minimal satu !!',
	        'minat.minat0.required'  		=> 'Minat wajib dipilih minimal satu !!',
	    ];

	    $messages['pilihan.in'] = 'Pilihan wajib dipilih ZS,BK,AH,GL !!';
	    $messages['antusiasme.in'] = 'Pilihan wajib dipilih !!';

	    return $messages;
	}	

	# i dont like this
    // protected function failedAuthorization()
    // {
    //     throw new AuthorizationException('Maaf akun ini tidak tersedia !!');
    //     exit;
    // }	


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
