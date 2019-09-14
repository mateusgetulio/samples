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
      // Get all data necessary via SQL
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

      // Parse to JSON
      $agendamentosJson = $agendamentos->toJson();  

      // Get the calendar data
      $calendarioAgendamentos = DB::table('agendamento')
          ->join('cliente', 'agendamento.id_cliente', '=', 'cliente.id')
          ->join('veiculo', 'agendamento.id_veiculo', '=', 'veiculo.id')
          ->select('agendamento.marcacao as start',  
                   DB::raw('CONCAT(cliente.nome, " ", cliente.sobrenome, " - ", veiculo.marca, " ", veiculo.modelo , " ", veiculo.ano) as title'))
          ->where('agendamento.id_unidade', '=', Unidade::get()->first()->id)
          ->get();     
      
      // Parse to JSON
      $calendarioAgendamentosJson = $calendarioAgendamentos->toJson();          

      // Return the index view
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

      // Return the appointment view
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

      // Create a new record
      $agendamento = new Agendamento;
      $agendamento->id_unidade = $request->id_unidade;
      $agendamento->id_cliente = $request->id_cliente;
      $agendamento->id_veiculo = $request->id_veiculo;
      $agendamento->marcacao = $request->marcacao;
      
      // Save it
      $agendamento->save();

      // Return the appointment view
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
      // Find the appointment
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
      // Find the appointment
      $agendamento = Agendamento::find($id);
      if(!$agendamento){
          abort(404);
      }

      // Return the edit view
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
      // Find the appointment
      $agendamento = Agendamento::find($id);
      $agendamento->id_usuario_cancelamento = Auth::id();
      $agendamento->motivo_cancelamento = $request->motivo_cancelamento;
      
      // Save the appointment
      $agendamento->save();

      // Return the appointment view
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
      // Find the appointment
      $agendamento = Agendamento::find($id);
      
      // Delete the appointment
      $agendamento->delete();
      
      // Return the appointment view
      return redirect('agendamentos')->with('message', 'Agendamento apagado com sucesso!');
    }


    public function agendar(Agendamento $agendamento)
    {           
        // Link the appointment with the customer
        $id_cliente = Auth::id();
        $agendamentos = $agendamento->get();
        $agendamentosJson = Agendamento::all()->toJson();       
       
        $veiculos = $col=Veiculo::where('id_cliente', '=', $id_cliente)->get();
        
        // Return the index view
        return view('agendar.index', ['veiculos' => $veiculos, 'id_cliente' => $id_cliente]);
    }

    public function finalizarAgendamento(Request $request)
    {           
        // Save the appointment by linking the customer, the branch and the vehicle
        $id_veiculo = 0;   
        $veiculo = new Veiculo;
        if ($request->id_veiculo == -1){
          
          // Vehicle info
          $veiculo->id_cliente = $request->id_cliente;
          $veiculo->marca = $request->marca;
          $veiculo->modelo = $request->modelo;
          $veiculo->ano = $request->ano;
          $veiculo->placa = $this->unmask($request->placa);
          // Save the vehicle
          $veiculo->save();
          // Fetch the saved vehicle ID
          $id_veiculo = $veiculo->id;

        } else {
          // If the vehicle already exists, then obtain its ID
          $id_veiculo = $request->id_veiculo;
        }

        // Find the branch
        $unidade = Unidade::where('cidade', $request->location)->first();

        // Appointment date
        $dataMarcacao = explode("/", $request->marcacao);

        $agendamento = new Agendamento;
        $agendamento->id_unidade = $unidade->id;
        $agendamento->id_cliente = $request->id_cliente;
        $agendamento->id_veiculo = $id_veiculo;
        $agendamento->marcacao = $dataMarcacao[2] . '-' . $dataMarcacao[1] . '-' . $dataMarcacao[0];
        
        // Save appointment
        $agendamento->save();

        $cliente = Cliente::where('id_usuario', '=', $agendamento->id_cliente)->first();
        $usuario = Usuario::find($cliente->id_usuario);
        $cliente->telefones = $usuario->telefones;
        $cliente->email = $usuario->email;
        $veiculo = Veiculo::find($agendamento->id_veiculo);
        
        // Return the appointment view
        return view('agendar.sucesso', ['dataAgendamento' => $request->marcacao . ' 08:00', 'cliente' => $cliente, 'unidade' => $unidade, 'veiculo' => $veiculo]);

    }


   // Get the weekend days to avoid scheduling a vehicle repair on them
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

    // Get the blocked days to avoid scheduling a vehicle repair on them
    public function obterDatasBloqueadas($id_unidade){
      
      // Find the appointment
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


    // Get the free days to schedule the vehicle repair on them
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

    // CPF unmask function
    public function unmask($value)
    {
      return str_replace( ['.', '-'], '', $value);
    }

    // Get each branch schedule
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