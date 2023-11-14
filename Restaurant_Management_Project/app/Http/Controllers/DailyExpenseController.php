<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;

class DailyExpenseController extends Controller
{
    /**
     * Admin will be able to see daily expense store form *
     */
    public function dailyExpense()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.expense.add-expense' , ['authUser' => $authUser]);
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
        return view('restaurant.admin.expense.expenses-list' , ['authUser' => $authUser , 'expenses' => $expenses]);
    }

    /**
     * Admin will be able to edit a specific expense information *
     */ 
    public function editExpense($id)
    {
        $specificExpense = Expense::find($id);
        $authUser = Auth::user();

        return view('restaurant.admin.expense.edit-expense', ['authUser' => $authUser , 'specificExpense' => $specificExpense]);
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
