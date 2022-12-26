<?php

namespace App\Http\Controllers;

use Carbon;
use App\Models\Carro;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{

    public function index()
    {
        $idUser = Auth::user()->id;
        $manutencoes = Maintenance::all()->where('user_id', $idUser)->where('ativo', 1);

        return view('admin.listaManutencao', ['manutencoes' => $manutencoes]);
    }

    public function register()
    {
        $veiculos = Carro::all()->where('user_id', Auth::user()->id);

        return view('admin.cadastrarManutencao', ['veiculos' => $veiculos]);
    }

    public function getManutencoes($userId)
    {
        $dados = DB::table('maintenances')
            ->leftJoin('carros', 'carros.id', '=', 'maintenances.modelo_id')
            ->leftJoin('modelos', 'modelos.id', '=', 'carros.id')
            ->leftJoin('marcas', 'marcas.id', '=', 'modelos.id')
            ->where('maintenances.ativo', '=', '1')
            ->where('maintenances.user_id', $userId)
            ->get();

        return $dados;
    }

    public function create(Request $request)
    {
        $request->validate([
            'modelo'  => ['required'],
            'data' => ['required'],
            'descricao'  => ['required'],
        ],[
            'modelo.required' => 'Campo de modelo obrigatório!',
            'data.required' => 'Campo de placa obrigatório!',
            'descricao.required' => 'Campo de descrição obrigatório!'
        ]);

        $create = Maintenance::create([
            'user_id' => Auth::user()->id,
            'modelo_id' => $request->input('modelo'),
            'descricao' => $request->input('descricao'),
            'data' => Carbon\Carbon::createFromFormat('Y-m-d', $request->input('data'))->format('Y-m-d 00:00:00')
        ]);

        if ($create) {
            return redirect()->route('manintence.register')->with('sucess', 'Manutenção cadastrada com sucesso');
        }

        return redirect()->route('manintence.register')->with('error', 'Erro ao cadastrar manutenção');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'modelo'  => ['required'],
            'data' => ['required'],
            'descricao'  => ['required'],
        ],[
            'modelo.required' => 'Campo de modelo obrigatório!',
            'data.required' => 'Campo de placa obrigatório!',
            'descricao.required' => 'Campo de descrição obrigatório!'
        ]);

        $manutencao = Maintenance::find($id);
        $manutencao->modelo_id = $request->input('modelo');
        $manutencao->data = $request->input('data');
        $manutencao->descricao = $request->input('descricao');

        if ($manutencao->save()) {
            return redirect()->route('maintenance.show', $id)->with('sucess', 'Manutenção editada com sucesso');
        }

        return redirect()->route('maintenance.show', $id)->with('error', 'Erro ao editar manutenção');
    }

    public function show($id)
    {
        $modelos = Carro::all()->where('user_id', Auth::user()->id);
        $manutencao = Maintenance::find($id);

        return view('admin.editarManutencao', ['manutencao' => $manutencao, 'modelos' => $modelos]);
    }

    public function finalize($id)
    {
        $manutencao = Maintenance::find($id);
        $manutencao->ativo = 0;
        $manutencao->save();

        return redirect()->route('maintenance.index', $id)->with('sucess', 'Manutenção finalizada com sucesso');;
    }

    public function delete($id)
    {
        $manutencao = Maintenance::find($id);
        $manutencao->delete();

        return redirect()->route('maintenance.index', $id)->with('sucess', 'Manutenção excluida com sucesso');
    }
}
