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
        <li>Decreto firmado digitalmente por el Sr/a. Alcalde/sa o en su defecto Secretario/a solicitando el alta en la plataforma.</li>
        <li>Logo oficial de la EELL/Ayuntamiento en formatto JPG o PNG.</li>
    </ul>

    <form method="POST" action="{{ route('registerentidad') }}" enctype="multipart/form-data">
        @csrf
        <h2>Datos de Ciudadano</h2>
        <div class="form-group">
            <label for="cif">CIF:</label>
            <input type="text" id="cif" name="cif" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
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
            <label for="decreto">Subir Decreto firmado:</label>
            <input type="file" id="decreto" name="decreto" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label for="logo">Subir Logo en JPG o PNG:</label>
            <input type="file" id="logo" name="logo" class="form-control-file" required>
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
