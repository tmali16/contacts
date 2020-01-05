<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost extends Model
{
    protected $table = "doljnost";
    public $timestamps = false;
    protected $hidden = [ 'parent_id', 'doljnost_id', 'upr_id', 'gu_id'];

    public function doljnost()
    {
        return $this->belongsTo('App\doljnost_list', 'doljnost_id');
    }

    public function Gu()
    {
        return $this->hasOne('App\Gupravlenie', "id", 'gu_id');
    }
    
    public function upr()
    {
        return $this->hasOne("App\Upravlenie", "id", 'upr_id');
    }
    public function persona()
    {
        return $this->hasOne("App\Persona", 'doljnost_id', 'id');
    }
}
