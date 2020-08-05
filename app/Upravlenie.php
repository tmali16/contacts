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
        return $this->hasMany('App\Upravlenie', 'parent_id', 'id')->with('doljnosti');
    }

    // public function doljnosti()
    // {
    //     return $this->belongsToMany("App\doljnost_list", 'doljnost',   'upravlenie_id', 'doljnost_id');
    // }

    public function doljnosti()
    {
        return $this->hasManyThrough('App\doljnost', 'App\Upravlenie', 'id', 'upravlenie_id', 'id', 'id')
        ->join('doljnost_lists', 'doljnost_lists.id', '=', 'doljnost.doljnost_id')
        ->join('persona as p', 'p.doljnost_id','=','doljnost.id')
        ->join('zvanie_lists as zvanie', 'zvanie.id', '=', 'p.zvanie_id')
        ->select('doljnost_lists.doljnost', 'p.fn', 'p.mn','p.ln','p.doljnost_id', 'zvanie.zvanie');
    }
    
    public function is_parent(){
        if ($this->parent_id != null){
            return false;
        }
        return true;
    }

}
