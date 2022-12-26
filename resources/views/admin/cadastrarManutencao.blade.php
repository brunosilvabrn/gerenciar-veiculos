@extends('layout.app')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="text-center my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Cadastrar manutenção
            </h2>

            <form method="POST" action="{{ route('manintence.create') }}" class="flex flex-wrap justify-between px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                @csrf

                <label class="block text-sm p-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Veiculo
                    </label>
                    <div class="relative">
                        <select name="modelo" style="width: 150px" class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="grid-state">
                            <option value="">Selecionar</option>
                            @foreach($veiculos as $veiculo)
                                <option value="{{ $veiculo->id }}">{{ $veiculo->marca->name }} - {{ $veiculo->modelo->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </label>

                <label class="block text-sm p-2">
                    <span class="text-gray-700 dark:text-gray-400">Data prevista manutenção</span>
                    <input type="date" name="data"
                           class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    />
                </label>

                <label class="block text-sm p-2 w-full">
                    <span class="text-gray-700 dark:text-gray-400">Descrição</span>
                    <textarea width="100%" name="descricao"
                              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                              placeholder="2022"
                    ></textarea>
                </label>

                <div class="block w-full text-center">
                    <button type="submit" class="mt-6 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Cadastrar manutenção
                    </button>
                </div>
            </form>
            @if(session('sucess'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-2 pr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-center w-full">
                            <p class="font-bold text-lg">{{ session('sucess') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any() || session('error'))
                <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="text-center w-full">
                            @if(session('error'))
                                <p class="font-bold text-lg">{{ session('error') }}</p>
                            @else
                                @foreach ($errors->all() as $error)
                                    <p class="font-bold text-lg">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
