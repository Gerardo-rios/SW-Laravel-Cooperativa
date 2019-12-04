<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model 
{
    protected $table = 'modelo_client';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'genero', 'fecha_nacimiento', 'estado_civil', 'correo',
        'telefono', 'celular', 'direccion'
    ];

    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     
    protected $hidden = [
        'password',
    ];*/
}