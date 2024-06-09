<!DOCTYPE html>
<html>
<head>
    <title>Detalles de Solicitudes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }
        .btn-back {
            margin-top: 20px;
        }
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <img src="{{ asset('images/logo_ppal_grande.png') }}" alt="Logo de la Entidad" class="logo img-fluid">
            <h2>Detalles de Solicitudes</h2>
            <p>Listado de todas las solicitudes completadas por el ciudadano.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nº de Solicitud</th>
                        <th>Nombre del Servicio</th>
                        <th>Descripción del Servicio</th>
                        <th>Importe Final</th>
                        <th>Fecha de Abono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->nsolicitud }}</td>
                            <td>{{ $solicitud->nombre_servicio }}</td>
                            <td>{{ $solicitud->descripcion_servicio }}</td>
                            <td>{{ $solicitud->importe_final }}</td>
                            <td>{{ \Carbon\Carbon::parse($solicitud->updated_at)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('datossolicitudentidad', ['nsolicitud' => $solicitud->nsolicitud]) }}" class="btn btn-primary">Ver Datos</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <a href="{{ url('/panelentidad') }}" class="btn btn-danger btn-back">Salir</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
