<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->user()->user_type == '1') { ///// akhane ami set kore diyechi jodi amader $request->user() mane authenticated user ar user_type jodi 1 hoy tahole amader oi user ke ai nicher page a redirect koro ...amader user_type hocche users table ar akta field ar nam and ai users table take represent kore amader User Model ta.....amader laravel application ar moddhe app/Models ar moddhe jei model gulo thake oi model guloke bole Eloquent Model...amader laravel application ar protita model database ar ak ak ta table ke represent kore..amader model ar nam ja hobe oiname chotohater ookhor diye shuru hobe amader database ar table ar nam and tar sesh aaa akta  s  add kore dite hobe tahole amader oi model ta amader ai database ar table take represent korbe...ta chara amra oonek somoy Model ar moddhei protected table array ar moddhe amader table ar nam ta bole dite pari tahole amader oi model ta database ar oi table take represent korbe jeita model ar moddhe amra protected table array ar moddhe likhe diyechi oita..ta chara amra jodi dekhte chai amader kon model ta amader kon database ar table take represent korche tahole amra php artisan model:show model_ar_man   akhane amra jei model ar nam dibo oi model ta amader database ar kon table take represent korche ta  dekhabe.

           return redirect()->route('password.edit')->with('status', 'Password Updated Successfully!!! ');

        }
    }
}
