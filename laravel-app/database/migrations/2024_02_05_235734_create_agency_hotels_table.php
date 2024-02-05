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
        Schema::create('agency_hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('agency_id')->references('id')->on('agency')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_hotels');
    }
};
