<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    protected $table='prendas';

    public $timestamps=false;

    protected $filelable=[
        'idCategoria',
        'idColor',
        'idTalle',
        'idMaterial',
        'nombre',
        'detalle',
        'imagen',
        'estado'
        
    ];

    protected $guarded = [
        
    ];
}
