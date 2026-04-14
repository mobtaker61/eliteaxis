<h2>New Service Booking Received</h2>
<p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
<p><strong>Customer Name:</strong> {{ $booking->customer->name }}</p>
<p><strong>WhatsApp:</strong> {{ $booking->customer->whatsapp_number }}</p>
<p><strong>Car Make:</strong> {{ $booking->car_make }}</p>
<p><strong>Car Model:</strong> {{ $booking->car_model }}</p>
<p><strong>Car Year:</strong> {{ $booking->car_year }}</p>
<p><strong>Service Type:</strong>
    {{ $booking->services->map(fn ($service) => $service->translate('name', 'en'))->filter()->implode(', ') ?: ($booking->service?->translate('name', 'en') ?? 'N/A') }}
</p>
<p><strong>Requested Date:</strong> {{ $booking->requested_date?->format('Y-m-d') }}</p>
<p><strong>Requested Time:</strong> {{ \Illuminate\Support\Carbon::parse($booking->requested_time)->format('H:i') }}</p>
<p><strong>Language:</strong> {{ strtoupper($booking->locale) }}</p>
