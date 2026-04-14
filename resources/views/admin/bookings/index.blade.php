@extends('admin.layout')

@section('title', 'Manage Bookings')

@section('content')
    <h1 class="h3 mb-3">Bookings</h1>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>WhatsApp</th>
                        <th>Services</th>
                        <th>Vehicle</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->customer?->name }}</td>
                            <td>{{ $booking->customer?->whatsapp_number }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @forelse ($booking->services as $service)
                                        <span class="badge bg-light text-dark border">{{ $service->translate('name', 'en') }}</span>
                                    @empty
                                        <span class="text-muted">{{ $booking->service?->translate('name', 'en') ?? 'N/A' }}</span>
                                    @endforelse
                                </div>
                                <div class="d-flex gap-1">
                                    @foreach ($booking->services as $service)
                                        @if ($service->avatar)
                                            <img src="{{ asset($service->avatar) }}" alt="avatar" class="rounded-circle border" style="width: 24px; height: 24px; object-fit: cover;">
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $booking->car_make }} {{ $booking->car_model }} ({{ $booking->car_year }})</td>
                            <td>{{ $booking->requested_date?->format('Y-m-d') }}</td>
                            <td>{{ date('H:i', strtotime((string) $booking->requested_time)) }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bookings.edit', ['locale' => app()->getLocale(), 'serviceBooking' => $booking->id]) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No bookings found.</td>
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
