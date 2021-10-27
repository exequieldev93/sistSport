<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marcas';

    public $timestamps=false;

    protected $filelable=[
        'nombre'
    ];

    protected $guarded = [
        
    ];
}
