<?php

namespace App\Models;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dni',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'estado',
        'password',
    ];
    Protected $guard_name ='web';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function nombre_completo(){
        return $this->attributes['nombres'].'-'.$this->attributes['apellido_paterno'].'-'.$this->attributes['apellido_materno'];
    }

    public function name(){
        // return $this->attributes['nombres'];
        return "nombres";
    }

    public function desc(){
        return "administrador";
    }

    public function getnameAttribute(){
        return $this->attributes['nombres'].' '.$this->attributes['apellido_paterno'].' '.$this->attributes['apellido_materno'];;
    }

    
    // public function getRoleNames()
    // {
    //     return $this->belongsToMany(Role::class);

    // }
    
    
}
