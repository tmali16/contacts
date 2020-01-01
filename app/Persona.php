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
}
