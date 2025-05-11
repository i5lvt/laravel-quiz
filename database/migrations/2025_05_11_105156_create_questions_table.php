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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_ar');
            $table->string('question_en');
            $table->json('options_ar'); // array of 4 options
            $table->json('options_en');
            $table->unsignedTinyInteger('correct_index'); // index 0-3
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('button_color')->nullable();
            $table->string('video_path')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
