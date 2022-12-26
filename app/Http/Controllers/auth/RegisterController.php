<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('admin.register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'email' => ['required', 'email', 'unique:users',],
            'password' => 'required',
            'passwordConfirm' => ['required', 'same:password'],
        ],[
            'user.required' => 'Preencha o campo de usúario',
            'email.required' => 'Preencha o campo de email.',
            'email.unique' => 'Email já cadastrado!',
            'email.email' => 'Email inválido',
            'password.required' => 'Preencha o campo de senha',
            'passwordConfirm.required' => 'Preencha o campo de confirmar senha',
            'passwordConfirm.same' => 'Senha e confirmar senha não correspondem!'
        ]);

        $createUser = User::create([
            'name'     => $request->input('user'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($createUser) {
            $credentials = [
                'email'    => $request->input('email'),
                'password' => $request->input('password')
            ];
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/');
            }
        }
        return redirect()->route('admin.register.register')->with('error', 'Erro ao realizar cadastro, tente novamente!');
    }
}
