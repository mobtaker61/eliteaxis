<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceBooking extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'car_make',
        'car_model',
        'car_year',
        'requested_date',
        'requested_time',
        'status',
        'locale',
    ];

    protected $casts = [
        'requested_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'booking_services');
    }
}
