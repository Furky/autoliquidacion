<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'publicado', 'tipo', 'importe', 'formula', 'id_entidad'
    ];

    public function camposPersonalizados()
    {
        return $this->hasMany(CampoPersonalizado::class, 'id_servicios');
    }
}
