<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SplitGroupPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_uuid', 'order_id', 'organizer_id',
        'total_amount', 'expected_splits', 'paid_splits',
        'amount_collected', 'status', 'expires_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'amount_collected' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function isComplete(): bool
    {
        return $this->status === 'completed';
    }
}
