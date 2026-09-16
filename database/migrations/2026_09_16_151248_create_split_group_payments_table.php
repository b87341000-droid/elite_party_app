<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('split_group_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('group_uuid')->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('total_amount', 12, 2);
            $table->integer('expected_splits');
            $table->integer('paid_splits')->default(0);
            $table->decimal('amount_collected', 12, 2)->default(0);
            $table->string('status')->default('open');   // open, completed, expired
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('split_group_payments');
    }
};
