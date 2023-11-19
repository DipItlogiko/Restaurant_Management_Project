<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Food;
use App\Models\User;

class FoodController extends Controller
{
    ///==== Admin Will be able to create food ====///
    public function createFood()
    {
        $authUser = Auth::user();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.create-food' , ['authUser' => $authUser , 'messages' => $messages , 'notifications' => $notifications]);
    }


    ///==== Admin created food will store here ====///
    public function foodStore(Request $request)
    {
        //--Form Data Validation--//
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'image' => ['required', 'image' ,'mimes:jpg,jpeg,png'],
            'food_type' => ['required', 'string'],
            'price' => ['required', 'numeric','min:2'],
            'description' => ['required', 'regex:/^[A-Za-z\s\.,\-]+$/' ,'max:200'],
        ]);     
        
        //// Upload image
        $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

        $request->image->move(public_path('Food_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Food_images directory ar moddhe move kore dicchi $imageName ai name.

        //--save form data into the database table--//
        $food = Food::create([ /////// jodi amra ai vabe amader laravel application ar eloquent Model ar sathe create method call kore ai vabe amader database ar table ar moddhe data save kori tahole amader oobosooi amara jei modle ar sathe create() method ta likhbo oi model ar moddhe giye amader fillable[] array ar moddhe ai field ar ar nam gulo likhe dite hobe jei field gulo ami bam side aa likhechi ai field gulo holo amader Food Modle jemon database ar food table ke represent kore oi food table ar field ar nam.jodi ami ai khane amar food table ar field ar moddhe request theke asha data gulo pass kore dei and model ar fillable[] array ar moddhe ai field ar nam na likhi tahole amader ai data gulo amader database ar table ar moddhe save hobe na..tai jokhon amra ai niyome mane model ar sathe create() method take call kore amader database ar tablea ar modddhe data pathabo tokhon amader ai bishoy ta mathai rakhte hobe je amar jei model ar sathe create() method call korbo and aikhan theke jei jei column ar moddhe data pathabo amader database ar table aa oi oi column ar nam gulo amadr oi model ar moddhe fillable [] array ar moddhe likhe dite hobe amra ai khan theke jei koita database ar table ar column ar moddhe data pathabo thik oi koita column ar nam amader model ar fillable[] array ar moddhe likhe dite hobe  jodi ami aikhan theke 5 ta column ar moddhe data pathai and ami amar model ar fillable [] array ar moddhe 4 ta culumn ar nam likhi tahole amader database ar oi table ar moddhe shudhu 4 ta column ar data eeee save hobe..
            'title' => $request->name,
            'food_type' => $request->food_type,
            'image' => $imageName,         
            'price' => $request->price,
            'description' => $request->description,         
            
        ]);        
            

        if ($request->food_type == 'fastfood') {
            return redirect()->route('admin.create.food')->with('status', 'New Fast Food added successfully!!!');
        }elseif ($request->food_type == 'salads'){
            return redirect()->route('admin.create.food')->with('status', 'New Salads added successfully!!!');
        }else{
            return redirect()->route('admin.create.food')->with('status', 'New Sushi added successfully!!!');
        }

    }
    
    ///===== Admin will be able to show all foods with Edit and Delete buttons =====/// 
    public function showFoods()
    {
        $authUser = Auth::user();
        $Foods = Food::cursor();
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe
        

        return view('restaurant.admin.show-foods',['authUser' => $authUser , 'Foods' => $Foods , 'messages' => $messages ,'notifications' => $notifications]);
    }
    
    ///===== Admin will be able to edit a specific food =====///
    public function foodEdit($id)
    {
        $authUser = Auth::user();
        $food = Food::find($id); ///// amader route/web.php theke jei id ta ashche oi id take amra amader Food Model mane Food Model ta amader database ar jei table take represent kore oi table theke amra amader route theke asha id take find korchi and oi id ar data take amader database ar table theke aaane ba fatch kore $food variable ar moddhe store kore dicchi...
        $messages = User::join('messages', 'users.id', '=', 'messages.user_id')        
        ->orderBy('messages.created_at', 'desc')
        ->take(4)
        ->cursor();
        //--For Admin Dashboard Notifications--//
        $notifications = User::join('admin_notifies' , 'users.id', '=', 'admin_notifies.user_id')->orderBy('admin_notifies.created_at','desc')->take(4)->cursor();  ///akhane ami amader User model ta database ar jei table take represent kore jemon aikhane amader User model ta database ar users table take represent kore and ami amader users table ar sathe amader database ar r akta table jar nam admin_notifies ai 2ta table ke aksathe inner join korechi ..and amader ai inner join ta hobe users table ar users id ar sathe admin_notifies table ar user_id ar sathe

        return view('restaurant.admin.food-edit',['authUser' => $authUser , 'food' => $food ,'messages' => $messages , 'notifications' => $notifications]);
    }
    
    ///===== Admin will be able to store specific updated food data into the database =====///
    public function updatedFoodStore(Request $request , $id)
    {
        //--Form Data Validation--//
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'], //// regex diye ami bole diyechi amar form ar input field ar name="name" jei input field ta ache oi field ar value ta A-z ba a-z ai okkhor gulo hobe shudhu, ar baire oonno kichu ai input field ar value hishebe diye form submit korle amader validation error show korbe
            'image' => ['image' ,'mimes:jpg,jpeg,png'], /////jokhon ami amader kono food ke update korbo tokhon amader image field ar validation ar moddhe 'required' validation rule ta likhbo na karon admin chaile food ar image change na kore onno kichu change kore food take update korte pare tai..jodi amra ai field ar moddhe 'required' validation rule ta add kori tahole admin image field ar moddhe image set na kora porjonto food updata form submit korte parbe na.
            'food_type' => ['required', 'string'],
            'price' => ['required', 'numeric','min:2'],
            'description' => ['required', 'regex:/^[A-Za-z\s\.,\-]+$/' ,'max:200'],
        ]);
        
        //--save form data into the database table--// 
        $specificFood = Food::find($id);


        $specificFood->title = $request->name;
        $specificFood->food_type = $request->food_type;
        $specificFood->price = $request->price;
        $specificFood->description = $request->description;

        if(isset($request->image)){ //// jodi amader form ar image input field ta kew fillup kore tokhon ai code tuku execute hobe.image input field aa jodi kono image kew set na kore tahole ai code ta execute hobe na.  
             
            $imageName = time().'.'.$request->image->extension(); ////akhane amader notun image ar akta file name create kora hoyeche

            $request->image->move(public_path('Food_images'), $imageName);  /////amader ai image file take public ar moddhe Products directory ar moddhe move kora hoyeche oi file ar nam  aaaaaaaaaa
            $specificFood->image = $imageName; ////// tar pore amader database ar oi id ar image field ar moddhe amader ai image name take save kora hoyeche
       }


       $specificFood->save();
         
        if ($request->food_type == 'fastfood') {
         return redirect()->route('admin.show.foods')->with('status', 'Fast Food updated successfully!!!');
        }elseif ($request->food_type == 'salads'){
            return redirect()->route('admin.show.foods')->with('status', 'Salads updated successfully!!!');
        }else{
            return redirect()->route('admin.show.foods')->with('status', 'Sushi updated successfully!!!');
        }       

    }
    ///===== Admin will be able to delete food here =====///
    public function deleteFood($id)
    {
        $specificFood = Food::find($id);
        
        $specificFood->delete();

        if ($specificFood->food_type == 'fastfood') {
            return redirect()->route('admin.show.foods')->with('status', 'Fast Food deleted successfully!!!');
        }elseif ($specificFood->food_type == 'salads'){
            return redirect()->route('admin.show.foods')->with('status', 'Salads deleted successfully!!!');
        }else{
            return redirect()->route('admin.show.foods')->with('status', 'Sushi deleted successfully!!!');
        } 
    }
}
