<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Nueva Solicitud</title>
    <!-- Importar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <style>
        /* Estilos personalizados aquí */
        /* Centrar contenido verticalmente */
        .vertical-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        /* Alineación del texto a la izquierda y justificado */
        .text-left-justified {
            text-align: justify;
        }
        /* Estilo para el select */
        #entidad {
            width: 35%;
            margin: 0 auto; /* Para centrar horizontalmente */
        }
        /* Estilo para los botones */
        .boton-container {
            text-align: center;
            margin-top: 20px;
        }
        #botonSeleccionar:hover {
            background-color: blue;
            color: white;
        }
        #botonCancelar:hover {
            background-color: red;
            color: white;
        }
        /* Estilo para centrar el texto */
        .titulo {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Logo -->
                <img src="{{ asset('images/logo_ppal_grande.png') }}" alt="Logo aLiquidación" class="img-fluid"><br/><br/>
                <!-- Frase de bienvenida -->
                <h2>Nueva Solicitud</h2>
                <!-- Frase de poder en negrita -->
                <p>Seleccione la EELL/Ayuntamiento en el que requiera realizar la solicitud. Nuestra plataforma aLiquidación le guiará paso a paso con los pasos e información necesaria para realizar su solicitud en tiempo récord.</p>
                <p>Sin esperas ni colas. Bienvenido al futuro de la administración pública.</p><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 titulo">
                <!-- Texto de título centrado -->
                <h3>Seleccione la EELL/Ayuntamiento:</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Formulario -->
                <form action="{{ route('paso1solicitudusuario') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" id="entidad" name="entidad">
                            @foreach($entidades as $entidad)
                                <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div><br><br>
                    <!-- Botones -->
                    <div class="boton-container">
                        <button id="botonSeleccionar" type="submit" class="btn btn-primary">Seleccionar</button>
                        <button id="botonCancelar" type="button" class="btn btn-danger" onclick="window.location.href = '/panelusuario'">Cancelar</button>
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
