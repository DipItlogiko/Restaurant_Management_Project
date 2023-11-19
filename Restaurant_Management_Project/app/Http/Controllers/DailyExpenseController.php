<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\User;

class DailyExpenseController extends Controller
{
    /**
     * Admin will be able to see daily expense store form *
     */
    public function dailyExpense()
    {
        $authUser = Auth::user();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.expense.add-expense' , ['authUser' => $authUser , 'messages' => $messages , 'notifications' => $notifications]);
    }

    /**
     * Admin will be able to store daily expense into the database table *
     */
    public function storeExpense(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'expense_type' => ['required' , 'regex:/^[A-Za-z\s\.,_\-]+$/'],   /// akhane ami validation ar moddhe bole diyechi amader ai input field ar moddhe boro hater A-Z and Choto hater a-z and . , _ aigulo use korte parbe 
            'description' => ['required' , 'string'],
            'total_price' => ['required' , 'string'],
        ]);

        //--store form data into the database table--//
        $expenses = new Expense;

        $expenses->expense_type = $request->expense_type;
        $expenses->description = $request->description;
        $expenses->total_amount = $request->total_price;

        $expenses->save();

        return redirect()->back()->with('status', 'Expense Store Successfully!!!');  ///// akhane return redirect()->back() mane hocche amader ai request ta jei page theke aasheche oi page ar moddhe back korbe ooporer kaj gulo hoye jawar pore ....jemon amader ai request ta ashche resources/views/admin/expense/add-expense.blade.php theke
    }

    /**
     * Admin will be able to see all daily expense list with edit and delete button *
     */ 
    public function expensesList()
    {
        $authUser = Auth::user();
        $expenses = Expense::cursor();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.expense.expenses-list' , ['authUser' => $authUser , 'expenses' => $expenses ,'messages' => $messages , 'notifications' => $notifications]);
    }

    /**
     * Admin will be able to edit a specific expense information *
     */ 
    public function editExpense($id)
    {
        $specificExpense = Expense::find($id);
        $authUser = Auth::user();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.expense.edit-expense', ['authUser' => $authUser , 'specificExpense' => $specificExpense, 'messages' => $messages , 'notifications' => $notifications]);
    }

    /**
     * Admin will be able to store a updated expense infomation into the database table *
     */ 
    public function updateExpense(Request $request, $id)
    {
        //--form data validation--//
        $request->validate([
        'expense_type' => ['required' , 'regex:/^[A-Za-z\s\.,_\-]+$/'],   /// akhane ami validation ar moddhe bole diyechi amader ai input field ar moddhe boro hater A-Z and Choto hater a-z and . , _ aigulo use korte parbe 
        'description' => ['required' , 'string'],
        'total_price' => ['required' , 'string'],
        ]);

        //--store form data into the database table--//
        $specificExpense = Expense::find($id);

        $specificExpense->expense_type = $request->expense_type;
        $specificExpense->description = $request->description;
        $specificExpense->total_amount = $request->total_price;

        $specificExpense->save();

        return redirect()->route('expenses.list')->with('status' , 'Expense Information Updated Successfully!!!');
    }

    public function deleteExpense($id)
    {
        $specificExpense = Expense::find($id);

        $specificExpense->delete();

        return redirect()->back()->with('status' , 'Expense Information Deleted Successfully!!!'); ////return redirect()->back() mane hocche amader ai request ta jei page theke ashche ai khane ooporer kaj gulo hoye jawar pore aabar oi page ar moddhe mane jei page theke ai request ta asheche oi page ar moddhe back korbe with akta message ooo niye jabe....jemon ai request ta ashche amader resources/views/admin/expense/expenses-list.blade.php
    } 

     
}
