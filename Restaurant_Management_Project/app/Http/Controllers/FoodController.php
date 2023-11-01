<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Food;

class FoodController extends Controller
{
    ///==== Admin Will be able to create food ====///
    public function createFood()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.create-food' , ['authUser' => $authUser]);
    }


    ///==== Admin created food will store here ====///
    public function foodStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'image' => ['required', 'image' ,'mimes:jpg,jpeg,png'],
            'food_type' => ['required', 'string'],
            'price' => ['required', 'numeric','min:2'],
            'description' => ['required', 'regex:/^[A-Za-z\s]+$/' ,'max:200'],
        ]);     
        
        //// Upload image
        $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

        $request->image->move(public_path('Food_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Food_images directory ar moddhe move kore dicchi $imageName ai name.


        $user = Food::create([ /////// jodi amra ai vabe amader laravel application ar eloquent Model ar sathe create method call kore ai vabe amader database ar table ar moddhe data save kori tahole amader oobosooi amara jei modle ar sathe create() method ta likhbo oi model ar moddhe giye amader fillable[] array ar moddhe ai field ar ar nam gulo likhe dite hobe jei field gulo ami bam side aa likhechi ai field gulo holo amader Food Modle jemon database ar food table ke represent kore oi food table ar field ar nam.jodi ami ai khane amar food table ar field ar moddhe request theke asha data gulo pass kore dei and model ar fillable[] array ar moddhe ai field ar nam na likhi tahole amader ai data gulo amader database ar table ar moddhe save hobe na..tai jokhon amra ai niyome mane model ar sathe create() method take call kore amader database ar tablea ar modddhe data pathabo tokhon amader ai bishoy ta mathai rakhte hobe je amar jei model ar sathe create() method call korbo and aikhan theke jei jei column ar moddhe data pathabo amader database ar table aa oi oi column ar nam gulo amadr oi model ar moddhe fillable [] array ar moddhe likhe dite hobe amra ai khan theke jei koita database ar table ar column ar moddhe data pathabo thik oi koita column ar nam amader model ar fillable[] array ar moddhe likhe dite hobe  jodi ami aikhan theke 5 ta column ar moddhe data pathai and ami amar model ar fillable [] array ar moddhe 4 ta culumn ar nam likhi tahole amader database ar oi table ar moddhe shudhu 4 ta column ar data eeee save hobe..
            'title' => $request->name,
            'food_type' => $request->food_type,
            'image' => $imageName,         
            'price' => $request->price,
            'description' => $request->description,         
            
        ]);

        event(new Registered($user));
            

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
        return view('restaurant.admin.show-foods',['authUser' => $authUser]);
    }
}
