<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Table;
use App\Models\TableReservation;
use App\Models\Order;
use App\Models\Cart;

class TablesController extends Controller
{
    ///====== Admin will be able to see create tables page =====/// 
    public function createTable()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.table.create-table', ['authUser' => $authUser]);
    }

    ///====== Admin will be able to store table name and capacity into the database table =====///
    public function storeTable(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'tableName' => ['required','string'],
            'capacity' => ['required','integer'],
        ]);
        
        //--save form data into the database table--//
        $tables = new Table;

        $tables->name = $request->tableName;
        $tables->capacity = $request->capacity;

        $tables->save();

        return redirect()->route('admin.create.tables')->with('status', 'New table created successfully!!!');
    }

    ///====== Admin will be able to see all table  list with edit and delete button ======///
    public function showTables()
    {
        $authUser = Auth::user();
        $tables = Table::withTrashed()->cursor();  //// akhane amader Table Model ta amader database ar jei table take represent kore jemon aikhane amader Table Model ta database ar tables table take represent korche oi table ar theke ami sob data fatch korechi lazy collection ar cursor() method diye get() method ba all() method ar theke cursor() method ta use kora valo karon cursor() method amader database theke sob datake aaane amader laravel application ar memory storage space ar moddhe akbare load kore dei na jar fole amader laravel ar memory storage space ta overflow hoye jawar chanch thake na..kintu jodi amra get() ba all() method ta use kori database ar table theke data fatch korar jonno tahole amader oi table ar moddhe jodi lakh lakh data thake tahole oi lakh lakh data amader laravel application ar moddhe akbare load hoye jabe and amader laravel application ar memory storage space overflow hoye giye amader application ta crass korbe and akta error dekhabe je memory storage overflow..tai good practice hocche get() ba all() method use na kore lazy collection ar cursor() method ta use kora valo database theke data fatch korar somoy...and amra fatch korechi withTruash() method ta use korechi karon ami laravel ar softdelete freture ta use korchi ai Table Model ar sathe.and ami ai book table ar bepar ta softdelete freture diye handel korchi...kokhon amader ai Table Model theke kichu delete hobe ba jokhon kew order korbe tokhon oi data take ba table take ami delete korbo mane softdelete korbo mane oi datata amader application theke chole jabe kintu database ar table theke jabe na jokhon amader tables table theke kono data softdelete hobe tokhon to amader datata amader application theke chole jabe amader tables table ar moddhe jei table gulo ache oi table ta oo chole jabe jokhon softdelete hobe softdelete howar pore ooo jeno amader tables table ar moddhe koita table ache oi sob koita table jeno amader aikhane show kore tai ami aikhane data fatch korar somoy SoftDelete freature ar akta method withTrushed() method ta use korechi ai withTrushed() method ar kaj hocche amader database ar table ar moddhe jei datagulo delete hoyeche and jei datagulo delete hoy ni sob data show korbe....and ami jodi onlyTrushed() method use kortam tahole amader oi table theke shudhu delete howa data gulo dekhato..
        return view('restaurant.admin.table.all-tables', ['authUser' => $authUser , 'tables' => $tables]);
    }

    ///====== Admin will be able to edit tables information =======///
    public function editTable($id)
    {
        $tables = Table::withTrashed()->find($id);
        $authUser = Auth::user();
         
        return view('restaurant.admin.table.edit-table', ['authUser' => $authUser, 'tables' => $tables]);
    }

    ///====== Admin Updated table info will store here =======///
    public function updateTable(Request $request , $id)
    {
        //--form data validation--//
        $request->validate([
            'tableName' => ['required','string'],
            'capacity' => ['required','integer'],
        ]);

        $specificTable = Table::find($id); //// akhane ami amader Table Model ar sathe mane amader ai Table Model ta database ar jei table take represent kore jemon amader application ar moddhe ai Table Model ta database ar tables table take represent kore and ami aikhane amader oi tables table theke find korechi amader ai $id diye ..amader $id ar value ja hobe oi value ba number ta find korbe amader tables table ar moddhe giye and oi data take fatch kore niye ashbe  $specificTable variable ar moddhe

        //--store data into the database--//
        $specificTable->name = $request->tableName;
        $specificTable->capacity = $request->capacity;

        $specificTable->save();

        return redirect()->route('admin.show.all.tables')->with('status','Table information updated successfully!!!');
         
    }

    ///====== Admin will be able to permanently delete a spacific rastaurant table from the database table ======///
    public function deleteTable($id)
    {
        $specificTable = Table::find($id);

        $specificTable->forceDelete();  ////jehetu ami Table Model ar sathe laravel ar softdelete freture ta add korechi tai jodi aikhane forceDelete() na diye delete() ditam tahole ooo softdelete korto mane amader application ar moddhe theke ai data ta chole jeto kintu amader database ar moddhe theke ai data ta delete hoto na...amader application and database ai 2 jaiga theke puropuri delete korar jonno ami aikhane forceDelete() method ta use korechi..... 
        
        return redirect()->route('admin.show.all.tables')->with('status' , 'Table deleted successfully!!!');
    }

    ///===== Admin will be able to reserve/book a restaurant table for user/customer =====///
    public function tableReservation()
    {
        $authUser = Auth::user();
        $tables = Table::where('deleted_at', NULL)->cursor(); //// akhane ami amader Table Model mane tables nam a database a jei table ta ache oi table theke where diye check korechi amader tables nam aa je database ar table ache oi table ar deleted_at column ar value jeikhane null ba '' ache oi data guloke aikhane fatch kore niye ashbe          
        return view('restaurant.admin.table.table-reservation' , ['authUser' => $authUser , 'tables' => $tables]);
    }


    ///===== Admin will be able to store table reservation information for user/customer =====///
    public function storeTableReservation(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'customerName' => ['required','regex:/^[A-Za-z\s]+$/'],
            'customerEmail' => ['required','email'],
            'customerNumber' => ['required','regex:/^[0-9]+$/','min:11','max:11'],
            'timeFrom' => ['required'],
            'timeTo' => ['required'],
            'nop' => ['required','regex:/^[0-9]+$/','max:2'],
            'tableName' => ['required','string'],
            'description' => ['required','regex:/^[A-Za-z\s\.,\-]+$/'], 
        ]);

        //--store data into database table--//
        $tableReservations = new TableReservation;

        $tableReservations->customer_name = $request->customerName;
        $tableReservations->customer_email = $request->customerEmail;
        $tableReservations->customer_number = $request->customerNumber;
        $tableReservations->time_from = $request->timeFrom;
        $tableReservations->time_to = $request->timeTo;
        $tableReservations->number_of_people = $request->nop;
        $tableReservations->table_name = $request->tableName;
        $tableReservations->description = $request->description;

        $tableReservations->save();

        //--book table logic here--//
       $specificTable = Table::where('name', $request->tableName); //// akhane ami amader Table Model ta database ar jei table take represent kore jemon aikhane amader Table model ta database ar tables nam aa akta table ke represent kore oi database ar tables nam ar table theke ami where diye find korechi amader oi table ar name column theke check korchi je amader request theke jei table ar nam ta ashche oi name diye check korbe amader oi table ar name column ar moddhe and oi data take niye ashbe  
       $specificTable->delete();

        return redirect()->back()->with('status', 'Table Reserved Successfully!!!'); //// return redirect()->back() mane hocche amader ai post request ta jei page theke asheche oi page ar moddhe aabar back korbe oopore kaj gulo korar por..jemon amader ai request ta ashche amader resources/views/admin/table/table-reservation.blade.php tai opore kaj gulo hoye gele amader oi page ar moddhe abar redirect korebe ata message soho 'Table Reserved Successfully!!!'
    }

    ///====== Admin will be able to see all reserved table info with free and delete button ======/// 
    public function showAllReservedTable()
    {
       $authUser = Auth::user(); 
       $bookedTables = TableReservation::join('tables', 'table_name', '=' , 'name' )->select('table_reservations.id as reservation_id', 'table_reservations.*', 'tables.*')->cursor();  //// akhane ami TableReservation Model ta jei database ar table ke represent korche oi table ar sathe ami tables table ke join kore diyechi akhane tables nam ar table ta beshi power pabe karon ami oi table ke join ar moddhe likhechi tai...table_name aita hocche amar  table_reservations table ar column ami ai column ar sathe amader tables table ar name column ar sathe join kore diyechi...and aikhane ami (table_reservations.id as reservation_id', 'table_reservations.*', 'tables.*) select ar moddhe bole diyechi amader ai table 2take join korar pore table_reservations table ar id take reservation_id ai nam aaa dhorbe and (table_reservations.*)  table_reservations table theke sob data anbe ai * astrick simbol mane hocche all..and amader users table theke oo sob datake anbe 

       return view('restaurant.admin.table.all-reserved-table',['authUser' => $authUser  , 'bookedTables' => $bookedTables]);
    }


    ///====== User/customer will be able to book a table ====///
    public function bookTable(Request $request)
    {
       //--form data validation--//
       $request->validate([
        'name' => ['required','string'],
        'email' => ['required','email'],
        'phone' => ['required', 'regex:/^[0-9]+$/' ,'min:11','max:11'],
        'timeFrom' => ['required'],
        'timeTo' => ['required'],
        'nop' => ['required','regex:/^[0-9]+$/','max:2'],
        'tableName' => ['required','string'],
        'message' => ['regex:/^[A-Za-z\s\.,\-]+$/'],
       ]);

       //--store form data into the database table--//
       $tableReservations = new TableReservation;

       $tableReservations->customer_name = $request->name;
       $tableReservations->customer_email = $request->email;
       $tableReservations->customer_number = $request->phone;
       $tableReservations->time_from = $request->timeFrom;
       $tableReservations->time_to = $request->timeTo;
       $tableReservations->number_of_people = $request->nop;
       $tableReservations->table_name = $request->tableName;
       $tableReservations->description = $request->message;
       $tableReservations->user_id = Auth::id();   //akhane Auth::id() ar maddhome amra authenticated user ar id ta peye jabo and oi id ta amara amader database ar table ar user_id column ar moddhe store kore dicchi

       $tableReservations->save();

       //--book table logic here--//
       $specificTable = Table::where('name', $request->tableName); //// akhane ami amader Table Model ta database ar jei table take represent kore jemon aikhane amader Table model ta database ar tables nam aa akta table ke represent kore oi database ar tables nam ar table theke ami where diye find korechi amader oi table ar name column theke check korchi je amader request theke jei table ar nam ta ashche oi name diye check korbe amader oi table ar name column ar moddhe and oi data take niye ashbe  
       $specificTable->delete();


       return redirect()->back()->with('success' , 'Table Booked Successfully!!!');    ////redirect()->back() mane hocche amader jei page theke ai post request ta asheche oi page ar moddhe abar back korbe oporer kaj gulo korar pore....jemon aikhane amader post request ta ashche resources/views/restaurant/includes/BookTable.blade.php and ai BookTable.blade.php ke amra home.blade.php ar moddhe include korechi
    }

    ///====== User/customer will be able to see his own booked  table history ====///
    public function tableReservations()
    {
        $authUser = Auth::user();
        $orderCount = Order::where('user_id', $authUser->id)->count(); 
        $count = Cart::where('user_id', $authUser->id )->count(); //// akhane amader Cart model ta amader database ar jei table take represent kore jemon aikhane Cart model ta amader database ar carts table take represent kore akhane carts table theke ami where ar moddhe bolechi carts table ar user_id column ar moddhe $authUser->id mane authenticated user ar id kotobar ache oita aikhane count() korechi 
        $specificUserReservations = TableReservation::join('tables', 'table_name', '=' , 'name' )->select('table_reservations.*', 'tables.*')->where('table_reservations.user_id',$authUser->id)->cursor();  //// akhane ami TableReservation Model ta jei database ar table ke represent korche oi table ar sathe ami tables table ke join kore diyechi akhane tables nam ar table ta beshi power pabe karon ami oi table ke join ar moddhe likhechi tai...table_name aita hocche amar  table_reservations table ar column ami ai column ar sathe amader tables table ar name column ar sathe join kore diyechi...and aikhane ami ('table_reservations.*', 'tables.*) select ar moddhe bole diyechi amader ai table 2take join korar pore  (table_reservations.*)  table_reservations table theke sob data anbe ai * astrick simbol mane hocche all..and amader users table theke oo sob datake anbe and tar pore ami ->where('table_reservations.user_id',$authUser->id) aita diye bolechi je amader table_reservations nam aaa jei table ta ache database ar moddhe oi table ar user_id column ar moddhe amader $authUser->id authenticated user ar id koto bar ache oita check kobe and joto bar thakbe oi datagulo lazy collection ar cursor() method ta amader eene debe database ar table theke


        return view('restaurant.user.show-booked-tables', ['authUser' => $authUser , 'orderCount' => $orderCount , 'count' => $count , 'specificUserReservations' => $specificUserReservations]);
    }
    
    ///========= Admin will be able to free aa booked table ======///
    public function freeReservedTable($id)
    {
       $specificTable = Table::withTrashed()->find($id);   ///akhane withTrashed() use korar karon hocche jokhon amader database ar table ar moddhe kono data jokhon softdelete hobe mane amader application ar moddhe theke oi datata chole jabe kintu amader database ar moddhe theke oi data ta jabe na jehetu ami ai softDelete ke use korchi book table hishebe jei datata amder softdelete hobe mane amader oi restaurant ar table ta book hoye geche and jokon ami oi deleted datatake ba book table take free korte jabo tokon amader oi table ar id ta akhane prothome check korbe amader jei datagulo soft delete hoyni oi datatheke kintu oi datateke ai id ta pabe na karon ai datata softDelete kora hoyeche mane ai table ta book kora hoyeche tai amader ai id take khojar jonno softDelete ar akta method withTrushed() use korte hobe tahole ooo oi id take amader oi table ar moddhe jei data gulo softdelete kora hoyeche oi datagulo theke ooo ai id ta check korbe and jei datagulo softdelete hoy ni oi datagulo theke ooo check korbe 
       $specificTable->restore();
       
       return redirect()->back()->with('status' , $specificTable->name . ' Table is now Avaliable!!!');  ////redirect()->back() mane hocche amader ai request ta jei page theke asheche oi page ar moddhe abar chole jabe ooporer kaj gulo korar pore...and with ar sathe ami status key ar moddhe akta message aikhan theke pass korchi ai status key diye akta leart amar create kora ache amader oi page ar moddhe jei page ar moddhe theke amader ai request ta ashche

    }    
    /////======== Admin will be able to permanently delete a specific table reservation =======///
    public function deleteReservation($id)
    {
        $specificReservation = TableReservation::find($id);

        $specificReservation->delete();

        return redirect()->back()->with('status' , 'Table Reservation Record Deleted Successfully!!!');
    }

}
