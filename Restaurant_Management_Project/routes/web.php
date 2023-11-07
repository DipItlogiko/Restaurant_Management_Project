<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectUsersController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. 
|
*/

Route::get('/',[Homecontroller::class,'index']);  

////======= Authentication ar pore amader oi authenticated user ta ai route aa aashe hit korbe karon amara amader app/providers/RouteServiceProvider ar moddhe ai route take define kore diyechi==========////
Route::get('/redirectUsers',[RedirectUsersController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');  ///// verified hoccche amader akta middleware ai middleware ar kaj hocche amader user ar email ta varify ki na ta check kore jodi user ar email varify thake tahole oi user ai route aa dhukte parbe jodi user ar email varify na thake tahole take aage email varify korte hobe tar pore she ai route aa dhukte parbe


Route::middleware('auth')->group(function () {
    ////====================================== User ================================////
    Route::get('/profileEdit', [ProfileController::class, 'edit'])->name('profile.edit'); 
    Route::patch('/profileUpdate', [ProfileController::class, 'update'])->name('profile.update'); ///ai route ta amader User and Admin 2 jon ee use korte parbe
    Route::get('/resetPassword', [ProfileController::class, 'userPasswordEdit'])->name('user.password.edit'); 
    Route::get('/deleteAccount', [ProfileController::class, 'userAdvanceSettings'])->name('user.advance.settings');   
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); ///ai route ta amader User and Admin 2 jon ee use korte parbe
    Route::get('/foodCart{id}', [OrderController::class, 'foodCart'])->name('food.cart'); /// this {id} is comes from restaurant/includes/FoodMenu.blade.php
    Route::post('/foodCartStore{id}',[OrderController::class, 'foodCartStore'])->name('store.cart'); /// this {id} is comes from restaurant/user/food-cart.blade.php.
    Route::get('/showCart', [OrderController::class, 'showCart'])->name('show.cart');
    Route::get('/deleteCart{id}', [OrderController::class, 'deleteCart']); /// this {id} is comes from resources/restaurant/user/show-cart.blade.php
    Route::post('/orderStore', [OrderController::class, 'orderStore'])->name('order.store');
    Route::get('/orderHistory', [OrderController::class, 'orderHistory'])->name('order.history');

    ////====================================== Admin ================================////    
    Route::get('/adminProfile', [ProfileController::class, 'adminEdit'])->name('admin.edit');
    Route::get('/adminPassword', [ProfileController::class, 'adminPasswordEdit'])->name('password.edit');
    Route::get('/adminAdvanceSettings', [ProfileController::class, 'adminAdvanceSettings'])->name('admin.advance.settings');
    Route::get('/adminShowUsers', [AdminUsersController::class, 'showUsers'])->name('admin.show.users');
    Route::get('/user{id}', [AdminUsersController::class , 'showUser']); ///// this {id} is comes from resource/views/restaurant/admin/show-users.blade.php
    Route::get('/adminCreateUser', [AdminUsersController::class, 'createUser'])->name('admin.create.user');    
    Route::post('/adminStoreUser', [AdminUsersController::class, 'storeUser'])->name('admin.store.user');    
    Route::get('/adminDeleteUsers', [AdminUsersController::class, 'usersDelete'])->name('admin.delete.user');
    Route::get('/adminDeleteUser{id}', [AdminUsersController::class, 'delete']); //// this {id} is comes from resource/views/restaurant/admin/users-delete.blade.php
    Route::get('/adminUsersTrush', [AdminUsersController::class, 'usersTrush'])->name('admin.users.trush');  
    Route::get('/restoreUser{id}', [AdminUsersController::class, 'usersRestore']); ////// this {id} is comes from resource/views/restaurant/admin/show-users-trush.blade.php
    Route::get('/permanentDeleteUser{id}', [AdminUsersController::class, 'usersDeletePermanently']); ////// this {id} is comes from resource/views/restaurant/admin/show-users-trush.blade.php
    Route::get('/createFood', [FoodController::class, 'createFood'])->name('admin.create.food');
    Route::post('/foodStore', [FoodController::class, 'foodStore'])->name('admin.food.store');
    Route::get('/showFoods', [FoodController::class, 'showFoods'])->name('admin.show.foods'); 
    Route::get('/foodEdit{id}', [FoodController::class, 'foodEdit'])->name('admin.food.edit'); ///// this {id} is comes from resource/views/restaurant/admin/show-foods.blade.php
    Route::patch('/updatedFoodStore{id}', [FoodController::class, 'updatedFoodStore'])->name('admin.updated.food.store'); ///// this {id} is comes from resource/views/restaurant/admin/food-edit.blade.php
    Route::get('/deleteFood{id}', [FoodController::class, 'deleteFood']); ///// this {id} is comes from resource/views/restaurant/admin/show-foods.blade.php
    Route::get('/allOrders', [OrderController::class, 'allOrders'])->name('admin.show.orders'); 
});


 

require __DIR__.'/auth.php'; ///// akhane amra amader routes ar moddhe jei auth.php file ta ache oi file take ami aikhane require kore niyechi karon amra amader oonek page ar moddhe routes/auth.php ar moddhe jei route ache oi route guloke add korechi...and jodi amra amader ai routes/auth.php ai web.php ar moddhe require na kori tahole amader page ar moddhe jei jei jaigai amara auth.php file ar route gulo use korechi oi route gulo khuje pabe na and error dekhabe...amara jokhon kono page ar moddhe amader route ar nam dei tokhon amader oi route gulo amader routes/web.php theke oi guloke khoje
