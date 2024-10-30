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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            max-width: 30%; /* Asegura que la imagen no desborde el contenedor */
            height: 30%; /* Mantiene la proporción de la imagen */
            margin-bottom: 20px; /* Espacio debajo de la imagen */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, {{ $nombresApellidos }}</h1>
        <p>Te recordamos que tu plan vence el {{ $fechaVencimiento }}.</p>
        <p>Gracias por tu atención.</p>
        <img src="https://img.freepik.com/vector-premium/vector-ilustracion-silueta-logotipo-gimnasio_808775-11548.jpg" alt="Logo de Gimnasio">
      
    </div>
</body>
</html>
