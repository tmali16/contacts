<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phone";
    protected $hidden = ['created_at', 'updated_at', 'persona_id'];
    //
    public function type()
    {
        return $this->hasOne('App\PhoneType', 'id', 'type_id');
    }
}
