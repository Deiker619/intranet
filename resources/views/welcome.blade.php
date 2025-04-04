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
                            <a href="{{ url('/dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm  text-sky-400 hover:text-white bg-white hover:bg-sky-400 transition duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-3 py-2 rounded-md text-sm font-extrabold text-sky-400 hover:text-white bg-white hover:bg-sky-400 transition duration-300 relative inline-block">
                                Ingresar

                            </a>
                            {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-3 py-2 rounded-md text-sm font-extrabold text-blue-400 hover:bg-sky-100 transition duration-300">
                        Registrarse
                    </a>
                    @endif --}}
                        @endauth
                    </nav>
                @endif

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class=" text-sky-400 focus:outline-none">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="md:hidden hidden ">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-sky-400 hover:text-white bg-sky-700 hover:bg-sky-400 transition duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-sky-400 hover:text-white hover:bg-sky-400 transition duration-300">
                        Ingresar
                    </a>
                    {{-- @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-sky-700 transition duration-300">
                    Registrarse
                </a>
                @endif --}}
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div
        class="min-h-[50vh] p-4 flex flex-col justify-center items-center bg-gradient-to-r from-sky-400 to-blue-600 text-white">
        <h1 class="text-7xl font-bold mb-4 animate-fade-in">
            Sistema de <span class="text-sky-200">Recursos Humanos</span>
        </h1>
        <p class="text-xl text-sky-100 max-w-2xl text-center animate-fade-in-up">
            Gestiona y verifica tus recibos de pago de manera rápida y segura. Accede a toda la información relevante
            sobre tu estado actual desde nuestro sitio.
        </p>
        <a href="{{ route('login') }}">
            <button type="button"
                class="py-2.5 px-5 me-2 mt-4 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Inicia
                sesión</button>
        </a>
    </div>


    <!-- cards Section -->
    <div class="py-16 bg-gradient-to-r from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!--card numero 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-5 h-5 inline-block">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="green"
                                d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zM272 192l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16zM164 152l0 13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9l0 13.8c0 11-9 20-20 20s-20-9-20-20l0-14.6c-10.3-2.2-20-5.5-28.2-8.4c0 0 0 0 0 0s0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5l0-14c0-11 9-20 20-20s20 9 20 20z" />
                        </svg>
                        Gestión de tus recibos de pagos
                    </h3>
                    <p class="text-gray-700">Averigua todos tus recibos de pago de manera rápida y segura</p>

                </div>


                <!--card numero 2 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 inline-block">

                            <path fill="brown"
                                d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z" />
                        </svg>
                        Generar constancia de trabajo
                    </h3>
                    <p class="text-gray-700"> Imprime y genera tu constancia de trabajo en cualquier momento</p>

                </div>


                <!--card numero 3 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 inline-block">
                            <path fill='orange'
                                d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z" />
                        </svg>
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
                    <img src="https://blog.xubio.com/wp-content/uploads/2020/07/PrinicipiantesMINI.jpg" alt=""
                        class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-300">
                </div>
                <div class="w-full md:w-1/2 pl-8 mt-8 md:mt-0">
                    <p class="text-lg text-gray-700 font-semibold italic">
                        Este es el sitio oficial de la institución, donde podrás verificar tus recibos de pago y acceder
                        a más información acerca de tu estado actual. Diseñado para ser intuitivo y fácil de usar,
                        nuestro sistema te permite gestionar tus finanzas y constancias de manera eficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- component -->
    <!-- Foooter -->
    <section class="bg-sky-500">
        <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
            <nav class="flex flex-wrap justify-center -mx-5 -my-2">

                <div class="px-5 py-2">
                    <a href="http://misionjosegregoriohernandez.gob.ve/?page_id=44"
                        class="text-base leading-6 text-white hover:text-white">
                        Quienes somos
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="http://misionjosegregoriohernandez.gob.ve/"
                        class="text-base leading-6 text-white hover:text-white">
                        Blog
                    </a>
                </div>

                <div class="px-5 py-2">
                    <a href="http://misionjosegregoriohernandez.gob.ve/?page_id=28"
                        class="text-base leading-6 text-white hover:text-white">
                        Contacto
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="http://misionjosegregoriohernandez.gob.ve/?page_id=6427"
                        class="text-base leading-6 text-white hover:text-white">
                        Servicios
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="" class="text-base leading-6 text-white hover:text-white">
                        Terminos y condiciones
                    </a>

                </div>

                <div class="px-5 py-2">
                    <a href="" class="text-base leading-6 text-white hover:text-white">
                        Privacidad
                    </a>

                </div>

            </nav>
            <div class="flex justify-center mt-8 space-x-6">
                <a href="https://www.facebook.com/FMisionJGH?locale=es_LA" class="text-white hover:text-white">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/fmisionjgh/#" class="text-white hover:text-white">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
        
            </div>
            <p class="mt-8 text-base leading-6 text-center text-white">
                © 2025 FMJGH. Todos los derechos reservados.
            </p>
        </div>
    </section>

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
