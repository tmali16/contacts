<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost_list extends Model
{
    public $timestamps = false;
    protected $hidden = [];

    public function sotrudnik()
    {
        return $this->belongsToMany('App\Persona', 'App\doljnost_list', 'doljnost_id','id');
    }
}
