<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('eAdmin', function ($user) {
            return $user->tipo_usuario_id == 1;
        });

        Gate::define('eMaster', function ($user) {

            if(($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 2)|| ($user->tipo_usuario_id == 6)){
                return true;
            }
            return false;
        });

        Gate::define('eConsulta', function ($user) {
            if(($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 2) || ($user->tipo_usuario_id == 3)|| ($user->tipo_usuario_id == 4)|| ($user->tipo_usuario_id == 5)|| ($user->tipo_usuario_id == 6)){
                return true;
            }
            return false;
        });

        Gate::define('eOferta', function ($user) {
            if(($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 2) || ($user->tipo_usuario_id == 4) || ($user->tipo_usuario_id == 5)|| ($user->tipo_usuario_id == 6)){
                return true;
            }
            return false;
        });

        Gate::define('eFinanceiro', function ($user) {
            if(($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 5)|| ($user->tipo_usuario_id == 6)){
                return true;
            }
            return false;
        });

        Gate::define('eGestao', function ($user) {
            if(($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 6)|| ($user->tipo_usuario_id == 10)){
                return true;
            }
            return false;
        });

        Gate::define('eEntePublico', function ($user) {
            if($user->tipo_usuario_id == 8){
                return true;
            }
            return false;
        });

        Gate::define('eRepresentanteEntePublico', function ($user) {
            if($user->tipo_usuario_id == 9){
                return true;
            }
            return false;
        });

        Gate::define('eSNHDemanda', function ($user) {

            if(($user->tipo_usuario_id == 1) ||  ($user->tipo_usuario_id == 10)){
                return true;
            }
            return false;
        });

        Gate::define('ePrototipo', function ($user) {

            if($user->tipo_usuario_id == 11){
                return true;
            }
            return false;
        });

        //
    }
}
