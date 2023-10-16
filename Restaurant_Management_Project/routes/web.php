<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectUsersController;
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[Homecontroller::class,'index']);  

////======= Authentication ar pore amader oi authenticated user ta ai route aa aashe hit korbe karon amara amader app/providers/RouteServiceProvider ar moddhe ai route take define kore diyechi==========////
Route::get('/redirectUsers',[RedirectUsersController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');  ///// verified hoccche amader akta middleware ai middleware ar kaj hocche amader user ar email ta varify ki na ta check kore jodi user ar email varify thake tahole oi user ai route aa dhukte parbe jodi user ar email varify na thake tahole take aage email varify korte hobe tar pore she ai route aa dhukte parbe

 


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); 
    Route::get('/adminProfile', [ProfileController::class, 'adminEdit'])->name('admin.edit');
    Route::get('/adminPassword', [ProfileController::class, 'adminPasswordEdit'])->name('password.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');   

    
});


 

require __DIR__.'/auth.php';
