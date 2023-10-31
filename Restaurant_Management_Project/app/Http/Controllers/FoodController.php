<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function foodMenu()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.food-menu' , ['authUser' => $authUser]);
    }
}
