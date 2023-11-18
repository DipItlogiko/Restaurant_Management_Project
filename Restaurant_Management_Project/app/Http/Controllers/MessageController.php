<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    ///======= User will be able to send message to Admin =========///
    public function sandMessage(Request $request)
    {        
        //--if Admin submit message from home page admin will be redirect to home page because Admin won't be able to send message from home page---//
        if(Auth::user()->user_type == '1')
        {
            return redirect('/')->with('error' , 'Admin won\'t be able to send message from home page');
        } 
        
        //--form data validation--//
        $request->validate([            
            'message' => ['required' , 'string'],
        ]);      


        //--store form data into the database table--//
        $messages = new Message;

        $messages->message = $request->message;
        $messages->user_id = Auth::id();

        $messages->save();


        return redirect('/')->with('success', 'Message Send Successfully To The Admin!!!');

    }

    ///============== Admin will be able to see all customer messages =============///
    public function customerMessages()
    {
        $authUser = Auth::user(); 

        $messages = User::join('messages', 'users.id', '=' , 'messages.user_id')
        ->orderBy('messages.created_at', 'desc')      ////// akhane amader messages table ar created_at column ke 'desc' mane descending format aa shajabe mane boro theke choto mane sobar last a jei message ta ashbe oi message ta sobar oopore thakbe mane boro theke choto  
        ->cursor();  //// akhane ami amader User Model ta database ar jei table take represent kore jemon amader ai User Model ta database ar users name table take represent kore and amader ai users table take amra join kore diyechi messages table ar sathe and jehetu amader messages table ta join ar moddhe ache tai amader ai table ta mane messages table ta beshi power pabe jemon amader users table ar moddhe created_at name akta column ache and messages table ar moddhe oooo created_at name akta column  ache akhon ai join hoyar pore ami jodi kothaw amader created_at column ar value take print kori tahole amra dekhbo amader messages table ar created_at column ar value ta ashche karon join ar moddhe amader messages table ar nam ta ache tai oi messages table ta power beshi pabe...and ai  inner join ta hobe amader users table ar id ar sathe messages table ar user_id ar sathe

        return view('restaurant.admin.message.all-messages' , ['authUser' => $authUser , 'messages' => $messages]);
    }

    ///============ Admin will be able to delete specific customer message ===========///
    public function deleteMessage($id)
    {
        $spechificMessage = Message::find($id);

        $spechificMessage->delete();

        return redirect()->back()->with('status', 'Message Deleted Successfully!!!');
    }
}
