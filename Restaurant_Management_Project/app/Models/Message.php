<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /// akhane amra accessore use korechi amader ai Message Model ta database ar jei table take represent kore jemon amader ai Message Eloquent Model ta database ar messages nam ar akta table ke represent kore...and amra jani amader laravel application ar protita Eloquent Model database ar ak ak ta table ke represent kore..
    public function getCreatedAtAttribute($value)  /// akhane amader messages table ar created_at column take accessor diye modify kore tar pore amader applicaion ar moddhe show korabo...accessore ta get diye likhte hoy...accessor ta use kora hoy database ar moddhe theke kono datake modify kore tar pore amader application ar moddhe show koranor jonno ...and mutator amra use kori amader application ar moddhe theke kono data database ar save hoyar aage oi data take modify kore then amra oi data take amader database ar tabele ar moddhe save kori ..mutator amra set diye likhi
    {
        return date("d-m-Y h:i A", strtotime($value));  ////// d-m-Y akhane 'd' mane hocche day and 'm' mane hocche mash jehetu ami aikhane choto hater m use korechi tai amader mash ar  nam ta number aa dekhabe jemon jodi march hoy tahole 3 dekhabe jodi ami boro hater 'M' ditam tahole amader mash ar nam dekha to jemon jodi mash ar nam march hoto tahole amader March dekhato letter aaa jehetu amader ai created_at column ar value ta string aakare ashbe tai amra oi string ke timestamp aa convart korar jonno amra strtotime($value) aita likhechi and aikhane h:i A akhane h hocche hour ba ghonta and i hocche miniutes and A hocche amader AM and PM take handel korbe..and amader desher time oonujayi jeno ai AM and PM ta dekhai tar jonno amra amader laravel application ar moddhe config directory ar moddhe app.php ar moddhe jei 'timezone' =>  ta ache oi khane ami 'Asia/Dhaka', likhe diyechi
    }

}
