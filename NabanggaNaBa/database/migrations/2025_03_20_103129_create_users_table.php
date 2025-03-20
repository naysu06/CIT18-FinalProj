<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Unique ID (Primary Key)
            $table->string('username')->unique(); // Unique Username
            $table->string('password'); // Required Password
            $table->enum('role', ['admin'])->default('admin'); // Required Role (admin only for now)
            $table->timestamps(); // Created at and Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
