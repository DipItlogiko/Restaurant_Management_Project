<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Table;
use App\Models\Chef;

class HomeController extends Controller
{
    public function index()
    {
        $allFood = Food::cursor(); //// akhane amader Food model ar table theke data fatch korechi and oi datata ke $allFood variable ar moddhe store kore diyechi amra aikane get() ba all() method ar poriborte lazy collection ar cursor() method ta use korechi data fatch korar jonno...lazy collection ar ai cursor() mehod ta amader database ar table theke sob data akbare fatch kore na kintu jodi get() ba all() mehod use kori tahole oita amader database ar table theke akbare sob data fatch kore niye ashto ar fole jei problem ta hoto ta holo amader laravel application ar memory storage space ar limit cross hoye jeto and amader laravel application ar memory storage space ta overflow hoye jeto and amader laravel application ta crass korto.
        $authUser = Auth::user(); //// akhane Auth:: fachad ar sathe user() diye amai amader application ar authenticated user ar sob information gulo $authUser ai variable ar moddhe store korechi and tarpore ami ai variable take amader view ar moddhe pass kore diyechi...authenticated user mane jei user ta signUp and SignIn kore amader application ar moddhe probesh koreche ba enter korechi oi user ke bojhai
        $tables = Table::where('deleted_at', NULL)->cursor(); //// akhane ami amader Table Model mane tables nam a database a jei table ta ache oi table theke where diye check korechi amader tables nam aa je database ar table ache oi table ar deleted_at column ar value jeikhane null ba '' ache oi data guloke aikhane fatch kore niye ashbe
        $chefs = Chef::cursor(); ////akhane amader Chef Model ta database ar jei table take represent kore jemon aikhane amader ai Chef Model ta database ar chefs table take represent kore oi table theke ami sob datake fatch korechi lazy collection ar cursor() method ar maddhome...get() ba all() method use korar theke cursor() method ta use kora valo..
        
        return view('restaurant.home',['allFood' => $allFood , 'authUser' => $authUser, 'tables' => $tables , 'chefs' => $chefs]); //// amra aikhan theke jei allFood name variable ta pass korchi ai allFood variable ta amara use korechi restaurant.home.blade.php file ar food menu section ar moddhe
    }
}
