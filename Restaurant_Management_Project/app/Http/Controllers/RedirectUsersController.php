<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class RedirectUsersController extends Controller
{
    public function index()
    {

        $userType = Auth::user()->user_type; ///// user_type is my users table field name 
        $authUser = Auth::user();

        if ($userType == '1')
        {
            return view('restaurant.admin.dashboard',['authUser'=>$authUser]);
        }

        else
        {
            $user_id = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
            $count = Cart::where('user_id',$user_id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.

            return view('restaurant.user.dashboard',['authUser'=>$authUser , 'count' => $count]);
        }
        
    }
}
