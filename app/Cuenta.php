<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model 
{
    protected $table = 'modelo_cuenta';
    protected $primaryKey = 'cuenta_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'estado', 'fecha_apertura', 'tipo_cuenta', 'saldo'
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