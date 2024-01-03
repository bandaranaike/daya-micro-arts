<?php

namespace App\Providers;

use App\Config\PermissionEnum;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('creating-art', function (User $user) {
            return $user->hasPermissionTo(PermissionEnum::CREATE_ART->value);
        });
        Gate::define('deleting-art', function (User $user) {
            return $user->hasPermissionTo(PermissionEnum::DELETE_ART->value);
        });
        Gate::define('editing-art', function (User $user) {
            return $user->hasPermissionTo(PermissionEnum::EDIT_ART->value);
        });
    }
}
