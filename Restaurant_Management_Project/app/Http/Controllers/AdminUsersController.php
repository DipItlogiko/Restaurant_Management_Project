<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AdminUsersController extends Controller
{
    ///==== Admin will be able to show all users ====///
    public function showUsers()
    {
        $authUser = Auth::user();
        $users= User::paginate(7); ////akhane ami amar User Model theke data guloke fatch korechi and paginate(7) diye ami bole diyechi amader oi users table ar moddhe theke joto data ache oi data guloke 7 ta 7 ta kore ak ak page ar moddhe dekhabe jodi amar ai table ar moddhe 12 ta data thake tahole prothom page aa 7 ta data dekhabe and tar porer page  aaa 5 ta data dekhabe...
        
        //--For Admin Dashboard message,which is located into a admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe
        
        return view('restaurant.admin.show-users',['authUser' => $authUser ,'users' => $users , 'messages' => $messages ,'notifications' => $notifications]);
    }
   ///==== Admin will be able to show single user information ====///
    public function showUser($id)
    {
         
        $authUser = Auth::user(); ///// ai Auth::user() ba authenticated user ar datata ami $authUser variable ar moddhe store kore amader view file ar moddhe pass kore diyechi karon amader view file ar moddhe je navbar ta ache oikhane amader authenticated user ar image ,name ai gulor proyojon hobe tai amra ami authUser ar information gulo akhan theke amader view file ar moddhe pass korec diyechi
        $user = User::find($id);
        //--For Admin Dashboard message,which is located into a admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.show-user',['authUser' => $authUser , 'user' => $user , 'messages' => $messages , 'notifications' => $notifications]);
    }
   ///==== Admin Create User ====///
    public function createUser()
    {
        $authUser = Auth::user(); 
        //--For Admin Dashboard message,which is located into a admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.create-user' , ['authUser' => $authUser , 'messages' => $messages, 'notifications' => $notifications]);
    }

   ///==== Admin Store Users / Store Users By Admin  ====////
    public function storeUser(Request $request)
    {
         
        //--form data validation--//     
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/' , 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'image' => ['required','image','mimes:jpg,jpeg,png'], ///// maximum image size ta ami akhane difine kore diyechi 1024 mame 1mb amara jani 1mb =1024 kb
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_role' => ['required', 'integer'],
            'address' => ['required', 'string',],
            'number' => ['required', 'regex:/^[0-9]+$/' ,'min:11','max:11'],
                
        ]);

            //// Upload image
            $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

            $request->image->move(public_path('Users_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Products directory ar moddhe move kore dicchi $imageName ai name.


        $user = User::create([ /////// jodi amra ai vabe amader laravel application ar eloquent Model ar sathe create method call kore ai vabe amader database ar table ar moddhe data save kori tahole amader oobosooi amara jei modle ar sathe create() method ta likhbo oi model ar moddhe giye amader fillable[] array ar moddhe ai field ar ar nam gulo likhe dite hobe jei field gulo ami bam side aa likhechi ai field gulo holo amader User Modle jemon database ar users table ke represent kore oi users table ar field ar nam.jodi ami ai khane amar users table ar field ar moddhe request theke asha data gulo pass kore dei and model ar fillable[] array ar moddhe ai field ar nam na likhi tahole amader ai data gulo amader database ar table ar moddhe save hobe na..tai jokhon amra ai niyome mane model ar sathe create() method take call kore amader database ar tablea ar modddhe data pathabo tokhon amader ai bishoy ta mathai rakhte hobe ja amar jei model ar sathe create() method call korbo and aikhan theke jei jei column ar moddhe data pathabo amader database ar table aa oi oi column ar nam gulo amadr oi model ar moddhe fillable [] array ar moddhe likhe dite hobe amra ai khan theke jei koita database ar table ar column ar moddhe data pathabo thik oi koita column ar nam amader model ar fillable[] array ar moddhe likhe dite hobe hobe jodi ami aikhan theke 5 ta column ar moddhe data pathai and ami amar model ar fillable [] array ar moddhe 4 ta culumn ar nam likhi tahole amader database ar oi table ar moddhe shudhu 4 ta column ar data eeee save hobe..
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageName,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_role,
            'address' => $request->address,
            'number' => $request->number,
            'account_created_by' => Auth::user()->name,
            'account_creator_role' => Auth::user()->user_type,
            
        ]);

        event(new Registered($user));
            

        if ($request->user_role == 1) {
            return redirect()->route('admin.create.user')->with('status', 'New Admin created successfully!!!');
        }else{
            return redirect()->route('admin.create.user')->with('status', 'New User created successfully!!!');
        }
    }  
    
    ///=== Admin will be able to see all users with Delete button ===///
    public function usersDelete()
    {
        $authUser = Auth::user();
        $user= User::paginate(7); ////akhane ami amar User Model theke data guloke fatch korechi and paginate(7) diye ami bole diyechi amader oi users table ar moddhe theke joto data ache oi data guloke 7 ta 7 ta kore ak ak page ar moddhe dekhabe jodi amar ai table ar moddhe 12 ta data thake tahole prothom page aa 7 ta data dekhabe and tar porer page  aaa 5 ta data dekhabe...
        
        //--For Admin Dashboard message,which is located into a admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe
        
        return view('restaurant.admin.users-delete',['authUser' => $authUser , 'users' => $user , 'messages' => $messages , 'notifications' => $notifications]);
    }

    ///=== After clicking on Delete button  Admin will be able to delete speceific user  ===///
    public function delete($id)

    {
        $user = User::find($id); 
        

        if ($user->user_type == '1'){
            $user->delete();
            return redirect()->route('admin.delete.user')->with('status', 'Admin deleted successfully!!!');

        }else{
            $user->delete();
            return redirect()->route('admin.delete.user')->with('status', 'User deleted successfully!!!');
        }    
    }
    
    ///=== Admin will be able to see all deleted users list with restore and permatently delete button ===///
    public function usersTrush()
    {
        $authUser = Auth::user();
        $users = User::onlyTrashed()->paginate(7); /// amader User Model ta database ar jei table take represent kore jemon akhane amader User Model ta database ar users table take represent korche ..akhane lazy collection ar cursor() method ta use kora koron hocche amader ai users table ar moddhe jodi lakh lakh deleted user ar data thake tahole oi lakh lakh data amader akbare load hobe jar fole amader laravel applicaion ar memory storage space ar limit cross hoye jabe and overfolw hobe jabe jar fole amader laravel application ta crass korbe..amader laravel application ar memory storage space aaa jeno akbare sob data load na hoy tar jonno amra get() ba all() method ar poriborte cursor() method ta use korechi..ai cursor() method ta amader database ar table theke sob deleted datake akbare load korbe na prothome akta datake anbe jeita hobe currnet data and pore jokhon aabar oonno kono datake anbe tokhon oi datata hobe current data and age jeita current data chilo oitake oo release kore debe..lazy collection ar cursor() method ai vabe kaj kore..akhane ami User Model ar sathe onlyTrashed() method take call korechi ai onlyTrashed() method ta amader users table ar moddhe jei user gulo shudhu delete hoyeche oi user der information gulo shudhu anbe...jodi amai onlyTrashed() method ar poriborte withTrashed() method use kortam amader User Model ar sathe tahobe amader users table theke deleted user der data oooo ashto aabar jei user gulo delete hoy ni oi user der data ooo ashto.
       
        //--For Admin Dashboard Message,which is located into admin dashboard navbar--//
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe
        
        return view('restaurant.admin.show-users-trush', ['authUser' => $authUser , 'users' => $users , 'messages' => $messages , 'notifications'=> $notifications]);
    }

    ///==== Admin will be able to restore soft deleted users ====///
    public function usersRestore($id)
    {
       $user = User::onlyTrashed()->find($id); //// akhane amader User Model theke mane User model ta database ar jei table take represent korche jemon ai khane amader User model ta users table thake represent korche..oi users table ba User Model ar sathe ami onlyTrashed() method ta use korechi tar por amra jei id ta pacchi oi id  take find korechi amader users table theke amader users table ar moddhe deleted user der data theke shudhu amar amader id diye find korbo users table theke tai amra User Model ar sathe onlyTrushed() method ta use korechi.. 
    

       if ($user->user_type == '1'){
            $user->restore();
        return redirect()->back()->with('status' , 'Admin Restore Successfully!!!');
       
       }else{
        $user->restore();
        return redirect()->back()->with('status' , 'User Restore Successfully!!!');
       }
       
    }
    
    ///==== Admin will be able to delete users permanently =====///
    public function usersDeletePermanently($id)
    {
        $user = User::onlyTrashed()->find($id); //// akhane amader User Model theke mane User model ta database ar jei table take represent korche jemon ai khane amader User model ta users table thake represent korche..oi users table ba User Model ar sathe ami onlyTrashed() method ta use korechi tar por amra jei id ta pacchi oi id  take find korechi amader users table theke amader users table ar moddhe deleted user der data theke shudhu amar amader id diye find korbo users table theke tai amra User Model ar sathe onlyTrushed() method ta use korechi.. 
    

       if ($user->user_type == '1'){
            $user->forceDelete();
        return redirect()->back()->with('status' , 'Admin Deleted Successfully!!!');
       
       }else{
        $user->forceDelete();
        return redirect()->back()->with('status' , 'User Deteled Successfully!!!');
       }
    }
}
 
