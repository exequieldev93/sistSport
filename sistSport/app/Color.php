<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table='colores';

    public $timestamps=false;

    protected $filelable=[
        'nombre',
        'descripcion'
    ];

    protected $guarded = [
        
    ];
}
