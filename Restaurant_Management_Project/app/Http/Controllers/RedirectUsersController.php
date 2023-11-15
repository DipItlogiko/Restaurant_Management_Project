<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Food;
use App\Models\TableReservation;
use App\Models\Chef;

class RedirectUsersController extends Controller
{
    public function index()
    {

        $userType = Auth::user()->user_type; ///// user_type is my users table field name 
        $authUser = Auth::user();
        $usersCount = User::withoutTrashed()->count(); //// akhane jehetu ami amar User Model ar sathe SoftDelete freture use korechi tai ami chacchi jei use gulo Admin data softdelete hoyeche oi user guloke jeno amader database ar users table theke count na kore tai ami aikhane withoutTrashed() method ta use korechi mane amar jei use gulo admin data softdelete hoyeche oi user gulo bade onno user gulo count korbe jei gulo softdelete hoy ni oi user gulo
        $foodsCount = Food::count();  ///akhane amader Food Model ta database ar jei table ke represent kore jemon aikhane amader ai Food Model ta database ar food table ke represent kore and oi food table theke ami aikhane aggregates function use korechi count() ai count() ar kaj hocche amader oi table ar moddhe joto gulo data ache oi dataguloke count korbe ba gunbe...tachara aggregates function mot 5 ta ja amra (SQL shekhar somoy shikhecilam) 
        $reservationsCount = TableReservation::count(); ///akhane amader TableReservation Model ta database ar jei table ke represent kore jemon aikhane amader ai TableReservation Model ta database ar table_reservations table ke represent kore and oi table_reservations table theke ami aikhane aggregates function use korechi count() ai count() ar kaj hocche amader oi table ar moddhe joto gulo data ache oi dataguloke count korbe ba gunbe...tachara aggregates function mot 5 ta ja amra (SQL shekhar somoy shikhecilam) 
        $chefsCount = Chef::count(); ///akhane amader Chef Model ta database ar jei table ke represent kore jemon aikhane amader ai Chef Model ta database ar chefs table ke represent kore and oi chefs table theke ami aikhane aggregates function use korechi count() ai count() ar kaj hocche amader oi table ar moddhe joto gulo data ache oi dataguloke count korbe ba gunbe...tachara aggregates function mot 5 ta ja amra (SQL shekhar somoy shikhecilam) 
        
        $datas = Order::where('order_status' , 'placed')->cursor();     /// akhane ami orders table ar moddhe theke oi dataguloke fatch korechi jekhane amader order_status column ar value placed ache and oi data theke amra total price ta ber korechi mane amader order ta placed hoye jawar pore amra jei takata pabo oi  takatai ami akhane sum korechi
        $receivedCash = 0;        ///// ai variable ta amara amader admin dashboard ar moddhe pathiyechi....
        foreach($datas as $data){
           $receivedCash += $data->price * $data->quantity;        //////$totalPrice += $data->price * $data->quantity; amra aivabe oo lilkhte pri $totalPrice = $totalPrice +  $data->price * $data->quantity;
        }   
        
        $datas = Order::where('order_status' , 'processing')->cursor();  /// akhane ami orders table ar moddhe theke oi dataguloke fatch korechi jekhane amader order_status column ar value processing ache and oi data theke amra total price ta ber korechi 
        $pendingCash = 0;  ///// ai variable ta amara amader admin dashboard ar moddhe pathiyechi....
        foreach($datas as $data){
           $pendingCash += $data->price * $data->quantity;
        }

        $datas = Order::where('order_status' , 'on the way')->cursor();  /// akhane ami orders table ar moddhe theke oi dataguloke fatch korechi jekhane amader order_status column ar value on the way ache and oi data theke amra total price ta ber korechi 
        $processingCash = 0;  ///// ai variable ta amara amader admin dashboard ar moddhe pathiyechi....
        foreach($datas as $data){
           $processingCash += $data->price * $data->quantity;
        }
        
        ///========= Redirect Admin and User into their Dashboard =========/// 

        if ($userType == '1') /// userType jodi 1 hoy mane jodi oi user ta admin hoy tahole oi admin ai view a chole jabe
        {
            return view('restaurant.admin.dashboard',['authUser'=>$authUser , 'usersCount' =>$usersCount , 'foodsCount' => $foodsCount , 'reservationsCount' => $reservationsCount , 'chefsCount' => $chefsCount , 'receivedCash' => $receivedCash , 'pendingCash' => $pendingCash , 'processingCash' => $processingCash ]);
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
