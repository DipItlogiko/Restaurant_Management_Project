<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use PDF;

class MonthlyExpenseController extends Controller
{
    //======== Admin Will be able to see Monthly Expense page ========///
    public function index()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.expense.monthly-expense' ,['authUser' => $authUser]);
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
        $pdf = PDF::loadView('restaurant.admin.expense.monthly-expense-pdf', [
            'monthlyExpenses' => $monthlyExpenses,
            'totalAmount' => $totalAmount,
        ]);

        if($totalAmount == '0')  /////amader montyly-expense.blade.php file ar moddhe Admin jokhon tar month and year ta likhe Get PDF a press korbe tokhon jodi oi month and Year oonujayi kono data khuje na pai amader database ar expenses table theke tahole amader $totalAmount variable ar value ta 0 hobe and if ar moddhe thaka code ta execute hobe.... 
        {        
            return redirect()->route('monthly.expense')->with('status' , 'No Data Found According Your Provided Month and Year!!!');
        
        }else{

            // Save or download the PDF as needed
         return $pdf->stream('McDonald\'s_monthly_expenses_report.pdf');  //// akhane $pdf->stream() method ta use korechi mane aita amader pdf file take dekhabe and amra chaile oikhan theke download korte pari kintu jodi ami $pdf->download() use kortam tahole amader pdf ta dekhato ta akbare download hoye jeto...and stream() method ar moddhe jei string ta ami diyechi ai name amader pdf file ta download hobe
        }
    }

        
}
