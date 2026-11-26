<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $fillable = [
        'name', 'slug', 'regency', 'description',
        'price', 'daily_quota', 'open_hours', 'image', 'is_active'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function remainingQuotaForDate(string $date): int
    {
        $booked = $this->orders()
            ->whereDate('visit_date', $date)
            ->whereIn('payment_status', ['pending', 'paid'])
            ->sum('quantity');

        return max(0, $this->daily_quota - $booked);
    }
}
