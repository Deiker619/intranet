<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intranet</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Tailwind CSS v3.4.17 */
            /* ... (Tailwind CSS styles) ... */
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-white">
    <!-- navegador -->
    <header class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-blue-400 text-lg font-bold">
                        <img src="{{ asset('img/logo3.6.png') }}" alt="Logo" class="h-16">
                        
                    </a>
                </div>

                <!-- Navigation Links -->
                @if (Route::has('login'))
                <nav class="hidden md:flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded-md text-sm  text-white bg-sky-700 hover:bg-sky-100 transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-extrabold text-blue-400 hover:bg-sky-100 transition duration-300">
                            Ingresar
                        </a>
                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm font-extrabold text-blue-400 hover:bg-sky-100 transition duration-300">
                                Registrarse
                            </a>
                        @endif --}}
                    @endauth
                </nav>
                @endif

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-sky-700 hover:bg-sky-800 transition duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-sky-700 transition duration-300">
                        Ingresar
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-sky-700 transition duration-300">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="min-h-[50vh] flex flex-col justify-center items-center bg-gradient-to-r from-sky-400 to-blue-600 text-white">
        <h1 class="text-7xl font-bold mb-4 animate-fade-in">
            Sistema <span class="text-sky-200">Oficial</span> de Recibos
        </h1>
        <p class="text-xl text-sky-100 max-w-2xl text-center animate-fade-in-up">
            Gestiona y verifica tus recibos de pago de manera rápida y segura. Accede a toda la información relevante sobre tu estado actual desde nuestro sitio.
        </p>
    </div>


    <!-- cards Section -->
    <div class="py-16 bg-gradient-to-r from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!--card numero 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">
                        Gestion de tus recibos de pago
                    </h3>
                    <p class="text-gray-700">Averigua todos tus recibos de pago de manera rápida y segura</p>
              
                </div>

                  
                <!--card numero 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">
                        Generar constancia de pago
                    </h3>
                    <p class="text-gray-700"> Imprime y genera tu constancia de pago en cualquier momento</p>
                   
                </div>

                  
                <!--card numero 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">
                    Revisa tu historial de pagos
                    </h3>
                    <p class="text-gray-700">Descubre tu historial de pagos a lo largo del año</p>
        
                </div>



            </div>

        </div>

    </div>

    <!-- About Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-blue-900 mb-8 text-center">
                ¿De qué se trata el sitio?
            </h2>
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 pr-8">
                    <img src="https://blog.xubio.com/wp-content/uploads/2020/07/PrinicipiantesMINI.jpg" alt="" class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-300">
                </div>
                <div class="w-full md:w-1/2 pl-8 mt-8 md:mt-0">
                    <p class="text-lg text-gray-700 font-semibold italic">
                        Este es el sitio oficial de la institución, donde podrás verificar tus recibos de pago y acceder a mucha más información acerca de tu estado actual. Diseñado para ser intuitivo y fácil de usar, nuestro sistema te permite gestionar tus finanzas de manera eficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-sky-400 text-white py-8 font-bold ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">
                &copy; 2025 FMJGH. Todos los derechos reservados. 

                <br>
                
                Despacho de presidencia
            </p>
        </div>
    </footer>

    <!-- Script for Mobile Menu -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>