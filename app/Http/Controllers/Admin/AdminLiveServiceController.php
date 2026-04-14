<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminLiveServiceController extends Controller
{
    public function __invoke(string $locale, Request $request): View
    {
        $selectedServiceId = $request->integer('service_id');
        $now = now()->format('Y-m-d H:i:s');

        $query = ServiceBooking::query()
            ->with(['customer', 'services', 'service'])
            ->where('status', 'confirmed')
            ->whereRaw("TIMESTAMP(requested_date, requested_time) <= ?", [$now])
            ->orderBy('requested_date')
            ->orderBy('requested_time');

        if ($selectedServiceId) {
            $query->where(function ($builder) use ($selectedServiceId) {
                $builder->whereHas('services', function ($nested) use ($selectedServiceId) {
                    $nested->where('services.id', $selectedServiceId);
                })->orWhere('service_id', $selectedServiceId);
            });
        }

        return view('admin.live-service', [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'selectedServiceId' => $selectedServiceId,
            'bookings' => $query->paginate(20)->withQueryString(),
        ]);
    }
}
