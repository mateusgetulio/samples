<?php

namespace SaborNatural\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
   public function enviarMensagem(Request $request)
   {       

		$validator = Validator::make($request->all(), [
      'nome' => 'required',
    	'email' => 'required|email',
      'mensagem' => 'required|max:2000',	        
		],
    [   
      'nome.required'    => 'Informe o nome por favor.',
      'email.required'      => 'Informe o e-mail por favor.',
      'email.email' => 'Formato de e-mail inválido.',
      'mensagem.required'      => 'Digite a mensagem por favor.',
    ]);

    if ($validator->fails()) {
      return redirect('/#contato')
              ->withErrors($validator)
              ->withInput()
              ->with('nome', $request->nome)
              ->with('email', $request->email)
              ->with('mensagem', $request->mensagem);       
		} else {

      $request = $this->sanitize_request($request);
 
       Mail::send('emails.contato',
	       array(
	           'nome' => $request['nome'],
	           'email' => $request['email'],
	           'mensagem' => $request['mensagem']
	       ), function($message)
	   {
	       $message->from('form@sabornatural.com');
	       $message->to('contato@sabornatural.com', 'Admin')->subject('Contato via Website');
	   });
 
			return redirect('/#contato')->with('message', 'Mensagem enviada com sucesso!');       
		}
   }

   public function sanitize_request($request)
   {
    $origem  = array('/', '"', "'", '*', '%', '#', '<', '>', '{', '}', ')', '(', '+', '-', '$', '/', "\\");
    $destino = array(' ');
    $array = $request->all();
    foreach ($array as $i => $atributo ) {
      $atributo = str_replace( $origem, $destino, $atributo);
      stripslashes($atributo);
      htmlentities($atributo);
      strip_tags($atributo);

      $array[$i] = $atributo;
    }

    return $array;
    
    }
}
