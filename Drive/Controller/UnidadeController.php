<?php

namespace Drive\Http\Controllers;

use Drive\Unidade;
use Illuminate\Http\Request;
use Drive\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Response;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Unidade $unidade)
    {           
        $unidades = $unidade->get();
        //$unidadesJson = Unidade::all()->toJson();       
        

        return view('unidade.index', ['todasUnidades' => $unidades]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidade.create');
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
        );  

        $validator = $this->validate(
            $request, [
                'nome' => 'required',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                'cep' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'telefones' => 'required',
                'email' => Rule::unique('unidade'),
                'gerente' => 'required',
                'inauguracao' => 'required|date_format:d/m/Y',
            ], 
            $messages);

        
        $unidade = new Unidade;
        $unidade->nome = $request->nome;
        $unidade->logradouro = $request->logradouro;
        $unidade->numero = $request->numero;
        $unidade->bairro = $request->bairro;
        $unidade->cidade = $request->cidade;
        $unidade->estado = $request->estado;
        $unidade->cep = $this->unmask($request->cep);
        $unidade->lat = $request->lat;
        $unidade->lng = $request->lng;
        $unidade->telefones = $request->telefones;
        $unidade->email = $request->email;
        $unidade->gerente = $request->gerente;
        $dataInauguracao = explode("/", $request->inauguracao);
        $unidade->inauguracao = $dataInauguracao[2] . '-' . $dataInauguracao[1] . '-' . $dataInauguracao[0];
        $unidade->foto = '/images/unidades/' . $this->fileUpload($request);
        
        $unidade->save();

        return redirect('unidades')->with('message', 'Unidade adicionada com sucesso!');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidades = Unidade::find($id);
        if(!$unidades){
            abort(404);
        }
        return view('unidades.details')->with('detailpage', $unidades);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidade = Unidade::find($id);
        if(!$unidade){
            abort(404);
        }
        
        $unidade->inauguracao = date('d-m-Y', strtotime($unidade->inauguracao));

        return view('unidade.edit')->with('detailpage', $unidade);
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
        $unidade = Unidade::find($id);

        $messages = array(
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'Formato de e-mail inválido.',
            'date_format' => 'Data inválida.',
            'unique' => 'Email já utilizado, por favor escolha outro.',
        );  

        $validator = $this->validate(
            $request, [
                'nome' => 'required',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                'cep' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'telefones' => 'required',
                'email' => Rule::unique('unidade')->ignore($unidade->email, 'email'), 
                'gerente' => 'required',
                'inauguracao' => 'required|date_format:d/m/Y',
            ], 
            $messages);
        
        $unidade->nome = $request->nome;
        $unidade->logradouro = $request->logradouro;
        $unidade->numero = $request->numero;
        $unidade->bairro = $request->bairro;
        $unidade->cidade = $request->cidade;
        $unidade->estado = $request->estado;
        $unidade->cep = $this->unmask($request->cep);
        $unidade->lat = $request->lat;
        $unidade->lng = $request->lng;
        $unidade->telefones = $request->telefones;
        $unidade->email = $request->email;
        $unidade->gerente = $request->gerente;
        $dataInauguracao = explode("/", $request->inauguracao);
        $unidade->inauguracao = $dataInauguracao[2] . '-' . $dataInauguracao[1] . '-' . $dataInauguracao[0];
        
        if ($request->file('image') !== null) {
            $unidade->foto = '/images/unidades/' . $this->fileUpload($request);
        }

        $unidade->save();

        return redirect('unidades')->with('message', 'Unidade atualizada com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidade = Unidade::find($id);
        $unidade->delete();
        return redirect('unidades')->with('message', 'Unidade apagada com sucesso!');
    }


    public function localizarUnidades(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $unidades=Unidade::all();
        
        return $unidades;
    }

    public function localizarCidade(Request $request)
    {
        $locationVal=$request->locationVal;
        
        $matchedCities=Unidade::where('cidade','like',"%$locationVal%")->pluck('cidade','cidade');
        return response()->json(['items'=>$matchedCities]);
    
    }

    public function obterCoordenadas(Request $request)
    {
        $val=$request->val;
        $col=Unidade::where('cidade',$val)->first();

        $lat=$col->lat;
        $lng=$col->lng;


        return [$lat,$lng];
    }

    public function fileUpload(Request $request) 
    {    
        

        $nomeArquivo = trim($request->nome) . time();
        $image = $request->file('image');

        $input['imagename'] = $nomeArquivo.'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/images/unidades');

        $image->move($destinationPath, $input['imagename']);

        return $input['imagename'];
                
    }

    public function unmask($value)
    {
        return str_replace( ['.', '-'], '', $value);
    }
}
