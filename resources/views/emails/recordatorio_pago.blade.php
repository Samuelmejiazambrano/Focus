<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        img {
            max-width: 30%;
            height: 30%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hola, {{ $nombresApellidos }}</h1>
        <p>{{ $mensaje }}</p> <!-- Aquí se muestra el mensaje generado -->
        <p>Gracias por tu atención.</p>
        <img align="center" border="0"
        src="{{ $message->embed(public_path() . '/img/focus.png') }}"
        alt="" title=""
        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 220.5px;"
        width="220.5" />
    </div>
</body>

</html>
