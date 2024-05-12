<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Catálogo de Servicios municipales de la EELL/Ayuntamiento seleccionado</title>
    <!-- Importar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Logo -->
                <img src="{{ asset('documents/' . $logo) }}" alt="Logo aLiquidación" class="img-fluid"><br/><br/>
                <!-- Nombre de la entidad -->
                <h2>{{ $nombre }}</h2>
                <!-- Frase de poder en negrita -->
                <p><strong>Catálogo de servicios disponibles powered by aLiquidación</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Texto informativo -->
                <p class="text-left-justified">
                    Bienvenido al catálogo de servicios municipales de {{ $nombre }}.
                    Seleccione el servicio que necesite para iniciar su proceso de solicitud.
                </p>
            </div>
        </div>
    </div>
    <!-- Importar jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
