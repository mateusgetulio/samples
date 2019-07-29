<?php

namespace Drive\Http\Controllers;

use Drive\Agendamento;
use Illuminate\Http\Request;
use Drive\Http\Controllers\Controller;
use Response;
use DateTime;
use DatePeriod;
use DateInterval;
use Drive\Unidade;
use Drive\Veiculo;
use Drive\Cliente;
use Drive\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Agendamento $agendamento)
    {           

      $agendamentos = DB::table('agendamento')
          ->join('cliente', 'agendamento.id_cliente', '=', 'cliente.id')
          ->join('unidade', 'agendamento.id_unidade', '=', 'unidade.id')
          ->join('veiculo', 'agendamento.id_veiculo', '=', 'veiculo.id')
          ->leftjoin('users as cancelamento', 'agendamento.id_usuario_cancelamento', '=', 'cancelamento.id')
          ->select('agendamento.*', 
                   DB::raw('CONCAT(cliente.nome, " ", cliente.sobrenome) as cliente'),
                   'unidade.nome as unidade', 
                   DB::raw('CONCAT(veiculo.marca, " ", veiculo.modelo , " ", veiculo.ano) as veiculo'),
                   'cancelamento.name as usuario_cancelamento')
          ->get();    

      $agendamentosJson = $agendamentos->toJson();  

      $calendarioAgendamentos = DB::table('agendamento')
          ->join('cliente', 'agendamento.id_cliente', '=', 'cliente.id')
          ->join('veiculo', 'agendamento.id_veiculo', '=', 'veiculo.id')
          ->select('agendamento.marcacao as start',  
                   DB::raw('CONCAT(cliente.nome, " ", cliente.sobrenome, " - ", veiculo.marca, " ", veiculo.modelo , " ", veiculo.ano) as title'))
          ->where('agendamento.id_unidade', '=', Unidade::get()->first()->id)
          ->get();     
      
      $calendarioAgendamentosJson = $calendarioAgendamentos->toJson();          

      return view('agendamento.index', ['todosAgendamentos' => $agendamentos, 'agendamentosJson' => $agendamentosJson, 'calendarioAgendamentosJson' => $calendarioAgendamentosJson]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      $atributos = [
          'data-format' => 'd/m/Y',
          'data-disabled-days' => $this->obterDatasBloqueadas(1),
          'data-lang' => 'pt',
          'data-large-mode' => 'true',
          'data-large-default' => 'true',
          'data-lock' => 'from',
          'data-min-year' => date("Y"),
          'data-max-year' => date("Y") + 1,
      ];

      return view('agendamento.create')->with('atributos', $atributos);     
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
          'id_unidade' => 'required',
          'id_cliente' => 'required',
          'id_veiculo' => 'required',
          'marcacao' => 'required',
      ]);

      
      $agendamento = new Agendamento;
      $agendamento->id_unidade = $request->id_unidade;
      $agendamento->id_cliente = $request->id_cliente;
      $agendamento->id_veiculo = $request->id_veiculo;
      $agendamento->marcacao = $request->marcacao;
      
      $agendamento->save();

      return redirect('agendamentos')->with('message', 'Agendamento adicionado com sucesso!');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $agendamentos = Agendamento::find($id);
      if(!$agendamentos){
          abort(404);
      }
      return view('agendamentos.details')->with('detailpage', $agendamentos);        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $agendamento = Agendamento::find($id);
      if(!$agendamento){
          abort(404);
      }
      return view('agendamento.edit')->with('detailpage', $agendamento);
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

      $agendamento = Agendamento::find($id);
      $agendamento->id_usuario_cancelamento = Auth::id();
      $agendamento->motivo_cancelamento = $request->motivo_cancelamento;
      
      $agendamento->save();

      return redirect('agendamentos')->with('message', 'Agendamento cancelado!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $agendamento = Agendamento::find($id);
      $agendamento->delete();
      return redirect('agendamentos')->with('message', 'Agendamento apagado com sucesso!');
    }


    public function agendar(Agendamento $agendamento)
    {           
        $id_cliente = Auth::id();
        $agendamentos = $agendamento->get();
        $agendamentosJson = Agendamento::all()->toJson();       
       
        $veiculos = $col=Veiculo::where('id_cliente', '=', $id_cliente)->get();
            
        return view('agendar.index', ['veiculos' => $veiculos, 'id_cliente' => $id_cliente]);
    }

    public function finalizarAgendamento(Request $request)
    {           
        $id_veiculo = 0;   
        $veiculo = new Veiculo;
        if ($request->id_veiculo == -1){
            
          $veiculo->id_cliente = $request->id_cliente;
          $veiculo->marca = $request->marca;
          $veiculo->modelo = $request->modelo;
          $veiculo->ano = $request->ano;
          $veiculo->placa = $this->unmask($request->placa);
          
          $veiculo->save();
          $id_veiculo = $veiculo->id;

        } else {

          $id_veiculo = $request->id_veiculo;
        }

        $unidade = Unidade::where('cidade', $request->location)->first();

        $dataMarcacao = explode("/", $request->marcacao);

        $agendamento = new Agendamento;
        $agendamento->id_unidade = $unidade->id;
        $agendamento->id_cliente = $request->id_cliente;
        $agendamento->id_veiculo = $id_veiculo;
        $agendamento->marcacao = $dataMarcacao[2] . '-' . $dataMarcacao[1] . '-' . $dataMarcacao[0];
        $agendamento->save();

        $cliente = Cliente::where('id_usuario', '=', $agendamento->id_cliente)->first();
        $usuario = Usuario::find($cliente->id_usuario);
        $cliente->telefones = $usuario->telefones;
        $cliente->email = $usuario->email;
        $veiculo = Veiculo::find($agendamento->id_veiculo);
        return view('agendar.sucesso', ['dataAgendamento' => $request->marcacao . ' 08:00', 'cliente' => $cliente, 'unidade' => $unidade, 'veiculo' => $veiculo]);

    }


   public function diasFinalSemana($dataInicio, $dias, $formato)
    {
     
      $diasRetorno = "";  
      $dataConvertida = new DateTime($dataInicio);
      
      for($i=0; $i<=$dias; $i++)
      { 
          
        $timeStamp=strtotime($dataConvertida->format('m/d/Y'));

        $diaSemana = date('w', $timeStamp);

        if ($diaSemana == '0' || $diaSemana == '6') {
          $diasRetorno .= date($formato, $timeStamp).',';
        }

        $dataConvertida->add(new DateInterval('P1D'));
       
      }
      return $diasRetorno;

    }


    public function obterDatasBloqueadas($id_unidade){
      
      $agendamentos=Agendamento::where('id_unidade','=', $id_unidade)->whereNull('id_usuario_cancelamento')->pluck('marcacao');
      $agendamento = "";
      for ($i=0; $i < count($agendamentos); $i++){
        $date = new DateTime($agendamentos[$i]);
        
        if ($i == 0){
          $agendamento .= $date->format('m/d/Y');
        } else {
          $agendamento .= "," . $date->format('m/d/Y');
        }
          
      }
      
      $diasBloqueados = $this->diasFinalSemana('2017-12-18', 365*2, 'm/d/Y') . $agendamento;
      
      return ($diasBloqueados);  

    }



    public function obterDatasLivresUnidade(Request $request)
    {

      $val=$request->val;
      $col=Unidade::where('cidade',$val)->first();

      $atributos = [
          'data-format' => 'd/m/Y',
          'data-disabled-days' => $this->obterDatasBloqueadas($col->id),
          'data-lang' => 'pt',
          'data-large-mode' => 'true',
          'data-large-default' => 'true',
          'data-lock' => 'from',
          'data-min-year' => date("Y"),
          'data-max-year' => date("Y") + 1,
      ];


      return $atributos;
    }

    public function unmask($value)
    {
      return str_replace( ['.', '-'], '', $value);
    }


    public function obterCalendarioUnidade(Request $request)
    {
      $val=$request->val;
     
      $unidade=Unidade::where('cidade',$val)->first();

      $calendarioAgendamentos = DB::table('agendamento')
          ->join('cliente', 'agendamento.id_cliente', '=', 'cliente.id')
          ->join('veiculo', 'agendamento.id_veiculo', '=', 'veiculo.id')
          ->select('agendamento.marcacao as start',  
                   DB::raw('CONCAT(cliente.nome, " ", cliente.sobrenome, " - ", veiculo.marca, " ", veiculo.modelo , " ", veiculo.ano) as title'))
          ->where('agendamento.id_unidade', '=', $unidade->id)
          ->whereNull('agendamento.id_usuario_cancelamento')
          ->get();     
      
        $resultAgendamentosJson = $calendarioAgendamentos->toJson();        
      return json_decode(stripslashes($resultAgendamentosJson));
    }
}