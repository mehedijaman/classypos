<?php

namespace ClassyPOS\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'ClassyPOS\Events\SomeEvent' => [
            'ClassyPOS\Listeners\EventListener',
        ],

        'ClassyPOS\Events\ActionDone' => [
        'ClassyPOS\Listeners\ThingToDoAfterEventWasFired',
    ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
