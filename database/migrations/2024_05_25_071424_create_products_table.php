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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_logo');
            $table->string('location');
            $table->string('phone_number');
            $table->string('website_link')->nullable();
            $table->string('menu')->nullable();
            $table->string('opening_time')->nullable();
            $table->text('about_us');
            $table->string('price_range')->nullable();
            $table->string('cuisines')->nullable();
            $table->string('special_diets')->nullable();
            $table->string('meals')->nullable();
            $table->float('latitude')->nullable()->default(0);
            $table->float('longitude')->nullable()->default(0);
            $table->text('features');
            $table->string('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
