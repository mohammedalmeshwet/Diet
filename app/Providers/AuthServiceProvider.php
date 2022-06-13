<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', function(User $user){
            return ($user->level === 1 ) ? Response::allow() : Response::deny('You must be an admin.');
        });

        Gate::define('user-only', function(User $user){
            return ($user->level  === 0 ) ? Response::allow() : Response::deny('You must be an user.');
        });

        // Gate::define('user-only-login', function( $user){
        //     return ($user->rank_id  === 2 ) ? true : false;
        // });

        // Gate::define('update-user', function($user){
        //     if($user->rank_id  === 1){return true;} else{return false;}
        // });
    }
}
