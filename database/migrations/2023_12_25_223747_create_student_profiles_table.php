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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('register_id')->unique();
            $table->string('whatapp_no')->nullable();
            $table->string('gender');
            $table->text('present_address');
            $table->string('area_locality')->nullable();
            $table->string('city')->default('guwahati')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('class')->nullable();
            $table->string('school')->nullable();
            $table->string('subjects');
            $table->string('board')->nullable();
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->string('profile_pic')->nullable();
            $table->string('tutor_gender')->nullable();
            $table->string('no_of_classes')->nullable();
            $table->string('convenient_days')->nullable();
            $table->string('convenient_time')->nullable();
            $table->string('reference_id')->nullable();
            $table->unsignedBigInteger('student_id'); // Assuming this is the reference to the students table
            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
