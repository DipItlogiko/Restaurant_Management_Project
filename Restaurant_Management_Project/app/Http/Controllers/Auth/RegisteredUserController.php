<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {        

        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/' , 'max:50'],
            'email' => ['required', 'string', 'email',  'unique:'.User::class],
            'image' => ['required','image','mimes:jpg,jpeg,png'], ///// maximum image size ta ami akhane difine kore diyechi 1024 mame 1mb amara jani 1mb =1024 kb
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string'],
            'number' => ['required', 'regex:/^[0-9]+$/','min:11'],
                            
        ]);

            //// Upload image
            $imageName = time().'.'.$request->image->extension(); //// akhane amader $request ar moddhe je image ta ashbe jokhon kew amader form ar moddhe kono image diye submit korbe tokhon amaer oi image ta amader ai $request  ar moddhe chole ashbe and aikhane ami amader $requset ar moddhe je image take pabo oi image ar extension ke niyechi extension() function ar maddhome and oi image ar akta nam create korechi amra aikhane jemon $request ar moddhe theke asha amader image ar nam ta akhane ami convart kore diyechi jemon ai image ar nam hobe  ptothom aa time ta pore akta . tarpore amader image file ar extension ta hobe form ar moddhe jei image ta pathabe oi image ar extension take ami use korechi amader image ar nam ta create korar jonno.....

            $request->image->move(public_path('Users_images'), $imageName); /// akhane ami amader $request ar moddhe theke je image take pabo oi image take ami akhan theke amader public_path mane amader laravel application ar public directory ar moddhe Products directory ar moddhe move kore dicchi $imageName ai name.


        $user = User::create([ /////// jodi amra ai vabe amader laravel application ar eloquent Model ar sathe create method call kore ai vabe amader database ar table ar moddhe data save kori tahole amader oobosooi amara jei modle ar sathe create() method ta likhbo oi model ar moddhe giye amader fillable[] array ar moddhe ai field ar ar nam gulo likhe dite hobe jei field gulo ami bam side aa likhechi ai field gulo holo amader User Modle jemon database ar users table ke represent kore oi users table ar field ar nam.jodi ami ai khane amar users table ar field ar moddhe request theke asha data gulo pass kore dei and model ar fillable[] array ar moddhe ai field ar nam na likhi tahole amader ai data gulo amader database ar table ar moddhe save hobe na..tai jokhon amra ai niyome mane model ar sathe create() method take call kore amader database ar tablea ar modddhe data pathabo tokhon amader ai bishoy ta mathai rakhte hobe ja amar jei model ar sathe create() method call korbo and aikhan theke jei jei column ar moddhe data pathabo amader database ar table aa oi oi column ar nam gulo amadr oi model ar moddhe fillable [] array ar moddhe likhe dite hobe amra ai khan theke jei koita database ar table ar column ar moddhe data pathabo thik oi koita column ar nam amader model ar fillable[] array ar moddhe likhe dite hobe hobe jodi ami aikhan theke 5 ta column ar moddhe data pathai and ami amar model ar fillable [] array ar moddhe 4 ta culumn ar nam likhi tahole amader database ar oi table ar moddhe shudhu 4 ta column ar data eeee save hobe..
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageName,
            'password' => Hash::make($request->password),
            'account_created_by' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
        
}
 
