<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'author_name', 'author_email', 'author_photo',
        'rating', 'comment', 'is_approved', 'is_featured',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getAuthorPhotoUrlAttribute(): ?string
    {
        if (! $this->author_photo) {
            return null;
        }

        if (str_starts_with($this->author_photo, 'http://') || str_starts_with($this->author_photo, 'https://')) {
            return $this->author_photo;
        }

        return asset('storage/'.$this->author_photo);
    }
}
