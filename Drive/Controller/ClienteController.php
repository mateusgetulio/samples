<?php

namespace Drive\Http\Controllers;

use Drive\Cliente;
use Drive\Usuario;
use Drive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Hash;
use Response;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cliente $cliente)
    {           
        $clientes = DB::table('cliente')
            ->join('users', 'cliente.id_usuario', '=', 'users.id')
            ->select('cliente.*', 'users.*')
            ->get();

        $clientesJson = $clientes->toJson();       
        

        return view('cliente.index', ['todosClientes' => $clientes, 'clientesJson' => $clientesJson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrar(Request $request)
    {
        $this->validate($request, [
            'cpf' => 'required',
            'rg' => 'required',
            'nome' => 'required',
            'sobrenome' => 'required',
            'nascimento' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);

    
        $usuario = Usuario::create([
            'name' => $request->nome . ' ' . $request->sobrenome,
            'email' => $request->email,
            'telefones' => $request->telefones,
            'flag_administrador' => 'N',
            'password' => bcrypt($request->senha),
            'remember_token' => Str::random(60),
        ]);

        
        $cliente = new Cliente;
        $cliente->id_usuario = $usuario->id;
        $cliente->cpf = $request->cpf;
        $cliente->rg = $request->rg;
        $cliente->nome = $request->nome;
        $cliente->sobrenome = $request->sobrenome;
        $cliente->nascimento = $request->nascimento;
        $cliente->logradouro = $request->logradouro;
        $cliente->numero = $request->numero;
        $cliente->bairro = $request->bairro;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->cep = $request->cep;
        
        $cliente->save();

        return redirect('login')->with('message', 'Cadastro concluído! Faça o login para utilizar o sistema.');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientes = Cliente::find($id);
        if(!$clientes){
            abort(404);
        }
        return view('clientes.details')->with('detailpage', $clientes);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = DB::table('cliente')
            ->join('users', 'cliente.id_usuario', '=', 'users.id')
            ->select('cliente.*', 'users.telefones', 'users.email')
            ->where('cliente.id_usuario', '=', $id)
            ->first();

        
        if(!$cliente){
            abort(404);
        }

        $cliente->nascimento = date('d-m-Y', strtotime($cliente->nascimento));

        return view('cliente.edit')->with('detailpage', $cliente);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $cliente = Cliente::find($id);

        $usuario = Usuario::find($cliente->id_usuario);
       
        $messages = array(
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'Formato de e-mail inválido.',
            'date_format' => 'Data inválida.',
            'unique' => 'Email já utilizado, por favor escolha outro.',
        );  
       
        $this->validate($request, [
            'cpf' => 'required',
            'rg' => 'required',
            'nome' => 'required',
            'sobrenome' => 'required',
            'nascimento' => 'required|date_format:d/m/Y',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'email' => Rule::unique('users')->ignore($usuario->email, 'email'), 
        ], $messages);
               
        
        
        $cliente->cpf = $this->unmask($request->cpf);
        $cliente->rg = $request->rg;
        $cliente->nome = $request->nome;
        $cliente->sobrenome = $request->sobrenome;
        $dataNascimento = explode("/", $request->nascimento);
        $cliente->nascimento = $dataNascimento[2] . '-' . $dataNascimento[1] . '-' . $dataNascimento[0];
        $cliente->logradouro = $request->logradouro;
        $cliente->numero = $request->numero;
        $cliente->bairro = $request->bairro;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->cep = $this->unmask($request->cep);
        

        $usuario->telefones = $request->telefones;
        $usuario->email = $request->email;

        
        $cliente->save();
        $usuario->save();

        return redirect('clientes')->with('message', 'Cliente atualizado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect('clientes')->with('message', 'Cliente apagado com sucesso!');
    }

    public function unmask($value)
    {
        return str_replace( ['.', '-'], '', $value);
    }
}
