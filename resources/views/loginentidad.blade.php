<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="css/app.css" rel="stylesheet"> <!-- Incluyendo Bootstrap CSS -->
    <style>
        /* Estilos personalizados */
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .login-container .form-group {
            margin-bottom: 20px;
        }
        .login-container .form-group label {
            font-weight: bold;
        }
        .login-container .form-group input[type="text"],
        .login-container .form-group input[type="password"],
        .login-container .form-group select { /* Aplicar estilos a los select también */
            width: calc(100% - 20px); /* Restar 20px para dejar espacio en el lado derecho */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff; /* Azul */
            color: #fff; /* Blanco */
            font-weight: bold;
            cursor: pointer;
        }
        .login-container button[type="submit"]:hover {
            background-color: #dc3545; /* Rojo */
        }
        .login-container a {
            color: #007bff; /* Azul */
            text-decoration: none;
        }
        .login-container a:hover {
            color: #dc3545; /* Rojo */
        }
        /* Estilos para el logo */
        .logo-container {
            text-align: center;
            margin-top: 20px;
        }
        .logo-container img {
            width: 200px; /* Ajusta el tamaño según sea necesario */
            height: auto;
            cursor: pointer; /* Indicar que la imagen es clicable */
        }
        /* Estilos para el título de bienvenida */
        .welcome-title {
            text-align: center;
            color: #333;
            font-size: 24px;
        }
        /* Estilos para el mensaje flotante */
        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }
        .message-container.show {
            display: block;
        }
        .message-container.alert-success {
            border-color: #007bff; /* Cambia el color del borde a azul */
            color: #007bff; /* Cambia el color del texto a azul */
            background-color: #cce5ff; /* Cambia el color de fondo a un tono de azul claro */
        }
        .message-container.alert-danger {
            border-color: #dc3545;
            color: #721c24;
            background-color: #f8d7da;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="welcome-title">Bienvenido/a a aLiquidación</div><br/> <!-- Título centrado -->
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('logueoentidad') }}">
        @csrf
        <div class="form-group">
            <label for="cif">Usuario (CIF):</label>
            <input type="text" id="cif" name="cif" required>
        </div>
        <div class="form-group">
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Recordar credenciales</label>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="{{ route('registroentidad') }}">Regístrate</a></p>
</div>

<!-- Contenedor del logo -->
<div class="logo-container">
    <img src="images/logo_ppal.png" alt="Logo" onclick="window.location.href='/'">
</div>

<!-- Contenedor del mensaje flotante -->
<div id="message-container" class="message-container"></div>

<!-- Script para mostrar mensaje por defecto -->
<script>
    // Mostrar mensaje por defecto al cargar la página
    showMessage('¡Bienvenido a aLiquidación!', 'success');

    // Función para mostrar el mensaje flotante
    function showMessage(message, type) {
        var messageContainer = document.getElementById('message-container');
        messageContainer.textContent = message;
        messageContainer.style.display = 'block';
        messageContainer.className = 'message-container alert-' + type + ' show';
        setTimeout(function() {
            hideMessage();
        }, 5000); // Ocultar el mensaje después de 5 segundos
    }

    // Función para ocultar el mensaje flotante
    function hideMessage() {
        var messageContainer = document.getElementById('message-container');
        messageContainer.style.display = 'none';
    }
</script>

</body>
</html>
