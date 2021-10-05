<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    protected $table='prendas';

    public $timestamps=false;

    protected $filelable=[
        'idCategoria',
        'nombre',
        'talle',
        'marca',
        'color',
        'estado',
        'imagen'
    ];

    protected $guarded = [
        
    ];
}
