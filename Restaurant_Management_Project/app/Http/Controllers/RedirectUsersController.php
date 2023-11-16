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
use App\Models\Task;

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
        
        //--For Admin Dashboard Transaction Summary--//
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
        //--For Admin Dashboard Sales Chart--//        
        $years = Order::selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'asc')->pluck('year');  //( Fetch all unique years from the orders tabel created_at column ...as you know our Order Model represents a orders table which table is exest in our database) and distinct() method ta hocche laravel ar akta method jar kaj hocche amader duplicate value take avoid kora jemon ami aikhane amader orders table ar moddhe je created_at column ta ache oi table ar moddhe year guloke niyeashbe and jodi amader oi column ar moddhe 2023 oonekbar thake tahole amader 2023 ke 1bar ee anbe karon ami akhane distinct() method ta use korechi jar kaj hocche duplication avoid kora and tar pore amra  orderBy('year', 'asc') ai ta use korechi mane amader year guloke ascending format mane choto theke boro aivabe sajiyechi ascending ar short form hocche 'asc' and dscendin ar short form hocche 'dsc' and tar por amra pluck() method ta use korechi jar kaj ai pluck() ar moddhe jei column ar nam bole dibo oi column ar value gulo pluck() akta array ar moddhe store kore debe jei array ar moddhe key and value pair aa data thakbe jei array ar moddhe key and value pair a data thake take accociative array bole..and ai pluck() ar moddhe amra 2 ta column ar nam dite parbo prothom aa jei column ar nam ta dibo oita hobe amader oi array ar value and second a jei column ar nam ta dibo oi column ta hobe amader oi array ar key...and akhane ami jemon pluck('year') pluck ar moddhe 'year' ta diyeci shudhu tai amader pluck jai accociative array ta create korbe oi array ar moddhe ai 'year' ar value ta hobe amader value and key ta oo autometically generate korbe 0 theke karon ami aikhane 2 ta column ar nam pass kori nai tai
         
        $yearlySales = [];
        foreach($years as $year)               /////akhane amader $years variable theke  year ar nam ashche akta akta kore
        {
            $yearlySale = Order::whereYear('created_at', $year)    ///akhane amader Order Model ta amader database ar orders table take represent kore..and amra jani amader laravel appliction ar protek ta Model ba Eloquent Model database ak ak ta table ke represent kore kore...akhane ami amader orders table theke created_at column ar value theke amader $year diye check korchi and ai $year onujayi jei dataguloke pabe oi datagulo theke nicher line theke aabar check korbe oi rows gulor order_status column ar value ki  placed ache ki na jodi thake tahole tar nicher line aa chole jabe and price column and quentity column take gun korbe tar por oi amount guloke jog korbe then amader oi amount ta totalSale ar moddhe pathiye debe tai amra as totalSale aita likhechi and ->value('totalSale'); bolte ami bujhiyechi amader  $yearlySale ai variable ar value ta hobe 'totalSale' ar value
            ->where('order_status', 'placed')
            ->selectRaw('SUM(price * quantity) as totalSale')
            ->value('totalSale');
                        
            $yearlySales[] = $yearlySale;  ////   yearlySale ai variable ar moddhe ami jei datatake pacchi(mane protita year ar jemon 2023 aa ami mot koto taka sale korechi and 2024 a ami mot koto taka sale korechi ai vabe protita year ar sale amader $yearlySale ai variable moddhe ashbe) and oi datatake ami amader $yearlySales [] array ar moddhe store kore dicchi

        } 

        $maximumSellingAmount = max($yearlySales);

        //--For Admin Dashboard Order Status--//
        $orders = User::join('orders', 'users.id', '=', 'orders.user_id')->orderBy('orders.created_at', 'desc')->take(5)->cursor(); ///// akhane ami amader User Model ta jei table ke represent kore jemon amader ai User Model ta database ar users table ke represent kore oi users table ar sathe ami amader database ar orders table ke join korechi mane inner join korechi..akhane ami amader users table ke join koreci orders table ar sathe join ar moddhe jehetu amader orders table ar nam ta ache tai amader orders table ta aikhane beshi power pabe mane jodi eemon hoy je amader orders table ar moddhe je nam aa akta column ache oi nam aa amader users table ar moddhe ooo akta column ache and amra jodi oi column ar nam dhore kothaw print kori tahole dekhbo amader orders table ar moddhe theke oi column ar moddhe theke amader data ta ashche tokhon amader users table ar moddhe theke oi column ar moddhe theke data take anbe na karon amader join ar moddhe orders table ar nam ache tai orders table ta power beshi pabe and amader ai join ta hobe users table ar id ar sathe orders table ar user_id eeder 2 jon ar sathe and tar pore ami orderBy('orders.created_at', 'desc') aita likhechi mane amader orders table ar moddhe jei created_at column ta ache oi column ta akhane descendind format aa shajabe mane boro theke choto aakare sajabe and tar pore ami bolechi take(5) mane boro theke choto aakare sajanor pore tumi protom theke 5 ta data anba aitai bole diyechi and last aa lazy collection ar cursor() method ar maddhome ami oi dataguloke fatch korechi..       
        
        //--For Admin Dashboard To Do List--//
        $tasks = Task::cursor();              //// akhane amader database ar tasks table theke all datake fatch korechi lazy collection ar cursor() method diye


        ///========= Redirect Admin and User into their Dashboard =========/// 

        if ($userType == '1') /// userType jodi 1 hoy mane jodi oi user ta admin hoy tahole oi admin ai view a chole jabe
        {
            return view('restaurant.admin.dashboard',['authUser'=>$authUser , 'usersCount' =>$usersCount , 'foodsCount' => $foodsCount , 'reservationsCount' => $reservationsCount , 'chefsCount' => $chefsCount , 'receivedCash' => $receivedCash , 'pendingCash' => $pendingCash , 'processingCash' => $processingCash , 'years' => $years , 'yearlySales' => $yearlySales , 'maximumSellingAmount' => $maximumSellingAmount , 'orders' => $orders , 'tasks' => $tasks ]);
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
