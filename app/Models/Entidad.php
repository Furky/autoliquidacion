<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';
    protected $fillable = [
        'nif',
        'nombre',
        'direccion',
        'cp',
        'poblacion',
        'provincia',
        'telefono',
        'email',
        'clave',
        'decreto',
        'logo',
        'validado'
    ];
}
