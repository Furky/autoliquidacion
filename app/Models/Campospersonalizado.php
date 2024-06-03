<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campospersonalizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'tipo', 'id_servicios'
    ];
}
