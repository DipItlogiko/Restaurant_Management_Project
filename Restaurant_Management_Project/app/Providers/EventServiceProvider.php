<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\AdminNotification::class => [   //// ami jei Event ta create korechi artisan command ar maddhome and oi event take listen korar jonno jei Listener ta create korechi artisan command ar maddhome and oi Event and Listen ke amra amader ai EventServiceProvider ar moddhe likheci karon amader protek ta service servieContainer aaa add hoy serviceProvider ar maddhome...
            \App\Listeners\ListenAdminNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
