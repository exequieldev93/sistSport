<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingresos';

    public $timestamps=false;

    protected $filelable=[
        'idProveedor',
        'fecha',
        'estado'
    ];

    protected $guarded = [
        
    ];
}
