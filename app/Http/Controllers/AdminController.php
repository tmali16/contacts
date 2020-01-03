<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doljnost;
use App\Gupravlenie;
use App\Persona;
use App\Phone;


class AdminController extends Controller
{
    
    public function index()
    {
    	return view('admin.index');
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

    public function addPersona(Request $request)
    {
        $person = new Persona();
        $rules = [
            'fname'=>'required|min:2',
            'mname'=>'required|min:2',
            'lname'=>'nullable|min:2',
            'zvanie'=>'required',
            
        ];

        if($this->validate($request, $rules, [])){
            $person->fn = $request->fname;
            $person->mn = $request->mname;
            $person->ln = ($request->lname != null ? $request->lname : '');
            $person->zvanie_id = $request->zvanie;
            $person->doljnost_id = $request->doljnost;

            if($person->save()){
                $ret = [
                    'state'=>true,
                    'message'=>'Добавлено'
                ];
            }else{
                $ret = [
                    'state'     =>false,
                    'message'   =>'Ошибка сохранения'
                ];
            }
            $id = $person->id;
            foreach ($request->phone as $key => $value) {
                if(strlen($value['tel']) > 0){
                    $phone = new Phone();
                    $phone->number = $value['tel'];
                    $phone->type_id = $value['type'];
                    $phone->persona_id = $id;
                    $phone->save();
                }
            }
        }else{
            $ret = [
                'state'     =>false,
                'message'   =>'Ошибка сохранения'
            ];
        }
        return $ret;
    }
    public function addPhone(Request $request)
    {
        dd($request->arr);
    }

}
