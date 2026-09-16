<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');                     // Regular, VIP, VVIP, Table of 4, Vendor Stall
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('perks')->nullable();          // array of perk strings
            $table->decimal('online_price', 12, 2);
            $table->decimal('door_price', 12, 2)->nullable();
            $table->integer('quantity_total')->default(0);
            $table->integer('quantity_sold')->default(0);
            $table->integer('max_per_order')->default(10);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_vendor_stall')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
