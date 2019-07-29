<?php

namespace SaborNatural\Http\Controllers;

use Illuminate\Http\Request;
use SaborNatural\Http\Controllers\Controller;
use SaborNatural\Pratos;

class HomeController extends Controller
{
    

	public function index(Pratos $prato){
    	
    	$pratos = $prato->paginate(6);

    	return view('index')->with('pratos', $pratos);
  
    }
    
}
