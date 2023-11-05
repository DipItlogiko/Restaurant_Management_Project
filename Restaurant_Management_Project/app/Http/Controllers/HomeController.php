<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class HomeController extends Controller
{
    public function index()
    {
        $allFood = Food::cursor(); //// akhane amader Food model ar table theke data fatch korechi and oi datata ke $allFood variable ar moddhe store kore diyechi amra aikane get() ba all() method ar poriborte lazy collection ar cursor() method ta use korechi data fatch korar jonno...lazy collection ar ai cursor() mehod ta amader database ar table theke sob data akbare fatch kore na kintu jodi get() ba all() mehod use kori tahole oita amader database ar table theke akbare sob data fatch kore niye ashto ar fole jei problem ta hoto ta holo amader laravel application ar memory storage space ar limit cross hoye jeto and amader laravel application ar memory storage space ta overflow hoye jeto and amader laravel application ta crass korto.
        return view('restaurant.home',['allFood' => $allFood]); //// amra aikhan theke jei allFood name variable ta pass korchi ai allFood variable ta amara use korechi restaurant.home.blade.php file ar food menu section ar moddhe
    }
}
