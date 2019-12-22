<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost extends Model
{
    protected $table = "doljnost";

    public function otdel()
    {
        return $this->hasMany('App\Otdel');
    }
    
    public function upr()
    {
        return $this->hasMany('App\Upravlenie');
    }
    
    public function gu()
    {
        return $this->hasMany('App\Gupravlenie');
    }
    
}
