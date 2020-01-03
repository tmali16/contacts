<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Upravlenie;

class Gupravlenie extends Model
{
    protected $table = "gupravlenie";
    public $timestamps = false;

    public function children()
    {
        return $this->hasMany('App\Upravlenie', 'gu_id', 'id');
    }
    public function doljnost()
    {
        return $this->hasMany('App\doljnost', 'gu_id', 'id');
    }
}
