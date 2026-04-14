@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-muted mb-0">Pending</h6>
                        <span class="fs-4">⏳</span>
                    </div>
                    <h2 class="mb-0">{{ $pendingCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-muted mb-0">Confirmed</h6>
                        <span class="fs-4">✅</span>
                    </div>
                    <h2 class="mb-0">{{ $confirmedCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-muted mb-0">Today</h6>
                        <span class="fs-4">📅</span>
                    </div>
                    <h2 class="mb-0">{{ $todayCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-muted mb-0">Completed</h6>
                        <span class="fs-4">🏁</span>
                    </div>
                    <h2 class="mb-0">{{ $completedCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <strong>New Pending Bookings</strong>
                    <span class="badge bg-warning text-dark">{{ $pendingBookingsCount }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>WhatsApp</th>
                                <th>Services</th>
                                <th>Requested Date</th>
                                <th>Requested Time</th>
                                <th>Vehicle</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingRecentBookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->customer?->name }}</td>
                                    <td>{{ $booking->customer?->whatsapp_number }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @forelse ($booking->services as $service)
                                                <span class="badge bg-light text-dark border">{{ $service->translate('name', 'en') }}</span>
                                            @empty
                                                <span class="badge bg-light text-dark border">{{ $booking->service?->translate('name', 'en') ?? 'N/A' }}</span>
                                            @endforelse
                                        </div>
                                        <div class="d-flex mt-1 gap-1">
                                            @foreach ($booking->services as $service)
                                                @if ($service->avatar)
                                                    <img src="{{ asset($service->avatar) }}" alt="avatar" class="rounded-circle border" style="width: 24px; height: 24px; object-fit: cover;">
                                                @endif
                                            @endforeach
                                            @if ($booking->services->isEmpty() && $booking->service?->avatar)
                                                <img src="{{ asset($booking->service->avatar) }}" alt="avatar" class="rounded-circle border" style="width: 24px; height: 24px; object-fit: cover;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $booking->requested_date?->format('Y-m-d') }}</td>
                                    <td>{{ date('H:i', strtotime((string) $booking->requested_time)) }}</td>
                                    <td>{{ $booking->car_make }} {{ $booking->car_model }} ({{ $booking->car_year }})</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <form method="POST" action="{{ route('admin.bookings.update-status', ['locale' => app()->getLocale(), 'serviceBooking' => $booking->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.bookings.update-status', ['locale' => app()->getLocale(), 'serviceBooking' => $booking->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3">No pending bookings.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <strong>Today's Bookings</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Services</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todayBookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->customer?->name }}</td>
                                    <td>
                                        {{ $booking->services->pluck('name')->map(fn ($value) => $value['en'] ?? null)->filter()->implode(', ') ?: ($booking->service?->translate('name', 'en') ?? 'N/A') }}
                                    </td>
                                    <td>{{ date('H:i', strtotime((string) $booking->requested_time)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">No bookings for today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <strong>Open Bookings (Confirmed)</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Services</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($openBookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->customer?->name }}</td>
                                    <td>
                                        {{ $booking->services->pluck('name')->map(fn ($value) => $value['en'] ?? null)->filter()->implode(', ') ?: ($booking->service?->translate('name', 'en') ?? 'N/A') }}
                                    </td>
                                    <td>{{ $booking->requested_date?->format('Y-m-d') }}</td>
                                    <td>{{ date('H:i', strtotime((string) $booking->requested_time)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">No open confirmed bookings.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
