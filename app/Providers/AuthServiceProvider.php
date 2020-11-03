<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Auth\Access\AuthorizationException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        App\User::class => App\Policies\AuthPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Localization Carbon
        // digunakan untuk localization pada class JsonResource $value->diffForHumans() 
        \Carbon\Carbon::setLocale(config('app.locale'));

        // argument pertama: $user dari model (wajib)
        // argument kedua: injected
        // Gate::define('onLogin', function($user) {
        //     if(!$user) {
        //         return false;
        //     }

        //     return true;

        //     // $credentials = [
        //     //     'username'  => request()->username, 
        //     //     'password'  => request()->password,
        //     // ];

        //     // $token = auth()
        //     //     ->claims(['csrf-token' => str_random(32)])
        //     //     ->attempt($credentials);

        //     // \Session::flash('token', $token);

        //     // return $token ? true : false;
        // });
    }
}
