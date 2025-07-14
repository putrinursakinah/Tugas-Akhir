<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SMKS Alawiyah - Login</title>
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background: #3862d6 !important;
        }
        .login-card {
            max-width: 350px;
            margin: 80px auto;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
            background: #f8f9fc;
        }
        .login-card .logo {
            width: 70px;
            margin: 30px auto 10px auto;
            display: block;
        }
        .login-card .title {
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: #222;
        }
        .login-card .form-control {
            border-radius: 20px;
            background: #e9ecef;
        }
        .login-card .btn {
            border-radius: 20px;
        }
        .login-card label {
            font-size: 0.95rem;
            margin-bottom: 2px;
            color: #222;
        }
        .login-card .custom-checkbox label {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-card p-4">
        <img src="{{ asset('backend/img/smkalawiyah.png') }}" class="logo" alt="Logo">
        <div class="title mb-3">SMKS ALAWIYAH</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Email *</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Username" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Password *</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group form-check mb-3 pl-1">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" style="font-weight:400;">Remember me</label>
            </div>
            <button type="submit" class="btn btn-secondary btn-block mb-2" style="background:#6c757d;">Log in</button>
        </form>
    </div>
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
</body>
</html>