<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S&E | Panel Administrador</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[url('/images/background.webp')] bg-cover bg-no-repeat w-max h-max bg-center">
    <div class="flex w-screen h-screen justify-center items-cente">
        <div class="bg-[#262626] mx-auto my-auto py-7 px-10 bg-opacity-80 w-12/12 md:w-3/12">
            <img src="{{ asset('images/services2-1.png') }}" alt="" class="mx-auto my-auto">
            <h1 class="font-bold text-2xl text-white pb-2 text-center">Panel Administrativo</h1>
            <hr>
            <form action="{{route('auth')}}" method="POST">
                @csrf
                <div class="mt-5">
                    <label
                        for="email"
                        class="relative block rounded border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 px-4 py-2 text-white"
                    >
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                            placeholder="email"
                        />

                        <span
                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-[rgba(38,38,38,0.8)] opacity-90 p-0.5 text-xs text-white transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                        >
                            Correo electrónico
                        </span>
                    </label>
                </div>
                <div class="mt-5">
                    <label
                        for="password"
                        class="relative block rounded border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 px-4 py-2 text-white"
                    >
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                            placeholder="Username"
                        />

                        <span
                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-[rgba(38,38,38,0.8)] bg-opacity-90 p-0.5 text-xs text-white transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                        >
                            Contraseña
                        </span>
                    </label>
                </div>

                @if ($errors->any())
                {{-- Listado de errores --}}
                <div class="mt-5 bg-red-100 text-red-800 px-2 py-2 border-l-4 border-l-red-800 flex">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mt-5">
                    <button class="w-full bg-gradient-to-r from-[#F1B8A7] to-[#AB849B] !bg-opacity-100 px-4 py-2 font-bold" type="submit">
                        Acceder
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
