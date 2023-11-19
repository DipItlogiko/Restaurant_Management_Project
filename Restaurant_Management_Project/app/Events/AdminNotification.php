<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;   ///// this $data variable is comes from app/Http/Controllers/TableController.php ar bookTable ai method theke ashche and this $data variable is comes from app/Http/controllers/OrderContorller.php
    /**
     * Create a new event instance.
     */
    public function __construct($data)  //// akhane amra dependency injection manage korchi __construct() method ar maddhome amra dependency injection majhe moddhe sitter() method ar maddhome oo manage kori kintu beshir vag khetre amra __construct() method ar maddhomei manage kori amader dependency injection..dependency injection bolte bojhai kono akta calss ar property ke paramiter aakara pass kore oonno akta calss ar moddhe use korake ....jemon ami amader ai class ar $data property ke paramiter  ar maddhome pass kore amader Listener file ar class ar moddhe use korchi and ai dependency injection ta amra manage korchi amader __construct() method diye.. akhane amader ai $data variable ta receive korche app/Listeners/ListenAdminNotification.php
    {
        $this->data = $data;
        
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
