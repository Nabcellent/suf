<?php

namespace App\Providers;

use App\Events\StkPushPaymentFailed;
use App\Events\StkPushPaymentSuccess;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            StkPushPaymentSuccess::class,
            \App\Listeners\StkPushPaymentSuccess::class
        );
        Event::listen(
            StkPushPaymentFailed::class,
            \App\Listeners\StkPushPaymentFailed::class
        );
    }
}
