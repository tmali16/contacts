<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otdel extends Model
{
    protected $table = "otdel";

    public function Otdel()
    {
        return $this->hasMany('');
    }
}
