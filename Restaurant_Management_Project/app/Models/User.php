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

    public function getEmailVerifiedAtAttribute($value) ////// akhane amra accessore use korechi 
    {
       return date("d-m-Y h:i A", strtotime($value));  ////// d-m-Y akhane 'd' mane hocche day and 'm' mane hocche mash jehetu ami aikhane choto hater m use korechi tai amader mash ar  nam ta number aa dekhabe jemon jodi march hoy tahole 3 dekhabe jodi ami boro hater 'M' ditam tahole amader mash ar nam dekha to jemon jodi mash ar nam march hoto tahole amader March dekhato letter aaa
    }
}
