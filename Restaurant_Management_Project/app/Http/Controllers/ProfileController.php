<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;

class ProfileController extends Controller
{
    /**
     * Display the User profile form.
     */
    public function edit(): View
    {
        $authUser = Auth::user();
        $count = Cart::where('user_id',$authUser->id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
        $orderCount = Order::where('user_id', $authUser->id)->count();

        return view('restaurant.user.profile.edit', ['authUser' => $authUser, 'orderCount' => $orderCount , 'count' => $count]);
    }

    /**
     * Display the User password edit form.
     */
    public function userPasswordEdit(): View
    {
        $authUser = Auth::user();
        $count = Cart::where('user_id',$authUser->id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
        $orderCount = Order::where('user_id', $authUser->id)->count();

        return view('restaurant.user.profile.update-password', ['authUser' => $authUser , 'orderCount' => $orderCount , 'count' => $count]);
    }

    /**
     * Display the User Account delete page.
     */
    public function userAdvanceSettings(): View
    {
        $authUser = Auth::user();
        $count = Cart::where('user_id',$authUser->id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
        $orderCount = Order::where('user_id', $authUser->id)->count();

        return view('restaurant.user.profile.advance-setting', ['authUser' => $authUser , 'orderCount' => $orderCount , 'count' => $count]);
    }    

    /**
     * Display the Admin profile form.
     */
    public function adminEdit():view
    {
         
        $authUser = Auth::user();

        //--for admin dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.profile.edit', ['authUser' => $authUser, 'messages' => $messages , 'notifications' => $notifications]);
    }

    /**
     * Update the Admin and User profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        $request->user()->fill($request->validated());


        $request->user()->name = $request->name; //// akhane amra  $request->user() mane authenticated user ar name column take dhorechi and tar moddhe amra request theke jei name ta pacchi oi name take amader database  ar name column ar moddhe store kore dicchi      

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if(isset($request->image)){ //// jodi amader form ar image input field ta kew fillup kore tokhon ai code tuku execute hobe.image input field aa jodi kono image kew set na kore tahole ai code ta execute hobe na. mane amader image ta update hobe na.
             
            $imageName = time().'.'.$request->image->extension(); ////akhane amader notun image ar akta file name create kora hoyeche

            $request->image->move(public_path('Users_images'), $imageName);  /////amader ai image file take public ar moddhe Products directory ar moddhe move kora hoyeche oi file ar nam  aaaaaaaaaa
            $request->user()->image = $imageName; ////// tar pore amader database ar oi id ar image field ar moddhe amader ai image name take save kora hoyeche
       }

        $request->user()->save(); ///// akhane amader $request->user() mane authenticated users ar data ta save hoye jabe

       if($request->user()->user_type == '1'){
          return Redirect::route('admin.edit')->with('status', 'Profile updated successfully');
       }

       return Redirect::route('profile.edit')->with('status', 'Profile-updated successfully');
        
    }

    /**
     * Display the Admin Password Edit form.
     */
    public function adminPasswordEdit(){

        $authUser = Auth::user();
        //--for admin dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.profile.update-password',['authUser' => $authUser ,'messages' => $messages , 'notifications' => $notifications]);
    }


    public function adminAdvanceSettings()
    {
        $authUser = Auth::user();
        //--for admin dashboard message,which is located into the admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.profile.advance-setting',['authUser' => $authUser , 'messages' => $messages , 'notifications' => $notifications]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {                
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account Deleted successfully !!!');
    }
}
