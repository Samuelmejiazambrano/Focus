<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .image-section {
            flex: 1;
            background-image: url('../img/focus.png');
            background-size: auto 80%;
            background-position: 20%;
            background-position: center;
            background-repeat: no-repeat;
            background-color: black;
        }

        .login-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 20px;
            background: linear-gradient(to left, #ffffff, #000000); 

        }

        .card {
            opacity: 0.9;
            border-radius: 10px;
            width: 100%;
            max-width: 700px;
            padding: 20px;
        }

        .card-header {
            text-align: center;
        }
        .card-header img {
           width: 150px;
           height: 150px;
        }
    </style>
</head>

<body>
    <div class="image-section"></div>

    <div class="login-section">
        <div class="card shadow">
            <div class="card-header">
                <h2>{{ __('Iniciar Sesión') }}</h2>

            {{-- <img src="../img/focus.png" alt=""> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Email:') }}</label>
                        <input id="email" type="email" class="form-control" name="email"
                            value="{{ old('email') }}" required autofocus>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
