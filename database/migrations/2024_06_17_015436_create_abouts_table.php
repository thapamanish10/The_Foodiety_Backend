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
            $table->string('company_name');
            $table->string('company_logo');
            $table->string('phone_number');
            $table->string('optional_phone_number')->nullable();
            $table->string('email_address');
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('youtube_link');
            $table->string('tiktok_link');
            $table->string('threads_link');
            $table->text('about_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
