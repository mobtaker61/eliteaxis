<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'whatsapp_number',
    ];

    public function serviceBookings(): HasMany
    {
        return $this->hasMany(ServiceBooking::class);
    }
}
