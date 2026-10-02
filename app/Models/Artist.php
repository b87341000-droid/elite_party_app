<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'name', 'stage_name', 'role', 'bio', 'photo',
        'instagram', 'tiktok', 'twitter',
        'is_headliner', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_headliner' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->stage_name ?: $this->name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        return asset('storage/'.$this->photo);
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('is_headliner')->orderBy('sort_order');
    }
}
