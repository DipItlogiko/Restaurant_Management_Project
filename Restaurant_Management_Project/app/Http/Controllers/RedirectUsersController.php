<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('restaurant.user.dashboard',['authUser'=>$authUser]);
        }
        
    }
}
