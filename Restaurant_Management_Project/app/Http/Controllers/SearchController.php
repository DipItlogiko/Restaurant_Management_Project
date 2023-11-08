<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SearchController extends Controller
{
    ///===== Admin will be able to search a specific order ====///
    public function search(Request $request)
    {
        //--Form data validation--//
        $request->validate([
            'search' =>['required'],
        ]);

        $authUser = Auth::user();

        $allData = User::join('orders', 'users.id' , '=' , 'orders.user_id' )->cursor();  ////akhane amader User Model ta database ar jei table take represent kore oitable theke sob data fatch korechi lazy collection ar cursor() method ar maddhome.. get() ba all() method diye ooo data fatch kora jai database ar table theke kintu jodi ami get() ba all() method diye data fatch kori tahole amader oi database ar table theke sob  datake akbare fatch kore amader laravel application memory storage space ar moddhe lod kore dei jodi amader oi database ar table ar moddhe lakh lakh data thake tahole oi data gulo amader laravel application ar moddhe akbare load hole amader laravel application ta crass korbe and akta error dekhabe je amader laravel ar memory storage space overlod hoye geche...tai amra lazy collection ar cursor() method ta use korbo aita amader database ar table theke sob data ke akbare amader laravel application ar moddhe load korbe na. ta chara aikhane amai amader User Model ar sathe mane users table ar sathe amader orders table take join kore diyechi and ai join ta hobe amader 'users.id' mane users table ar id jekhane '=' soman hobe 'orders.user_id' orders table ar user_id ar sathe oikhane amader ai 2ta table join hoye jabe and jehutu join() ar moddhe amader 'orders' table ta ache tai akhane orders table ta power ta beshi thakbe jemon dhoren amader users table ar mooddhe created_at name akta column ache and orders table ar moddhe oooo created_at name akta column ache jokhon ami amader ai $ordersTable variable ar value ta foreach ar maddome print korbo amader blade.php file ar moddhe tokhon jodi ami created_at likhi tahole amra dekhbo amader orders table ar created_at column ar moddhe theke data ta ashche users table theke ashbe na karon join ar moddhe 'orders' table ar nam ache tai ai orders table ta power beshi pabe
        $totalOrder = $allData->count('id');
        $TotalOrderInProcess = $allData->where('order_status', '=', 'processing')->count();
        $TotalOrderPlaced = $allData->where('order_status', '=', 'placed')->count();
        $OrderOnTheWay = $allData->where('order_status', '=', 'on the way')->count();
        
        //--search queary--//
        $ordersTable = User::join('orders', 'users.id' , '=' , 'orders.user_id' )->where('name' , 'Like' , '%'.$request->search.'%')->orWhere('food_name' , 'Like' , '%'.$request->search.'%')->orWhere('order_status' , 'Like' , '%'.$request->search.'%')->orWhere('user_address' , 'Like' , '%'.$request->search.'%')->orWhere('orders.number', 'Like', '%'.$request->search.'%')->orWhere('orders.created_at', 'Like', '%'.$request->search.'%')->cursor();  ////akhane amader User Model ta database ar jei table take represent kore oitable theke sob data fatch korechi lazy collection ar cursor() method ar maddhome.. get() ba all() method diye ooo data fatch kora jai database ar table theke kintu jodi ami get() ba all() method diye data fatch kori tahole amader oi database ar table theke sob  datake akbare fatch kore amader laravel application memory storage space ar moddhe lod kore dei jodi amader oi database ar table ar moddhe lakh lakh data thake tahole oi data gulo amader laravel application ar moddhe akbare load hole amader laravel application ta crass korbe and akta error dekhabe je amader laravel ar memory storage space overlod hoye geche...tai amra lazy collection ar cursor() method ta use korbo aita amader database ar table theke sob data ke akbare amader laravel application ar moddhe load korbe na. ta chara aikhane amai amader User Model ar sathe mane users table ar sathe amader orders table take join kore diyechi and ai join ta hobe amader 'users.id' mane users table ar id jekhane '=' soman hobe 'orders.user_id' orders table ar user_id ar sathe oikhane amader ai 2ta table join hoye jabe and jehutu join() ar moddhe amader 'orders' table ta ache tai akhane orders table ta power ta beshi thakbe jemon dhoren amader users table ar mooddhe created_at name akta column ache and orders table ar moddhe oooo created_at name akta column ache jokhon ami amader ai $ordersTable variable ar value ta foreach ar maddome print korbo amader blade.php file ar moddhe tokhon jodi ami created_at likhi tahole amra dekhbo amader orders table ar created_at column ar moddhe theke data ta ashche users table theke ashbe na karon join ar moddhe 'orders' table ar nam ache tai ai orders table ta power beshi pabe...tachara orders table ar moddhe kono name nam aa column nei kintu users table ar moddhe ache tai oi name column ar value ta amader users table theke ashbe kintu jodi amader orders table ar moddhe name nam aaa kono column thakto tahole amader name ta oi orders table thekei ashto..ta chara ami akhane whare ar pore amader column ar nam likhechi tar por while card ar 'Like' likhechi (while card ki ta amra SQL shekhar somoy jenechi) then while card ar  syntax likhechi and while card ta amader ai 2ta join kora table ar moddhe theke '$request->search'  $request theke  search nam aaa jei key ta ashche oi key ar value take amra amader name column ar theke find korchi jodi pai tahole lazy collection ar cursor() method ta amader oi data take eenne debe database ar table theke ..and orWhere ar kaj hocche akta Where ar condition match na korle oonno where a chole jabe ...

        return view('restaurant.admin.show-all-orders',['authUser' => $authUser , 'ordersTable' => $ordersTable , 'totalOrder' => $totalOrder , 'TotalOrderInProcess' => $TotalOrderInProcess , 'TotalOrderPlaced' => $TotalOrderPlaced , 'OrderOnTheWay' => $OrderOnTheWay]);  
    }
}
