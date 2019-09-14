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
        // Get the vehicle
        $veiculos = $veiculo->get();
        
        // Parse to JSON
        $veiculosJson = Veiculo::all()->toJson();       
        
        // Render the view index
        return view('veiculo.index', ['todosVeiculos' => $veiculos, 'veiculosJson' => $veiculosJson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Render the view create
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
         
        // Validate the data
        $this->validate($request, [
            'id_cliente' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'placa' => 'required',
        ]);
        
        // Create a new vehicle
        $veiculo = new Veiculo;
        $veiculo->id_cliente = $request->id_cliente;
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->ano = $request->ano;
        $veiculo->placa = $request->placa;
        
        // Save vehicle
        $veiculo->save();

        // Redirect to the view index
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
        // Find vehicle
        $veiculos = Veiculo::find($id);
        
        // Abort if no vehicle is found
        if(!$veiculos){
            abort(404);
        }

        // Render the view details
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
        // Find vehicle
        $veiculo = Veiculo::find($id);

        // Abort if no vehicle is found
        if(!$veiculo){
            abort(404);
        }
        // Render the view edit
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
        // Validate the data
        $this->validate($request, [
            'id_cliente' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'placa' => 'required',
        ]);
        
        // FInd the vehicle to be updated
        $veiculo = Veiculo::find($id);
        $veiculo->id_cliente = $request->id_cliente;
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->ano = $request->ano;
        $veiculo->placa = $request->placa;

        // Update vehicle
        $veiculo->save();

        // redirect to the view index
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
        // Find vehicle
        $veiculo = Veiculo::find($id);
        
        // Delete vehicle
        $veiculo->delete();
        
        // redirect to the view index
        return redirect('veiculos')->with('message', 'Veiculo apagado com sucesso!');
    }
}