<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Solicitud</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <img src="{{ asset('images/logo_ppal_grande.png') }}" alt="Logo de la Entidad" class="logo img-fluid">
            <h2>Detalles de la Solicitud</h2>
            <p>Información completa de la solicitud.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3>Servicio: {{ $servicio->nombre }}</h3>
            <p>{{ $servicio->descripcion }}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($respuestas as $respuesta)
                        <tr>
                            <td>
                                @if($respuesta->valor == 'Importe final')
                                    Importe Final (€)
                                @elseif($respuesta->valor == 'Abonado')
                                    Abonado
                                @else
                                    {{ $camposPersonalizados[$respuesta->id_campo]->nombre ?? 'Campo no encontrado' }}
                                @endif
                            </td>
                            <td>
                                @if($respuesta->valor == 'Abonado')
                                    {{ $respuesta->importe == 1 ? 'Sí' : 'No' }}
                                @elseif($respuesta->valor == 'Importe final')
                                    {{ $respuesta->importe }}
                                @else
                                    {{ $respuesta->valor }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <a href="{{ route('detallessolicitudesentidad', ['id_usuario' => $respuestas->first()->id_usuario]) }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
