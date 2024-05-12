<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'nif',
        'nombre',
        'apellido1',
        'apellido2',
        'direccion',
        'cp',
        'poblacion',
        'provincia',
        'telefono',
        'email',
        'clave',
        'identidad',
        'declaracion',
        'validado',
        'rol'
    ];
}
