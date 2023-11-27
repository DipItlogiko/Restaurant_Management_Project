<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectUsersController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\DailyExpenseController;
use App\Http\Controllers\MonthlyExpenseController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MonthlyIncomeController;
 

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

////====================================== User ================================////
Route::middleware(['auth' , 'can:isUser'])->group(function () {                      /// amader can middleware ta app/Http/kernel.php ar moddhe bydefault vabe thake..ai can middleware ar kaj hocche authorization check kora jemon ai khane amader isUser authorization take check korbe amader can middleware ta ..and ai isUser authentication ta amara app/providers/AuthServiceProvider.php ar boot method ar moddhe define kore diyechi
  
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
    Route::post('/bookTable' , [TablesController::class, 'bookTable'])->name('book.table');
    Route::get('/tableReservationsHistory', [TablesController::class, 'tableReservations'])->name('table.reservations');
    Route::post('/sandMessage', [MessageController::class, 'sandMessage'])->name('sand.message');
    Route::get('/allMessages', [MessageController::class, 'allMessages'])->name('all.messages');
    Route::get('/editMessage{id}', [MessageController::class, 'editMessage'])->name('edit.message'); /// this {id} is comes from resources/views/restaurant/user/message/all-messages.blade.php
    Route::patch('/updateMessage{id}', [MessageController::class, 'updateMessage'])->name('message.edit');  //this {id} is comes from resources/views/restaurant/user/message/edit-message.blade.php
    Route::get('/messageDelete{id}', [MessageController::class, 'messageDelete']); //this {id} is comes from resources/views/restaurant/user/message/all-messages.blade.php
    Route::get('/messageSearch', [SearchController::class, 'searchUserMessage'])->name('message.search');
    Route::get('/searchOrder', [SearchController::class, 'searchOrder'])->name('search.order');
    Route::get('/allNotification' , [MessageController::class, 'allNotification'])->name('all.notifications');
    Route::get('/userNotificationDelete{id}', [MessageController::class, 'userNotificationDelete']); //this {id} is comes from resources/views/restaurant/user/all-notifications.blade.php
    Route::get('/clearAllNotifications', [MessageController::class, 'clearAllNotifications'])->name('clear.all.notifications');
});


 ////====================================== Admin ================================////
Route::middleware(['auth' ,'can:isAdmin'])->group(function () {      /// amader can middleware ta app/Http/kernel.php ar moddhe bydefault vabe thake..ai can middleware ar kaj hocche authorization check kora jemon ai khane amader isAdmin authorization take check korbe amader can middleware ta ..and ai isAdmin authentication ta amara app/providers/AuthServiceProvider.php ar boot method ar moddhe define kore diyechi

       
    Route::get('/adminProfile', [ProfileController::class, 'adminEdit'])->name('admin.edit');
    Route::get('/adminPassword', [ProfileController::class, 'adminPasswordEdit'])->name('password.edit');
    Route::get('/adminAdvanceSettings', [ProfileController::class, 'adminAdvanceSettings'])->name('admin.advance.settings');
    Route::get('/adminShowUsers', [AdminUsersController::class, 'showUsers'])->name('admin.show.users');
    Route::get('/user{id}', [AdminUsersController::class , 'showUser']); ///// this {id} is comes from resources/views/restaurant/admin/show-users.blade.php
    Route::get('/adminCreateUser', [AdminUsersController::class, 'createUser'])->name('admin.create.user');    
    Route::post('/adminStoreUser', [AdminUsersController::class, 'storeUser'])->name('admin.store.user');    
    Route::get('/adminDeleteUsers', [AdminUsersController::class, 'usersDelete'])->name('admin.delete.user');
    Route::get('/adminDeleteUser{id}', [AdminUsersController::class, 'delete']); //// this {id} is comes from resources/views/restaurant/admin/users-delete.blade.php
    Route::get('/adminUsersTrush', [AdminUsersController::class, 'usersTrush'])->name('admin.users.trush');  
    Route::get('/restoreUser{id}', [AdminUsersController::class, 'usersRestore']); ////// this {id} is comes from resources/views/restaurant/admin/show-users-trush.blade.php
    Route::get('/permanentDeleteUser{id}', [AdminUsersController::class, 'usersDeletePermanently']); ////// this {id} is comes from resources/views/restaurant/admin/show-users-trush.blade.php
    Route::get('/createFood', [FoodController::class, 'createFood'])->name('admin.create.food');
    Route::post('/foodStore', [FoodController::class, 'foodStore'])->name('admin.food.store');
    Route::get('/showFoods', [FoodController::class, 'showFoods'])->name('admin.show.foods'); 
    Route::get('/foodEdit{id}', [FoodController::class, 'foodEdit'])->name('admin.food.edit'); ///// this {id} is comes from resources/views/restaurant/admin/show-foods.blade.php
    Route::patch('/updatedFoodStore{id}', [FoodController::class, 'updatedFoodStore'])->name('admin.updated.food.store'); ///// this {id} is comes from resources/views/restaurant/admin/food-edit.blade.php
    Route::get('/deleteFood{id}', [FoodController::class, 'deleteFood']); ///// this {id} is comes from resources/views/restaurant/admin/show-foods.blade.php
    Route::get('/allOrders', [OrderController::class, 'allOrders'])->name('admin.show.orders'); 
    Route::get('/search', [SearchController::class, 'search'])->name('search'); 
    Route::get('/editOrder{id}', [OrderController::class, 'editOrder'])->name('admin.edit.orders');  ////this {id} is comes from resources/views/restaurant/admin/edit-orders.blade.php
    Route::patch('updateOrder{id}',[OrderController::class,'updateOrder'])->name('admin.update.order'); //// this {id} is comes from resources/views/restaurant/admin/edit-orders.blade.php
    Route::get('/deleteOrder{id}', [OrderController::class, 'deleteOrder']); /// this {id} is comes from resources/views/restaurant/admin/show-all-orders.blade.php
    Route::get('/createTable', [TablesController::class, 'createTable'])->name('admin.create.tables');
    Route::post('/storeTable', [TablesController::class, 'storeTable'])->name('admin.store.table');
    Route::get('/showTables', [TablesController::class, 'showTables'])->name('admin.show.all.tables');
    Route::get('/editTable{id}', [TablesController::class, 'editTable'])->name('admin.edit.tables.info'); /// this {id} is comes from resources/views/restaurant/admin/table/all-tables.blade.php
    Route::patch('/updatedTable{id}', [TablesController::class,'updateTable'])->name('admin.updated.table.info.store'); /// this {id} is comes from resources/views/restaurant/admin/table/edit-table
    Route::get('/deleteTable{id}' , [TablesController::class, 'deleteTable']); /// this {id} is comes from resources/views/restaurant/admin/table/all-tables.blade.php
    Route::get('/tableReservations', [TablesController::class, 'tableReservation'])->name('admin.make.reservation');
    Route::post('/storeTableReservations', [TablesController::class, 'storeTableReservation'])->name('admin.store.table.reservation');
    Route::get('/allReservedTables', [TablesController::class,'showAllReservedTable'])->name('admin.show.all.reserved.table');
    Route::get('/freeReservedTable{id}', [TablesController::class , 'freeReservedTable'])->name('booked.table.free');  //// this {id} is comes from resources/views/restaurant/admin/table/all-reserved-table.blade.php
    Route::get('/deleteReservation{id}', [TablesController::class, 'deleteReservation']);     //// this {id} is comes from resources/views/restaurant/admin/table/all-reserved-table.blade.php
    Route::get('/searchTable', [SearchController::class, 'searchBookedTable'])->name('booked.table.search');
    Route::get('/tableSearch', [SearchController::class, 'tableSearch'])->name('table.search');
    Route::get('/addChef', [ChefController::class, 'addChef'])->name('add.chefs');
    Route::post('/storeChef', [ChefController::class, 'storeChef'])->name('store.chef');
    Route::get('/allChefs', [ChefController::class, 'allChefs'])->name('show.all.chefs'); 
    Route::get('/editChef{id}', [ChefController::class, 'editChef'])->name('admin.edit.chef'); /// this id is comes from resources/views/admin/chef/all-chefs.blade.php 
    Route::patch('/updateChef{id}', [ChefController::class, 'updateChef'])->name('admin.chef.update'); //// this {id} is comes from resources/views/admin/chef/edit-chef.blade.php and amra patch method ta use kori kono data ke update korar jonno mane jokhon amra kono data ke update korbo tokhon ai patch() method ta use korbo patch() method ta use korle laravel autometically bujhe jai amader ai data take update korte hobe...
    Route::get('/deleteChef{id}', [ChefController::class, 'deleteChef']); //// this {id} is comes from resources/views/admin/chef/all-chefs.blade.php
    Route::get('/chefSearch', [SearchController::class, 'chefSearch'])->name('chef.search');
    Route::get('/addWorker', [WorkerController::class, 'addWorker'])->name('add.worker');
    Route::post('/storeWorker', [WorkerController::class, 'storeWorker'])->name('store.worker');
    Route::get('/showWorkers', [WorkerController::class, 'showWorkers'])->name('show.workers');
    Route::get('/editWorker{id}', [WorkerController::class, 'editWorker'])->name('worker.edit'); //// this {id} is comes from resources/views/admin/worker/all-workers.blade.php
    Route::patch('/updateWorker{id}', [WorkerController::class, 'updateWorker'])->name('worker.update');
    Route::get('/deleteWorker{id}', [WorkerController::class, 'deleteWorker']); //// this {id} is comes from resources/views/admin/worker/all-workers.blade.php
    Route::get('/searchWorker', [SearchController::class, 'searchWorker'])->name('search.worker'); 
    Route::get('/dailyExpense', [DailyExpenseController::class, 'dailyExpense'])->name('daily.expense');
    Route::post('/storeExpense', [DailyExpenseController::class, 'storeExpense'])->name('store.expense');
    Route::get('/expensesList', [DailyExpenseController::class,'expensesList'])->name('expenses.list');
    Route::get('/searchExpense', [SearchController::class, 'searchExpense'])->name('expense.search');
    Route::get('/editExpense{id}', [DailyExpenseController::class, 'editExpense'])->name('admin.edit.expense');  /// this {id} is comes from resources/views/admin/expense/expenses-list.blade.php 
    Route::patch('/updateExpense{id}', [DailyExpenseController::class, 'updateExpense'])->name('update.expense');  /// this {id} is comes from resources/views/admin/expense/edit-expense.blade.php 
    Route::get('/deleteExpense{id}', [DailyExpenseController::class, 'deleteExpense']);  /// this {id} is comes from resources/views/admin/expense/expenses-list.blade.php 
    Route::get('/monthlyExpense', [MonthlyExpenseController::class,'index'])->name('monthly.expense');
    Route::post('/monthlyPDF', [MonthlyExpenseController::class,'monthlyPDF'])->name('monthly.pdf'); 
    Route::post('/addTask', [TaskController::class,'addTask'])->name('add.task'); 
    Route::get('/deleteTask{id}', [TaskController::class,'deleteTask'])->name('delete.task'); /// this  {id} is comes from resources/views/restaurant/admin/dashboard.blade.php
    Route::get('/customerMessages', [MessageController::class , 'customerMessages'])->name('customser.messages');
    Route::get('/searchMessage', [SearchController::class, 'searchMessage'])->name('search.message');
    Route::get('/deleteMessage{id}' , [MessageController::class,'deleteMessage']); /// this {id} is comes from resources/views/restaurant/admin/message/all-message.blade.php and search-messages.blade.php
    Route::get('/llNotifications', [MessageController::class, 'allNotifications'])->name('all.notification');
    Route::get('/deleteNotification{id}' , [MessageController::class,'deleteNotification']); /// this {id} is comes from resources/views/restaurant/admin/all-notification.blade.php
    Route::get('/deleteAllNotification' , [MessageController::class, 'deleteAllNotification'])->name('delete.All.Notification');
    Route::get('/searchUser' , [SearchController::class, 'searchUser'])->name('search.user'); 
    Route::get('/searchUserForDelete' , [SearchController::class, 'searchUserForDelete'])->name('search.for.delete.user');
    Route::get('/searchTrushUser' , [SearchController::class, 'searchTrushUser'])->name('search.trush.user');
    Route::get('/searchFood' , [SearchController::class, 'searchFood'])->name('search.food');
    Route::get('/monthlyIncome' , [MonthlyIncomeController::class, 'monthlyIncome'])->name('monthly.income');
    Route::post('/monthlyIncomePDF', [MonthlyIncomeController::class,'monthlyIncomePDF'])->name('monthly.income.pdf'); 

});



// fallback route(ai fallback route ar kaj hocche amader application ar moddhe jodi kono user emon kono route likhe browser ar moddhe diye browse kore ja amader ai routes/web.php ar moddhe nei tokhon ai fallback route ar moddhe ai jei page ta define kore debo oi page ta user ar shamne show korbe)
Route::fallback(function () {
   return view('restaurant.fallback.error');
});
 

require __DIR__.'/auth.php'; ///// akhane amra amader routes ar moddhe jei auth.php file ta ache oi file take ami aikhane require kore niyechi karon amra amader oonek page ar moddhe routes/auth.php ar moddhe jei route ache oi route guloke add korechi...and jodi amra amader ai routes/auth.php ai web.php ar moddhe require na kori tahole amader page ar moddhe jei jei jaigai amara auth.php file ar route gulo use korechi oi route gulo khuje pabe na and error dekhabe...amara jokhon kono page ar moddhe amader route ar nam dei tokhon amader oi route gulo amader routes/web.php theke oi guloke khoje
 