<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [        
        'title',
        'food_type',
        'image',
        'price',
        'description',
         
    ];

    /// akhane amra accessore use korechi. accessore amra use kori database theke data anar somoy take modify kore tar pore amader application ar moddhe dekhanor jonno and accessore get diye likhte hoy and mutator set diye likhte hoy.

    public function getCreatedAtAttribute($value) /// akhane get likhechi karon ami accessor use korchi tai and CreatedAt hocche amader food table ar column ar nam created_at aikhane column ar nam ar prothom letter boro hater likhte hoy tar pore Attribute likhte hobe and ai $value ai variable ar moddhe amader food table created_at column ar moddhe theke je datagulo ashbe oi datagulo aikhane mane $value ai variable ar moddhe store hoye jabe
    {
       return date("d-m-Y h:i A", strtotime($value)); ///// jehetu amader $value ai variable ar moddhe jei datata ashbe oi datata string aaakare ashbe tai amra strtotime() function ar maddhome $value variable ar value take timestramp a convart kore niyechi and difine kore diyechi amader created_at column  ar value ta "d-M-Y" ai format aa dekhabe..akhane "d-M-Y" boro hater M mane amader mash ar nam ta letter a dekhabe jodi amra aikhane choto hater m dei tahole amader mash ar nam sonkhai dekhabe march hole 3 dekhabe  
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y h:i A", strtotime($value)); /// 'h' mane hocche Hours and 'i' hocche minutes and 'A' amader AM and PM ta handel korbe and amader ai time ta jeno thik thak vabe dekhai amader desh ar time oonujayi tar jonno ami amader laravel application ar config/app.php ar moddhe giye timezone ta Asia/Dhaka kore diyechi....
    }
}
