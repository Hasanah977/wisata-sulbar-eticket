<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'booking_code', 'destination_id', 'visitor_name',
        'visitor_whatsapp', 'visit_date', 'quantity',
        'total_price', 'payment_status', 'paid_at'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
