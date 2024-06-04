<!DOCTYPE html>
<html>
<head>
    <title>Crear Servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3"> <!-- Espacio para el logo -->
            <img src="{{ asset('images/logo_ppal.png') }}" alt="Logo" class="img-fluid">
        </div>
        <div class="col-md-9 text-right"> <!-- Espacio para los datos de la EELL/Ayuntamiento -->
            <!-- Datos de la EELL/Ayuntamiento -->
            <p>Nombre: {{ $entidad->nombre }}</p>
            <p>CIF: {{ $entidad->cif }}</p>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h1>Crear Servicio</h1>
    <form method="POST" action="{{ route('entidadguardarservicio') }}">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="publicado" class="form-label">Publicado</label>
            <select class="form-control" id="publicado" name="publicado" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Servicio</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="0">Coste Fijo</option>
                <option value="1">Coste Variable</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="importe" class="form-label">Importe</label>
            <input type="number" step="0.01" class="form-control" id="importe" name="importe" required>
        </div>
        <div class="mb-3" id="formula-container" style="display: none;">
            <label for="formula" class="form-label">Fórmula</label>
            <textarea class="form-control" id="formula" name="formula" rows="3"></textarea>
            <button type="button" id="agregar-campo-formula" class="btn btn-secondary mt-2">Agregar Campos a la Fórmula</button>
        </div>
        <h3>Campos Personalizados</h3>
        <div id="campos-container"></div>
        <button type="button" id="agregar-campo" class="btn btn-secondary mt-3">Agregar Campo</button>
        <button type="submit" class="btn btn-primary mt-3">Crear Servicio</button>
    </form>
</div>
<script>
document.getElementById('tipo').addEventListener('change', function () {
    var formulaContainer = document.getElementById('formula-container');
    if (this.value == '1') {
        formulaContainer.style.display = 'block';
    } else {
        formulaContainer.style.display = 'none';
    }
});

document.getElementById('agregar-campo').addEventListener('click', function () {
    var container = document.getElementById('campos-container');
    var index = container.children.length;
    var campoHtml = `
        <div class="mb-3">
            <label for="campos_personalizados[${index}][nombre]" class="form-label">Nombre del Campo</label>
            <input type="text" class="form-control" id="campos_personalizados[${index}][nombre]" name="campos_personalizados[${index}][nombre]" required>
            <label for="campos_personalizados[${index}][tipo]" class="form-label">Tipo</label>
            <select class="form-control" id="campos_personalizados[${index}][tipo]" name="campos_personalizados[${index}][tipo]" required>
                <option value="TEXT">Texto</option>
                <option value="NUMBER">Número</option>
                <option value="DATE">Fecha</option>
            </select>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', campoHtml);
});

document.getElementById('agregar-campo-formula').addEventListener('click', function () {
    var campos = document.querySelectorAll('#campos-container .form-control[name*="[nombre]"]');
    var formulaTextarea = document.getElementById('formula');
    campos.forEach(function (campo) {
        var nombreCampo = campo.value;
        if (!formulaTextarea.value.includes('$' + nombreCampo)) {
            formulaTextarea.value += ' $' + nombreCampo;
        }
    });
    if (!formulaTextarea.value.includes('Importe Base *')) {
        formulaTextarea.value = 'Importe Base *' + formulaTextarea.value;
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

