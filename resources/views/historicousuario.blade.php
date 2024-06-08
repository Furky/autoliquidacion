<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Solicitudes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <img src="{{ asset('images/logo_ppal_grande.png') }}" alt="Logo" class="img-fluid mb-4">
            <h2>Histórico de Solicitudes</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nº Solicitud</th>
                        <th>Estado Solicitud</th>
                        <th>Entidad</th>
                        <th>Nombre Servicio</th>
                        <th>Información Servicio</th>
                        <th>Importe Final (€)</th>
                        <th>Fecha Solicitud</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->nsolicitud }}</td>
                            <td>{{ $solicitud->abonado == 1 ? 'PRESENTADO' : 'BORRADOR' }}</td>
                            <td>{{ $solicitud->nombre_entidad }}</td>
                            <td>{{ $solicitud->nombre_servicio }}</td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $solicitud->nsolicitud }}">Información</button>
                                <div class="modal fade" id="modal{{ $solicitud->nsolicitud }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $solicitud->nsolicitud }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $solicitud->nsolicitud }}">{{ $solicitud->nombre_servicio }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $solicitud->descripcion_servicio }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $solicitud->importeFinal }}</td>
                            <td>{{ $solicitud->fecha_abono }}</td>
                            <td>
                                @if($solicitud->abonado  == 0)
                                    <a href="{{ route('resumenhistoricoservicio', ['nsolicitud' => $solicitud->nsolicitud]) }}" class="btn btn-primary">Abonar</a>
                                    <form action="{{ route('eliminarSolicitud', ['nsolicitud' => $solicitud->nsolicitud]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                @else
                                <a href="{{ route('finalsolicitudpresentadaciudadano', ['nsolicitud' => $solicitud->nsolicitud, 'fecha_abono' => $solicitud->fecha_abono]) }}" class="btn btn-success">Justificante</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('panelusuario') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
