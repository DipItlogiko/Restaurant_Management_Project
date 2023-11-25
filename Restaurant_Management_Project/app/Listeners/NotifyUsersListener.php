<?php

namespace App\Listeners;

use App\Events\FoodAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserNotify;

class NotifyUsersListener
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
    public function handle(FoodAddedEvent $event): void
    {
        $foodName = $event->foodName;
        $userIds = $event->userIds;
        $authAdminId = $event->authAdminId;

        foreach($userIds as $userId)
        {
           $user_notifies = new UserNotify;   /// akhane amader UserNotify Model ta database ar jei table take represent kore jemon amader ai khane UserNotify Model ta database ar user_notifies ai tabel take represent kore...and ami oi table ar akta instance akhane create kore niyechi
           
           //--store data into the database table--//
           $user_notifies->food_name = $foodName;
           $user_notifies->user_id = $userId;
           $user_notifies->admin_id = $authAdminId;

           $user_notifies->save();
        }
    }
}
