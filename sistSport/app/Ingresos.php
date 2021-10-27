<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    protected $table='ingresos';

    public $timestamps=false;

    protected $filelable=[
        'idProveedor',
        'num_comprobante',
        'fecha',
        'estado',
    ];

    protected $guarded = [
        
    ];
}
