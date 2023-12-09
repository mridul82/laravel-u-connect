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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('register_id')->unique();
            $table->string('whatapp_no')->nullable();
            $table->string('gender');
            $table->text('present_address');
            $table->string('area_locality');
            $table->string('city')->default('guwahati');
            $table->string('pin_code');
            $table->string('highest_qualification');
            $table->string('specialisation');
            $table->string('preferred_subject')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('education_document1')->nullable();
            $table->string('education_document2')->nullable();
            $table->string('education_document3')->nullable();
            $table->string('education_document4')->nullable();
            $table->unsignedBigInteger('teacher_id'); // Assuming this is the reference to the teachers table
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
