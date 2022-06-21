<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Nacimiento extends Model
{
    use HasFactory;
    protected $table="acta_nacimientos";

    protected $fillable = [
        'fk_id_nacido',
        'fk_id_padre',
        'fk_id_madre',
        'acta',
        'libro',
        'fecha_registro',
        'fecha_nacimiento',
        'archivo',
        'rectificado',
    ];

    public function nacido()
    {
        return $this->belongsTo(Persona::class, 'fk_id_nacido','id');
    }
    public function padre()
    {
        return $this->belongsTo(Persona::class, 'fk_id_padre','id');
    }
    public function madre()
    {
        return $this->belongsTo(Persona::class, 'fk_id_madre','id');
    }
}
