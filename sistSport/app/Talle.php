<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table='talles';

    public $timestamps=false;

    protected $filelable=[
        'unidad'
    ];

    protected $guarded = [
        
    ];
}
