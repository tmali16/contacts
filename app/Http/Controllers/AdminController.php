<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doljnost;
use App\Gupravlenie;

class AdminController extends Controller
{
    
    public function index()
    {
    	return view('admin.index');
    }


    public function create(Request $request)
    {
    	
    }

    public function create_doljnost(Request $request)
    {
        
    }
    public function getOne(Request $request)
    {
        if($request->json()){
            if($request->trigger == 0){
                $ret = Gupravlenie::where("id", "=", $request->id)->with(["children.children.children", "doljnost"])->get();
            }
            if($request->trigger == 1){
                $ret = doljnost::where('id', '=', $request->id)->with(['doljnost', 'upr', 'Gu','persona.phone.type'])->get();
            }

            return $ret;
        }
    }

}
