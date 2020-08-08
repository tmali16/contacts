<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gruppa;
use App\Otdel;
use App\Persona;
use App\Phone;
use App\PhoneType;
use App\Upravlenie as Uprava;
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

    public function fetchData()
    {
        $headers = [];

        $data = [
            'data'=>Uprava::with(["children.doljnosti.phones", 'doljnosti'])->whereNull("parent_id")->get()
        ];
        return response()->json($data, 200, $headers);
    }
}
