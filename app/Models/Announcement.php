<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'audience', 'send_email',
        'is_published', 'published_at', 'emailed_at', 'created_by',
    ];

    protected $casts = [
        'send_email' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'emailed_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
