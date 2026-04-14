@extends('admin.layout')

@section('title', 'Customer Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Customer #{{ $customer->id }}</h1>
        <a class="btn btn-outline-primary" href="{{ route('admin.customers.edit', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}">Edit Customer</a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>Name:</strong> {{ $customer->name }}</p>
            <p class="mb-0"><strong>WhatsApp:</strong> {{ $customer->whatsapp_number }}</p>
        </div>
    </div>

    <h2 class="h5 mb-3">Booking History</h2>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Services</th>
                        <th>Vehicle</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>
                                {{ $booking->services->map(fn ($service) => $service->translate('name', 'en'))->filter()->implode(', ') ?: ($booking->service?->translate('name', 'en') ?? 'N/A') }}
                            </td>
                            <td>{{ $booking->car_make }} {{ $booking->car_model }} ({{ $booking->car_year }})</td>
                            <td>{{ $booking->requested_date?->format('Y-m-d') }}</td>
                            <td>{{ date('H:i', strtotime((string) $booking->requested_time)) }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bookings.edit', ['locale' => app()->getLocale(), 'serviceBooking' => $booking->id]) }}">Manage</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No bookings found for this customer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $bookings->links() }}
    </div>
@endsection
