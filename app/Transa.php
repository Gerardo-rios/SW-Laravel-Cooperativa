<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transa extends Model 
{
    protected $table = 'modelo_transaccion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha', 'tipo', 'valor', 'descripcion', 'responsable'
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