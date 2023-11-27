<?php

namespace App\Authorization;

class UserGate {
    public function check_user($user)  //// amader ai authorization take amader app/providers/AuthServiceProvider.php ar moddhe boot function ar moddhe set kore diyechi.
    {
        if($user->user_type == '0')
            {
                return true;
            
            }else
            {
                return false;
            }
    }
}