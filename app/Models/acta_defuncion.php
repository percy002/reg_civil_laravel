<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Defuncion extends Model
{
    use HasFactory;
    protected $fillable = [
        'fk_id_fallecido',
        'acta',
        'libro',
        'fecha_registro',
        'fecha_defuncion',
        'archivo',
        'rectificado',
    ];
}
