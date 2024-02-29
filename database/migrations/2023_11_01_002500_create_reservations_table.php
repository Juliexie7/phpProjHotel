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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('reservation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('room_type_id');
            $table->unsignedTinyInteger('number_booked');
            $table->date('checkin');
            $table->date('checkout');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('addinfo');            
            $table->timestamps();

            $table->foreign('room_type_id')->references('room_type_id')->on('roomtypes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
