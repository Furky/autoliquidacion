<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Servicios y Solicitudes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .logo {
            display: block;
            margin: 0 auto;
            width: 50%;
            margin-bottom: 20px;
        }
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
            <h2>Histórico de Servicios y Solicitudes</h2>
            <p>Listado de todas las solicitudes completadas por los ciudadanos en esta entidad.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NIF</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Documentos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nif }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellido1 }}</td>
                            <td>{{ $usuario->apellido2 }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <a href="{{ asset('documents/' . $usuario->identidad) }}" class="btn btn-success" target="_blank">NIF</a>
                                <a href="{{ asset('documents/' . $usuario->declaracion) }}" class="btn btn-warning" target="_blank">Decl. Resp.</a>
                            </td>
                            <td>
                                <a href="{{ route('detallessolicitudesentidad', ['id_usuario' => $usuario->id]) }}" class="btn btn-primary">Ver Solicitudes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <a href="{{ url('/panelentidad') }}" class="btn btn-danger btn-back">Volver</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
