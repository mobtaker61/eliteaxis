<?php

return [
    'car_makes' => [
        'Toyota',
        'Nissan',
        'Honda',
        'Mitsubishi',
        'Hyundai',
        'Kia',
        'Ford',
        'Chevrolet',
        'BMW',
        'Mercedes-Benz',
        'Audi',
        'Volkswagen',
        'Porsche',
        'Lexus',
        'Infiniti',
        'Mazda',
        'Land Rover',
        'Jeep',
        'Volvo',
        'Tesla',
    ],

    'admin_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', (string) env('BOOKING_ADMIN_EMAILS', ''))
    ))),

    'admin_whatsapps' => array_values(array_filter(array_map(
        static fn (string $number): string => trim($number),
        explode(',', (string) env('BOOKING_ADMIN_WHATSAPPS', ''))
    ))),

    'queue_notifications' => filter_var(env('BOOKING_QUEUE_NOTIFICATIONS', false), FILTER_VALIDATE_BOOLEAN),
];
