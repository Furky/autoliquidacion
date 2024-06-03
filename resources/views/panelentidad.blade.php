<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de EELL/Ayuntamiento</title>
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
            <div class="col-md-9 text-right"> <!-- Espacio para los datos de la EELL/Ayuntamiento -->
                <!-- Datos de la EELL/Ayuntamiento -->
                <p>Nombre: {{ $entidad->nombre }}</p>
                <p>CIF: {{ $entidad->cif }}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <!-- Espacio para el mensaje de bienvenida y los botones -->
                <!-- Mensaje de bienvenida y explicación de servicios -->
                <p class="text-left">Bienvenido {{ $entidad->nombre }}. Este es tu Panel de Control personal. Desde aquí puedes mantener actualizados tus datos de contacto y notificaciones, así como crear los trámites y servicios proporcionados por tu EELL/Ayuntamientos. Además, dispones de una sección de Historial donde podrás revisar toda la información de los trámites realizados en tu EELL/Ayuntamiento.</p>
                <!-- Botones --><br><br><br><br>
                <div class="center">
                    <button type="button" class="btn btn-primary mr-2" onclick="window.location='{{ route("editarentidad") }}'">Modificar Datos EELL/Ayuntamiento</button>
                    <button type="button" class="btn btn-primary mr-2" onclick="window.location='{{ route("servicionuevoentidad") }}'">Crear nuevo Servicio</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ route("historicoentidad") }}'">Histórico de Servicios y Solicitudes</button>
                </div>
                <!-- Salto de línea -->
                <br><br><br><br><br><br>
                <!-- Botón de salir -->
                <div class="center">
                    <button type="button" class="btn btn-danger" style="width: 25%" onclick="window.location='{{ route("loginentidad") }}'">Salir</button>
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
