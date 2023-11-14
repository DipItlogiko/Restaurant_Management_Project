<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Expense extends Model
{
    use HasFactory;    

    
    
    public function getCreatedAtAttribute($value) //// akhane ami accessor use korechi amader Expense Model ta jemon akhane database ar expenses nam aa akta table ke represent korche oi table ar created_at column ar value ta jodi amader application ar moddhe kothaw use kori tokhon oidata ta aikhan theke modify hoye tar pore amader application ar moddhe show hobe ...accessor amra get diye likhi and mutator amra set diye likhi....akhane created_at column take accessor diye modify korechi tai get tar pore amader column ar nam CreatedAt boro hater likhte hobe 
    {
       return date("d-m-Y h:i A" ,strtotime($value));  
    }  
     
}
