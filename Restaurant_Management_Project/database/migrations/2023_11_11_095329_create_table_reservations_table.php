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
        Schema::create('table_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_number');
            $table->string('time_from');
            $table->string('time_to');
            $table->string('number_of_people');
            $table->string('table_name');
            $table->string('description');
            $table->string('user_id')->nullable(); //// akhnae ami user_id column take nullable korediyechi mane ai column ar moddhe amader data ashte ooo pare aaabar na ooo ashte pare..
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_reservations');
    }
};
