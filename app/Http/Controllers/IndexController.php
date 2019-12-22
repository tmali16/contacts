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
use App\table_rank;
use App\doljnost;
use App\Doljnosti;


class IndexController extends Controller
{
    
    public function index()
    {
        return view("index.index");
    }

    public function getPhone(Request $request)
    {
        if($request->json()){
            return Gupravlenie::with(['upr.otdel','otdel'])->get();
        }
    }

    public function search(Request $request)
    {
        if($request->json()){
            $ser = trim($request->q);

            $data = Gupravlenie::where('fullname', 'like', "$ser%")->orWhere('shortname', 'like', "$ser%")->get();

            if($data->count() == 0){
               $data = Otdel::where('fullname', 'like', "$ser%")->orWhere('shortname', 'like', "$ser%")->get();
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
            if($request->state_id == 1){
                $upr = new Upravlenie();
                $rules = [
                    'fullname'=>'required|min:5',
                    'shortname'=>'nullable',
                    'guid'=>'required|integer'
                ];
    
                if($this->validate($request, $rules, [])){
                    $upr->fullname = $request->fullname;
                    $upr->shortname = $request->shortname;
                    $upr->gu_id = $request->guid;
                    $upr->save();
                }
            }
            if($request->state_id == 2){
                $Otdel = new Otdel();
                $rules = [
                    'fullname'=>'required|min:5',
                    'shortname'=>'nullable',
                    'guid'=>'required|integer'
                ];
    
                if($this->validate($request, $rules, [])){
                    $Otdel->fullname = $request->fullname;
                    $Otdel->shortname = $request->shortname;
                    $Otdel->upr_id = $request->guid;
                    $Otdel->save();
                } 
            }
            if($request->state_id == 4){
                $doljnost = new doljnost();
                $doljnost->otdel_id = $request->podgu_id;
                $doljnost->name_id = $request->doljnosti_id;
                $doljnost->save();
            }
            
            return $this->getGu();
        }
    }
    public function getGu()
    {
        $gu = Gupravlenie::with(['Upr.Otdel', 'otdel'])->get();
        $ret = [
            'gu'=>$gu,
            'upr'=> Upravlenie::all(),
            'otdel'=> Otdel::all(),
            'rank' => table_rank::all(),
            'doljnost_name' => Doljnosti::all(),
            'doljnost' => doljnost::with(['otdel', 'upr', 'dol'])->get(),
        ];
        return ($ret);

    }
    public function getUprOtd(Request $request)
    {
        if($request->json()){
            
            $id = $request->gu_id;
            $ret = null;
            $ret = Upravlenie::where('gu_id' , '=',$id)->get();
            if($ret->count() == 0){
                $ret = Otdel::where('upr_id' , '=', $id)->get();
            }
            return $ret->toJson();
        }
    }
}
