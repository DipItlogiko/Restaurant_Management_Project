<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //======== Admin will be able to store his task into the database table ========//
    public function addTask(Request $request)
    {
        //--form data validation--//
        $request->validate([
            'task' => ['required', 'string'],
        ]);

        //--store form data into the database table--//
        $tasks = new Task;  /// akhane amader Task Model ar akta instance create korechi ba amader task model ta database ar jei table take represent kore jemon aikhane amader Task Model ta database ar tasks table take represent kore and oi table ar akta instance create korechi ami aikhane
    
        $tasks->description = $request->task;

        $tasks->save();

        return redirect()->back()->with('status', 'Task Added Successfully!!!');      //// akhaen returen redirect()->back() mane hocche amader ai post request ta jei page theke aasheche oporer kaj gulo hoye jawar pore aabar oi page ar moddhe chole jabe jemon amader ai post request ta ashche admin ar dashboard theke tai jokhon ai controller ar oporer kaj gulo hoye jabe tar pore aabar admin ar dashboard ar moddhe back korbe with akta messate ar sathe jei message ta ami with() ar moddhe 'status' key ar moddhe set kore diyechi...ai status key ar value ta hocche pore string ta...amader admin dashboard ar moddhe ai status key ar value take flash message ar moddhe show korano ache ja amader bootstrap5 ar Aleart use kore create kora 
    
    }

    public function deleteTask($id)
    {
        $specificTask = Task::find($id);

        $specificTask->delete();

        return redirect()->back()->with('status', 'Task Deleted Successfully');
    }
}
