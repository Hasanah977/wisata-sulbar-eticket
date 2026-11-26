<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'order_id',
        'qr_token',
        'scan_count',
        'status',
        'scanned_at',
        'scanned_by',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
