<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Registro Completado</title>
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
                <h2>Registro Completado</h2>
                <!-- Frase de poder en negrita -->
                <p><strong>Su solicitud de registro ha sido satisfactorio</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Texto informativo -->
                <p class="text-left-justified">Su registro ha sido completado exitosamente. Su cuenta está pendiente de revisión y validación por nuestro equipo. Este proceso puede tardar entre 24 y 48 horas.</p>
                <p class="text-left-justified">Una vez que su cuenta haya sido validada, recibirá un correo electrónico de confirmación. Después de esto, podrá ingresar en nuestra plataforma utilizando las credenciales proporcionadas durante el registro.</p>
                <p class="text-left-justified">
                    Gracias por su paciencia y bienvenido a nuestra plataforma.</p><br/><br/>
                <!-- Botón -->
                <button id="boton" class="btn btn-primary mt-3" onclick="window.location.href = '/'">Volver</button>
            </div>
        </div>
    </div>
    <!-- Importar jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
