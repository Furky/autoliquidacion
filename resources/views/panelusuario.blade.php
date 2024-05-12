<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Ciudadano</title>
    <!-- Enlaces a Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"> <!-- Espacio para el logo -->
                <img src="{{ asset('images/logo_ppal.png') }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-9 text-right"> <!-- Espacio para los datos del usuario -->
                <!-- Datos del usuario -->
                <p>Nombre: {{ $usuario->nombre }} {{ $usuario->apellido1 }} {{ $usuario->apellido2 }}</p>
                <p>NIF: {{ $usuario->nif }}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <!-- Espacio para el mensaje de bienvenida y los botones -->
                <!-- Mensaje de bienvenida y explicación de servicios -->
                <p class="text-left">Bienvenido/a {{ $usuario->nombre }}. Este es tu Panel de Control personal. Desde aquí puedes mantener actualizados tus datos de contacto y notificaciones, así como acceder a los trámites y servicios proporcionados por las EELL/Ayuntamientos. Además, dispones de una sección de Historial donde podrás revisar toda la información de tus trámites realizados.</p>
                <!-- Botones --><br><br><br><br>
                <div class="center">
                    <button type="button" class="btn btn-primary mr-2" onclick="window.location='{{ route("editarusuario") }}'">Modificar Datos Ciudadano</button>
                    <button type="button" class="btn btn-primary mr-2" onclick="window.location='{{ route("solicitudusuario") }}'">Nueva Solicitud</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ route("historicousuario") }}'">Histórico de Solicitudes</button>
                </div>
                <!-- Salto de línea -->
                <br><br><br><br><br><br>
                <!-- Botón de salir -->
                <div class="center">
                    <button type="button" class="btn btn-danger" style="width: 25%" onclick="window.location='{{ route("loginusuario") }}'">Salir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
