<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'address',
        'number',
        'user_type',
        'account_created_by',
        'account_creator_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getCreatedAtAttribute($value) ////// akhane amra accessore use korechi 
    {
       return date("d-m-Y h:i A", strtotime($value));  ////// d-m-Y akhane 'd' mane hocche day and 'm' mane hocche mash jehetu ami aikhane choto hater m use korechi tai amader mash ar  nam ta number aa dekhabe jemon jodi march hoy tahole 3 dekhabe jodi ami boro hater 'M' ditam tahole amader mash ar nam dekha to jemon jodi mash ar nam march hoto tahole amader March dekhato letter aaa
    }

    public function getUpdatedAtAttribute($value) ////// akhane amra accessore use korechi 
    {
       return date("d-m-Y h:i A", strtotime($value));  ////// d-m-Y akhane 'd' mane hocche day and 'm' mane hocche mash jehetu ami aikhane choto hater m use korechi tai amader mash ar  nam ta number aa dekhabe jemon jodi march hoy tahole 3 dekhabe jodi ami boro hater 'M' ditam tahole amader mash ar nam dekha to jemon jodi mash ar nam march hoto tahole amader March dekhato letter aaa
    }


    /////=====================(IMPORTANT) Akhane amra amader users table ar email_verified_at column take jodi ai vabe accessor ar maddhome data ta show kori tahole amader email varified functionality ta kaj korbe na karon amader notun kono user jokhon signUp korbe tokhon oi user ar ar record ar moddhe email_varified_at column ar value ta null hobe and oi user ar samne email varification ar akta page dekhabe and jodi amra accessore ar maddhome aikhane email_varified_at column ar value take ai vabe modify kore then amader page ar moddhe show kori tahole amra dekhte pabo amader email varificaton ta koj korche na and kono user signUp korar sathe sathe dashboard ar moddhe chole jabe kono email varification charai...and jodi amra ai vabe amader users table ar  email_varified_at column take accessore ar maddhome datatake modify kore then amader application ar moddhe show korai tahole amra dekhte pabo amader email_varified_at column ar moddhe jei khane null ache oi khane akta vul val data dekhabe tai amra amader Model ar moddhe email_varified_at column take accessore ar maddhome modify korbo na...jodi kori tahole amader email varification functionality ta kaj korbe na 
    // public function getEmailVerifiedAtAttribute($value) ////// akhane amra accessore use korechi 
    // {
    //    return date("d-m-Y h:i A", strtotime($value));  ////// d-m-Y akhane 'd' mane hocche day and 'm' mane hocche mash jehetu ami aikhane choto hater m use korechi tai amader mash ar  nam ta number aa dekhabe jemon jodi march hoy tahole 3 dekhabe jodi ami boro hater 'M' ditam tahole amader mash ar nam dekha to jemon jodi mash ar nam march hoto tahole amader March dekhato letter aaa
    // }
}
