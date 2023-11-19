<?php

namespace App\Listeners;

use App\Events\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AdminNotify;

class ListenAdminNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminNotification $event): void
    {
        $data = new AdminNotify;

        //--store data into the admin_notifications table--//         

        if (isset($event->data['payment_method'])) {    //// akhane ami check korechi amader event ar moddhe data name jei array take pacchi oi array ar moddhe jodi amader 'payment_method' ai key ta thake and oi key ar moddhe jodi data set hoy  tahole ai if ar moddhe ar code tuke execute hobe....and ai $event ar moddhe $data ta ashche amader app/Events/AdminNotification.php
            $data->payment_method = $event->data['payment_method'];
            $data->user_id = $event->data['user_id'];
            $data->save();
        } else {
            $data->booked_table = $event->data['bookedTableName'];
            $data->user_id = $event->data['user_id'];
            $data->save();
        }
        
    }
}
