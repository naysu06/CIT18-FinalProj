<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//update the snippet below
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // Unique ID
            $table->string('plate_number')->unique(); // Required Plate Number, Unique
            $table->string('model_year'); // Required Model/Year
            $table->string('image'); // Required Image Path or URL
            $table->date('date')->nullable(); // Optional Date
            $table->string('place')->nullable(); // Optional Place
            $table->timestamps(); // Created At and Updated At
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};