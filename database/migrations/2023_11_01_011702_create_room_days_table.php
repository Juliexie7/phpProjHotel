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
        Schema::create('room_days', function (Blueprint $table) {
            $table->unsignedInteger('room_type_id');
            $table->unsignedBigInteger('hotel_id');
            $table->date('date');
            $table->unsignedInteger('total'); 
            $table->unsignedInteger('available');
            $table->primary(['room_type_id', 'hotel_id', 'date']);

            $table->foreign('room_type_id')->references('room_type_id')->on('roomtypes');
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_days');
    }
};
