<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function(Blueprint $table){ ///// jokhon amra amader database ar moddhe kono exesting table ar moddhe kono modify ba kono change korbo tokhon amra ai Schema:: fasads ba class ar  sathe table method ta use korbo karon amader akhane ami amader database ar moddhe already create kora kono table ar moddhe modify korchi tai... kintu jokhon amara notun kono table create korbo tokhon amara Schema:: fasads ba class ar sathe amra create method ta use korbo....and Blueprint hocche akta class jar moddhe amader table ar datatype gulo store kora thake jemon amra SQL ar maddhome jokhon kono table ar kono column ar type ta amra define kortam tokhon amra varchar() int() ai gulo use kortam kintu ai Blueprint ar moddhe amader datatype gulo oonno name define kora jemon Blueprint ar moddhe string() name akta method ache ja under the hood amader SQL ar varchar() method takei run kore.
            $table->string('image')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
