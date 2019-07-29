<?php

namespace SaborNatural\Http\Controllers;

use Illuminate\Http\Request;
use SaborNatural\Http\Controllers\Controller;
use SaborNatural\Pratos;



class PratosAjaxController extends Controller
{
 
    public function index(Pratos $pratos){
    	return response()->json($pratos->get());
    }

    public function ajax(Pratos $prato){
        $pratos = $prato->paginate(6);

        return view('pratosajax')->with('pratos', $pratos);
    }
  	
}
