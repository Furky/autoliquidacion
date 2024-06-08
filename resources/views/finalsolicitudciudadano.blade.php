<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Presentada Correctamente</title>
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
            <p><strong>Resumen de los datos del servicio abonado</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Texto informativo -->
            <p class="text-left-justified">
                Nº de Solicitud: <strong>{{ $nsolicitud }}</strong></br>
                Fecha: <strong>{{ now()->format('d-m-Y') }}</strong></br>
            </p>
            <p class="text-left-justified">
                Ha solicitado y abonado correctamente el servicio: <strong>{{ $servicio->nombre }}</strong>
            </p>
            <p class="text-left-justified">
                Descripción: <strong>{{ $servicio->descripcion }}</strong>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($camposRespuestas as $campoRespuesta)
                        <tr>
                            <td>{{ $campoRespuesta['label'] }}</td>
                            <td>{{ $campoRespuesta['valor'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Importe Final (€)</td>
                        <td>{{ $importeFinal }}</td>
                    </tr>
                    <tr>
                        <td>Abonado</td>
                        <td>{{ $abonado }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('panelusuario') }}" class="btn btn-success">Terminar</a>
            <button onclick="window.print()" class="btn btn-warning">Imprimir Documentación</button>
        </div>
    </div>
</div>
<!-- Importar jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
