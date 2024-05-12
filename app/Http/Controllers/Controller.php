<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudadano;
use App\Models\Entidad;
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

        // Enviar la información del campo logo y el nombre a la vista catalogoserviciosusuario
        return view('catalogoserviciosusuario', [
            'logo' => $entidad->logo,
            'nombre' => $entidad->nombre
        ]);
    }

}
