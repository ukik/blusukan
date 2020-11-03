<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {

    use Notifiable;

    protected $fillable = [
        'nama',
        'telepon',
        'whatsapp',
        'peran',
        'password',
        'password_plain',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password_plain', 'username',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function getJWTIdentifier() {
        // return the primary key of the user - user id
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        // return a key value array, containing any custom claims to be added to JWT
        return [
            'registered_at'     => date('Y-m-d H:i:s'),
            'expired_at'        => \Carbon\Carbon::now()->addMinutes(60)->format('Y-m-d H:i:s'),
        ];
    }    



    // Validation via Model
    /*
     * Validations
     */

    # import: use Illuminate\Validation\Rule; // imported class
    # usage di controller: $this->validate($request, Colleague::rules(false));
    /*

    public static function rules($update = false, $id = null)
    {
        $rules = [
            'first_name'    => 'required',
            'email'         => ['required', Rule::unique('colleagues')->ignore($id, 'id')],
            'email'         => 'email',
            'gender'        => ['required', Rule::in(['male', 'female'])],
            'address'       => 'required',
            'phone_number'  => 'required'
        ];

        if ($update) {
            return $rules;
        }

        return array_merge($rules, [
            'email'         => 'required|unique:colleagues,email',
        ]);
    }    
    */
}
