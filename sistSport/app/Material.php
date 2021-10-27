<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table='materiales';

    public $timestamps=false;

    protected $filelable=[
        'nombre'
    ];

    protected $guarded = [
        
    ];
}
