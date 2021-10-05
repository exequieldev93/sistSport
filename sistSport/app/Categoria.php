<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categorias';

    public $timestamps=false;

    protected $filelable=[
        'nombre'
    ];

    protected $guarded = [
        
    ];
}
