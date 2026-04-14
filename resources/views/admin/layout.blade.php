<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003169;">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}">Elite Axis Admin</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('admin.services.index', ['locale' => app()->getLocale()]) }}">Services</a>
                <a class="nav-link" href="{{ route('admin.customers.index', ['locale' => app()->getLocale()]) }}">Customers</a>
                <a class="nav-link" href="{{ route('admin.bookings.index', ['locale' => app()->getLocale()]) }}">Bookings</a>
                <a class="nav-link" href="{{ route('admin.live-service', ['locale' => app()->getLocale()]) }}">Live Service</a>
                <a class="nav-link" href="{{ route('home', ['locale' => app()->getLocale()]) }}" target="_blank">Open Website</a>
                <form method="POST" action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link p-0 ms-3 text-decoration-none">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
