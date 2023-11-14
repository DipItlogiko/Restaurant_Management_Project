<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory,SoftDeletes;    

    public function getCreatedAtAttribute($value) //// akhane ami accessor use korechi amader Table Model ta jemon akhane database ar tables nam aa akta table ke represent korche oi table ar created_at column ar value ta jodi amader application ar moddhe kothaw use kori tokhon oidata ta aikhan theke modify hoye tar pore amader application ar moddhe show hobe ...accessor amra get diye likhi and mutator amra set diye likhi....akhane created_at column take accessor diye modify korechi tai get tar pore amader column ar nam CreatedAt boro hater likhte hobe 
    {
       return date("d-m-Y h:i A", strtotime($value)); ///// jehetu amader $value ai variable ar moddhe jei datata ashbe oi datata string aaakare ashbe tai amra strtotime() function ar maddhome $value variable ar value take timestramp a convart kore niyechi and difine kore diyechi amader created_at column  ar value ta "d-M-Y" ai format aa dekhabe
    }   
}
