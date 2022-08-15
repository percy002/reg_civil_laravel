<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use Carbon\Carbon;

class Acta_Defuncion extends Model
{
    use HasFactory;
    protected $table="acta_defuncions";
    protected $fillable = [
        'fk_id_fallecido',
        'acta',
        'libro',
        'fecha_registro',
        'fecha_defuncion',
        'archivo',
        'rectificado',
    ];

    /**
     * Get the user that owns the acta_defuncion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'fk_id_fallecido','id');
    }

    public function Fecha_defuncion_format(){
        return Carbon::parse($this->attributes['fecha_registro'])->format('d-m-Y');
        //  $this->attributes['fecha_registro'];
    }

    
}
