<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos del Ciudadano</title>
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
            <div class="col-md-9 text-right"> <!-- Espacio para los datos del usuario -->
                <!-- Datos del usuario -->
                <p>Nombre: {{ $usuario->nombre }} {{ $usuario->apellido1 }} {{ $usuario->apellido2 }}</p>
                <p>NIF: {{ $usuario->nif }}</p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12"> <!-- Espacio para el mensaje de bienvenida y formulario -->
                <!-- Texto de bienvenida -->
                <p class="text-left">En esta pantalla puedes editar tus datos de contacto y notificación. Por favor, mantén siempre estos datos actualizados para evitar problemas o dificultades en las notificaciones.</p>
                <!-- Formulario para editar datos -->
                <form action="{{ route('editardatosusuario') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $usuario->direccion }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cp">Código Postal</label>
                            <input type="text" class="form-control" id="cp" name="cp" value="{{ $usuario->cp }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="poblacion">Población</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion" value="{{ $usuario->poblacion }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" value="{{ $usuario->provincia }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $usuario->telefono }}" required>
                        </div>
                    </div>
                    <!-- Botones -->
                    <div class="center mt-4">
                        <button type="submit" class="btn btn-primary mr-2">Editar Datos</button>
                        <button type="button" class="btn btn-secondary mr-2" onclick="limpiarDatos()">Limpiar Datos</button>
                    </div>
                </form>
                <!-- Botón Volver -->
                <div class="center mt-4">
                    <button type="button" class="btn btn-danger" style="width: 20%" onclick="window.location='{{ route("panelusuario") }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script para limpiar los datos del formulario -->
    <script>
        function limpiarDatos() {
            document.getElementById("direccion").value = "";
            document.getElementById("cp").value = "";
            document.getElementById("poblacion").value = "";
            document.getElementById("provincia").value = "";
            document.getElementById("telefono").value = "";
        }
    </script>
</body>
</html>

