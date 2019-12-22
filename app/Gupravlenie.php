<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Upravlenie;

class Gupravlenie extends Model
{
    protected $table = "gupravlenie";

    public function Upr()
    {
        return $this->hasMany(\App\Upravlenie::class, 'gu_id', 'id');
    }
    public function otdel()
    {
        return $this->hasMany(\App\otdel::class, 'upr_id', 'id');
    }
}
