<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    ///====== User will be able to see Cart Food page hare =======///
    public function foodCart($id)
    {
        $authUser = Auth::user();
        $specificFood = Food::find($id);
        

        $user_id = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
        $count = Cart::where('user_id',$user_id)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.

        if ($authUser->user_type == '0'){ //// jodi amader Authenticated user ar user_type jodi 0 hoy mane jei user ta siguUp and logIn kore amader application ar moddhe ashbe oi user ar user_type ta jodi 0 hoy tahole shudhu oi user ta amader ai if ar moddhe ja bola ache ta korte parbe

            if(Auth::id()){ ///// akhane ami if ar moddhe Auth::id() diye bole diyechi je jodi Auth:id() pai mane kono Authenticated user ar id pai mane je user signUp ba signIn kore amader application ar moddhe ashbe oi user ar id ta jodi pai taholei oi Authenticated user ke amader cart page ar moddhe  jete parbe...mane authentication chara kew amader cart page ar moddhe jete parbe na..
                return view('restaurant.user.food-cart',['authUser' => $authUser , 'specificFood' => $specificFood , 'count' => $count]);
            }else{  ///// jodi kono user Authenticated na thake mane signUp ba signIn kore na ashe tahole amader oi user take aikhane login page dekhabe
                return redirect()->route('login');
            }

        }else{ //// jodi kono  admin ai page aaa ashar try kore tahole take home page ai redirect kore debe karon oi page theke request ashbe and ami else ar moddhe bole deyechi return redirect()->back() mane jei page theke request ta ashbe oi page ar moddhei take redirect kore debe..
            return redirect()->back();
        }
    }


    ///====== User Carted food will store here =======///
    public function foodCartStore(Request $request ,$id)
    {
        //----form data validation----//
        $request->validate([
            'quantity' => ['string'],
        ]); 

        $user_id = Auth::id(); //// here we will get the Authenticated user id by Auth::id() and here we have stored that Authenticated user id into this $user_id variable
        $food_id = $id;

        //---save data into the database---//
        $store = new Cart; /// here i have created a new instance of the Cart Model by new Cart and i have stored it into the $store variable
        
        $store->user_id = $user_id;
        $store->food_id = $food_id;
        $store->quantity = $request->quantity; 

        $store->save();

        return redirect()->route('dashboard')->with('status','Food Carted Successful');
        
    }

    ///======= User will be able to see his own all carts with remove button and Order button =======///
    public function showCart()
    {
        $authUser = Auth::user();
        $userId = Auth::id(); //// akhane ami authenticated user ar id ta peye jabo Auth::id() ar maddhome....Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe enter koreche oi user ke bojhai..
        $count = Cart::where('user_id',$userId)->count(); /// akhane amader laravel application ar Cart Model ta database ar jei table take represent kore oi table theke ami where ar maddhome check korchi oi table ar user_id field ar moddhe amader Authenticated user ar id koi bar ache oi ta count korchi count() function diye...count hocche akta aggregiate function amra jani aggregiate function mot 5 ta.
        $orderCount = Order::where('user_id', $userId)->count();

        $specificUserCarts = Cart::where('user_id',$userId)->join('food', 'carts.food_id', '=', 'food.id')->get(['carts.id', 'food.title', 'food.price', 'carts.quantity', 'food.image']); //// aakhane ami amar Cart Model mane Cart model ta amader database ar jei table take represent kore jemon akhane amader Cart Model ta database ar carts table take represent kore oi carts table ar moddhe theke prothome amra check korechi oi table ar user_id nameeee jei field ta ache oi field ar moddhe amader Authenticated user ar id diye check korechi je ai authenticated user koita cart koreche and jar pore amra ai 'carts' table ar sathe join korechi amader 'food' table ke and ai join ta hobe amader carts.food_id ar opore mane carts table ar moddhe jei food_id column ta ache oi id oonujayi food.id mane food table ar id column ar jei id gulo match korbe oi data gulo sob niye ashbe amader food table theke...and amader carts table ar sathe food table join hoye jawar pore ami oi data gulo theke 'carts.id' carts table ar id take  and 'food.title' food table ar title take and 'food.price' food table ar price take  and 'carts.quantity' carts table ar quantity take and 'food.image' food table theke image take get korechi mane ai data gulo shudhu anechi sob data ar moddhe theke..
         
        $sumOfQuantity = $specificUserCarts->sum('quantity');
        $sumOfPrice = 0; // Initialize the total price variable
        foreach ($specificUserCarts as $cartItem) {
            $sumOfPrice += $cartItem->price * $cartItem->quantity;   ///// $sumOfPrice = $sumOfPrice + $cartItem->price * $cartItem->quantity; aitake amra $sumOfPrice += $cartItem->price * $cartItem->quantity; aivave likhechi short curt aaa...
        }
        $sumOfItems = $specificUserCarts->count('title');         
        
        return view('restaurant.user.show-cart' , ['authUser' => $authUser, 'count' => $count , 'data' => $specificUserCarts , 'sumOfQuantity' => $sumOfQuantity , 'sumOfPrice' => $sumOfPrice, 'sumOfItems' => $sumOfItems , 'orderCount' => $orderCount]);
    }

    ///====== User will be able to remove their carts from carts ======///
    public function deleteCart($id)
    {
        $specificCart = Cart::find($id);

        $specificCart->delete();

        return redirect()->route('show.cart')->with('status', 'Food Removed Successfully From Carts');
    }

    ///====== User order will sotore into the database ======///
    public function orderStore(Request $request)
    {
        //--form data validation--//
        $request->validate([
            //amader ai $request ar moddhe r oo oonek input field ar data ashche kintu ami oi data guloke aikhane validate kori ni karon amader oi data gulo aage thekei validate kora ache..               
            'payment_method' => ['required','string'],
            'address' => ['required','string'],
            'number' => ['required', 'regex:/^[0-9]+$/' ,'min:11'],

        ]);

        //--data store into the database table--//
        foreach ($request->food_name as $key => $foodname)    /////amader resources/views/restaurant/user/show-cart.blade.php ar moddhe jei form ta ache and oi form ar moddhe food_name nam aaa jei input field ar nam ache oi input field  ar moddhe multipale value ashte pare key and value pair aa jemon "0"=>"burggur" tai amra foreach loop ar moddhe $request->food_name request theke jei food_name ta pacchi oi food name ar key take ami $key ar moddhe rakhchi and food ar nam take ami $foodname ar moddhe store kore diyechi...amader $request ar moddhe data gulo ki vabe ashche ta dekhar jonno amader ai controller ar ai method ar sob code comment kore diye dd($request->all()); ai ta likhe amader application run korle amra dekhte pabo amader $request ar moddhe data gulo kivabe ashche
        {
            $ordersTable = new Order;    //// akhane ami amader Order Model ar akta new instance create korechi amra jani amader laravel application ar protekta Eloquent Model amader database ar ak ak ta table ke represent kore amader laravel application ar kon Model ta amader database ar kon table ke represent korche ta amra 3 vabe check korte pari jemon 1. amader Modle ar moddhe mane app/Models ar moddhe theke jei model ta ke dekhte chacchi oi model ar moddhe giye dekhte hobe amader oi Model ar moddhe kono $protected table name kono array ache ki na and oi array ar moddhe kono table ar nam lekha ache ki na jodi amader oi model ar $protected array ar moddhe kono table ar nam lekha thake tahole amader bujte hobe amader oi Model ta amader database ar oi table ke represent korche  2. amader laravel application ar database/migrations ar moddhe jei table gulo ache or moddhe giye amader check korte hobe amader Model ar same nam aaa and tar seshe s (sob choto hater and seshe s ai format ke bole snakecase) jodi ai vabe kono table ar nam thake tahole bujte hobe amader database ar ai table take represent korche amader oi Model ta.  3.(php artisan model:show model_ar_nam)  ai artisan command ar ai khane ami show ar pore jei model ar nam ta dibo oi model ta amader database ar kon table ke represent kore ta amader dekhabe
            
            $ordersTable->food_name = $foodname;
            $ordersTable->price = $request->price[$key];  /// akhane amader price ar pore [$key] dewar karon hocche amader ak ak ta specific food ar specific price amader database ar table aa save korar jonno
            $ordersTable->quantity = $request->quantity[$key];
            $ordersTable->food_image = $request->image[$key];             
            $ordersTable->user_id = Auth::id();  //// aikhane Auth::id(); mane hocche Authenticated user ar id . Authenticated user mane hocche jei user signUp and signIn kore amader application ar moddhe aasheche oi user ke bojhai
            $ordersTable->payment = $request->payment_method;
            $ordersTable->user_address = $request->address;
            $ordersTable->number = $request->number;
            
            $ordersTable->save();
        }

        return redirect()->route('show.cart')->with('status', 'Order Confirm Successfully');
    }

    ///===== Admin will be able to see all orders information with Edit and Delete buttons =====///
    public function allOrders()
    {
        $authUser = Auth::user();
        $ordersTable = Order::join('users', 'orders.user_id' , '=' , 'users.id' )->cursor();  ////akhane amader Order Model ta database ar jei table take represent kore oitable theke sob data fatch korechi lazy collection ar cursor() method ar maddhome.. get() ba all() method diye ooo data fatch kora jai database ar table theke kintu jodi ami get() ba all() method diye data fatch kori tahole amader oi database ar table theke sob  datake akbare fatch kore amader laravel application memory storage space ar moddhe lod kore dei jodi amader oi database ar table ar moddhe lakh lakh data thake tahole oi data gulo amader laravel application ar moddhe akbare load hole amader laravel application ta crass korbe and akta error dekhabe je amader laravel ar memory storage space overlod hoye geche...tai amra lazy collection ar cursor() method ta use korbo aita amader database ar table theke sob data ke akbare amader laravel application ar moddhe load korbe na.
        $totalOrder = $ordersTable->count('id');
        $TotalOrderInProcess = $ordersTable->where('order_status', '=', 'processing')->count();
        $TotalOrderPlaced = $ordersTable->where('order_status', '=', 'placed')->count();
        $OrderOnTheWay = $ordersTable->where('order_status', '=', 'on the way')->count();

        return view('restaurant.admin.show-all-orders',['authUser' => $authUser , 'ordersTable' => $ordersTable , 'totalOrder' => $totalOrder , 'TotalOrderInProcess' => $TotalOrderInProcess , 'TotalOrderPlaced' => $TotalOrderPlaced , 'OrderOnTheWay' => $OrderOnTheWay]);  
    }

    ///===== User Will be able to see his own orders history =====///
    public function orderHistory()
    {
       $authUser = Auth::user(); 
       $count = Cart::where('user_id', $authUser->id )->count(); //// akhane amader Cart model ta amader database ar jei table take represent kore jemon aikhane Cart model ta amader database ar carts table take represent kore akhane carts table theke ami where ar moddhe bolechi carts table ar user_id column ar moddhe $authUser->id mane authenticated user ar id kotobar ache oita aikhane count() korechi 
       $orderCount = Order::where('user_id', $authUser->id)->count(); 

       $data = Order::where('user_id', $authUser->id)->cursor();

       return view('restaurant.user.order-history',['authUser' => $authUser , 'count' => $count, 'orderCount' => $orderCount , 'data' => $data]);
    }
}
