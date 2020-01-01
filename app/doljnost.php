<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost extends Model
{
    protected $table = "doljnost";
    public $timestamps = false;
    protected $hidden = [ 'parent_id', 'doljnost_id'];

    public function doljnost()
    {
        return $this->hasOne('App\doljnost_list', 'id', 'doljnost_id');
    }

    public function Gu()
    {
        return $this->hasOne('App\Gupravlenie', "id", 'parent_id');
    }
    
    public function upr()
    {
        return $this->hasOne("App\Upravlenie", "id", 'parent_id');
    }
    public function persona()
    {
        return $this->hasOne("App\Persona", 'doljnost_id', 'id');
    }
}
