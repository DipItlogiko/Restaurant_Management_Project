<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use App\Models\Chef;

class ChefController extends Controller
{
    ///========== Admin will be able to see add chef page =======///
    public function addChef()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.chef.create-chef' , ['authUser' => $authUser]);
    }


    ///========== Admin will be able to store a chef information into database table ========///
    public function storeChef(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'name' => ['required' , 'regex:/^[A-Za-z\s]+$/'],
            'image' => ['required',
                File::image()
                ->types(['png', 'jpg', 'jpeg'])                 
                ->max(2 * 1024)
                ->dimensions(
                    Rule::dimensions()
                        ->maxWidth(640)
                        ->maxHeight(640)
                )], //// akhane max:1024 diye bolechi amader image ta maximum 1 mb hobe amra jai 1024 kb = 1mb
            'position' => ['required' ,'regex:/^[A-Za-z\s]+$/'],
            'number' => ['required','regex:/^[0-9]+$/','min:11','max:11'],
            'twitter' => ['string','nullable'],
            'fb' => ['string','nullable'],
            'instagraam' => ['string','nullable'],
            'linkedin' => ['string','nullable'],
        ]);

        //// Upload image
        $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

        $request->image->move(public_path('Chefs_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Chefs_images directory ar moddhe move kore dicchi $imageName ai name.


        //--store form data into the database table--//
        $chefs = new Chef;

        $chefs->name = $request->name;
        $chefs->position = $request->position;
        $chefs->image = $imageName;
        $chefs->number = $request->number;
        $chefs->twitter = $request->twitter;
        $chefs->facebook = $request->fb;
        $chefs->instagraam = $request->instagraam;
        $chefs->linkedin = $request->linkedin;

        $chefs->save();

        return redirect()->back()->with('status' , 'New Chef Added Successfully!!!'); ///// akhane  return redirect()->back() mane hocche amader ai request ta jei page theke aasheche oi page ar moddhe back korbe ooporer kaj gulo korar pore..jemon amader ai request ta ashche resources/views/restaurant/admin/chef/create-chef.blade.php ai file theke jokhon amader ooporer kaj gulo hoye jabe tar pore amader ai page ar moddhe aabar redirect korbe....sathe akta message niye jabe jei message ta ami with() ar moddhe pass kore diyechi 'status' key ar value hishebe amader oi blade.php file ar moddhe ai status key ar value take flash message ar maddhome show korano hobe jar jonno amra bootstrap ar Aleart use korechi 
    }    

    ///======= Admin will be able to show all chefs information with edit and delete button =======///
    public function allChefs()
    {
        $authUser = Auth::user();
        $chefs = Chef::cursor();
        return view('restaurant.admin.chef.all-chefs' ,['authUser' => $authUser , 'chefs' => $chefs]);
    }


    ///======= Admin will be able to edit specific chef information =======///
    public function editChef($id)
    {
        $chef = Chef::find($id);
        $authUser = Auth::user();

        return view('restaurant.admin.chef.edit-chef',['chef' => $chef , 'authUser' => $authUser]);

    }

    ///======= Admin will be able to store updated chefs information into the database table =======///
    public function updateChef(Request $request , $id)
    {
        //--form data validation--//
       $request->validate([
        'name' => ['required' , 'regex:/^[A-Za-z\s]+$/'],
            'image' => [
                File::image()
                ->types(['png', 'jpg', 'jpeg'])                 
                ->max(2 * 1024)
                ->dimensions(
                    Rule::dimensions()
                        ->maxWidth(640)
                        ->maxHeight(640)
                )], //// akhane max:1024 diye bolechi amader image ta maximum 1 mb hobe amra jai 1024 kb = 1mb
            'position' => ['required' ,'regex:/^[A-Za-z\s]+$/'],
            'number' => ['required','regex:/^[0-9]+$/','min:11','max:11'],
            'twitter' => ['string','nullable'],
            'fb' => ['string','nullable'],
            'instagram' => ['string','nullable'],
            'linkedin' => ['string','nullable'],
       ]);

       //--store form data into the database table--//
       $specificChef = Chef::find($id);


        $specificChef->name = $request->name;
        $specificChef->position = $request->position;
        $specificChef->number = $request->number;
        $specificChef->twitter = $request->twitter;
        $specificChef->facebook = $request->fb;
        $specificChef->instagraam = $request->instagram;
        $specificChef->linkedin = $request->linkedin;

        if(isset($request->image)){ //// jodi amader form ar image input field ta kew fillup kore tokhon ai code tuku execute hobe.image input field aa jodi kono image kew set na kore tahole ai code ta execute hobe na.  
             
            $imageName = time().'.'.$request->image->extension(); ////akhane amader notun image ar akta file name create kora hoyeche

            $request->image->move(public_path('Chefs_images'), $imageName);  /////amader ai image file take public ar moddhe Products directory ar moddhe move kora hoyeche oi file ar nam  aaaaaaaaaa
            $specificChef->image = $imageName; ////// tar pore amader database ar oi id ar image field ar moddhe amader ai image name take save kora hoyeche
       }


       $specificChef->save();

       return redirect()->route('show.all.chefs')->with('status', 'Chef Information Updated Successfully!!!');
       
    }


    ///======= Admin will be able to permanently delete a  specific chef from the database table =======///
    public function deleteChef($id)
    {
        $specificChef = Chef::find($id);

        $specificChef->delete();

        return redirect()->route('show.all.chefs')->with('status' , 'Chef Deleted Successfully!!!');
    }
}
