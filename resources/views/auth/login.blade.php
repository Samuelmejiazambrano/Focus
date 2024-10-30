<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://www.rcnradio.com/_next/image?url=https%3A%2F%2Ffiles.rcnradio.com%2Fpublic%2Fstyles%2F16_9%2Fpublic%2F2023-08%2Fproyecto_nuevo_14_0.jpg%3FVersionId%3DGyHvsfne3nYj_S3hsJRb0aL.kO3Ae01t%26h%3D99a541cf%26itok%3DuehI0ok6&w=1200&q=75') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }
        .card {
            opacity: 0.9; 
            border-radius: 10px;
            margin-top: 50%;
            padding: 10px;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>{{ __('Iniciar Sesión') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Email:') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label">{{ __('Password:') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">{{ __('Recuerdame') }}</label>
                            </div>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="text-muted" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Ingresar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
