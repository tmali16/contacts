<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doljnost;
use App\Persona;
use App\Phone;
use App\Upravlenie as Uprava;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    
    public function index()
    {
    	return view('admin.index');
    }

    public function ContactAll(Request $request)
    {
        $headers = [];
        $data = [
            // "parrent"=>Uprava::whereNull('parent_id')->get(),
            "slujba"=>Uprava::with("children.doljnosti", "doljnosti")->whereNull("parent_id")->get()
        ];
        return response()->json($data, 200, $headers);
    }

    public function test(Request $request)
    {
        
        $d = $this->ContactAll($request);
        echo "<pre>";
        return $d;
    }
}
