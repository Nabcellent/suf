<?php

namespace App\Providers;

use App\Events\StkPushFailed;
use App\Events\StkPushSuccess;
use App\Events\StkRequested;
use App\Listeners\StkPushRequestedNotification;
use App\Listeners\StkPushFailedNotification;
use App\Listeners\StkPushSuccessNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        StkPushSuccess::class => [
            StkPushSuccessNotification::class,
        ],

        StkPushFailed::class => [
            StkPushFailedNotification::class,
        ],

        StkRequested::class => [
            StkPushRequestedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return true;
    }
}
