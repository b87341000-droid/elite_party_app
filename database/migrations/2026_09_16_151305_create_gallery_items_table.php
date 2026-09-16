<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->default('image');  // image, video
            $table->string('file_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('video_url')->nullable();   // YouTube/Vimeo embed
            $table->string('category')->nullable();    // performance, crowd, backstage, afterparty
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
