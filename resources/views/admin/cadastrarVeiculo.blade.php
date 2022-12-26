@extends('layout.app')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Cadastrar novo veiculo</h2>
            <form method="POST" action="{{ route('vehicle.create') }}" class="flex flex-wrap justify-evenly px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                @csrf

                <label class="block text-sm p-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Marca
                    </label>
                    <div class="relative">
                        <select name="marca" id="marcas" onclick="clickModelo()" class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="grid-state">
                            <option value="">Selecione</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" >{{ $marca->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </label>

                <label class="block text-sm p-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Modelo
                    </label>
                    <div class="relative">
                        <select name="modelo" style="width: 130px" id="selectOptionModelo"  class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="grid-state">
                            <option id="selectOptionModelo" value="">Selecione</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </label>

                <label class="block text-sm p-2">
                    <span class="text-gray-700 dark:text-gray-400">Placa</span>
                    <input name="placa"
                        class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="AAA-0000"
                    />
                </label>


                <label class="block text-sm p-2">
                    <span class="text-gray-700 dark:text-gray-400">Ano Fabricação</span>
                    <input name="ano"
                        class="block w-50 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="2022"
                    />
                </label>

                <div class="block w-full text-center">
                    <button type="submit"
                        class="mt-6 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Cadastrar veiculo
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
    <script>
        let modelo = document.getElementById("selectModelo");

        function clickModelo() {
            let select = document.getElementById("marcas");
            let idMarca = select.options[select.selectedIndex].value;
            let boxSelectModelo = document.getElementById("selectOptionModelo");
            let route = "{{ route('api.vehicleModel', ':id') }}"
            route = route.replace(":id", idMarca);
            let htmlSelect = "";

            if (idMarca !== '') {

                fetch(route, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain",
                    },
                    method: 'GET',
                    }).then((dataResponse) => {
                        return dataResponse.json()
                    }).then((data) => {
                    Object.keys(data).forEach(function(item){
                            console.log(data[item])
                            htmlSelect += "<option value=" + data[item].id +" >" + data[item].name +  "</option>"
                        });

                        boxSelectModelo.innerHTML = htmlSelect;
                });
            }

        }
    </script>
@endsection
