<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_servicio', 'id_usuario', 'id_campo', 'valor', 'importe'
    ];

    public function campoPersonalizado()
    {
        return $this->belongsTo(CampoPersonalizado::class, 'id_campo');
    }
}
