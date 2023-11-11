<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableReservation extends Model
{
    use HasFactory;

    /// akhane amra mutator use korechi mutator ta use kora hoy amader application theke kono data ke database ar moddhe save korar aage amra oi datatake modify korte pari ai mutator ar maddhome and mutator amra set diye likhi 
    public function setTimeFromAttribute($value) /// akhane amader TableReservation Model ta database ar jei table take represent kore jemon aikhane amader ai Model ta database ar table_reservations table take represent kore and oi table ar moddhe jei time_from column ta ache oi column ar moddhe jokhon eee kono data save hobe tokhon amader aikhane aaage ashbe data ta and aikhan theke modify hoye tar pore database ar oi table ar oi column ar moddhe giye set hobe
    {
        $formattedDate = date("h:i A", strtotime($value));  ///// jehetu amader $value ai variable ar value ta string aaakara ashbe and aitake timestamp aa  convart korar jonno amra strtotime() ai method ta use korechi....and aikhane h mane hocche hours mane ghonta and i mane hocche minites and A hocche amader AM and PM take handel korbe
       $this->attributes['time_from'] =  $formattedDate;
    }

    public function setTimeToAttribute($value) /// akhane amader TableReservation Model ta database ar jei table take represent kore jemon aikhane amader ai Model ta database ar table_reservations table take represent kore and oi table ar moddhe jei time_to column ta ache oi column ar moddhe jokhon eee kono data save hobe tokhon amader aikhane aaage ashbe data ta and aikhan theke modify hoye tar pore database ar oi table ar oi column ar moddhe giye set hobe
    {
        $formattedDate = date("h:i A", strtotime($value));  ///// jehetu amader $value ai variable ar value ta string aaakara ashbe and aitake timestamp aa  convart korar jonno amra strtotime() ai method ta use korechi....and aikhane h mane hocche hours mane ghonta and i mane hocche minites and A hocche amader AM and PM take handel korbe
       $this->attributes['time_to'] =  $formattedDate;
    }
}
