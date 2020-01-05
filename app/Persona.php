<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "persona";
    protected $hidden = ['doljnost_id', 'zvanie_id', 'created_at', 'updated_at'];

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
