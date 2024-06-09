<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudadano;
use App\Models\Entidad;
use App\Models\Servicio;
use App\Models\Campospersonalizado;
use App\Models\Respuesta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function inicio()
    {
        return view('inicio');
    }
    public function loginusuario()
    {
        return view('loginusuario');
    }
    public function loginentidad()
    {
        return view('loginentidad');
    }
    public function registrousuario()
    {
        return view('registrousuario');
    }
    public function registroentidad()
    {
        return view('registroentidad');
    }
    public function registrocompletado()
    {
        return view('registrocompletado');
    }
    public function registerusuario(Request $request)
    {
        // Procesar y guardar los archivos de identidad y declaración
        $identidad = $request->file('identidad');
        $declaracion = $request->file('declaracion');

        $currentDateTime = Carbon::now()->format('YmdHis');
        $identidadFileName = 'identidad_' . $currentDateTime . '.' . $identidad->getClientOriginalExtension();
        $declaracionFileName = 'declaracion_' . $currentDateTime . '.' . $declaracion->getClientOriginalExtension();

        $identidad->move(public_path('documents'), $identidadFileName);
        $declaracion->move(public_path('documents'), $declaracionFileName);

        // Crear un nuevo registro de ciudadano en la base de datos
        $ciudadano = new Ciudadano();
        $ciudadano->nif = $request->nif;
        $ciudadano->nombre = $request->nombre;
        $ciudadano->apellido1 = $request->apellido1;
        $ciudadano->apellido2 = $request->apellido2;
        $ciudadano->direccion = $request->direccion;
        $ciudadano->cp = $request->cp;
        $ciudadano->poblacion = $request->poblacion;
        $ciudadano->provincia = $request->provincia;
        $ciudadano->telefono = $request->telefono;
        $ciudadano->email = $request->email;
        $ciudadano->clave = bcrypt($request->clave); // Encriptar la contraseña
        $ciudadano->identidad = $identidadFileName;
        $ciudadano->declaracion = $declaracionFileName;
        $ciudadano->validado = 0;
        $ciudadano->rol = 0;
        $ciudadano->save();

        return redirect('/registrocompletado')->with('success', '¡Ciudadano/a registrado correctamente!');
    }
    public function registerentidad(Request $request)
    {
        // Procesar y guardar los archivos de decreto y declaración
        $decreto = $request->file('decreto');
        $logo = $request->file('logo');

        $currentDateTime = Carbon::now()->format('YmdHis');
        $decretoFileName = 'decreto_' . $currentDateTime . '.' . $decreto->getClientOriginalExtension();
        $logoFileName = 'logo_' . $currentDateTime . '.' . $logo->getClientOriginalExtension();

        $decreto->move(public_path('documents'), $decretoFileName);
        $logo->move(public_path('documents'), $logoFileName);

        // Crear un nuevo registro de entidad en la base de datos
        $entidad = new Entidad();
        $entidad->cif = $request->cif;
        $entidad->nombre = $request->nombre;
        $entidad->direccion = $request->direccion;
        $entidad->cp = $request->cp;
        $entidad->poblacion = $request->poblacion;
        $entidad->provincia = $request->provincia;
        $entidad->telefono = $request->telefono;
        $entidad->email = $request->email;
        $entidad->clave = bcrypt($request->clave); // Encriptar la contraseña
        $entidad->decreto = $decretoFileName;
        $entidad->logo = $logoFileName;
        $entidad->validado = 0;
        $entidad->save();

        return redirect('/registrocompletado')->with('success', '¡Entidad registrada correctamente!');
    }
    public function logueousuario(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nif' => 'required',
            'clave' => 'required',
        ]);

        // Obtener el ciudadano por su NIF
        $ciudadano = Ciudadano::where('nif', trim($request->nif))->first();

        // Verificar si el ciudadano existe y la contraseña es correcta
        if ($ciudadano && Hash::check($request->clave, $ciudadano->clave)) {
            // Verificar si el ciudadano está validado
            if ($ciudadano->validado == 0) {
                return redirect()->route('loginusuario')->with('error', 'Ciudadano no validado');
            } else {
                // Guardar el id del ciudadano en una variable global
                session(['id_ciudadano' => $ciudadano->id]);

                // Redireccionar al panel del usuario
                return redirect()->route('panelusuario');
            }
        } else {
            return redirect()->route('loginusuario')->with('error', 'Ciudadano no registrado o contraseña incorrecta');
        }
    }
    public function logueoentidad(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cif' => 'required',
            'clave' => 'required',
        ]);

        // Obtener la entidad por su CIF
        $entidad = Entidad::where('cif', trim($request->cif))->first();

        // Verificar si la entidad existe y la contraseña es correcta
        if ($entidad && Hash::check($request->clave, $entidad->clave)) {
            // Verificar si la entidad está validada
            if ($entidad->validado == 0) {
                return redirect()->route('loginentidad')->with('error', 'Entidad no validada');
            } else {
                // Guardar el id de la entidad en una variable global
                session(['id_entidad' => $entidad->id]);

                // Redireccionar al panel del usuario
                return redirect()->route('panelentidad');
            }
        } else {
            return redirect()->route('loginentidad')->with('error', 'Ciudadano no registrado o contraseña incorrecta');
        }
    }
    public function panelusuario()
    {
        // Recuperar el ID del usuario de la sesión
        $idCiudadano = session('id_ciudadano');

        // Obtener los datos del ciudadano desde la base de datos
        $ciudadano = Ciudadano::findOrFail($idCiudadano);

        // Pasar los datos del ciudadano a la vista
        return view('panelusuario')->with('usuario', $ciudadano);
    }
    public function panelentidad()
    {
        // Recuperar el ID de la EELL/Ayuntamiento de la sesión
        $idEntidad = session('id_entidad');

        // Obtener los datos del ciudadano desde la base de datos
        $entidad = Entidad::findOrFail($idEntidad);

        // Pasar los datos del ciudadano a la vista
        return view('panelentidad')->with('entidad', $entidad);
    }
    public function editarusuario()
    {
        // Obtener el ID del usuario desde la sesión
        $idCiudadano = session('id_ciudadano');

        // Obtener los datos del usuario desde el modelo Ciudadano
        $ciudadano = Ciudadano::findOrFail($idCiudadano);

        // Retornar la vista editarusuario con los datos del usuario
        return view('editarusuario')->with('usuario', $ciudadano);
    }
    public function editarentidad()
    {
        // Obtener el ID del usuario desde la sesión
        $idEntidad = session('id_entidad');

        // Obtener los datos del usuario desde el modelo Ciudadano
        $entidad = Entidad::findOrFail($idEntidad);

        // Retornar la vista editarusuario con los datos del usuario
        return view('editarentidad')->with('entidad', $entidad);
    }
    public function editardatosusuario(Request $request)
    {
        // Obtener el ID del usuario desde la sesión
        $idCiudadano = session('id_ciudadano');

        // Obtener los datos del usuario desde el modelo Ciudadano
        $ciudadano = Ciudadano::findOrFail($idCiudadano);

        // Actualizar los campos del usuario con los datos del formulario
        $ciudadano->direccion = $request->input('direccion');
        $ciudadano->cp = $request->input('cp');
        $ciudadano->poblacion = $request->input('poblacion');
        $ciudadano->provincia = $request->input('provincia');
        $ciudadano->telefono = $request->input('telefono');

        // Guardar los cambios en la base de datos
        $ciudadano->save();

        // Redireccionar a la vista editarusuario con un mensaje de éxito
        return redirect()->route('panelusuario')->with('success', '¡Datos actualizados correctamente!');
    }
    public function editardatosentidad(Request $request)
    {
        // Obtener el ID de la EELL/Ayuntamiento desde la sesión
        $idEntidad = session('id_entidad');

        // Obtener los datos de la EELL/Ayuntamiento desde el modelo Entidad
        $entidad = Entidad::findOrFail($idEntidad);

        // Actualizar los campos de la EELL/Ayuntamiento con los datos del formulario
        $entidad->direccion = $request->input('direccion');
        $entidad->cp = $request->input('cp');
        $entidad->poblacion = $request->input('poblacion');
        $entidad->provincia = $request->input('provincia');
        $entidad->telefono = $request->input('telefono');

        // Guardar los cambios en la base de datos
        $entidad->save();

        // Redireccionar a la vista editarusuario con un mensaje de éxito
        return redirect()->route('panelentidad')->with('success', '¡Datos actualizados correctamente!');
    }
    public function solicitudusuario()
    {
        $entidades = Entidad::where('validado', 1)->get(); // Obtener solo las entidades validadas

        return view('solicitudusuario', ['entidades' => $entidades]);
    }
    public function paso1solicitudusuario(Request $request)
    {
        // Obtener el ID de la entidad seleccionada del formulario
    $id_entidad_seleccionada = $request->input('entidad');

    // Guardar el ID de la entidad seleccionada en una variable de sesión
    session(['id_entidad_seleccionada' => $id_entidad_seleccionada]);

    // Obtener la información de la entidad seleccionada
    $entidad = Entidad::find($id_entidad_seleccionada);

    // Obtener los servicios publicados para la entidad seleccionada
    $servicios = Servicio::where('id_entidad', $id_entidad_seleccionada)
                         ->where('publicado', 1)
                         ->get();

    // Enviar la información del campo logo, nombre y los servicios a la vista catalogoserviciosusuario
    return view('catalogoserviciosusuario', [
        'logo' => $entidad->logo,
        'nombre' => $entidad->nombre,
        'servicios' => $servicios
    ]);
    }
    public function paso2solicitudusuario($id_servicio)
{
    $servicio = Servicio::findOrFail($id_servicio);
    $campos = Campospersonalizado::where('id_servicios', $id_servicio)->get();
    $entidad = Entidad::find(session('id_entidad_seleccionada'));

    return view('ciudadanoanadirrespuesta', [
        'servicio' => $servicio,
        'campos' => $campos,
        'logo' => $entidad->logo,
        'nombre' => $entidad->nombre,
    ]);
}

public function ciudadanoanadirrespuesta(Request $request, $id)
{
    $servicio = Servicio::findOrFail($id);
    $importeBase = $servicio->importe;
    $importeFinal = $importeBase;

    // Obtener el número de solicitud más alto
    $maxNSolicitud = Respuesta::max('nsolicitud') ?? 0;
    $nsolicitud = $maxNSolicitud + 1;

    if ($servicio->tipo == 1) {
        if (!empty($servicio->formula)) {
            // Evaluar fórmula con los valores introducidos
            $formula = $servicio->formula;

            // Verificar el contenido de las respuestas
            // dd($request->respuestas);

            // Reemplazar los identificadores de campos personalizados en la fórmula
            $respuestas = array_values($request->respuestas); // Asegurarse de que los índices sean 0, 1, 2, ...
            foreach ($respuestas as $index => $valor) {
                $identificadorCampo = 'campo_' . $index;
                // Verificar el identificador y valor antes de reemplazar
                // dd($identificadorCampo, $valor);
                $formula = str_replace($identificadorCampo, $valor, $formula);
            }

            // Evaluar la fórmula utilizando eval
            try {
                $importeFinal = eval('return ' . $formula . ';');
            } catch (\Throwable $e) {
                return redirect()->back()->withErrors('Error en la fórmula: ' . $e->getMessage());
            }

            // Guardar las respuestas
            foreach ($request->respuestas as $campoId => $valor) {
                Respuesta::create([
                    'id_servicio' => $id,
                    'id_usuario' => session('id_ciudadano'),
                    'id_campo' => $campoId,
                    'valor' => $valor,
                    'importe' => null,
                    'nsolicitud' => $nsolicitud
                ]);
            }
        } else {
            // Guardar las respuestas si no hay fórmula
            foreach ($request->respuestas as $campoId => $valor) {
                Respuesta::create([
                    'id_servicio' => $id,
                    'id_usuario' => session('id_ciudadano'),
                    'id_campo' => $campoId,
                    'valor' => $valor,
                    'importe' => null,
                    'nsolicitud' => $nsolicitud
                ]);
            }
        }
    } else {
        // Guardar el importe final en una respuesta separada
        Respuesta::create([
            'id_servicio' => $id,
            'id_usuario' => session('id_ciudadano'),
            'id_campo' => null,
            'valor' => 'Importe final',
            'importe' => $importeFinal,
            'nsolicitud' => $nsolicitud
        ]);
    }

    // Guardar el importe final en una respuesta separada
    Respuesta::create([
        'id_servicio' => $id,
        'id_usuario' => session('id_ciudadano'),
        'id_campo' => null,
        'valor' => 'Importe final',
        'importe' => $importeFinal,
        'nsolicitud' => $nsolicitud
    ]);

    // Guardar el valor de la variable abonado en una respuesta separada
    Respuesta::create([
        'id_servicio' => $id,
        'id_usuario' => session('id_ciudadano'),
        'id_campo' => null,
        'valor' => 'Abonado',
        'importe' => '0',
        'nsolicitud' => $nsolicitud
    ]);

    // Redirigir a la vista de resumen de solicitud
    return redirect()->route('paso3solicitudusuario', ['nsolicitud' => $nsolicitud]);
}
public function paso3solicitudusuario($nsolicitud)
{
    // Obtener las respuestas de la solicitud
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = null;
    $importeFinal = null;
    $abonado = null;
    $camposRespuestas = [];
    $entidad = null;

    foreach ($respuestas as $respuesta) {
        if ($respuesta->valor == 'Importe final') {
            $importeFinal = $respuesta->importe;
        } elseif ($respuesta->valor == 'Abonado') {
            $abonado = $respuesta->importe == '0' ? 'No' : 'Sí';
        } else {
            $campo = Campospersonalizado::find($respuesta->id_campo);
            if ($campo) {
                $camposRespuestas[] = [
                    'label' => $campo->nombre,
                    'valor' => $respuesta->valor
                ];
            }
        }
    }

    if ($respuestas->isNotEmpty()) {
        $servicio = Servicio::findOrFail($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad); // Suponiendo que hay un campo entidad_id en la tabla de servicios
    }

    return view('resumensolicitudciudadano', compact('servicio', 'camposRespuestas', 'importeFinal', 'abonado', 'entidad', 'nsolicitud'));
}
public function paso4solicitudusuario($nsolicitud)
{
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = null;
    $entidad = null;

    if ($respuestas->isNotEmpty()) {
        $servicio = Servicio::findOrFail($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad);
    }

    return view('abonosolicitudciudadano', compact('servicio', 'entidad', 'nsolicitud'));
}

public function procesarPago(Request $request, $nsolicitud)
{
    $numeroTarjetaValida = '1234567890';
    $fechaExpiracionValida = '07/25';
    $ccvValido = '1598';

    if (
        $request->numero_tarjeta === $numeroTarjetaValida &&
        $request->fecha_expiracion === $fechaExpiracionValida &&
        $request->ccv === $ccvValido
    ) {
        $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
        foreach ($respuestas as $respuesta) {
            if ($respuesta->valor == 'Abonado') {
                $respuesta->importe = '1';
                $respuesta->save();
            }
        }
        return redirect()->route('paso5solicitudusuario', ['nsolicitud' => $nsolicitud]);
    } else {
        return back()->with('error', 'Los datos de la tarjeta no son correctos.');
    }
}

public function paso5solicitudusuario($nsolicitud)
{
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = null;
    $importeFinal = null;
    $abonado = null;
    $camposRespuestas = [];
    $entidad = null;

    foreach ($respuestas as $respuesta) {
        if ($respuesta->valor == 'Importe final') {
            $importeFinal = $respuesta->importe;
        } elseif ($respuesta->valor == 'Abonado') {
            $abonado = $respuesta->importe == '0' ? 'No' : 'Sí';
        } else {
            $campo = Campospersonalizado::find($respuesta->id_campo);
            if ($campo) {
                $camposRespuestas[] = [
                    'label' => $campo->nombre,
                    'valor' => $respuesta->valor
                ];
            }
        }
    }

    if ($respuestas->isNotEmpty()) {
        $servicio = Servicio::findOrFail($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad);
    }

    return view('finalsolicitudciudadano', compact('servicio', 'camposRespuestas', 'importeFinal', 'abonado', 'entidad', 'nsolicitud'));
}

// Crear un nuevo servicio por la EELL/Ayuntamiento
public function servicionuevoentidad()
{
    // Recuperar el ID de la EELL/Ayuntamiento de la sesión
    $idEntidad = session('id_entidad');

    // Obtener los datos del ciudadano desde la base de datos
    $entidad = Entidad::findOrFail($idEntidad);

    // Pasar los datos del ciudadano a la vista
    return view('servicionuevoentidad')->with('entidad', $entidad);
}

// Guardar un nuevo servicio por la EELL/Ayuntamiento
public function entidadguardarservicio(Request $request)
{
    // Crear el nuevo servicio
    $servicio = new Servicio();
    $servicio->nombre = $request->nombre;
    $servicio->descripcion = $request->descripcion;
    $servicio->publicado = $request->publicado;
    $servicio->tipo = $request->tipo;
    $servicio->importe = $request->importe;
    $servicio->id_entidad = session('id_entidad');

    // Si el tipo de servicio es 1 (coste variable) y tiene fórmula, guardarla. De lo contrario, dejarla nula.
    if ($request->tipo == 1 && isset($request->formula)) {
        $servicio->formula = $request->formula;
    } else {
        $servicio->formula = null;
    }

    // Guardar el servicio
    $servicio->save();

    // Si hay campos personalizados, guardarlos
    if (isset($request->campos_personalizados) && is_array($request->campos_personalizados)) {
        foreach ($request->campos_personalizados as $campo) {
            $campoPersonalizado = new Campospersonalizado();
            $campoPersonalizado->nombre = $campo['nombre'];
            $campoPersonalizado->tipo = $campo['tipo'];
            $campoPersonalizado->id_servicios = $servicio->id;
            $campoPersonalizado->save();
        }
    }

    return redirect()->route('panelentidad')->with('success', 'Servicio creado correctamente.');
}

public function historicoUsuario()
{
    $idUsuario = session('id_ciudadano');

    // Obtener todas las respuestas del usuario agrupadas por nsolicitud
    $respuestasAgrupadas = Respuesta::where('id_usuario', $idUsuario)
        ->select('nsolicitud', 'id_servicio', 'importe', 'updated_at', 'valor')
        ->get()
        ->groupBy('nsolicitud');

    // Procesar cada grupo de respuestas
    $solicitudes = $respuestasAgrupadas->map(function ($respuestas, $nsolicitud) {
        $abonado = $respuestas->firstWhere('valor', 'Abonado');
        $servicio = Servicio::find($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad);

        return (object) [
            'nsolicitud' => $nsolicitud,
            'nombre_servicio' => $servicio->nombre,
            'descripcion_servicio' => $servicio->descripcion,
            'importeFinal' => $respuestas->firstWhere('valor', 'Importe final')->importe ?? 0,
            'abonado' => $abonado ? $abonado->importe : 0,
            'fecha_abono' => $abonado ? $abonado->updated_at->format('d-m-Y') : null,
            'nombre_entidad' => $entidad->nombre,
            'logo_entidad' => $entidad->logo,
        ];
    });

    return view('historicousuario', compact('solicitudes'));
}

public function eliminarSolicitud($nsolicitud)
{
    Respuesta::where('nsolicitud', $nsolicitud)->delete();
    return redirect()->route('historicousuario')->with('success', 'Solicitud eliminada correctamente.');
}

public function resumenhistoricoservicio($nsolicitud)
{
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = null;
    $importeFinal = null;
    $abonado = null;
    $camposRespuestas = [];
    $entidad = null;
    $fechaAbono = null;

    foreach ($respuestas as $respuesta) {
        if ($respuesta->valor == 'Importe final') {
            $importeFinal = $respuesta->importe;
        } elseif ($respuesta->valor == 'Abonado') {
            $abonado = $respuesta->importe == '0' ? 'No' : 'Sí';
            if ($abonado == 'Sí') {
                $fechaAbono = $respuesta->updated_at->format('d/m/Y');
            }
        } else {
            $campo = Campospersonalizado::find($respuesta->id_campo);
            if ($campo) {
                $camposRespuestas[] = [
                    'label' => $campo->nombre,
                    'valor' => $respuesta->valor
                ];
            }
        }
    }

    if ($respuestas->isNotEmpty()) {
        $servicio = Servicio::findOrFail($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad);
    }

    return view('resumenhistoricoservicio', compact('servicio', 'camposRespuestas', 'importeFinal', 'abonado', 'entidad', 'nsolicitud', 'fechaAbono'));
}


public function finalsolicitudpresentadausuario($nsolicitud, $fecha_abono)
{
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = null;
    $importeFinal = null;
    $abonado = null;
    $camposRespuestas = [];
    $entidad = null;

    foreach ($respuestas as $respuesta) {
        if ($respuesta->valor == 'Importe final') {
            $importeFinal = $respuesta->importe;
        } elseif ($respuesta->valor == 'Abonado') {
            $abonado = $respuesta->importe == '0' ? 'No' : 'Sí';
        } else {
            $campo = Campospersonalizado::find($respuesta->id_campo);
            if ($campo) {
                $camposRespuestas[] = [
                    'label' => $campo->nombre,
                    'valor' => $respuesta->valor
                ];
            }
        }
    }

    if ($respuestas->isNotEmpty()) {
        $servicio = Servicio::findOrFail($respuestas->first()->id_servicio);
        $entidad = Entidad::find($servicio->id_entidad);
    }

    $fechaAbono = $fecha_abono;

    return view('finalsolicitudpresentadaciudadano', compact('servicio', 'camposRespuestas', 'importeFinal', 'abonado', 'entidad', 'nsolicitud', 'fechaAbono'));
}

public function historicoentidad()
{
    $idEntidad = session('id_entidad');

    // Obtener servicios de la entidad
    $servicios = Servicio::where('id_entidad', $idEntidad)->pluck('id')->toArray();

    // Obtener usuarios con respuestas abonadas a esos servicios
    $respuestasAbonadas = Respuesta::whereIn('id_servicio', $servicios)
        ->where('valor', 'Abonado')
        ->where('importe', '>', 0)
        ->get()
        ->groupBy('id_usuario');

    $usuarios = [];
    foreach ($respuestasAbonadas as $idUsuario => $respuestas) {
        $usuario = Ciudadano::find($idUsuario);
        $usuarios[] = $usuario;
    }

    $entidad = Entidad::find($idEntidad);

    return view('historicoentidad', compact('usuarios', 'entidad'));
}

public function detallessolicitudesentidad($id_usuario)
{
    $respuestas = Respuesta::where('id_usuario', $id_usuario)
        ->where('valor', 'Abonado')
        ->get();

    // Agrupar respuestas por número de solicitud
    $solicitudes = $respuestas->groupBy('nsolicitud')->map(function ($items, $nsolicitud) {
        $servicio = Servicio::find($items->first()->id_servicio);
        $importeFinal = $items->where('valor', 'Abonado')->sum('importe'); // Sumar importes abonados
        return (object) [
            'nsolicitud' => $nsolicitud,
            'nombre_servicio' => $servicio->nombre,
            'descripcion_servicio' => $servicio->descripcion,
            'importe_final' => $importeFinal,
            'updated_at' => $items->first()->updated_at,
        ];
    });

    return view('detallessolicitudesentidad', ['solicitudes' => $solicitudes]);
}


public function datossolicitudentidad($nsolicitud)
{
    $respuestas = Respuesta::where('nsolicitud', $nsolicitud)->get();
    $servicio = Servicio::find($respuestas->first()->id_servicio);

    $datos = [
        'nsolicitud' => $nsolicitud,
        'servicio' => $servicio,
        'respuestas' => $respuestas,
    ];

    return view('datossolicitudentidad', $datos);
}


}
