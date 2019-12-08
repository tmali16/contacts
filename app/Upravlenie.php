<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upravlenie extends Model
{
    protected $table = "upravlenie";

    public function Otdel()
    {
        return $this->hasMany(\App\Otdel::class, 'upr_id', 'id');
    }

}
