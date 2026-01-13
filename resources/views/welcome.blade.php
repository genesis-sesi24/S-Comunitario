<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Batalla - Sistema Comunitario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-lb-primary via-lb-primary-dark to-lb-secondary min-h-screen">
    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-lb-accent rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10">
        <!-- Header -->
        <header class="container mx-auto px-6 py-6">
            <nav class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-lb-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="text-white">
                        <h1 class="font-display text-xl font-bold">La Batalla</h1>
                        <p class="text-xs opacity-90">Sistema Comunitario</p>
                    </div>
                </div>

                @if (Route::has('login'))
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/home') }}" class="px-5 py-2.5 bg-white text-lb-primary font-semibold rounded-lg shadow-md hover:shadow-lg transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-medium rounded-lg hover:bg-white/20 transition">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-white text-lb-primary font-semibold rounded-lg shadow-md hover:shadow-lg transition">Registrarse</a>
                        @endif
                    @endauth
                </div>
                @endif
            </nav>
        </header>

        <!-- Hero Section -->
        <main class="container mx-auto px-6 py-12 md:py-20">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-12">
                    <!-- Icon Hero -->
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-lb-primary to-lb-primary-light rounded-2xl shadow-lg flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z"/>
                            <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z"/>
                            <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z"/>
                        </svg>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-display font-bold text-slate-900 text-center mb-4">Bienvenido a La Batalla</h2>
                    <p class="text-lg text-slate-600 text-center mb-8 max-w-2xl mx-auto">
                        Sistema integral de gestión de salud comunitaria. Cuidando a las familias de nuestra comunidad con profesionalismo y dedicación.
                    </p>

                    @if (Route::has('login'))
                        @auth
                            <div class="text-center">
                                <a href="{{ url('/home') }}" class="inline-block px-8 py-3 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition">
                                    Acceder al Sistema
                                </a>
                            </div>
                        @else
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition">
                                    Ingresar al Sistema
                                </a>
                            </div>
                        @endauth
                    @endif

                    <!-- Features -->
                    <div class="grid md:grid-cols-3 gap-6 mt-12">
                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                            <div class="w-12 h-12 bg-lb-primary/10 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-lb-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 mb-2">Fichas Familiares</h3>
                            <p class="text-sm text-slate-600">Registro y seguimiento detallado de las familias de la comunidad.</p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                            <div class="w-12 h-12 bg-emerald-500/10 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z" clip-rule="evenodd"/>
                                    <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 01-3 0V6.75z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 mb-2">Gestión Territorial</h3>
                            <p class="text-sm text-slate-600">Organización por sectores y calles de la comunidad.</p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                            <div class="w-12 h-12 bg-amber-500/10 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 mb-2">Reportes Comunitarios</h3>
                            <p class="text-sm text-slate-600">Estadísticas y análisis de salud de la población.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="container mx-auto px-6 py-8 text-center text-white/80">
            <p>&copy; {{ date('Y') }} La Batalla - Sistema Comunitario. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
