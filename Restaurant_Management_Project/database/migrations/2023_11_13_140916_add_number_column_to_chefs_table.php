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
        Schema::table('chefs', function (Blueprint $table) {  //// akhane amader chefs table ta already database ar moddhe exest ache and amra ai table take modify korbo tai Schema:: fasad ar sathe ami table() method ta use korechi...jodi ami notun kono table create kortam amader database ar moddhe tahole amra Schema:: fasad ar sathe create() method ta use kortam
            $table->string('number')->after('image'); //// akhane ami bolechi amader chefs table ar moddhe ai number name akta column add koro and ai column ta add hobe amader image column ar pore tai amra after('image') likhechi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chefs', function (Blueprint $table) {
            Schema::dropIfExists('chefs');
        });
    }
};
