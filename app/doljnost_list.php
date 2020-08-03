<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doljnost_list extends Model
{
    public $timestamps = false;
    protected $hidden = [];

    public function persona()
    {
        return $this->belongsTo('App\doljnost', 'doljnost_id', 'upr_id');
    }
}
