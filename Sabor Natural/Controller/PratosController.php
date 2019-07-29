<?php

namespace SaborNatural\Http\Controllers;


use Illuminate\Http\Request;
use SaborNatural\Http\Controllers\Controller;
use SaborNatural\Pratos;
use Response;

class PratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pratos $pratos)
    {           
        $prato = $pratos->get();
        $pratosjson = Pratos::all()->toJson();
        

        

        return view('pratos.index',['todospratos' => $prato, 'pratosjson' => $pratosjson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pratos.create');
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
            'nome' => 'required',
            'descricao' => 'required',
        ]);
        
        $pratos = new Pratos;
        $pratos->nome = $request->nome;
        $pratos->descricao = $request->descricao;

        $pratos->peso = $request->peso;
        $pratos->preco = $request->preco;        
        $pratos->foto = '/imagens/pratos/' . $this->fileUpload($request);

        $pratos->save();
        return redirect('pratos')->with('message', 'Prato atualizado com sucesso!');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pratos = Pratos::find($id);
        if(!$pratos){
            abort(404);
        }
        return view('pratos.details')->with('detailpage', $pratos);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pratos = Pratos::find($id);
        if(!$pratos){
            abort(404);
        }
        return view('pratos.edit')->with('detailpage', $pratos);
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
            'nome' => 'required',
            'descricao' => 'required',
        ]);
        
        $pratos = Pratos::find($id);
        $pratos->nome = $request->nome;
        $pratos->descricao = $request->descricao;
        $pratos->peso = $request->peso;
        $pratos->preco = $request->preco;        
       
        if ($request->file('image') !== null) {
            $pratos->foto = '/imagens/pratos/' . $this->fileUpload($request);
        }
        
        $pratos->save();
        return redirect('pratos')->with('message', 'Prato editado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pratos = Pratos::find($id);
        $pratos->delete();
        return redirect('pratos')->with('message', 'Prato apagado com sucesso!');
    }


    public function fileUpload(Request $request) {    
        
        /*$this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);*/

        $nomeArquivo = trim($request->nome) . time();
        $image = $request->file('image');

        $input['imagename'] = $nomeArquivo.'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/imagens/pratos');

        $image->move($destinationPath, $input['imagename']);

        return $input['imagename'];
                
    }
}
