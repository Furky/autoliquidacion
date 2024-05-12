<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro en aLiquidación</title>
    <link href="css/app.css" rel="stylesheet"> <!-- Incluyendo Bootstrap CSS -->
    <style>
        /* Estilos personalizados */
        .registration-container {
            max-width: 900px; /* Ajustando el ancho de la hoja */
            margin: 0 auto;
            padding: 20px;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            width: 500px; /* Ajustando el ancho del logo */
            height: auto;
        }
        .form-group {
            width: 45%;
            display: inline-block;
            margin-right: 5%;
            margin-bottom: 10px;
        }
        .form-group:nth-child(2n) {
            margin-right: 0;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="password"] {
            width: 100%;
        }
        /* Estilos para el botón de limpiar formulario */
        .btn-clear {
            margin-right: 10px;
        }
        /* Estilos para el mensaje flotante */
        .floating-message {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>

<div class="container registration-container">
    <div class="logo-container">
        <img src="{{ asset('images/logo_ppal_grande.png') }}" alt="Logo">
    </div>

    <h1>Regístrate en aLiquidación y simplifica tus trámites</h1>
    <p>Bienvenido/a a aLiquidación. Regístrate para empezar a gestionar tus trámites de forma más eficiente.</p>

    <h2>Requisitos:</h2>
    <ul>
        <li>Copia digitalizada del DNI por ambas caras</li>
        <li>Declaración Jurada firmada digitalmente con certificado digital. <a href="{{ asset('documents/modelo_declaracion_jurada.pdf') }}" download class="btn btn-primary">Descargar modelo de declaración jurada</a></li>
    </ul>

    <form method="POST" action="{{ route('registerusuario') }}" enctype="multipart/form-data">
        @csrf
        <h2>Datos de Ciudadano</h2>
        <div class="form-group">
            <label for="nif">NIF:</label>
            <input type="text" id="nif" name="nif" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido1">Apellido 1:</label>
            <input type="text" id="apellido1" name="apellido1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido2">Apellido 2:</label>
            <input type="text" id="apellido2" name="apellido2" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cp">Código Postal:</label>
            <input type="text" id="cp" name="cp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="poblacion">Población:</label>
            <input type="text" id="poblacion" name="poblacion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="identidad">Subir copia digitalizada NIF:</label>
            <input type="file" id="identidad" name="identidad" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label for="declaracion">Subir declaración jurada:</label>
            <input type="file" id="declaracion" name="declaracion" class="form-control-file" required>
        </div>

        <!-- Botones -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Registrarme</button>
            <button type="button" class="btn btn-secondary btn-clear" onclick="clearForm()">Limpiar Datos</button>
        </div>
    </form>

    <!-- Mensaje flotante -->
    <div id="floating-message" class="floating-message"></div>
</div>

<script>
    // Función para limpiar el formulario
    function clearForm() {
        document.querySelectorAll('input[type=text], input[type=email], input[type=tel], input[type=password], input[type=file]').forEach(function(input) {
            input.value = '';
        });
    }
</script>

</body>
</html>
