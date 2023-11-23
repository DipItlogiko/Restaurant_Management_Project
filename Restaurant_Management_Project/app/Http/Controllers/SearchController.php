<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\TableReservation;
use App\Models\Table;
use App\Models\Chef;
use App\Models\Worker;
use App\Models\Expense;
use App\Models\Food;
use App\Models\Message;
use App\Models\Cart;
use App\Models\Order;

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
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe


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
        ->orWhereDate('orders.created_at','=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe 
        ->paginate(7);  ////akhane amader User Model ta database ar jei table take represent kore oi table theke amader request theke jei search ar value ta ashche oi value diye data fatch korchi and aikhan theke jei data guloke pabo oi datagulo ke ami paginate(7) kore diyechi mane amader ai khane jei data gulo pabe oi data guloke 7 ta 7 ta kore amder ak ak ta page ar moddhe show korabe jodi amader search ar value onujayi amader database ar table theke 10 ta data pai tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe..akhane ami paginate() use korechi and ai search ar result gulo amader jei variable ar moddhe store korche and ai variable ta amra jei khane use korchi amader search ar result dekhanor jonno oi page ar moddhe amader pagination ar degine korte hobe jemon ami niche jei page ar moddhe amader ai search ar result ta jei variable ar moddhe ache oi variable ta pass korechi and oi page ar moddhe amra amader pagination ar degine ta korechi.....

        return view('restaurant.admin.search-order',['authUser' => $authUser , 'ordersTable' => $ordersTable , 'totalOrder' => $totalOrder , 'TotalOrderInProcess' => $TotalOrderInProcess , 'TotalOrderPlaced' => $TotalOrderPlaced , 'OrderOnTheWay' => $OrderOnTheWay , 'messages' => $messages , 'notifications' => $notifications ]);  
    }


    ///====== Admin will be able to search a specific Booked table information ======///
    public function searchBookedTable(Request $request)
    {
        //--Form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

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
    
        return view('restaurant.admin.table.search-reserved-table',['bookedTables'=>$bookedTables , 'authUser'=>$authUser , 'messages'=>$messages , 'notifications' => $notifications]);
    }

    ///======== Admin will be able to search specific table from tables records ========///
    public function tableSearch(Request $request)
    {
        //--Form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        if ($request->search == 'Booked' || $request->search == 'booked')
        {
            $tables = Table::onlyTrashed()->paginate(4);
        
        }elseif ($request->search == 'Available' || $request->search == 'available')
        {
            $tables = Table::withoutTrashed()->paginate(4);
        
        }else{

            $tables = Table::withTrashed()
            ->where('name' , 'Like' , '%'.$request->search.'%')
            ->orWhere('capacity' , 'Like' , '%'.$request->search.'%')
            ->orWhere('created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
            ->orWhereDate('created_at','=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
            ->paginate(4); //// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe... and amra ai $tables variable ta jei view ar moddhe pass korchi oi view ar moddhe amader pagination ar degine ta korte hobe tahole amra ai pagination ta amader page ar moddhe dekhte pabo   
        }
        
         
        return view('restaurant.admin.table.search-table', ['tables' => $tables , 'authUser' => $authUser ,'messages' => $messages , 'notifications' => $notifications]);
    }

    ///======== Admin will be able to search specific chef by information from chefs records ========///
    public function chefSearch(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        //--search queary--//
        $chefs = Chef::where('name' , 'Like' , '%'.$request->search.'%')  ///// akane amader Chef Model ta amader database ar chefs table take represent kore and oi table theke ami where diye ami bolechi oi table ar moddhe 'name' nam aa jei column ta ache oi column ar moddhe theke $request ar moddhe theke je search name key ta ashche oi key ar value ta diye ami amder database ar oi table ar name column theke find korchi whild card ar maddhom and ai whild card ta amra (SQL shekhar somoy shikhechi) 'Like' hocche amader whild card ar syntax and tar pore '%'.$request->search.'%' ar mane hocche amader $request theke je search name aa key ta ashbe oi key ar valu ta diye amader name column ar moddhe find korbe and ar aage ba pore ja khushi thakte pare ai ta amra '%' aage and pore likhe tai bujhiyechi 
        ->orWhere('position' , 'Like' , '%'.$request->search.'%')
        ->orWhere('twitter' , 'Like' , '%'.$request->search.'%')
        ->orWhere('facebook' , 'Like' , '%'.$request->search.'%')
        ->orWhere('instagraam' , 'Like' , '%'.$request->search.'%')
        ->orWhere('linkedin' , 'Like' , '%'.$request->search.'%')
        ->paginate(7);  //// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe... and amra ai $chefs variable ta jei view ar moddhe pass korchi oi view ar moddhe amader pagination ar degine ta korte hobe tahole amra ai pagination ta amader page ar moddhe dekhte pabo   


        return view('restaurant.admin.chef.search-chef', ['authUser' => $authUser,'chefs' => $chefs ,'messages' => $messages , 'notifications' => $notifications]);
    }

    ///=========== Admin will be able to search a specific worker from the workers records =========///
    public function searchWorker(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        //--search queary--//
        $workers = Worker::where('name' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('position' , 'Like' , '%'.$request->search.'%')
        ->orWhere('email' , 'Like' , '%'.$request->search.'%')
        ->orWhere('number' , 'Like' , '%'.$request->search.'%')
        ->orWhere('address' , 'Like' , '%'.$request->search.'%')         
        ->paginate(7); //// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe...   


        return view('restaurant.admin.worker.search-worker', ['authUser' => $authUser,'workers' => $workers, 'messages' => $messages , 'notifications' => $notifications]);
    }

    ///=========== Admin will be able to search a specific expense from the expenses records ==========///
    public function searchExpense(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        $expenses = Expense::where('expense_type' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('description' , 'Like' , '%'.$request->search.'%')
        ->orWhere('total_amount' , 'Like' , '%'.$request->search.'%')
        ->orWhere('created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhereDate('created_at','=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->paginate(7);  //// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe... and amra ai $expenses variable ta jei view ar moddhe pass korchi oi view ar moddhe amader pagination ar degine ta korte hobe tahole amra ai pagination ta amader page ar moddhe dekhte pabo   


        return view('restaurant.admin.expense.search-expenses', ['authUser' => $authUser,'expenses' => $expenses ,'messages' => $messages, 'notifications' => $notifications]);
    }

    ///=============== Admin will be able to Search a Specific customer message ==============///
    public function searchMessage(Request $request)
    {         
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        $allMessages = User::join('messages', 'users.id', '=' , 'messages.user_id')
        ->where('name' , 'Like' , '%'.$request->search.'%')   
        ->orWhere('email' , 'Like' , '%'.$request->search.'%')
        ->orWhere('message' , 'Like' , '%'.$request->search.'%')
        ->orWhere('messages.created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhereDate('messages.created_at','=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->paginate(7);  ///// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe... and amra ai $allMessages variable ta jei view ar moddhe pass korchi jemon resources/views/restaurant/admin/message/search-messages.blade.php  ai view ar moddhe amader pagination ar degine ta korte hobe tahole amra ai pagination ta amader page ar moddhe dekhte pabo    


        return view('restaurant.admin.message.search-messages', ['authUser'=> $authUser, 'allMessages' => $allMessages , 'messages' => $messages , 'notifications' => $notifications]);
    }    


    ///=============== Admin Will be able to search a specific user from the users records ====================///
    public function searchUser(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard Message,which is located into admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        if ($request->search == 'Admin' || $request->search == 'admin')    ////// jehetu amader users table ar moddhe user_type column ar moddhe 1 and 0 ache and all users ar moddhe jei search bar ache oikhane admin jodi User ba Admin diye search kore tahole jeno amader database ar users table ar moddhe jei user_type column ta ache 0 and 1, so jodi user diye search kore tahole amader database ar users table ar moddhe theke user_type column ar moddhe jeikhane 0 ache oi data guloke sob niye ashbe .. and jodi key Admin ba admin diye search kore tahole amader users table ar user_type column ar jeikhane 1 ache oi dataguloke akhane niye ashbe  and aikhane || aita mane or bojhai jemon ta amra jani or ar jekono akta pash ar condition match korlei if ar moddhe jei code ta thake oitake read kore and execute kore kintu && mane and ai and ar 2 pash ar condition match na korle if ar moddhe thaka code read kore na and execute oo kore na
        {
            $users= User::where('user_type' , '=' , 1)->paginate(7);   /// akhane search field ar value diye queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        
        }elseif($request->search == 'User' || $request->search == 'user')
        {
            $users= User::where('user_type' , '=' , 0)->paginate(7);
        
        }elseif($request->search == 'Not Varified' || $request->search == 'not varified')
        {
            $users= User::where('email_verified_at' , '=' , null)->paginate(7);
        
        }else{
            $users= User::where('name' , 'Like' , '%'.$request->search.'%')
            ->orWhere('email' , 'Like' , '%'.$request->search.'%')         
            ->orWhere('created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
            ->orWhereDate('created_at','=', $searchDate)
            ->orWhereDate('updated_at','=', $searchDate)
            ->orWhereDate('email_verified_at','=', $searchDate)
            ->paginate(7); /// akhane search field ar value diye queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        } 


        return view('restaurant.admin.search-user', ['authUser'=> $authUser, 'users' => $users, 'messages' => $messages , 'notifications' => $notifications]);
    }

    ///================ Admin will be able to search a specific user for delete ===============///
    public function searchUserForDelete(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard Message,which is located into admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        if ($request->search == 'Admin' || $request->search == 'admin')    ////// jehetu amader users table ar moddhe user_type column ar moddhe 1 and 0 ache and delete users ar moddhe jei search bar ache oikhane admin jodi User ba Admin diye search kore tahole jeno amader database ar users table ar moddhe jei user_type column ta ache 0 and 1, so jodi user diye search kore tahole amader database ar users table ar moddhe theke user_type column ar moddhe jeikhane 0 ache oi data guloke sob niye ashbe .. and jodi key Admin ba admin diye search kore tahole amader users table ar user_type column ar jeikhane 1 ache oi dataguloke akhane niye ashbe  and aikhane || aita mane or bojhai jemon ta amra jani or ar jekono akta pash ar condition match korlei if ar moddhe jei code ta thake oitake read kore and execute kore kintu && mane and ai and ar 2 pash ar condition match na korle if ar moddhe thaka code read kore na and execute oo kore na
        {
            $users= User::where('user_type' , '=' , 1)->paginate(7);     ////// akhane  queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        
        }elseif($request->search == 'User' || $request->search == 'user')
        {
            $users= User::where('user_type' , '=' , 0)->paginate(7);
        
        }elseif($request->search == 'Not Varified' || $request->search == 'not varified')
        {
            $users= User::where('email_verified_at' , '=' , null)->paginate(7);
        
        }else{
            $users= User::where('name' , 'Like' , '%'.$request->search.'%')
            ->orWhere('email' , 'Like' , '%'.$request->search.'%')         
            ->orWhere('created_at', 'Like', '%'.$request->search.'%')   ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
            ->orWhereDate('created_at','=', $searchDate)
            ->orWhereDate('updated_at','=', $searchDate)
            ->orWhereDate('email_verified_at','=', $searchDate)
            ->paginate(7);  ///// akhane search field ar value diye queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        }      


        return view('restaurant.admin.search-users-delete', ['authUser'=> $authUser, 'users' => $users, 'messages' => $messages , 'notifications' => $notifications]);
    }

    ///============= Admin will be able to search a specific Trush user i mean deleted user =============///
    public function searchTrushUser(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard Message,which is located into admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        if ($request->search == 'Admin' || $request->search == 'admin')    ////// jehetu amader users table ar moddhe user_type column ar moddhe 1 and 0 ache and delete users ar moddhe jei search bar ache oikhane admin jodi User ba Admin diye search kore tahole jeno amader database ar users table ar moddhe jei user_type column ta ache 0 and 1, so jodi user diye search kore tahole amader database ar users table ar moddhe theke user_type column ar moddhe jeikhane 0 ache oi data guloke sob niye ashbe .. and jodi key Admin ba admin diye search kore tahole amader users table ar user_type column ar jeikhane 1 ache oi dataguloke akhane niye ashbe  and aikhane || aita mane or bojhai jemon ta amra jani or ar jekono akta pash ar condition match korlei if ar moddhe jei code ta thake oitake read kore and execute kore kintu && mane and ai and ar 2 pash ar condition match na korle if ar moddhe thaka code read kore na and execute oo kore na
        {
            $users= User::onlyTrashed()->where('user_type' , '=' , 1)->paginate(7);     /// akhane queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        
        }elseif($request->search == 'User' || $request->search == 'user')
        {
            $users= User::onlyTrashed()->where('user_type' , '=' , 0)->paginate(7);
        
        }elseif($request->search == 'Not Varified' || $request->search == 'not varified')
        {
            $users= User::onlyTrashed()->where('email_verified_at' , '=' , null)->paginate(7);
        
        }else{
            $users = User::where(function ($query) use ($request , $searchDate) {  ///// akhane amra aivabe korechi karon amader jodi kew date diye search dei tahole dekha jabe amader search ar result ar moddhe jei user gulo trush ar moddhe jei mane softdelete hoy ni oi user gulo  oo amader user trush ar moddhe dekhabe search ar pore to oi problem take solve korar jonno amra aivabe korechi where() ar moddhe akta function declear korechi and ai function ta amader $request , $searchDate ai 2ta variable ke use korte parbe
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('created_at', 'like', '%' . $request->search . '%')
                    ->orWhereDate('created_at','=', $searchDate)
                    ->orWhereDate('updated_at','=', $searchDate)
                    ->orWhereDate('email_verified_at','=', $searchDate);
            })
            ->onlyTrashed()
            ->paginate(7); /// akhane search field ar value diye queary korar pore jei koita data pabe oi koita datake 7 ta 7 ta kore ak ak ta page ar moddhe show korbe jodi queary korar pore 10 data pai tahole 1 page ar moddhe 7 ta data dekhabe and oonno page ar moddhe 3 ta data dekhabe 
        }      


        return view('restaurant.admin.search-trush-users', ['authUser'=> $authUser, 'users' => $users, 'messages' => $messages , 'notifications' => $notifications]);
    }

    ///=============== Admin will be able to search a specific food from foods records =============///
    public function searchFood(Request $request)
    {
        //--form data validation--//
         $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        //--For Admin Dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa

        //--search queary--//
        $Foods = Food::where('title' , 'Like', '%'.$request->search.'%')      //// akhane amader Food Model ta database ar jei table take take represent kore oi table ar protita column ar sathe amader $request theke search key ar moddhe jei value ta ashche oi value ta diye check korchi and amader ai Food Model ta database ar food table take represent kore
        ->orWhere('food_type' , 'Like', '%'.$request->search.'%')
        ->orWhere('price' , 'Like' , '%'.$request->search.'%')
        ->orWhere('description' , 'Like' , '%'.$request->search.'%')
        ->orWhere('created_at' , 'Like' , '%'.$request->search.'%')  ///// jodi kew created_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe created_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhere('updated_at' , 'Like' , '%'.$request->search.'%')    ///// jodi kew updated_at column ar kono date ar kono number ta dei ba kono sonkha dei tahole oooo amader search ar result show korbe.....dhoren amader database ar ai table ar moddhe updated_at column ar moddhe akta date ache 2023-11-14 akhon kew jodi amader search bar ar moddhe 2023 ba 11 ba 14 jai eee likhuk na keno  amader search ar akta result dekhabe..
        ->orWhereDate('created_at','=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->orWhereDate('updated_at', '=', $searchDate)      /////jodi kew amader search bar ar moddhe 14-11-2023(d-m-Y) ai format diye ooo search kore tahole aikhan theke oita handel hobe and oi date ar data ta dekhabe       
        ->paginate(7);      ///// akhane amader $request->search ar moddhe theke je value ta ashbe oi value ta diye amader database ar table ar moddhe search korar pore amra jei data ta pabo oi data take ami aikhane paginate() korechi and paginate ar moddhe bole diyechi amader protita page ar moddhe 7 ta kore data thakbe jemon jodi amder aikhane 10 ta data pai queary kore tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar moddhe 3 ta data dekhabe... and amra ai $Foods variable ta jei view ar moddhe pass korchi niche oi view ar moddhe amader pagination ar degine ta korte hobe tahole amra ai pagination ta amader page ar moddhe dekhte pabo    


        return view('restaurant.admin.search-food', ['authUser'=> $authUser, 'Foods' => $Foods , 'messages' => $messages , 'notifications' => $notifications]);
    }


    ///================ User will be able to search his own messages from database table =============///
    public function searchUserMessage(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        $count = Cart::where('user_id', $authUser->id )->count(); //// akhane amader Cart model ta amader database ar jei table take represent kore jemon aikhane Cart model ta amader database ar carts table take represent kore akhane carts table theke ami where ar moddhe bolechi carts table ar user_id column ar moddhe $authUser->id mane authenticated user ar id kotobar ache oita aikhane count() korechi 
        $orderCount = Order::where('user_id', $authUser->id)->count();
        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa
        
        //--search queary--//
        $specificUserAllMessages = Message::where('user_id', $authUser->id)  //// akhane amader Message Model ta database ar jei table take represent kore jemon messages nam ar akta database ar table ke amader ai Message Model ta represent kore oi table theke akhane check korbe amader jei user ta amader application ar modddhe authenticated hoye asheche mane signUp and signIn kore amader application ar moddhe asheche oi user ar id ta amra pabo and oi user jokon ee all messages ar search bar ar moddhe kono data diye search korbe tokhon oi user ar id onujayi search ar value diye amader messages table ar moddhe theke jei koita data pabe oi koita data show korbe
        ->where(function ($query) use ($request , $searchDate) {   ///// and akhane amra anonymous function use korechi and ai anonymous function ta use kora hoy conditional search ar jonno jemon akhane ami conditionaly search korechi amader authenticated user jokhon eee message ar search bar ar moddhe kono value diye searche korbe oi authenticated user ar id diye amader messages table ar moddhe check kora hobe and check kore jei koita data pabe oi koita data theke amader search ar value diye search korbe and search korar pore amra jei data ba result ta pabo oi result take amra lazy collection ar cursor() method diye fatch korechi...and anonymous function hocche jei function ar kono nam thake ta oi function ke anonymous function bole.. amader $query ai variable ta queary builder ar instance ke represent kore jei query ta amra niche build korechi and ai $query mane queary builder ar instance ta amader $request , $searchDate ai 2ta variable ke use korbe
            $query->where('message', 'like', '%' . $request->search . '%')
                ->orWhere('created_at', 'like', '%' . $request->search . '%')
                ->orWhereDate('created_at','=',$searchDate);  
        })
        ->paginate(7);   ///// amader oopore search key diye  queary korar pore jei koita data pabe oi data guloke ak ak ta page ar moddhe 7 ta 7 ta kore dekhabe jodi amader ai khane queary korar pore 10 ta data pai tahole amader 1st page ar moddhe 7 ta data dekhabe and 2nd page ar modddhe amader 3 ta data dekhabe ...and pagination ar degine ta amader application ar moddhe dkhanor jonno amra ai pagination ar variable ta niche jei view ar moddhe pathaccchi oi view file ar moddhe diye amader pagination ar degine ta korte hobe ta chara amra pagination ar degine ta dekhte pabo na...  


        return view('restaurant.user.message.search-messages' , ['authUser'=> $authUser ,'specificUserAllMessages' => $specificUserAllMessages , 'orderCount' => $orderCount , 'count' => $count]);
    
    }

    ///=================== User will be able to search his specific order from his own order history ====================///
    public function searchOrder(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'search' => ['required'],
        ]);

        $authUser = Auth::user();
        $count = Cart::where('user_id', $authUser->id )->count(); //// akhane amader Cart model ta amader database ar jei table take represent kore jemon aikhane Cart model ta amader database ar carts table take represent kore akhane carts table theke ami where ar moddhe bolechi carts table ar user_id column ar moddhe $authUser->id mane authenticated user ar id kotobar ache oita aikhane count() korechi 
        $orderCount = Order::where('user_id', $authUser->id)->count();

        //--convert date format for searching--//
        $searchDate = date("Y-m-d", strtotime($request->search));    ///// amader $request->search mane $request ar moddhe theke je search key ta ashbe oi key ar value ta string aakare ashbe tai ami amader $request->search ar moddhe theke jei value ta pabo oitake timestrap aaa convart korar jonno ai strtotime() method ar moddhe rekhechi ai method ar kaj hocche amader string take timestrap aa convart kora and oi date take Y-m-d te convart kora jemon ami search ar moddhe jodi d-m-Y ai format aa search kori tahole oi format ta akhan theke convart hoye jabe Y-m-d ai format aaa karon amader database ar moddhe created_at column ar moddhe date ta Y-m-d ai format aa ache to jokhon ami amader serach bar theke d-m-Y ai format aa search korbo tokhon kono data ashbe na ai problem take solve korar jonno amra aikhan theke date ar format take convart kore nicchi...ai Y-m-d format aaaa
        
        //--search queary--//
        if($request->search == 'Your Order Is Under Processing' || $request->search == 'your order is under processing')  /// akhane jodi amader $request->search ar moddhe theke 'Your Order Is Under Processing' othoba  'your order is under processing' jei kono akta ashlei amader if ar moddher code ta execute hobe
        {
            $data = Order::where('user_id', $authUser->id) 
                ->where(function ($query) {                  ///// and akhane amra anonymous function use korechi and ai anonymous function ta use kora hoy conditional search ar jonno jemon akhane ami conditionaly search korechi amader authenticated user jokhon eee message ar search bar ar moddhe kono value diye searche korbe oi authenticated user ar id diye amader messages table ar moddhe check kora hobe and check kore jei koita data pabe oi koita data theke amader search ar value diye search korbe and search korar pore amra jei data ba result ta pabo oi result take amra lazy collection ar cursor() method diye fatch korechi...and anonymous function hocche jei function ar kono nam thake ta oi function ke anonymous function bole.. amader $query ai variable ta queary builder ar instance ke represent kore jei query ta amra niche build korechi and ai $query mane queary builder ar instance ta amader $request , $searchDate ai 2ta variable ke use korbe
                    $query->where('order_status', '=' , 'processing' );           /// amader orders table ar user_id column ar sathe amader $authUser->id jekhane match korbe oi data gulo theke check korbe oi data gulor order_status column ar value kothai kothai 'processing' ache and oi data guloke amader akhane aane debe
                         
                })
                ->orderBy('created_at' , 'desc')
                ->paginate(7);              ////// akhane amader orders table theke protita specific user ar koita order processing aa ache oi data ta pabo and oi data take ami 'desc' mane descending format aaa sajiyechi descending format mane hocche boto theke choto amader created_at column ar opor vitti kore amader ai 'desc' ta hobe and oi datake ami aikhane paginate(7) kore diyechi mane amader protita page ar moddhe 7 ta kore data dekhabe jodi amader aikhane queary korar pore 10 ta data pai tahole amader application ar moddhe prothom page ar moddhe 7 ta data dekhabe and second page ar moddhe 3 ta data dekhabe
        
        }elseif($request->search == 'Your Food is Delivered' || $request->search == 'your food is delivered')
        {
            $data = Order::where('user_id', $authUser->id) 
                ->where(function ($query) {   ///// and akhane amra anonymous function use korechi and ai anonymous function ta use kora hoy conditional search ar jonno jemon akhane ami conditionaly search korechi amader authenticated user jokhon eee message ar search bar ar moddhe kono value diye searche korbe oi authenticated user ar id diye amader messages table ar moddhe check kora hobe and check kore jei koita data pabe oi koita data theke amader search ar value diye search korbe and search korar pore amra jei data ba result ta pabo oi result take amra lazy collection ar cursor() method diye fatch korechi...and anonymous function hocche jei function ar kono nam thake ta oi function ke anonymous function bole.. amader $query ai variable ta queary builder ar instance ke represent kore jei query ta amra niche build korechi and ai $query mane queary builder ar instance ta amader $request , $searchDate ai 2ta variable ke use korbe
                    $query->where('order_status', '=' , 'placed' );  
                         
                })
                ->orderBy('created_at' , 'desc')
                ->paginate(7);
        
        
        }elseif($request->search == 'Your Food Is On The Way' || $request->search == 'your food is on the way')
        {
            $data = Order::where('user_id', $authUser->id) 
                ->where(function ($query) {   ///// and akhane amra anonymous function use korechi and ai anonymous function ta use kora hoy conditional search ar jonno jemon akhane ami conditionaly search korechi amader authenticated user jokhon eee message ar search bar ar moddhe kono value diye searche korbe oi authenticated user ar id diye amader messages table ar moddhe check kora hobe and check kore jei koita data pabe oi koita data theke amader search ar value diye search korbe and search korar pore amra jei data ba result ta pabo oi result take amra lazy collection ar cursor() method diye fatch korechi...and anonymous function hocche jei function ar kono nam thake ta oi function ke anonymous function bole.. amader $query ai variable ta queary builder ar instance ke represent kore jei query ta amra niche build korechi and ai $query mane queary builder ar instance ta amader $request , $searchDate ai 2ta variable ke use korbe
                    $query->where('order_status', '=' , 'on the way' );  
                         
                })
                ->orderBy('created_at' , 'desc')
                ->paginate(7);
        
        
        }else{

            $data = Order::where('user_id', $authUser->id)
            ->where(function ($query) use ($request , $searchDate) {   ///// and akhane amra anonymous function use korechi and ai anonymous function ta use kora hoy conditional search ar jonno jemon akhane ami conditionaly search korechi amader authenticated user jokhon eee message ar search bar ar moddhe kono value diye searche korbe oi authenticated user ar id diye amader messages table ar moddhe check kora hobe and check kore jei koita data pabe oi koita data theke amader search ar value diye search korbe and search korar pore amra jei data ba result ta pabo oi result take amra lazy collection ar cursor() method diye fatch korechi...and anonymous function hocche jei function ar kono nam thake ta oi function ke anonymous function bole.. amader $query ai variable ta queary builder ar instance ke represent kore jei query ta amra niche build korechi and ai $query mane queary builder ar instance ta amader $request , $searchDate ai 2ta variable ke use korbe
                $query->where('price', 'like', '%' . $request->search . '%')
                    ->orWhere('quantity', 'like', '%' . $request->search . '%')
                    ->orWhere('food_name', 'like', '%' . $request->search . '%')
                    ->orWhere('created_at', 'like', '%' . $request->search . '%')
                    ->orWhereDate('created_at','=',$searchDate)
                    ->orWhereDate('updated_at','=',$searchDate);  
            })
            ->orderBy('created_at' , 'desc')
            ->paginate(7);
        }

        

        return view('restaurant.user.search-order-history' , ['authUser' => $authUser , 'data' => $data , 'orderCount' => $orderCount , 'count' => $count]);
    }


    
}
