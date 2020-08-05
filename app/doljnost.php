<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost extends Model
{
    protected $table = "doljnost";
    public $timestamps = false;
    protected $hidden = [ 'parent_id', 'doljnost_id', 'upr_id', 'gu_id'];

    public function persona()
    {
        return $this->hasOne("App\Persona", 'doljnost_id', 'id');
    }

    public function upr()
    {
        return $this->belongsTo('App\Upravlenie', 'upr_id', 'id');
    }

    public function sotrudnik()
    {
        return $this->belongsToMany('App\doljnost', 'persona', 'doljnost_id', 'doljnost_id', 'id');
    }
    // public function sotrudniki()upravlenie_
    // {
    //     return $this->belongsToMany(self::class, 'doljnost_list', 'id', 'doljnost_id')
    // }
}
