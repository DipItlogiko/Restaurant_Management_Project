<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Authorization\AdminGate;
use App\Authorization\UserGate;

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
        Gate::define('isAdmin', [AdminGate::class, 'check_admin']); /// akhane amra 'isAdmin' nam aaa akta Gate define korechi admin ar jonno and ai 'isAdmin' name ta amara amader routes/web.php ar moddhe can middleware ar sathe likhe diyechi....
        Gate::define('isUser', [UserGate::class, 'check_user']);    
        
    }
}
