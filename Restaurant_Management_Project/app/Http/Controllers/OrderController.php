<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Cart;

class OrderController extends Controller
{
    ///====== User will be able to see Cart Food page hare =======///
    public function foodCart($id)
    {
        $authUser = Auth::user();
        $specificFood = Food::find($id);

        $user_id = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
        $count = Cart::where('user_id',$user_id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.

        if ($authUser->user_type == '0'){ //// jodi amader Authenticated user ar user_type jodi 0 hoy mane jei user ta siguUp and logIn kore amader application ar moddhe ashbe oi user ar user_type ta jodi 0 hoy tahole shudhu oi user ta amader ai if ar moddhe ja bola ache ta korte parbe

            if(Auth::id()){ ///// akhane ami if ar moddhe Auth::id() diye bole diyechi je jodi Auth:id() pai mane kono Authenticated user ar id pai mane je user signUp ba signIn kore amader application ar moddhe ashbe oi user ar id ta jodi pai taholei oi Authenticated user ke amader cart page ar moddhe  jete parbe...mane authentication chara kew amader cart page ar moddhe jete parbe na..
                return view('restaurant.user.food-cart',['authUser' => $authUser , 'specificFood' => $specificFood , 'count' => $count]);
            }else{  ///// jodi kono user Authenticated na thake mane signUp ba signIn kore na ashe tahole amader oi user take aikhane login page dekhabe
                return redirect()->route('login');
            }

        }else{ //// jodi kono  admin ai page aaa ashar try kore tahole take home page ai redirect kore debe karon oi page theke request ashbe and ami else ar moddhe bole deyechi return redirect()->back() mane jei page theke request ta ashbe oi page ar moddhei take redirect kore debe..
            return redirect()->back();
        }
    }


    ///====== User Carted food will store here =======///
    public function foodCartStore(Request $request ,$id)
    {
        //----form data validation----//
        $request->validate([
            'quantity' => ['string'],
        ]); 

        $user_id = Auth::id(); //// here we will get the Authenticated user id by Auth::id() and here we have stored that Authenticated user id into this $user_id variable
        $food_id = $id;

        //---save data into the database---//
        $store = new Cart; /// here i have created a new instance of the Cart Model by new Cart and i have stored it into the $store variable
        
        $store->user_id = $user_id;
        $store->food_id = $food_id;
        $store->quantity = $request->quantity; 

        $store->save();

        return redirect()->route('dashboard')->with('status','Food Carted Successful');
        
    }

    ///======= User will be able to see his own all carts with remove button and Order button =======///
    public function showCart()
    {
        $authUser = Auth::user();

        $userId = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
        $count = Cart::where('user_id',$userId)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
        
        $specificUserCarts = Cart::where('user_id',$userId)->join('food', 'carts.food_id', '=', 'food.id')->get(); //// aakhane ami amar Cart Model mane Cart model ta amader database ar jei table take represent kore jemon akhane amader Cart Model ta database ar carts table take represent kore oi carts table ar moddhe theke prothome amra check korechi oi table ar user_id nameeee jei field ta ache oi field ar moddhe amader Authenticated user ar id diye check korechi je ai authenticated user koita cart koreche and jar pore amra ai 'carts' table ar sathe join korechi amader 'food' table ke and ai join ta hobe amader carts.food_id ar opore mane carts table ar moddhe jei food_id column ta ache oi id oonujayi food.id mane food table ar id column ar jei id gulo match korbe oi data gulo sob niye ashbe amader food table theke...
         
        $sumOfQuantity = $specificUserCarts->sum('quantity');
        $sumOfPrice = $specificUserCarts->sum('price');
        $sumOfItems = $specificUserCarts->count('title');

        return view('restaurant.user.show-cart' , ['authUser' => $authUser, 'count' => $count , 'data' => $specificUserCarts , 'sumOfQuantity' => $sumOfQuantity , 'sumOfPrice' => $sumOfPrice, 'sumOfItems' => $sumOfItems]);
    }

    public function deleteCart($id)
    {
        dd($id);
    }
}
