<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doljnost;


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

}
