@extends('admin.layout')

@section('title', 'Create Service')

@section('content')
    <h1 class="h3 mb-3">Create Service</h1>

    @include('admin.services.partials.form', [
        'action' => route('admin.services.store', ['locale' => app()->getLocale()]),
        'method' => 'POST',
        'service' => null,
    ])
@endsection
