<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('venue_name');
            $table->string('venue_address');
            $table->string('city')->default('Lagos');
            $table->string('state')->default('Lagos');
            $table->string('country')->default('Nigeria');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->dateTime('doors_open_at')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('flyer_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->json('social_links')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('tickets_on_sale')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
