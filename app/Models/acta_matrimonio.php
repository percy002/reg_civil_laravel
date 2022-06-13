<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Matrimonio extends Model
{
    use HasFactory;
    protected $table="acta_matrimonios";
    protected $fillable = [
        'fk_id_novio',
        'fk_id_novia',
        'acta',
        'libro',
        'fecha_registro',
        'fecha_matrimonio',
        'archivo',
        'rectificado',
    ];
    public function novio()
    {
        return $this->belongsTo(Persona::class, 'fk_id_novio','id');
    }
    public function novia()
    {
        return $this->belongsTo(Persona::class, 'fk_id_novia','id');
    }
}
