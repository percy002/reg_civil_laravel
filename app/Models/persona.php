<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table="personas";
    protected $fillable = [
        'dni',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'genero',
        'fecha_nacimiento',
    ];
    public function getFullname()
    {
        return "{$this->dni}-{$this->apellido_paterno}-{$this->apellido_paterno}-{$this->nombres}";
    }
}
