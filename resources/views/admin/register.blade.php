<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Registrar
                </h1>
                <form method="POST" action="{{ route('admin.create') }}" class="space-y-4 md:space-y-6" id="formulario" >
                    @csrf
                    <div>
                        <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuário</label>
                        <input type="user" name="user" id="user" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="passwordConfirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar senha</label>
                        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Já tem uma conta? <a href="{{ route('admin.login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Entrar</a>
                    </p>
                </form>
            </div>
        </div>
        @if (($errors->any() || session('error')))
        <div role="alert" class="mt-5 max-w-1/1 relative" id="alertLogin">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-3">
                Erro
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" id="closeAlert">
                    <svg class="fill-current h-6 w-6 text-slate-200" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"></path></svg>
                  </span>
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                @if(session('error'))
                    <p>{{ session('error') }}</p>
                @else
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
<script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
<script>

    let form = document.getElementById('formulario');
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        let senha = document.getElementById('password');
        let confirmarSenha = document.getElementById('passwordConfirm');

        if (senha.value != confirmarSenha.value) {
            // let box = document.getElementById('alertLogin');
            // box.innerHTML = '<p class="text-red-500 text-xs italic">Senha e confirmar senha não correspondem!</p>';
            senha.classList.add('border-red-500');
            confirmarSenha.classList.add('border-red-500');
        }else {
            form.submit();
        }
    });

    let close = document.getElementById("closeAlert");
    if(close) {
        close.onclick = function() {
            let alert = document.getElementById("alertLogin");
            alert.remove();
        }
    }
</script>
</body>
</html>
