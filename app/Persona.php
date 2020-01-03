<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "persona";
    //

    public function phone()
    {
        return $this->hasMany('App\Phone', 'persona_id', 'id');
    }
    public function doljnost()
    {
        return $this->hasOne('App\doljnost', 'id', 'doljnost_id');
    }

    public function zvanie()
    {
        return $this->hasOne('App\Zvanie', 'id', 'zvanie_id');
    }
}
