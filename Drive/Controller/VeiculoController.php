<?php

namespace Drive\Http\Controllers;

use Drive\Veiculo;
use Illuminate\Http\Request;
use Drive\Http\Controllers\Controller;
use Response;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Veiculo $veiculo)
    {           
        $veiculos = $veiculo->get();
        $veiculosJson = Veiculo::all()->toJson();       
        

        return view('veiculo.index', ['todosVeiculos' => $veiculos, 'veiculosJson' => $veiculosJson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veiculo.create');
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
            'id_cliente' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'placa' => 'required',
        ]);
        
        $veiculo = new Veiculo;
        $veiculo->id_cliente = $request->id_cliente;
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->ano = $request->ano;
        $veiculo->placa = $request->placa;
        
        $veiculo->save();

        return redirect('veiculos')->with('message', 'Veiculo adicionado com sucesso!');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculos = Veiculo::find($id);
        if(!$veiculos){
            abort(404);
        }
        return view('veiculos.details')->with('detailpage', $veiculos);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Veiculo::find($id);
        if(!$veiculo){
            abort(404);
        }
        return view('veiculo.edit')->with('detailpage', $veiculo);
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
            'id_cliente' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'placa' => 'required',
        ]);
        
        $veiculo = Veiculo::find($id);
        $veiculo->id_cliente = $request->id_cliente;
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->ano = $request->ano;
        $veiculo->placa = $request->placa;

        
        $veiculo->save();

        return redirect('veiculos')->with('message', 'Veiculo atualizado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::find($id);
        $veiculo->delete();
        return redirect('veiculos')->with('message', 'Veiculo apagado com sucesso!');
    }
}