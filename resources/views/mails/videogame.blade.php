<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a La Muebleria Leon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: white;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            color: #aaa;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenido a la muebleria Leon</h1>
        </div>
        <div class="content">
            <h2>Hola {{$nombre}},</h2>
            <p>Estamos encantados de darte la bienvenida a nuestro sistema web. Gracias por registrarte en nuestra plataforma. Aqui podras realizar la venta de la mercancia a nuestros clientes.</p>
            <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>
            <a href="#" class="button">Explorar ahora</a>
        </div>
        <div class="footer">
            <p>&copy; 2024 Muebleria Leon. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>