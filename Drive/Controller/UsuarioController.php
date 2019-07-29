<?php

namespace Drive\Http\Controllers;

use Drive\Usuario;
use Drive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Hash;
use Illuminate\Validation\Rule;


class UsuarioController extends Controller
{
    use RegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Usuario $usuarios)
    {           
        $usuario = $usuarios->get();
        $usuariojson = Usuario::all()->toJson();
                

        return view('usuario.index',['usuarios' => $usuario, 'usuarioJson' => $usuariojson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = array(
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'Formato de e-mail inválido.',
            'date_format' => 'Data inválida.',
            'unique' => 'Email já utilizado, por favor escolha outro.',
            'confirmed' => 'As senhas informadas são diferentes.',
            'min' => 'A senha deve possuir pelo menos 6 caracteres.',
        );  

        $this->validate(
            $request, [
                'name' => 'required',
                'email' => Rule::unique('users'),
                'password' => 'required|confirmed|min:6',
            ],
            $messages
        );
            
     
        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefones' => $request->telefones,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);        
    
                
        return redirect('usuarios')->with('message', 'Usuário cadastrado com sucesso!');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuarios = Usuario::find($id);
        if(!$usuarios){
            abort(usuarios404);
        }
        return view('usuario.details')->with('detailpage', $usuarios);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = Usuario::find($id);
        if(!$usuarios){
            abort(404);
        }
        return view('usuario.edit')->with('detailpage', $usuarios);
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
        $usuarios = Usuario::find($id);

        $messages = array(
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'Formato de e-mail inválido.',
            'date_format' => 'Data inválida.',
            'unique' => 'Email já utilizado, por favor escolha outro.',
            'confirmed' => 'As senhas informadas são diferentes.',
            'min' => 'A senha deve possuir pelo menos 6 caracteres.',
        );  

        $this->validate(
            $request, [
                'name' => 'required',
                'email' => Rule::unique('users')->ignore($usuarios->email, 'email'),
                'password' => 'required|confirmed|min:6',
            ],
            $messages
        );
        
        
        $usuarios->update([
            'name' => $request->name,
            'email' => $request->email,
            'telefones' => $request->telefones,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);  


        return redirect('usuarios')->with('message', 'Usuário editado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuario::find($id);
        $usuarios->delete();
        return redirect('usuarios')->with('message', 'Usuário apagado com sucesso!');
    }


    public function emailExists($email)
    {
        
        $usuario = Usuario::where('email', '=', $email)->first();
        if ($usuario === null) {
            echo "false";
        } else {
            echo "true";
        }

    }    
}
