<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

class RedirectUsersController extends Controller
{
    public function index()
    {

        $userType = Auth::user()->user_type; ///// user_type is my users table field name 
        $authUser = Auth::user();

        if ($userType == '1') /// userType jodi 1 hoy mane jodi oi user ta admin hoy tahole oi admin ai view a chole jabe
        {
            return view('restaurant.admin.dashboard',['authUser'=>$authUser]);
        }

        else  /// userType jodi 1 na hoy tahole oi user ai view ar moddhe chole jabe 
        {
            $user_id = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
            $count = Cart::where('user_id',$user_id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
            $orderCount = Order::where('user_id', $user_id)->count(); 

            return view('restaurant.user.dashboard',['authUser'=>$authUser , 'count' => $count , 'orderCount' => $orderCount]);
        }
        
    }
}
