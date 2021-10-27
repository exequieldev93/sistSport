<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='roles';

    public $timestamps=false;

    protected $filelable=[
        'nombre'
    ];

    protected $guarded = [
        
    ];
}
