<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index() {
        $veiculos = Carro::all()->where('user_id', Auth::user()->id);

        return view('admin.listaVeiculos', ['veiculos' => $veiculos]);
    }

    public function register()
    {
        $marcas = DB::table('marcas')
            ->select('*')
            ->whereExists(function ($query) {
                $query->from('modelos')
                    ->select('id')
                    ->where('id','=',DB::raw('marcas.id'));
            })
            ->orderBy('name')
            ->get();

        return view('admin.cadastrarVeiculo', ['marcas' => $marcas]);
    }

    public function create(Request $request) {
        $credentials = $request->validate([
            'marca'  => ['required'],
            'modelo' => ['required'],
            'placa'  => ['required'],
            'ano'    => ['required']
        ],[
            'marca.required'  => 'Campo marca obrigatório!',
            'modelo.required' => 'Campo model obrigatório!',
            'placa.required'  => 'Campo placa obrigatório!',
            'ano.required'    => 'Campo ano obrigatório!'
        ]);

        $create = Carro::create([
            'user_id' => Auth::user()->id,
            'marca_id' => $request->input('marca'),
            'modelo_id' => $request->input('modelo'),
            'placa' => $request->input('placa'),
            'ano' => $request->input('ano')
        ]);

        if ($create) {
            return redirect()->route('vehicle.register')->with('sucess', 'Veículo cadastrado com sucesso');
        }

        return redirect()->route('vehicle.register')->with('error', 'Erro ao cadastrar veículo');
    }

    public function edit(Request $request, $id)
    {
        $credentials = $request->validate([
            'placa'  => ['required'],
            'ano'    => ['required']
        ],[
            'placa.required'  => 'Campo placa obrigatório!',
            'ano.required'    => 'Campo ano obrigatório!'
        ]);

        $carro = Carro::find($id);
        $carro->placa = $request->input('placa');
        $carro->ano = $request->input('ano');

        if ($carro->save()) {
            return redirect()->route('vehicle.show', $id)->with('sucess', 'Veículo editado com sucesso');
        }

        return redirect()->route('vehicle.show', $id)->with('error', 'Erro ao editar veículo');
    }

    public function getModelCar($id)
    {
        return  DB::table('modelos')
            ->select('*')->where('marca_id', $id)
            ->whereExists(function ($query) {
                $query->from('marcas')
                    ->select('id')
                    ->where('id','=',DB::raw('modelos.marca_id'));
            })
            ->orderBy('name')
            ->get();
    }

    public function show($id)
    {
        $veiculo = Carro::find($id);
        return view('admin.editarVeiculo', ['veiculo' => $veiculo]);
    }

    public function delete($id)
    {
        $veiculo = Carro::find($id);
        Maintenance::where('modelo_id', $veiculo->id)->delete();
        $veiculo::find($id)->delete();

        return redirect()->route('vehicle.index', $id)->with('sucess', 'veículo excluido com sucesso');
    }

}
