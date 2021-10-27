<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngresos extends Model
{
    protected $table='detalle_Ingresos';

    public $timestamps=false;

    protected $filelable=[
        'idIngreso',
        'idPrenda',
        'idMarca',
        'cantidad',
        'precio'
    ];

    protected $guarded = [
        
    ];
}
