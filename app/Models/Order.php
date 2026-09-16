<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'reference', 'user_id',
        'customer_name', 'customer_email', 'customer_phone',
        'subtotal', 'fees', 'total',
        'status', 'payment_method', 'paid_at', 'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'fees' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->uuid ??= (string) Str::uuid();
            $order->reference ??= 'ELITE-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function splitGroup(): HasMany
    {
        return $this->hasMany(SplitGroupPayment::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getFormattedTotalAttribute(): string
    {
        return '₦'.number_format((float) $this->total, 0);
    }

    public function getTicketCountAttribute(): int
    {
        return (int) $this->items()->sum('quantity');
    }
}
