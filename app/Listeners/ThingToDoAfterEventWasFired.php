<?php

namespace ClassyPOS\Listeners;

use ClassyPOS\Events\ActionDone;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThingToDoAfterEventWasFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActionDone  $event
     * @return void
     */
    public function handle(ActionDone $event)
    {
        //
    }
}
