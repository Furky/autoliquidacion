<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela de Pago</title>
    <!-- Importar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- Logo -->
            @if ($entidad && $entidad->logo)
                <img src="{{ asset('documents/' . $entidad->logo) }}" alt="Logo" class="img-fluid"><br/><br/>
            @endif
            <!-- Nombre de la entidad -->
            @if ($entidad && $entidad->nombre)
                <h2>{{ $entidad->nombre }}</h2>
            @endif
            <!-- Frase de poder en negrita -->
            <p><strong>Proceda al pago del servicio solicitado</strong></p>
            <p>Datos para la tarjeta válida de prueba:</p>
            <p>Número de tarjeta: 1234567890</p>
            <p>Fecha de expiración: 07/25</p>
            <p>CCV: 1598</p>
            <p><strong>Nota:</strong> También puede hacer clic en "Dejar en Borrador" donde la solicitud se quedará en estado de borrador y podrá abonarla más tarde, pero hasta que no se haga el abono no tendrá activo el servicio.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('procesarPago', ['nsolicitud' => $nsolicitud]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="numero_tarjeta">Número de Tarjeta</label>
                    <input type="text" name="numero_tarjeta" id="numero_tarjeta" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_expiracion">Fecha de Expiración (MM/AAAA)</label>
                    <input type="text" name="fecha_expiracion" id="fecha_expiracion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ccv">CCV</label>
                    <input type="text" name="ccv" id="ccv" class="form-control" required>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Abonar</button>
                    <a href="{{ route('panelusuario') }}" class="btn btn-danger">Dejar en Borrador</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Importar jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
