<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->text('desc2');
            $table->timestamp('publish_at')->nullable();
            $table->enum('status', ['public', 'private', 'draft'])->default('public');
            $table->enum('type', ['vegetarian', 'vegan', 'gluten-free'])->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('type');
            $table->index('publish_at');
        });

        Schema::create('recipe_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('recipe_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['recipe_id', 'user_id']);
        });

        Schema::create('recipe_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->foreignId('parent_id')->nullable()->constrained('recipe_comments')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('recipe_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('platform', ['facebook', 'twitter', 'instagram', 'copy_link']);
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });

        Schema::create('recipe_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        Schema::create('recipe_categorys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_categorys');
        Schema::dropIfExists('recipe_views');
        Schema::dropIfExists('recipe_shares');
        Schema::dropIfExists('recipe_comments');
        Schema::dropIfExists('recipe_likes');
        Schema::dropIfExists('recipe_images');
        Schema::dropIfExists('recipes');
    }
};