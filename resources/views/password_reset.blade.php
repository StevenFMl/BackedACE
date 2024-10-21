<!-- resources/views/emails/password_reset.blade.php -->

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #d9534f; /* Rojo fuerte */
            color: #ffffff;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            margin-top: 20px;
            background-color: #ffffff; /* Fondo blanco para el contenido */
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Código de Recuperación</h1>
        </div>
        <div class='content'>
            <p>Hola,</p>
            <p>Tu código de recuperación es <strong>{{ $token }}</strong>. Este código expira en 1 hora.</p>
            <p>Si no solicitaste un restablecimiento de contraseña, por favor ignora este mensaje.</p>
        </div>
        <div class='footer'>
            <p>Este es un mensaje automático. No respondas a este correo.</p>
        </div>
    </div>
</body>
</html>