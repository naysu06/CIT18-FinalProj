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
            $table->id();
            $table->string('plate_number')->unique();
            $table->string('model_year');
            $table->string('image');
            $table->date('date')->nullable();
            $table->string('place')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Post Status
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Associate with user
            $table->timestamps();
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