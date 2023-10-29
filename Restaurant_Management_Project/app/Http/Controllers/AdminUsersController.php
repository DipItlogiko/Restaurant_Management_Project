<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function showUsers()
    {
        $authUser = Auth::user();
        $users= User::cursor(); ////akhane ami amar User Model theke data guloke fatch korechi ami aikhane dataguloke fatche korar jonno get() ba all() method take use kori ni karon amra jani jokhon amader ai User Model jei table take represent korche oi table ar moddhe jodi lakh lakh data thake and amra jodi oi table ar sob data take fatche korar jonno get() ba all() method use kori tahole oi table ar lakh lakh data amader laravel application ar moddhe akbare load hobe and jokhon amader laravel ar memory storage space ar limite ke cross kore jabe tokhon amader laravel application ta crass korbe and akta error dekhabe je amader memory storage space ta overflow hoye geche...ai problem ta solve korar jonno amra lazy collection ar cursor() method ta use korbo jokhon amra amader model ar sathe cursor() method ta use korbo amader kono table ar data fatch korar jonno tokhon amader database ar oi table aaa jodi lakh lakh data  oooo thake tahole oi data gulo amader laravel application ar moddhe akbare load hobe na...
        return view('restaurant.admin.show-users',['authUser' => $authUser ,'users' => $users]);
    }

    public function showUser($id)
    {
         
        $authUser = Auth::user(); ///// ai Auth::user() ba authenticated user ar datata ami $authUser variable ar moddhe store kore amader view file ar moddhe pass kore diyechi karon amader view file ar moddhe je navbar ta ache oikhane amader authenticated user ar image ,name ai gulor proyojon hobe tai amra ami authUser ar information gulo akhan theke amader view file ar moddhe pass korec diyechi
        $user = User::find($id);
        return view('restaurant.admin.show-user',['authUser' => $authUser , 'user' => $user]);
    }

    public function createUser()
    {
        $authUser = Auth::user(); 
        return view('restaurant.admin.create-user' , ['authUser' => $authUser]);
    }
}
