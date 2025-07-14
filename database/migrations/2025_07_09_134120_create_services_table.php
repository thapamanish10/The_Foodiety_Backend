<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('info');
            $table->text('desc');
            $table->text('why');
            $table->text('why2')->nullable();
            $table->text('offer');
            $table->string('logo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });

        Schema::create('service_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_images');
        Schema::dropIfExists('services');
    }
};