<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost extends Model
{
    protected $table = "doljnost";
    public $timestamps = false;

    public function otdel()
    {
        return $this->hasOne('App\Otdel', 'id', 'otdel_id');
    }
    
    public function upr()
    {
        return $this->hasOne('App\Upravlenie', 'id', 'otdel_id');
    }
    public function dol()
    {
        return $this->hasOne('App\Doljnosti', 'id', 'name_id');
    }
    public function gu()
    {
        return $this->hasMany('App\Gupravlenie');
    }
    
}
