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

class IndexController extends Controller
{
    
    public function index()
    {
        return view("index.index");
    }

    public function create(Request $request)
    {
    	$Persona = new Persona();
    	$Persona->fn = $request->input('fn');
    	$Persona->mn = $request->input('mn');
    	$Persona->ln = $request->input('ln');




    }
    public function createGu(Request $request)
    {
        if($request->json()){
            $gu = new Gupravlenie();
            $rules = [
                'fullname'=>'required|min:5',
                'shortname'=>'nullable'
            ];

            if($this->validate($request, $rules, [])){
                $gu->fullname = $request->fullname;
                $gu->shortname = $request->shortname;
                $gu->save();
            }
            return $this->getGu();
        }
    }
    public function createUpr(Request $request)
    {
        if($request->json()){
            $upr = new Upravlenie();
            $rules = [
                'fullname'=>'required|min:5',
                'shortname'=>'nullable',
                'id'=>'required|integer'
            ];

            if($this->validate($request, $rules, [])){
                $upr->fullname = $request->fullname;
                $upr->shortname = $request->shortname;
                $upr->gu_id = $request->id;
                $upr->save();
            }
            return $this->getGu();
        }
    }
    public function getGu()
    {
        $gu = Gupravlenie::with('Upr.Otdel')->get();
        return $gu->toJson();
    }
}
