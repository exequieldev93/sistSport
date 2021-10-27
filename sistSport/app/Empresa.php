<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresas';

    public $timestamps=false;

    protected $filelable=[
        'nombre',
        'tipo',
        'email',
        'telefono',
        'direccion',
        'imagen'
    ];

    protected $guarded = [
        
    ];
}
