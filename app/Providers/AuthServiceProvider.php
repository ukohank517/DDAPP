<?php

namespace DDApp\Providers;

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
        'DDApp\Model' => 'DDApp\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 開発者のみ許可
	Gate::define('system-only', function($user){
	    return ($user->role == 1);
	});
	// 管理者以上に許可
	Gate::define('admin-higher', function($user){
	    return ($user->role > 0 && $user->role <=5);
	});
	// 全ユーザーに許可
	Gate::define('user-higher', function($user){
	    return ($user->role > 0 && $user->role <=10);
	});
    }
}
