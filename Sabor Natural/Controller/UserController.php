<?php

namespace SaborNatural\Http\Controllers;

use SaborNatural\User;
use SaborNatural\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Hash;

class UserController extends Controller
{
    use RegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users)
    {           
        $user = $users->get();
        $userjson = User::all()->toJson();
                

        return view('users.index',['usuarios' => $user, 'userjson' => $userjson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
            
     
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
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
        $users = User::find($id);
        if(!$users){
            abort(users404);
        }
        return view('users.details')->with('detailpage', $users);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        if(!$users){
            abort(404);
        }
        return view('users.edit')->with('detailpage', $users);
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',            
        ]);
        
        $users = User::find($id);

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->editPassword),
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
        $users = User::find($id);
        $users->delete();
        return redirect('usuarios')->with('message', 'Usuário apagado com sucesso!');
    }


    public function emailExists($email)
    {
        
        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            echo "false";
        } else {
            echo "true";
        }

    }    
}