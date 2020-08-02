<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upravlenie extends Model
{
    protected $table = "upravlenie";
    public $timestamps = false;
    protected $hidden = ['parent_id', 'gu_id'];

    public function children()
    {
        return $this->hasMany('App\Upravlenie', 'parent_id', 'id');
    }

    public function Persona()
    {
        return $this->hasMany("App\Persona", "id", "doljnost_id");
    }

    public function is_parent(){
        if ($this->parent_id != null){
            return false;
        }
        return true;
    }
}
