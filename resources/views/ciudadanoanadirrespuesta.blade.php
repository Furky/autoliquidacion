<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aLiquidación - Solicitud de Servicio</title>
    <!-- Importar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- Logo -->
            <img src="{{ asset('documents/' . $logo) }}" alt="Logo aLiquidación" class="img-fluid"><br/><br/>
            <!-- Nombre de la entidad -->
            <h2>{{ $nombre }}</h2>
            <!-- Frase de poder en negrita -->
            <p><strong>Solicitud de servicio powered by aLiquidación</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Texto informativo -->
            <p class="text-left-justified">
                Está solicitando el servicio: <strong>{{ $servicio->nombre }}</strong>
            </p>
            @if($campos->isEmpty())
                <p>Este servicio tiene un coste de {{ $servicio->importe }} €. Haga clic en Solicitar para proseguir con el proceso de solicitud. En caso contrario pulse Cancelar.</p>
            @endif
        </div>
    </div>
    @if(!$campos->isEmpty())
        <form action="{{ route('ciudadanoanadirrespuesta', $servicio->id) }}" method="POST">
            @csrf
            <div class="row">
                @foreach($campos as $campo)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="campo_{{ $campo->id }}">{{ $campo->nombre }}</label>
                            @if ($campo->tipo == 'TEXT')
                                <input type="text" class="form-control" id="campo_{{ $campo->id }}" name="respuestas[{{ $campo->id }}]" required>
                            @elseif ($campo->tipo == 'NUMBER')
                                <input type="number" class="form-control" id="campo_{{ $campo->id }}" name="respuestas[{{ $campo->id }}]}" required>
                            @elseif ($campo->tipo == 'DATE')
                                <input type="date" class="form-control" id="campo_{{ $campo->id }}" name="respuestas[{{ $campo->id }}]}" required>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Solicitar</button>
                <a href="/panelusuario" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    @else
        <div class="text-center mt-4">
            <form action="{{ route('ciudadanoanadirrespuesta', $servicio->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Solicitar</button>
                <a href="/panelusuario" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    @endif
</div>
<!-- Importar jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
