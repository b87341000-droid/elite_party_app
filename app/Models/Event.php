<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'tagline', 'description',
        'venue_name', 'venue_address', 'city', 'state', 'country',
        'starts_at', 'ends_at', 'doors_open_at',
        'hero_image', 'flyer_image', 'logo_image',
        'social_links', 'is_active', 'tickets_on_sale',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'doors_open_at' => 'datetime',
        'social_links' => 'array',
        'is_active' => 'boolean',
        'tickets_on_sale' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->name);
            }
        });
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

    public function artists(): HasMany
    {
        return $this->hasMany(Artist::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('starts_at', '>=', now())->orderBy('starts_at');
    }

    public function isUpcoming(): bool
    {
        return $this->starts_at && $this->starts_at->isFuture();
    }

    public function getCountdownTargetAttribute(): ?string
    {
        return $this->doors_open_at?->toIso8601String()
            ?? $this->starts_at?->toIso8601String();
    }

    public function getFullAddressAttribute(): string
    {
        return trim("{$this->venue_name}, {$this->venue_address}, {$this->city}, {$this->state}, {$this->country}", ', ');
    }
}
