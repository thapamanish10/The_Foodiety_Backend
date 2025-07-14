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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->string('number');
            $table->string('email');
            $table->string('logo')->nullable();
            $table->string('opt_number')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('threads')->nullable();
            $table->timestamps();
        });

        Schema::create('about_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_images');
        Schema::dropIfExists('abouts');
    }
};
