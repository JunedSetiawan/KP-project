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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nis')->unique();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('phone_number');
            $table->string('name_parent');
            $table->string('phone_number_parent');
            $table->string('phone_number_parent_opt')->nullable();
            $table->foreignId('classes_id')->nullable();
          //  $table->foreign('classes_id')->references('id')->on('classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
