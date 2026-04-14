@extends('admin.layout')

@section('title', 'Manage Services')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Services</h1>
        <a class="btn btn-primary" href="{{ route('admin.services.create', ['locale' => app()->getLocale()]) }}">Create Service</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name (EN)</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>
                                @if ($service->avatar)
                                    <img src="{{ asset($service->avatar) }}" alt="avatar" class="rounded" style="width: 44px; height: 44px; object-fit: cover;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $service->translate('name', 'en') }}</td>
                            <td>{{ $service->sort_order }}</td>
                            <td>
                                <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.services.edit', ['locale' => app()->getLocale(), 'service' => $service->id]) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('admin.services.destroy', ['locale' => app()->getLocale(), 'service' => $service->id]) }}" onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $services->links() }}
    </div>
@endsection
