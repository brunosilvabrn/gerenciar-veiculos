<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
        $veiculos = Carro::all()->where('user_id', $idUser);
        $manutencoes = Maintenance::all()->where('user_id', $idUser);

        return view('admin.home', ['veiculos' => $veiculos, 'manutencoes' => $manutencoes]);
    }
}
