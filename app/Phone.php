<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phone";
    //
    public function type()
    {
        return $this->hasOne('App\PhoneType', 'id', 'type_id');
    }
}
