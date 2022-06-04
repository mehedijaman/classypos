<?php

namespace ClassyPOS\Events;

use ClassyPOS\sales\SubOrders;
use ClassyPOS\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
     * @var User
     *
     * SubOrder details
     *
     * @var SubOrders
     */
    public $user, $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, SubOrders $order)
    {
        $this->user = $user;
        $this->SubOrderID = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-received');
    }
}
