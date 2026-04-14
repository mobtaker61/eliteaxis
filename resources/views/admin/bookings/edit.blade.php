@extends('admin.layout')

@section('title', 'Edit Booking')

@section('content')
    <h1 class="h3 mb-3">Edit Booking #{{ $booking->id }}</h1>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-1"><strong>Customer:</strong> {{ $booking->customer?->name }}</p>
            <p class="mb-1"><strong>WhatsApp:</strong> {{ $booking->customer?->whatsapp_number }}</p>
            <p class="mb-1">
                <strong>Services:</strong>
                {{ $booking->services->map(fn ($service) => $service->translate('name', 'en'))->filter()->implode(', ') ?: ($booking->service?->translate('name', 'en') ?? 'N/A') }}
            </p>
            <p class="mb-0"><strong>Vehicle:</strong> {{ $booking->car_make }} {{ $booking->car_model }} ({{ $booking->car_year }})</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.bookings.update', ['locale' => app()->getLocale(), 'serviceBooking' => $booking->id]) }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected(old('status', $booking->status) === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label d-block">Services</label>
                    <div class="border rounded p-3 bg-white" style="max-height: 180px; overflow-y: auto;">
                        @php
                            $defaultServiceIds = $booking->services->pluck('id')->all();
                            if (empty($defaultServiceIds) && $booking->service_id) {
                                $defaultServiceIds = [$booking->service_id];
                            }
                            $selectedIds = array_map('intval', old('service_ids', $defaultServiceIds));
                        @endphp
                        @foreach ($services as $service)
                            <div class="form-check d-flex align-items-center mb-2">
                                <input class="form-check-input me-2"
                                    type="checkbox"
                                    id="admin_booking_service_{{ $service->id }}"
                                    name="service_ids[]"
                                    value="{{ $service->id }}"
                                    @checked(in_array($service->id, $selectedIds, true))>
                                @if ($service->avatar)
                                    <img src="{{ asset($service->avatar) }}" alt="avatar" class="rounded-circle border me-2" style="width: 22px; height: 22px; object-fit: cover;">
                                @endif
                                <label class="form-check-label" for="admin_booking_service_{{ $service->id }}">
                                    {{ $service->translate('name', 'en') }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Requested Date</label>
                    <input type="date" class="form-control" name="requested_date" value="{{ old('requested_date', $booking->requested_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Requested Time</label>
                    <input type="time" class="form-control" name="requested_time" value="{{ old('requested_time', date('H:i', strtotime((string) $booking->requested_time))) }}" required>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.bookings.index', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
