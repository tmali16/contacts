<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class doljnost_list extends Model
{
    public $timestamps = false;
    protected $hidden = [];

    
    public function upravlenie()
    {
        return $this->belongsToMany('App\Upravlenie', 'doljnost', 'doljnost_id', 'upravlenie_id');
    }
    public function sotrudnik()
    {
        return $this->belongsToMany('App\Persona', 'doljnost');
    }
    public function phones()
    {
        return $this->belongsToMany('App\Phone', 'phone_type');
    }
}
