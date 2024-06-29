<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S&E | Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800&family=Manrope:wght@300;400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @yield('styles')
</head>
<body class="flex bg-gray-100 min-h-screen" x-data="{panel:false, menu:true}">
    <aside class="flex flex-col" :class="{'hidden sm:flex sm:flex-col': window.outerWidth > 768}">
        <a href="#" class="inline-flex items-center justify-center h-20 w-full bg-[#171C30]">
            <span class="text-white text-3xl ml-2 font-GreatVibes flex gap-2" x-show="menu">
                S<img src="{{ asset('images/icon-heart.png') }}" alt="heart" class="w-9">E
            </span>
        </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-[#171C30]">
            <nav class="flex flex-col mx-4 my-6 space-y-4">
                <a href="#" class="inline-flex items-center py-3 text-blue-600 bg-white rounded-lg px-2" :class="{'justify-start': menu, 'justify-center': menu == false}">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="ml-2"  x-show="menu">Dashboard</span>
                </a>
                <a href="#" class="inline-flex items-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg px-2" :class="{'justify-start': menu, 'justify-center': menu == false}">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-2"  x-show="menu">Deseos</span>
                </a>
            </nav>
        </div>
    </aside>
    <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
            {{-- <div class="mr-8 cursor-pointer" @click="menu = !menu" >
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div> --}}
            <div class="flex flex-shrink-0 items-center ml-auto">
                <span class="sr-only">User Menu</span>
                <span class="relative inline-flex items-center p-2 hover:bg-gray-100 focus:bg-gray-100 rounded-lg">
                    <div class="hidden md:flex md:flex-col md:items-end md:leading-tight" >
                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                </span>
                <div class="border-l pl-3 ml-3 space-x-1 block">
                    <a
                        href="{{ route('logout') }}"
                        class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full block"
                    >
                        <span class="sr-only">Log out</span>
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        @yield('content')

    </div>
    @yield('scripts')
  </body>
</html>
