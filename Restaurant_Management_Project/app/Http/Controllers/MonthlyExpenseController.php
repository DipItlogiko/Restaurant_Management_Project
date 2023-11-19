<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\User;
use PDF;

class MonthlyExpenseController extends Controller
{
    //======== Admin Will be able to see Monthly Expense page ========///
    public function index()
    {
        $authUser = Auth::user();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.expense.monthly-expense' ,['authUser' => $authUser , 'messages' => $messages, 'notifications' => $notifications]);
    }

    //======== Admin will be able to generate a  Monthly Expense PDF =========///
    public function monthlyPDF(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'month' => ['required' , 'regex:/^[0-9]+$/','min:2', 'max:2'],
            'year' => ['required' , 'regex:/^[0-9]+$/','min:4', 'max:4'],
        ]);

        //--Calculate monthly expenses--//
        $monthlyExpenses = Expense::whereYear('created_at', $request->year)
            ->whereMonth('created_at', $request->month)
            ->cursor();

        //--Calculate total amount--//
        $totalAmount = $monthlyExpenses->sum('total_amount');   
        
        // Generate PDF report
        $pdf = PDF::loadView('restaurant.admin.expense.monthly-expense-pdf', [   ////akhane ami PDF::loadView PDF:: fasad ar sathe loadView() method take call korechi and amader view file ar nam ta bole diyechi and oi view file ar moddhe paramiter pass korechi...akhane jei view file ta pass korechi ai view file ta amra pdf ar moddhe dekhte pabo
            'monthlyExpenses' => $monthlyExpenses,
            'totalAmount' => $totalAmount,
        ])->setPaper('A4', 'portrait'); /// akhane ami setPaper() method ar moddhe bole diyechi amader paper ar size hobe 'a4' and page ta hobe 'landscape' mane chowra hobe amader page ta  and jodi ami 'portrait' jei tahole amader page ta lomba aakare dekhabe...
        

        //--Redirect--//
        if($totalAmount == '0')  /////amader montyly-expense.blade.php file ar moddhe Admin jokhon tar month and year ta likhe Get PDF a press korbe tokhon jodi oi month and Year oonujayi kono data khuje na pai amader database ar expenses table theke tahole amader $totalAmount variable ar value ta 0 hobe and if ar moddhe thaka code ta execute hobe.... 
        {        
            return redirect()->route('monthly.expense')->with('status' , 'No Data Found According Your Provided Month and Year!!!');
        
        }else{
            // Save or download the PDF as needed(if we use $pdf->download it will download automatically but if we use $pdf->stream it won't download automatically it will show first our pdf file and then if we want we can download the pdf)
         return $pdf->stream('McDonald\'s_monthly_expenses_report.pdf');  //// akhane $pdf->stream() method ta use korechi mane aita amader pdf file take dekhabe and amra chaile oikhan theke download korte pari kintu jodi ami $pdf->download() use kortam tahole amader pdf ta dekhato ta akbare download hoye jeto...and stream() method ar moddhe jei string ta ami diyechi ai name amader pdf file ta download hobe
        }
    }

        
}
