<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller; // Importa el controlador

Route::get('/', [Controller::class, 'inicio'])->name('inicio'); // Ruta para mostrar el formulario de inicio de sesión
Route::get('/loginusuario', [Controller::class, 'loginusuario'])->name('loginusuario'); // Ruta para mostrar el formulario de inicio de sesión
Route::get('/loginentidad', [Controller::class, 'loginentidad'])->name('loginentidad'); // Ruta para mostrar el formulario de inicio de sesión
Route::get('/registrousuario', [Controller::class, 'registrousuario'])->name('registrousuario');
Route::get('/registroentidad', [Controller::class, 'registroentidad'])->name('registroentidad');
Route::get('/registrocompletado', [Controller::class, 'registrocompletado'])->name('registrocompletado');
Route::get('/panelusuario', [Controller::class, 'panelusuario'])->name('panelusuario');
Route::get('/panelentidad', [Controller::class, 'panelentidad'])->name('panelentidad');

Route::get('/editarusuario', [Controller::class, 'editarusuario'])->name('editarusuario');
Route::get('/solicitudusuario', [Controller::class, 'solicitudusuario'])->name('solicitudusuario');
Route::get('/historicousuario', [Controller::class, 'historicousuario'])->name('historicousuario');


Route::get('/editarentidad', [Controller::class, 'editarentidad'])->name('editarentidad');
Route::get('/servicionuevoentidad', [Controller::class, 'servicionuevoentidad'])->name('servicionuevoentidad');
Route::get('/historicoentidad', [Controller::class, 'historicoentidad'])->name('historicoentidad');
Route::get('/resumenhistoricoservicio/{nsolicitud}', [Controller::class, 'resumenhistoricoservicio'])->name('resumenhistoricoservicio');

Route::get('/paso2solicitudusuario/{id_servicio}', [Controller::class, 'paso2solicitudusuario'])->name('paso2solicitudusuario');
Route::get('/paso3solicitudusuario/{nsolicitud}', [Controller::class, 'paso3solicitudusuario'])->name('paso3solicitudusuario');
Route::get('/paso4solicitudusuario/{nsolicitud}', [Controller::class, 'paso4solicitudusuario'])->name('paso4solicitudusuario');
Route::get('/paso5solicitudusuario/{nsolicitud}', [Controller::class, 'paso5solicitudusuario'])->name('paso5solicitudusuario');
Route::get('/finalsolicitudpresentadaciudadano/{nsolicitud}/{fecha_abono}', [Controller::class, 'finalsolicitudpresentadausuario'])->name('finalsolicitudpresentadaciudadano');

Route::get('/detallessolicitudesentidad/{id_usuario}', [Controller::class, 'detallessolicitudesentidad'])->name('detallessolicitudesentidad');
Route::get('/datossolicitudentidad/{nsolicitud}', [Controller::class, 'datossolicitudentidad'])->name('datossolicitudentidad');


Route::post('/registerusuario', [Controller::class, 'registerusuario'])->name('registerusuario'); // Ruta para manejar el registro
Route::post('/registerentidad', [Controller::class, 'registerentidad'])->name('registerentidad'); // Ruta para manejar el registro
Route::post('/logueousuario', [Controller::class, 'logueousuario'])->name('logueousuario'); // Ruta para manejar el logueo
Route::post('/logueoentidad', [Controller::class, 'logueoentidad'])->name('logueoentidad'); // Ruta para manejar el logueo

Route::post('/editardatosusuario', [Controller::class, 'editardatosusuario'])->name('editardatosusuario'); // Ruta para manejar la edicion de datos de ciudadano
Route::post('/editardatosentidad', [Controller::class, 'editardatosentidad'])->name('editardatosentidad'); // Ruta para manejar la edicion de datos de EELL/Ayuntamiento

Route::post('/paso1solicitudusuario', [Controller::class, 'paso1solicitudusuario'])->name('paso1solicitudusuario'); // Ruta para manejar la selección de EELL/Ayuntamiento
Route::post('/entidadguardarservicio', [Controller::class, 'entidadguardarservicio'])->name('entidadguardarservicio');
Route::post('/ciudadanoanadirrespuesta/{id}', [Controller::class, 'ciudadanoanadirrespuesta'])->name('ciudadanoanadirrespuesta');
Route::post('/procesarpago/{nsolicitud}', [Controller::class, 'procesarPago'])->name('procesarPago');

Route::delete('/eliminarsolicitud/{nsolicitud}', [Controller::class, 'eliminarSolicitud'])->name('eliminarSolicitud');

