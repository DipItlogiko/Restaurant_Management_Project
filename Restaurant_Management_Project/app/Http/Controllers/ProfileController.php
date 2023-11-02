<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the User profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();

        return view('restaurant.user.profile.edit', ['authUser' => $user]);
    }

    /**
     * Display the Admin profile form.
     */
    public function adminEdit()
    {
         
        $authUser = Auth::user();

        return view('restaurant.admin.profile.edit', ['authUser' => $authUser]);
    }

    /**
     * Update the Admin and User profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        $request->user()->fill($request->validated());


        $request->user()->name = $request->name; //// akhane amra  $request->user() mane authenticated user ar name column take dhorechi and tar moddhe amra request theke jei name ta pacchi oi name take amader database  ar name column ar moddhe store kore dicchi      

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if(isset($request->image)){ //// jodi amader form ar image input field ta kew fillup kore tokhon ai code tuku execute hobe.image input field aa jodi kono image kew set na kore tahole ai code ta execute hobe na. mane amader image ta update hobe na.
             
            $imageName = time().'.'.$request->image->extension(); ////akhane amader notun image ar akta file name create kora hoyeche

            $request->image->move(public_path('Users_images'), $imageName);  /////amader ai image file take public ar moddhe Products directory ar moddhe move kora hoyeche oi file ar nam  aaaaaaaaaa
            $request->user()->image = $imageName; ////// tar pore amader database ar oi id ar image field ar moddhe amader ai image name take save kora hoyeche
       }

        $request->user()->save(); ///// akhane amader $request->user() mane authenticated users ar data ta save hoye jabe

       if($request->user()->user_type == '1'){
          return Redirect::route('admin.edit')->with('status', 'Profile updated successfully');
       }

       return Redirect::route('profile.edit')->with('status', 'Profile-updated successfully');
        
    }

    /**
     * Display the Admin Password Edit form.
     */
    public function adminPasswordEdit(){

        $authUser = Auth::user();

        return view('restaurant.admin.profile.update-password',['authUser' => $authUser]);
    }


    public function adminAdvanceSettings()
    {
        $authUser = Auth::user();
        return view('restaurant.admin.profile.advance-setting',['authUser' => $authUser]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {                
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account Deleted successfully !!!');
    }
}
