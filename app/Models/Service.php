<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'title',
        'description',
        'features',
        'content',
        'icon',
        'image',
        'avatar',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'title' => 'array',
        'description' => 'array',
        'features' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(ServiceBooking::class, 'booking_services');
    }

    public function translate(string $field, ?string $locale = null, string $fallback = 'en'): mixed
    {
        $value = $this->{$field} ?? null;

        if (! is_array($value)) {
            return $value;
        }

        $locale = $locale ?? app()->getLocale();

        return $value[$locale] ?? $value[$fallback] ?? array_values($value)[0] ?? null;
    }
}
