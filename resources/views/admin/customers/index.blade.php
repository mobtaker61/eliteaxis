@extends('admin.layout')

@section('title', 'Manage Customers')

@section('content')
    <h1 class="h3 mb-3">Customers</h1>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>WhatsApp</th>
                        <th>Bookings</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->whatsapp_number }}</td>
                            <td>{{ $customer->service_bookings_count }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.customers.show', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}">View</a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.customers.edit', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $customers->links() }}
    </div>
@endsection
