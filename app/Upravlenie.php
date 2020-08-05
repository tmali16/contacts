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

    public function doljnosti()
    {
        // return $this->hasMany("App\Persona", "id", "doljnost_id");
        return $this->belongsToMany("App\doljnost_list", 'doljnost', 'upravlenie_id', 'doljnost_id');
    }

    public function sotrudnik()
    {
        return $this->belongsToMany(self::class, 'persona', 'upravlenie_id', 'id');
    }
    


    public function is_parent(){
        if ($this->parent_id != null){
            return false;
        }
        return true;
    }
}
