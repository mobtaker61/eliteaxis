<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center">Elite Axis Admin Login</h1>

                        @if ($errors->has('login'))
                            <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.login.post', ['locale' => app()->getLocale()]) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Captcha Code</label>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-dark fs-6 px-3 py-2">{{ $captchaCode }}</span>
                                    <button type="submit"
                                        form="captcha-refresh-form"
                                        class="btn btn-outline-secondary btn-sm">
                                        Refresh
                                    </button>
                                </div>
                                <input type="text" class="form-control" name="captcha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <form id="captcha-refresh-form" method="POST" action="{{ route('admin.login.captcha.refresh', ['locale' => app()->getLocale()]) }}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
