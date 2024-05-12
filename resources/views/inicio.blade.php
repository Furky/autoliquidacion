<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Tu poder para simplificar trámites</title>
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
        #opcion {
            width: 35%;
            margin: 0 auto; /* Para centrar horizontalmente */
        }
        /* Estilo para el botón */
        #boton {
            display: block;
            margin: 0 auto; /* Para centrar horizontalmente */
        }
        #boton:hover {
            background-color: red;
            color: white;
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
                <h2>Bienvenido a aLiquidación</h2>
                <!-- Frase de poder en negrita -->
                <p><strong>Tu poder para simplificar trámites</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Texto informativo -->
                <p class="text-left-justified">
                    aLiquidación tiene como finalidad ayudar al ciudadano a solicitar y abonar los servicios municipales de su localidad que les sean necesarios y descargar los justificantes en pocos minutos, agilizando así sus trámites y disminuyendo los tiempos de espera y las colas. Para la administración pública, es una gran herramienta porque libera a los trabajadores municipales de gestiones que ya hace la plataforma por ellos y evita masificación de trabajo.
                </p><br/><br/>
                <!-- Texto "Soy un/a:" -->
                <p class="text-center">Soy un/a:</p>
                <!-- Select con opciones -->
                <select name="opcion" id="opcion" class="form-control">
                    <option value="ciudadano">Ciudadano/a</option>
                    <option value="entidad">EELL/Ayuntamiento</option>
                </select>
                <!-- Botón -->
                <button id="boton" class="btn btn-primary mt-3">Entrar</button>
            </div>
        </div>
    </div>
    <!-- Importar jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script para redirigir según opción seleccionada -->
    <script>
        $(document).ready(function(){
            $('#boton').click(function(){
                var opcion = $('#opcion').val();
                if(opcion == 'ciudadano'){
                    window.location.href = '/loginusuario';
                } else if(opcion == 'entidad'){
                    window.location.href = '/loginentidad';
                }
            });
        });
    </script>
</body>
</html>
