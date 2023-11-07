<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //// akhane amra amader Order Model ta database ar jei table take represent kore oi table theke created_at column ar value take table theke aaane akhane modify korechi accessor ar maddhome...amra accessor ar maddhome database ar table theke kono column ar value aakhan theke modify kore tar por amader application ar moddhe oi value ta dekhate pari 
    public function getCreatedAtAttribute($value) /// akhane get likhechi karon ami accessor use korchi tai and CreatedAt hocche amader orders table ar column ar nam created_at aikhane column ar nam ar prothom letter boro hater likhte hoy tar pore Attribute likhte hobe and ai $value ai variable ar moddhe amader orders table created_at column ar moddhe theke je datagulo ashbe oi datagulo aikhane mane $value ai variable ar moddhe store hoye jabe
    {
       return date("d-M-Y", strtotime($value)); ///// jehetu amader $value ai variable ar moddhe jei datata ashbe oi datata string aaakare ashbe tai amra strtotime() function ar maddhome $value variable ar value take timestramp a convart kore niyechi and difine kore diyechi amader created_at column  ar value ta "d-M-Y" ai format aa dekhabe
    }
}
