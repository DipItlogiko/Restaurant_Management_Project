<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Table;

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
        $tables = Table::cursor();  //// akhane amader Table Model ta amader database ar jei table take represent kore jemon aikhane amader Table Model ta database ar tables table take represent korche oi table ar theke ami sob data fatch korechi lazy collection ar cursor() method diye get() method ba all() method ar theke cursor() method ta use kora valo karon cursor() method amader database theke sob datake aaane amader laravel application ar memory storage space ar moddhe akbare load kore dei na jar fole amader laravel ar memory storage space ta overflow hoye jawar chanch thake na..kintu jodi amra get() ba all() method ta use kori database ar table theke data fatch korar jonno tahole amader oi table ar moddhe jodi lakh lakh data thake tahole oi lakh lakh data amader laravel application ar moddhe akbare load hoye jabe and amader laravel application ar memory storage space overflow hoye giye amader application ta crass korbe and akta error dekhabe je memory storage overflow..tai good practice hocche get() ba all() method use na kore lazy collection ar cursor() method ta use kora valo database theke data fatch korar somoy...
        return view('restaurant.admin.table.all-tables', ['authUser' => $authUser , 'tables' => $tables]);
    }

    ///====== Admin will be able to edit tables information =======///
    public function editTable($id)
    {
        $tables = Table::find($id);
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

    ////===== Admin will be able to reserve/book a restaurant table for user/customer =====///
    public function tableReservation()
    {
        $authUser = Auth::user();
        $tables = Table::where('deleted_at', NULL)->cursor(); //// akhane ami amader Table Model mane tables nam a database a jei table ta ache oi table theke where diye check korechi amader tables nam aa je database ar table ache oi table ar deleted_at column ar value jeikhane null ba '' ache oi data guloke aikhane fatch kore niye ashbe          
        return view('restaurant.admin.table.table-reservation' , ['authUser' => $authUser , 'tables' => $tables]);
    }


}
