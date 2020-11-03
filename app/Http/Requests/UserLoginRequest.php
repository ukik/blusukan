<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class UserLoginRequest extends FormRequest {

	/*
	Pastikan nilai kembalian dari method authorize() adalah true untuk memastikan pengguna dapat melanjutkan ke proses validasi. Method authorize() ini nantinya dapat digunakan dalam berbagai keperluan, semisal hanya pengguna yang sudah login yang dapat mengisi formulir dan melanjutkan proses validasi.
	*/

	public $callback = null;

	public function authorize() : bool {

		// if(Request::segment(2) !== 'user') {
		// 	return true;
		// }
		
        $credentials = [
            'username'	=> $this->username, 
            'password'	=> $this->password,
        ];

        $token = auth()
            ->claims(['csrf-token' => str_random(32)])
            ->attempt($credentials);

        if($token) {
	        \Session::flash('token', $token);
	        return true;
	    }

	    return false;
	    
	}

	public function rules() {
		return [
			'username' => 'required',
			'password' => 'required|min:1',
		];
	}

	// i love this
	public function messages()
	{
	    return [
	        'username.required' => 'A title is required',
	        'password.required'  => 'A message is required',
	    ];
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

    // protected function failedAuthorization()
    // {
    //     throw new AuthorizationException('Maaf akun ini tidak tersedia !!');
    //     exit;
    // }

	// i dont love this
	// public function withValidator($validator)
	// {

	//     $validator->after(function ($validator) {
	//         // if ($this->somethingElseIsInvalid()) {
	//             $validator->errors()->add('field', 'Something is wrong with this field!');
	//         // }
	//     });
	// }
	

}
