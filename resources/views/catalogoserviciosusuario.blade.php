<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Catálogo de Servicios municipales de la EELL/Ayuntamiento seleccionado</title>
    <!-- Importar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .service-info {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        .modal-body {
            text-align: left;
        }
        .service-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
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
        <div class="row">
            @foreach($servicios as $servicio)
                <div class="col-md-6 text-center">
                    <div class="service-item">
                        <h4>{{ $servicio->nombre }}</h4>
                        <a href="#" class="service-info" data-toggle="modal" data-target="#serviceModal{{ $servicio->id }}">Información</a> |
                        <a href="{{ route('paso2solicitudusuario', ['id_servicio' => $servicio->id]) }}">Solicitud</a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="serviceModal{{ $servicio->id }}" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel{{ $servicio->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="serviceModalLabel{{ $servicio->id }}">{{ $servicio->nombre }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ $servicio->descripcion }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Importar jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
