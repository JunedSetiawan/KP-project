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
            $table->unsignedInteger('nipd')->unique()->nullable();
            $table->unsignedBigInteger('nisn')->unique()->nullable();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('phone_number')->nullable();
            $table->string('name_parent')->nullable();
            $table->string('phone_number_parent')->nullable();
            $table->string('phone_number_parent_opt')->nullable();
            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->string('status')->nullable()->default('active');
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->foreign('school_year_id')->references('id')->on('school_years');
            $table->unsignedBigInteger('user_id')->nullable(); // Kolom untuk menyimpan user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('note')->nullable();
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
