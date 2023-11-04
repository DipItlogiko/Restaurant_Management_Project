<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    ///====== User will be able to see Cart Food page hare =======///
    public function foodCart()
    {
        $authUser = Auth::user();

        if ($authUser->user_type == '0'){ //// jodi amader Authenticated user ar user_type jodi 0 hoy mane jei user ta siguUp and logIn kore amader application ar moddhe ashbe oi user ar user_type ta jodi 0 hoy tahole shudhu oi user ta amader ai if ar moddhe ja bola ache ta korte parbe

            if(Auth::id()){ ///// akhane ami if ar moddhe Auth::id() diye bole diyechi je jodi Auth:id() pai mane kono Authenticated user ar id pai mane je user signUp ba signIn kore amader application ar moddhe ashbe oi user ar id ta jodi pai taholei oi Authenticated user ke amader cart page ar moddhe  jete parbe...mane authentication chara kew amader cart page ar moddhe jete parbe na..
                return view('restaurant.user.food-cart',['authUser' => $authUser]);
            }else{  ///// jodi kono user Authenticated na thake mane signUp ba signIn kore na ashe tahole amader oi user take aikhane login page dekhabe
                return redirect()->route('login');
            }

        }else{ //// jodi kono  admin ai page aaa ashar try kore tahole take home page ai redirect kore debe karon oi page theke request ashbe and ami else ar moddhe bole deyechi return redirect()->back() mane jei page theke request ta ashbe oi page ar moddhei take redirect kore debe..
            return redirect()->back();
        }
    }
}
