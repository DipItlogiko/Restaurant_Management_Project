<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TableReservation;
use App\Models\Table;
use App\Models\Chef;
use App\Models\Worker;
use App\Models\Expense;

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


        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa
        
        //--search queary--//
        $ordersTable = User::join('orders', 'users.id' , '=' , 'orders.user_id' )
        ->where('name' , 'Like' , '%'.$request->search.'%')
        ->orWhere('food_name' , 'Like' , '%'.$request->search.'%')
        ->orWhere('order_status' , 'Like' , '%'.$request->search.'%')
        ->orWhere('user_address' , 'Like' , '%'.$request->search.'%')
        ->orWhere('orders.number', 'Like', '%'.$request->search.'%')
        ->orWhere('orders.created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhere(DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m-%d")'), $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe 
        ->cursor();  ////akhane amader User Model ta database ar jei table take represent kore oitable theke sob data fatch korechi lazy collection ar cursor() method ar maddhome.. get() ba all() method diye ooo data fatch kora jai database ar table theke kintu jodi ami get() ba all() method diye data fatch kori tahole amader oi database ar table theke sob  datake akbare fatch kore amader laravel application memory storage space ar moddhe lod kore dei jodi amader oi database ar table ar moddhe lakh lakh data thake tahole oi data gulo amader laravel application ar moddhe akbare load hole amader laravel application ta crass korbe and akta error dekhabe je amader laravel ar memory storage space overlod hoye geche...tai amra lazy collection ar cursor() method ta use korbo aita amader database ar table theke sob data ke akbare amader laravel application ar moddhe load korbe na. ta chara aikhane amai amader User Model ar sathe mane users table ar sathe amader orders table take join kore diyechi and ai join ta hobe amader 'users.id' mane users table ar id jekhane '=' soman hobe 'orders.user_id' orders table ar user_id ar sathe oikhane amader ai 2ta table join hoye jabe and jehutu join() ar moddhe amader 'orders' table ta ache tai akhane orders table ta power ta beshi thakbe jemon dhoren amader users table ar mooddhe created_at name akta column ache and orders table ar moddhe oooo created_at name akta column ache jokhon ami amader ai $ordersTable variable ar value ta foreach ar maddome print korbo amader blade.php file ar moddhe tokhon jodi ami created_at likhi tahole amra dekhbo amader orders table ar created_at column ar moddhe theke data ta ashche users table theke ashbe na karon join ar moddhe 'orders' table ar nam ache tai ai orders table ta power beshi pabe...tachara orders table ar moddhe kono name nam aa column nei kintu users table ar moddhe ache tai oi name column ar value ta amader users table theke ashbe kintu jodi amader orders table ar moddhe name nam aaa kono column thakto tahole amader name ta oi orders table thekei ashto..ta chara ami akhane whare ar pore amader column ar nam likhechi tar por while card ar 'Like' likhechi (while card ki ta amra SQL shekhar somoy jenechi) then while card ar  syntax likhechi and while card ta amader ai 2ta join kora table ar moddhe theke '$request->search'  $request theke  search nam aaa jei key ta ashche oi key ar value take amra amader name column ar theke find korchi jodi pai tahole lazy collection ar cursor() method ta amader oi data take eenne debe database ar table theke ..and orWhere ar kaj hocche akta Where ar condition match na korle oonno where a chole jabe ...

        return view('restaurant.admin.show-all-orders',['authUser' => $authUser , 'ordersTable' => $ordersTable , 'totalOrder' => $totalOrder , 'TotalOrderInProcess' => $TotalOrderInProcess , 'TotalOrderPlaced' => $TotalOrderPlaced , 'OrderOnTheWay' => $OrderOnTheWay]);  
    }


    ///====== Admin will be able to search a specific Booked table information ======///
    public function searchBookedTable(Request $request)
    {
        //--Form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        //--search queary--//
        $bookedTables = TableReservation::join('tables', 'table_reservations.table_name', '=' , 'tables.name' )                  /////akhane amader ai join ar moddhe tables table ta beshi power pabe karon ai table ar nam ta join() ar moddhe ache tai jodi eemon hoy je amader ak eee nam aaa 2ta table ar moddhei column ache and jodi ami oi column ar value take print korte chai tahole dekhbo amader join() ar moddhe jei table ar nam ache oi table theke amader oi column ar value ta ashche
        ->select('table_reservations.id as reservation_id', 'table_reservations.*', 'tables.*')
        ->where('name' , 'Like' , '%'.$request->search.'%')    ////// akhane where() ar moddhe jai name ta ache aita holo amader table ar field/column ar nam and 'Like' hocche amader while card ar syntax (Whild card amra SQL ar moddhe shikhechi) '%'$request->search'%' ar mane hocceh amader $request ar moddhe theke search nam a je key ta pabo oi key ar value ta amader '%'ar moddhe'%' chole ashbe mane amader search key ar value  ar aage and seshe je kono kichu takte pare oita amara bojhanor jonno '%' ar moddhe likhechi search key ar value take '%'
        ->orWhere('table_name' , 'Like' , '%'.$request->search.'%')
        ->orWhere('customer_email' , 'Like' ,'%'.$request->search.'%')
        ->orWhere('customer_number' , 'Like' ,'%'.$request->search.'%')
        ->orWhere('time_from' , 'Like' , '%'.$request->search.'%')
        ->orWhere('time_to' , 'Like' , '%'.$request->search.'%')
        ->orWhere('number_of_people' , 'Like' , '%'.$request->search.'%')
        ->orWhere('description' , 'Like' , '%'.$request->search.'%')
        ->cursor();  //// akhane ami TableReservation Model ta jei database ar table ke represent korche oi table ar sathe ami tables table ke join kore diyechi akhane tables nam ar table ta beshi power pabe karon ami oi table ke join ar moddhe likhechi tai...table_name aita hocche amar  table_reservations table ar column ami ai column ar sathe amader tables table ar name column ar sathe join kore diyechi...and aikhane ami (table_reservations.id as reservation_id', 'table_reservations.*', 'tables.*) select ar moddhe bole diyechi amader ai table 2take join korar pore table_reservations table ar id take reservation_id ai nam aaa dhorbe and (table_reservations.*)  table_reservations table theke sob data anbe ai * astrick simbol mane hocche all..and amader users table theke oo sob datake anbe 
    
        return view('restaurant.admin.table.all-reserved-table',['bookedTables'=>$bookedTables , 'authUser'=>$authUser]);
    }

    ///======== Admin will be able to search specific table from tables records ========///
    public function tableSearch(Request $request)
    {
        //--Form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        //--search queary--//
        $tables = Table::withTrashed()
        ->where('name' , 'Like' , '%'.$request->search.'%')
        ->orWhere('capacity' , 'Like' , '%'.$request->search.'%')
        ->cursor();

        return view('restaurant.admin.table.all-tables', ['tables' => $tables , 'authUser' => $authUser]);
    }

    ///======== Admin will be able to search specific chef by information from chefs records ========///
    public function chefSearch(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        //--search queary--//
        $chefs = Chef::where('name' , 'Like' , '%'.$request->search.'%')  ///// akane amader Chef Model ta amader database ar chefs table take represent kore and oi table theke ami where diye ami bolechi oi table ar moddhe 'name' nam aa jei column ta ache oi column ar moddhe theke $request ar moddhe theke je search name key ta ashche oi key ar value ta diye ami amder database ar oi table ar name column theke find korchi whild card ar maddhom and ai whild card ta amra (SQL shekhar somoy shikhechi) 'Like' hocche amader whild card ar syntax and tar pore '%'.$request->search.'%' ar mane hocche amader $request theke je search name aa key ta ashbe oi key ar valu ta diye amader name column ar moddhe find korbe and ar aage ba pore ja khushi thakte pare ai ta amra '%' aage and pore likhe tai bujhiyechi 
        ->orWhere('position' , 'Like' , '%'.$request->search.'%')
        ->orWhere('twitter' , 'Like' , '%'.$request->search.'%')
        ->orWhere('facebook' , 'Like' , '%'.$request->search.'%')
        ->orWhere('instagraam' , 'Like' , '%'.$request->search.'%')
        ->orWhere('linkedin' , 'Like' , '%'.$request->search.'%')
        ->cursor();


        return view('restaurant.admin.chef.all-chefs', ['authUser' => $authUser,'chefs' => $chefs]);
    }

    ///=========== Admin will be able to search a specific worker from the workers records =========///
    public function searchWorker(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        //--search queary--//
        $workers = Worker::where('name' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('position' , 'Like' , '%'.$request->search.'%')
        ->orWhere('email' , 'Like' , '%'.$request->search.'%')
        ->orWhere('number' , 'Like' , '%'.$request->search.'%')
        ->orWhere('address' , 'Like' , '%'.$request->search.'%')         
        ->cursor();


        return view('restaurant.admin.worker.all-workers', ['authUser' => $authUser,'workers' => $workers]);
    }

    ///=========== Admin will be able to search a specific expense from the expenses records ==========///
    public function searchExpense(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        $expenses = Expense::where('expense_type' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('description' , 'Like' , '%'.$request->search.'%')
        ->orWhere('total_amount' , 'Like' , '%'.$request->search.'%')
        ->orWhere('created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhere(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->cursor();


        return view('restaurant.admin.expense.search-expenses', ['authUser' => $authUser,'expenses' => $expenses]);
    }

    ///=============== Admin will be able to Search a Specific customer message ==============///
    public function searchMessage(Request $request)
    {         
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        $messages = User::join('messages', 'users.id', '=' , 'messages.user_id')
        ->where('name' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('email' , 'Like' , '%'.$request->search.'%')
        ->orWhere('message' , 'Like' , '%'.$request->search.'%')
        ->orWhere('messages.created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhere(DB::raw('DATE_FORMAT(messages.created_at, "%Y-%m-%d")'), $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->cursor();


        return view('restaurant.admin.message.search-messages', ['authUser'=> $authUser, 'messages' => $messages]);
    }

    
}
