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
        Schema::create('roomtypes', function (Blueprint $table) {
            $table->unsignedInteger('room_type_id');
            $table->string('type');
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedDecimal('price', $precision = 8, $scale = 2);
            $table->primary(['room_type_id', 'hotel_id']);
            
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomtypes');
    }
};
