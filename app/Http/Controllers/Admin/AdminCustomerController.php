<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCustomerController extends Controller
{
    public function index(string $locale): View
    {
        return view('admin.customers.index', [
            'customers' => Customer::query()
                ->withCount('serviceBookings')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function show(string $locale, Customer $customer): View
    {
        return view('admin.customers.show', [
            'customer' => $customer,
            'bookings' => $customer->serviceBookings()
                ->with(['service', 'services'])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function edit(string $locale, Customer $customer): View
    {
        return view('admin.customers.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, string $locale, Customer $customer): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'whatsapp_number' => ['required', 'regex:/^\+9715\d{8}$/', 'unique:customers,whatsapp_number,'.$customer->id],
        ]);

        $customer->update($data);

        return redirect()
            ->route('admin.customers.index', ['locale' => $locale])
            ->with('success', 'Customer updated successfully.');
    }
}
