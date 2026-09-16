<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScanLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'scanned_code', 'result',
        'scanned_by', 'ip_address', 'user_agent', 'notes',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }

    public function scopeSuccess($query)
    {
        return $query->where('result', 'success');
    }

    public function scopeDuplicates($query)
    {
        return $query->where('result', 'duplicate');
    }
}
