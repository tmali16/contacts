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

    public function getPhone(Request $request)
    {
        if($request->json()){
            return Gupravlenie::with(['children.children'])->get();
        }
    }

    public function search(Request $request)
    {
        if($request->json()){
            $ser = trim($request->q);

            $data = Gupravlenie::where('fullname', 'like', "$ser%")->orWhere('shortname', 'like', "$ser%")->get();

            if($data->count() == 0){
               $data = Upravlenie::where('fullname', 'like', "$ser%")->orWhere('shortname', 'like', "$ser%")->get();
            }
            
            return $data;
        }
    }
    // public function create(Request $request)
    // {
    // 	$Persona = new Persona();
    // 	$Persona->fn = $request->input('fn');
    // 	$Persona->mn = $request->input('mn');
    // 	$Persona->ln = $request->input('ln');




    // }
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
    public function create(Request $request)
    {
        if($request->json()){
            if($request->add_id == 0){
                $upr = new Upravlenie();
                $rules = [
                    'fullname'=>'required|min:5',
                    'shortname'=>'nullable',
                    'guid'=>'nullable|integer'
                ];
    
                if($this->validate($request, $rules, [])){
                    $upr->fullname = $request->fullname;
                    $upr->shortname = $request->shortname;
                    $upr->gu_id = $request->guid;
                    $upr->save();
                }
            }
            if($request->add_id == 1){
                $upr = new Upravlenie();
                $rules = [
                    'fullname'=>'required|min:5',
                    'shortname'=>'nullable',
                    'parent_id'=>'nullable'
                ];
    
                if($this->validate($request, $rules, [])){
                    $upr->fullname = $request->fullname;
                    $upr->shortname = $request->shortname;
                    $upr->parent_id = $request->parent_id;
                    $upr->save();
                }
            }
            if($request->add_id == 4){
                $doljnost = new doljnost();
                $rules = [
                    'dol_id'=>'nullable|integer',
                    'guid'=>'nullable|integer'
                ];

                if($this->validate($request, $rules, [])){
                    $doljnost->parent_id = $request->guid;
                    $doljnost->doljnost_id = $request->dol_id;
                    $doljnost->save();
                }
            }
            
            return response()->json(['message'=>"Данные добавлены"]);
        }
    }
    public function getGu()
    {
        $gu = Gupravlenie::with(['Upr'])->get();

        $ret = [
            'gu'=>$gu,
            'upr'=> Upravlenie::all(),
            'zvanie' => Zvanie::all(),
            'doljnost_name' => doljnost_list::all(),
            'doljnost' => doljnost::with(['upr', 'doljnost', 'Gu'])->get(),
        ];

        return ($ret);

    }
    public function getdolj(Request $request)
    {
        if($request->json()){
            return doljnost_list::all();
        }
    }
    public function returnGu()
    {
        $gu = Gupravlenie::with(['children.children.children', 'doljnost.doljnost'])->get();
        // dd(Gupravlenie::root()->get());
        return $gu->toJson();
    }

    public function getUprOtd(Request $request)
    {
        if($request->json()){
            
            $id = $request->gu_id;
            $ret = null;
            $ret = Upravlenie::where('gu_id' , '=',$id)->whereNull('parent_id')->get();
            // if($ret->count() == 0){
            //     $ret = Otdel::where('upr_id' , '=', $id)->get();
            // }
            return $ret->toJson();
        }
    }
}
