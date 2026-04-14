<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(string $locale): View
    {
        $todayDate = now()->toDateString();
        $now = now()->format('Y-m-d H:i:s');

        $todayBookings = ServiceBooking::query()
            ->with(['customer', 'service', 'services'])
            ->whereDate('requested_date', $todayDate)
            ->orderBy('requested_time')
            ->limit(12)
            ->get();

        $openBookings = ServiceBooking::query()
            ->with(['customer', 'service', 'services'])
            ->where('status', 'confirmed')
            ->whereRaw("TIMESTAMP(requested_date, requested_time) <= ?", [$now])
            ->orderBy('requested_date')
            ->orderBy('requested_time')
            ->limit(12)
            ->get();

        $pendingRecentBookings = ServiceBooking::query()
            ->with(['customer', 'service', 'services'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return view('admin.dashboard', [
            'pendingCount' => ServiceBooking::query()->where('status', 'pending')->count(),
            'confirmedCount' => ServiceBooking::query()->where('status', 'confirmed')->count(),
            'todayCount' => ServiceBooking::query()->whereDate('requested_date', $todayDate)->count(),
            'completedCount' => ServiceBooking::query()->where('status', 'completed')->count(),
            'pendingBookingsCount' => ServiceBooking::query()->where('status', 'pending')->count(),
            'todayBookings' => $todayBookings,
            'openBookings' => $openBookings,
            'pendingRecentBookings' => $pendingRecentBookings,
        ]);
    }
}
