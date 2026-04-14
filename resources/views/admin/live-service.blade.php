@extends('admin.layout')

@section('title', 'Live Service')

@section('content')
    @php
        $selectedService = $selectedServiceId ? $services->firstWhere('id', $selectedServiceId) : null;
        $serviceCardsCount = $services->count() + 1; // +1 for "All Services"
    @endphp

    <style>
        .live-service-filter-grid {
            display: grid;
            grid-template-columns: repeat(var(--live-service-cols), minmax(0, 1fr));
            gap: 10px;
        }

        .live-service-filter-item {
            min-width: 0;
        }

        .live-service-filter-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .live-service-filter-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 1px solid #d8deea;
            border-radius: 10px;
            padding: 8px;
            min-height: 96px;
            background: #fff;
            cursor: pointer;
            transition: all .2s ease;
            text-align: center;
        }

        .live-service-filter-input:checked + .live-service-filter-label {
            border-color: #003169;
            background: rgba(0, 49, 105, 0.08);
            box-shadow: 0 0 0 2px rgba(0, 49, 105, 0.15);
        }

        .live-service-filter-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #d8deea;
        }

        .live-service-filter-fallback {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #003169;
            background: #f5f7fb;
            border: 1px solid #d8deea;
        }

        .live-service-filter-title {
            font-size: 11px;
            font-weight: 700;
            color: #003169;
            line-height: 1.2;
            word-break: break-word;
        }
    </style>

    <div class="card border-0 shadow-sm mb-3" style="background: linear-gradient(135deg, rgba(0, 49, 105, 0.08), rgba(0, 49, 105, 0.02));">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.live-service', ['locale' => app()->getLocale()]) }}">
                <label class="form-label d-block mb-2">Filter by Service</label>
                <div class="live-service-filter-grid" style="--live-service-cols: {{ $serviceCardsCount }};">
                    <div class="live-service-filter-item">
                        <input class="live-service-filter-input"
                            type="radio"
                            id="live_service_filter_all"
                            name="service_id"
                            value=""
                            @checked(!$selectedServiceId)>
                        <label class="live-service-filter-label" for="live_service_filter_all">
                            <span class="live-service-filter-fallback"><i class="fa fa-th-large"></i></span>
                            <span class="live-service-filter-title">All Services</span>
                        </label>
                    </div>

                    @foreach ($services as $service)
                        <div class="live-service-filter-item">
                            <input class="live-service-filter-input"
                                type="radio"
                                id="live_service_filter_{{ $service->id }}"
                                name="service_id"
                                value="{{ $service->id }}"
                                @checked($selectedServiceId === $service->id)>
                            <label class="live-service-filter-label" for="live_service_filter_{{ $service->id }}">
                                @if ($service->avatar)
                                    <img src="{{ asset($service->avatar) }}" alt="{{ $service->translate('name', 'en') }}" class="live-service-filter-avatar">
                                @else
                                    <span class="live-service-filter-fallback"><i class="{{ $service->icon ?? 'fa fa-cog' }}"></i></span>
                                @endif
                                <span class="live-service-filter-title">{{ $service->translate('name', 'en') }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex gap-2 mt-3">
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>WhatsApp</th>
                        <th>Services</th>
                        <th>Requested Date</th>
                        <th>Requested Time</th>
                        <th>Vehicle</th>
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
                                        <span class="badge bg-light text-dark border">{{ $booking->service?->translate('name', 'en') ?? 'N/A' }}</span>
                                    @endforelse
                                </div>
                                <div class="d-flex gap-1">
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No open confirmed bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $bookings->links() }}
    </div>

    <script>
        (function () {
            const form = document.querySelector('form[action="{{ route('admin.live-service', ['locale' => app()->getLocale()]) }}"]');
            if (!form) return;

            const radios = form.querySelectorAll('input[name="service_id"]');
            radios.forEach((radio) => {
                radio.addEventListener('change', () => {
                    form.submit();
                });
            });
        })();
    </script>
@endsection
