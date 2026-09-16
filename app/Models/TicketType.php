<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'name', 'slug', 'description', 'perks',
        'online_price', 'door_price',
        'quantity_total', 'quantity_sold', 'max_per_order',
        'is_active', 'is_vendor_stall', 'sort_order',
    ];

    protected $casts = [
        'perks' => 'array',
        'online_price' => 'decimal:2',
        'door_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_vendor_stall' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (TicketType $type) {
            if (empty($type->slug)) {
                $type->slug = Str::slug($type->name).'-'.uniqid();
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function getRemainingAttribute(): int
    {
        return max(0, $this->quantity_total - $this->quantity_sold);
    }

    public function isSoldOut(): bool
    {
        return $this->quantity_total > 0 && $this->quantity_sold >= $this->quantity_total;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('online_price');
    }

    public function getFormattedOnlinePriceAttribute(): string
    {
        return '₦'.number_format((float) $this->online_price, 0);
    }

    public function getFormattedDoorPriceAttribute(): ?string
    {
        return $this->door_price ? '₦'.number_format((float) $this->door_price, 0) : null;
    }
}
