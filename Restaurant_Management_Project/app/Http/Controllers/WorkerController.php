<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File; 
use App\Models\Worker;

class WorkerController extends Controller
{
    ///======== Admin will be able to create new worker ======///
    public function addWorker()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.worker.add-worker' , ['authUser' => $authUser]);
    }

    ///======== Admin will be able to store worker into the database table ======///
    public function storeWorker(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'name' => ['required' , 'regex:/^[A-Za-z\s]+$/'],
            'image' => ['required',
                File::image()
                ->types(['png', 'jpg', 'jpeg'])                 
                ->max(2 * 1024)
                ], //// akhane max:2 * 1024 diye bolechi amader image ta maximum 2 mb hobe amra jai 1024 kb = 1mb
            'worker_type' => ['required' ,'regex:/^[A-Za-z\s]+$/'],
            'number' => ['required','regex:/^[0-9]+$/','min:11','max:11'],
            'email' => ['required','email'],
            'address' => ['required','string'],             
        ]);

        //// Upload image
        $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

        $request->image->move(public_path('Worker_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Worker_images directory ar moddhe move kore dicchi $imageName ai name.

        //--store form data into the database table--//
        $workers = new Worker;

        $workers->name = $request->name;
        $workers->position = $request->worker_type;
        $workers->image = $imageName;
        $workers->email = $request->email;
        $workers->number = $request->number;
        $workers->address = $request->address;

        $workers->save();

        return redirect()->back()->with('status', 'Worker Added Successfully!!!'); //// ai post request ta jei page theke asheche ooporer kaj gulo hoye jawar pore aabar oi page ar moddhe chole jabe tar sathe akta message ooo niye jabe jei message ta ami with() ar moddhe 'status' key name set kore diyechi....jemon ai post request ta ashche resorses/views/admin/worker/add-worker.blade.php
    }


    ///======= Admin will be able to see all workers with edit and delete button =======///
    public function showWorkers()
    {
        $authUser = Auth::user();
        $workers = Worker::cursor(); ////akhane amader Worker Model ta jemon database ar workers table take represent kore ai database ar oi table theke ami sob datake aikhane fatch kore niye ashchi lazy collection ar cursor() method ar maddhome
        return view('restaurant.admin.worker.all-workers' , ['authUser' => $authUser , 'workers' => $workers]);
    }

    ///======= Admin will be able to edit a specific worker information =======///
    public function editWorker($id)
    {
        $specificWorker = Worker::find($id);

        $authUser = Auth::user();

        return view('restaurant.admin.worker.edit-worker', ['authUser' => $authUser,'specificWorker' => $specificWorker]);
    }

    ///======= Admin will be able to store updated workers information into the database table =======///
    public function updateWorker(Request $request , $id)
    {
        //--form data validation--//
        $request->validate([
            'name' => ['required' , 'regex:/^[A-Za-z\s]+$/'],
            'image' => [
                File::image()
                ->types(['png', 'jpg', 'jpeg'])                 
                ->max(2 * 1024)
                ], //// akhane max:2 * 1024 diye bolechi amader image ta maximum 2 mb hobe amra jai 1024 kb = 1mb
            'position' => ['required' ,'regex:/^[A-Za-z\s]+$/'],
            'number' => ['required','regex:/^[0-9]+$/','min:11','max:11'],
            'email' => ['required','email'],
            'address' => ['required','string'],             
        ]);

        //--store form data into the database table--//

        $specificWorker = Worker::find($id);   /// akhane amader Worker Model ta database ar jei table ke represent kore jemon ai khane  amader Ai Worker Model ta database ar workers table take represent kore..and ami Worker Model mane workers table theke $id diye find korechi $id ar moddhe jei value ta thakbe oi value diye amader workers table theke find korbe and jei datata pabe oi table theke oi data take $specificWorker ai variable ar moddhe store kore debe
        
        $specificWorker->name = $request->name;
        $specificWorker->position = $request->position;
        $specificWorker->number = $request->number;
        $specificWorker->email = $request->email;
        $specificWorker->address = $request->address;

        if(isset($request->image)){ //// jodi amader form ar image input field ta kew fillup kore tokhon ai code tuku execute hobe.image input field aa jodi kono image kew set na kore tahole ai code ta execute hobe na.  
             
            $imageName = time().'.'.$request->image->extension(); ////akhane amader notun image ar akta file name create kora hoyeche

            $request->image->move(public_path('Worker_images'), $imageName);  /////amader ai image file take public ar moddhe Worker_images directory ar moddhe move kora hoyeche oi $imageName ar nam  aaaaaaaaaa
            $specificWorker->image = $imageName; ////// tar pore amader database ar oi id ar image field ar moddhe amader ai image name take save kora hoyeche
       }

       $specificWorker->save();

       return redirect()->route('show.workers')->with('status', 'Worker Information Updated Successfully!!!');

    }

    ///========== Admin will be able to delete a specific worker from the database table =========///
    public function deleteWorker($id)
    {
        $specificWorker = Worker::find($id);

        $specificWorker->delete();

        return redirect()->route('show.workers')->with('status', 'Worker Name ' .$specificWorker->name. ' Deleted Successfully!!!');
    }

}
