<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use App\Models\AdminNotify;

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
        //--this queary is for admin dashbord message icon which is placed top of the page on right--//
        $messages = User::join('messages', 'users.id', '=' , 'messages.user_id')
        ->orderBy('messages.created_at', 'desc')      ////// akhane amader messages table ar created_at column ke 'desc' mane descending format aa shajabe mane boro theke choto mane sobar last a jei message ta ashbe oi message ta sobar oopore thakbe mane boro theke choto  
        ->take(4)
        ->cursor();
        //----------------//

        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        $allMessages = User::join('messages', 'users.id', '=' , 'messages.user_id')
        ->orderBy('messages.created_at', 'desc')      ////// akhane amader messages table ar created_at column ke 'desc' mane descending format aa shajabe mane boro theke choto mane sobar last a jei message ta ashbe oi message ta sobar oopore thakbe mane boro theke choto  
        ->paginate(7);  //// akhane ami amader User Model ta database ar jei table take represent kore jemon amader ai User Model ta database ar users name table take represent kore and amader ai users table take amra join kore diyechi messages table ar sathe and jehetu amader messages table ta join ar moddhe ache tai amader ai table ta mane messages table ta beshi power pabe jemon amader users table ar moddhe created_at nam aa akta column ache and messages table ar moddhe oooo created_at nam aa akta column  ache akhon ai join hoyar pore ami jodi kothaw amader created_at column ar value take print kori tahole amra dekhbo amader messages table ar created_at column ar value ta ashche karon join ar moddhe amader messages table ar nam ta ache tai oi messages table ta power beshi pabe...and ai  inner join ta hobe amader users table ar id ar sathe messages table ar user_id ar sathe....join howar pore amader oi sob datake ami paginate(7) korechi mane oi data theke  amader ak ak ta page ar moddhe 7 ta 7 ta kore data dekhabe karon ami paginate(7) likhechi tai ...jodi amader ai join ta howar pore 10 ta data pai tahole amader akta page ar moddhe 7 ta data dekhabe and onno page ar moddhe 3 ta data dekhabe and ai $allMessages variable ta jei view ar moddhe pass korechi amra niche oi view file ar moddhe giye amder pagination ar degine ta korte hobe tahole amra amader application ar page ar moddhe pagination ar degine ta dekhte pabo  

        return view('restaurant.admin.message.all-messages' , ['authUser' => $authUser , 'allMessages' => $allMessages , 'messages' => $messages ,  'notifications' => $notifications]);
    }

    ///============ Admin will be able to delete specific customer message ===========///
    public function deleteMessage($id)
    {
        $spechificMessage = Message::find($id);

        $spechificMessage->delete();

        return redirect()->back()->with('status', 'Message Deleted Successfully!!!');
    }


    ///============ Admin will be able to see all Notification with clear and clear all buttons ===========///
    public function allNotifications()
    {
        $authUser = Auth::user();
        //--For Admin Dashboard Messages,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

         
        $allNotifications =User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->cursor();

        return view('restaurant.admin.all-notification', ['authUser' => $authUser , 'messages' => $messages , 'notifications' => $notifications , 'allNotifications' => $allNotifications]);
    }

    ///=========== Admin will be able to clear a specific notification from notification records =============///
    public function deleteNotification($id)
    {
        $spechificNotification = AdminNotify::find($id);

        $spechificNotification->delete();

        return redirect()->back()->with('status', 'Notification cleared successfully!!!');  //// akhane return redirect()->back() mane hocche amader ai request ta jei page theke asheche oi page ar moddhe aabar back korbe oooporer kaj gulo hoye jawar pore..akhane jemon amader ai request ta ashche resources/views/restaurant/admin/all-notification.blade.php ooporer kaj gulo hoye jawar pore abar ai page ar moddhe back korbe sathe akta flash message niye jabe jei message ta ami akhane 'status' key ar value hishebe set kore diyechi
    }

    ///========= Admin will be able to clear all notifications from notification records ============///
    public function deleteAllNotification()
    {
        AdminNotify::truncate(); //// akhane amader AdminNotify Model ta database ar jei table take represent kore jemon amader ai AdminNotify Model ta database ar admin_notifies ai table take represent kore and oi table theke ami sob delete kore dicchi ai truncate() method ar maddhome truncate() method ar maddhome database ar table ar moddhe thaka data delete korle amra akta shubidha pai jemon amader oi table ar data delete howar sathe sathe amader oi table aabar reset hoye jai mane oi table ar moddhe jodi amra aabar kono data insert kori tahole amader id ta aabar 1 theke shuru hobe .... 
        
        return redirect()->back();
    }
}
