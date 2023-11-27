<?php

namespace App\Authorization;

class AdminGate {
    public function check_admin($user)  //// amader ai authorization take amader app/providers/AuthServiceProvider.php ar moddhe boot function ar moddhe set kore diyechi.
    {
        if($user->user_type == '1')
            {
                return true;
            
            }else
            {
                return false;
            }
    }
}