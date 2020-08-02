<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gruppa;
use App\Otdel;
use App\Persona;
use App\Phone;
use App\PhoneType;
use App\Upravlenie;
use App\Gupravlenie;
use App\User;
use App\doljnost_list;
use App\doljnost;
use App\Zvanie;


class IndexController extends Controller
{    
    public function index()
    {
        return view("index.index");
    }
}
