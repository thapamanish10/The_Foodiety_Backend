<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('name');
            $table->text('desc');
            $table->text('desc2');
            $table->string('publish_at');
            $table->string('status')->default("public");
            $table->float('latitude')->nullable()->default(0);
            $table->float('longitude')->nullable()->default(0);
            $table->string('number')->nullable();
            $table->string('rating')->nullable();
            $table->string('email')->nullable();
            $table->string('services')->nullable();
            $table->string('food')->nullable();
            $table->string('value')->nullable();
            $table->string('atmosphere')->nullable();
            $table->timestamps();
        });

        // Blog Images table
        Schema::create('restaurant_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('restaurant_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['restaurant_id', 'user_id']); // Prevent duplicate likes
        });

        // Blog comments table
        Schema::create('restaurant_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->foreignId('parent_id')->nullable()->constrained('restaurant_comments')->onDelete('cascade');
            $table->timestamps();
        });

        // Blog shares table
        Schema::create('restaurant_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('platform'); // 'facebook', 'twitter', 'copy_link', etc.
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });

        // Blog views table
        Schema::create('restaurant_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('restaurant_views');
        Schema::dropIfExists('restaurant_shares');
        Schema::dropIfExists('restaurant_comments');
        Schema::dropIfExists('restaurant_likes');
        Schema::dropIfExists('restaurant_images');
        Schema::dropIfExists('restaurants');
    }
};
