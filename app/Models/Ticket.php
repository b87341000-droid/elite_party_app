<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'order_id', 'order_item_id', 'ticket_type_id', 'user_id',
        'attendee_name', 'attendee_email',
        'ticket_code', 'qr_hash', 'pdf_path',
        'is_scanned', 'scanned_at', 'scanned_by', 'is_emailed',
    ];

    protected $casts = [
        'is_scanned' => 'boolean',
        'scanned_at' => 'datetime',
        'is_emailed' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Ticket $ticket) {
            $ticket->uuid ??= (string) Str::uuid();
            $ticket->ticket_code ??= 'EBP-'.strtoupper(Str::random(8));
            $ticket->qr_hash ??= hash('sha256', $ticket->uuid.'|'.Str::random(40).'|'.now()->timestamp);
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }

    public function scanLogs(): HasMany
    {
        return $this->hasMany(ScanLog::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function isScanned(): bool
    {
        return $this->is_scanned;
    }
}
