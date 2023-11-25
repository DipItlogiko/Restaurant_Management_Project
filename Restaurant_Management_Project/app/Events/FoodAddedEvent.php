<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FoodAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $foodName, $userIds,$authAdminId;
    /**
     * Create a new event instance.
     */
    public function __construct($foodName, $userIds,$authAdminId)
    {
       $this->foodName = $foodName;
       $this->userIds = $userIds;
       $this->authAdminId = $authAdminId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
