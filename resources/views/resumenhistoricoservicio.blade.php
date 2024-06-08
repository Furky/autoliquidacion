<!DOCTYPE html>
<html>
<head>
    <title>Resumen de Solicitud Histórica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <center><img src="{{ asset('documents/' . $entidad->logo) }}" alt="Logo de la Entidad" class="img-fluid"></center><br/><br/>
                    <h2>{{ $entidad->nombre }}</h2>
                </div>
                <div class="card-body">
                    <h3>Resumen de Solicitud Histórica</h3>
                    <p><strong>Nº de Solicitud:</strong> {{ $nsolicitud }}</p>
                    <p><strong>Estás solicitando el servicio:</strong> {{ $servicio->nombre }}</p>
                    <p><strong>Descripción del servicio:</strong> {{ $servicio->descripcion }}</p>
                    <p><strong>Importe Final (€):</strong> {{ $importeFinal }}</p>
                    <p><strong>Abonado:</strong> {{ $abonado }}</p>

                    <h4>Campos Personalizados:</h4>
                    <ul>
                        @foreach($camposRespuestas as $campo)
                            <li><strong>{{ $campo['label'] }}:</strong> {{ $campo['valor'] }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('paso4solicitudusuario', ['nsolicitud' => $nsolicitud]) }}" class="btn btn-primary">Abonar</a>
                    <a href="{{ route('panelusuario') }}" class="btn btn-danger">Dejar en Borrador</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
