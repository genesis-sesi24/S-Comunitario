<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Batalla - Sistema Comunitario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="gradient-animated min-h-screen overflow-x-hidden">
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-lb-accent/10 rounded-full blur-3xl" style="animation: float 8s ease-in-out infinite;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-lb-primary-light/5 rounded-full blur-3xl" style="animation: float 10s ease-in-out infinite;"></div>
    </div>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La Batalla - Comunidad Digital</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'DM Sans', sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; } 
        </style>
    </head>
    <body class="antialiased text-slate-700 bg-[#f8fafc] selection:bg-blue-200 selection:text-blue-900 overflow-x-hidden">

        <!-- Navigation -->
        <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-4 px-6 md:px-12 bg-white/80 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="#" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform">L</div>
                    <span class="text-xl font-bold text-slate-800 tracking-tight">La Batalla</span>
                </a>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Características</a>
                    <a href="#about" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Nosotros</a>
                    <div class="flex items-center gap-4 ml-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="px-5 py-2.5 rounded-xl bg-blue-50 text-blue-700 font-semibold hover:bg-blue-100 transition-all">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-semibold shadow-lg shadow-slate-200 hover:shadow-xl hover:-translate-y-0.5 transition-all">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
             <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-b border-slate-100 p-4 shadow-xl md:hidden flex-col gap-4">
                <a href="#features" class="block py-2 text-slate-600 font-medium">Características</a>
                <a href="#about" class="block py-2 text-slate-600 font-medium">Nosotros</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="block py-2 text-blue-600 font-bold">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 text-slate-800 font-bold">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block py-2 text-blue-600 font-bold">Registrarse</a>
                        @endif
                    @endauth
                @endif
             </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- True Blue Background Blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-blue-50 rounded-full blur-3xl opacity-70 mix-blend-multiply animate-pulse-slow"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[500px] h-[500px] bg-slate-100 rounded-full blur-3xl opacity-70 mix-blend-multiply animate-pulse-slow illustration-float"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-200 shadow-sm mb-8 animate-fade-in-up">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-sm font-semibold text-slate-600">Sistema de Gestión Comunal 2.0</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-display font-bold text-slate-900 leading-tight mb-6 animate-fade-in-up delay-100">
                    Tu comunidad, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">más conectada.</span>
                </h1>

                <p class="text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed animate-fade-in-up delay-200">
                    La plataforma integral para gestionar familias, sectores y servicios comunitarios de manera eficiente, transparente y moderna.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up delay-300">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-300 hover:scale-105 hover:shadow-2xl transition-all">
                        Comenzar Ahora
                    </a>
                    <a href="#how-it-works" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white text-slate-700 border border-slate-200 font-bold text-lg hover:bg-slate-50 hover:border-slate-300 transition-all">
                        Cómo funciona
                    </a>
                </div>

                <!-- Stats Preview -->
                <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 max-w-4xl mx-auto animate-fade-in-up delay-500">
                    <div class="p-6 rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-100 shadow-lg shadow-slate-100 hover:-translate-y-1 transition-transform">
                        <p class="text-3xl font-bold text-blue-600 mb-1">1.2k+</p>
                        <p class="text-sm font-medium text-slate-500">Familias</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-100 shadow-lg shadow-slate-100 hover:-translate-y-1 transition-transform">
                        <p class="text-3xl font-bold text-slate-800 mb-1">100%</p>
                        <p class="text-sm font-medium text-slate-500">Digitalizado</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-100 shadow-lg shadow-slate-100 hover:-translate-y-1 transition-transform">
                        <p class="text-3xl font-bold text-indigo-600 mb-1">24/7</p>
                        <p class="text-sm font-medium text-slate-500">Acceso</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-100 shadow-lg shadow-slate-100 hover:-translate-y-1 transition-transform">
                        <p class="text-3xl font-bold text-sky-600 mb-1">5+</p>
                        <p class="text-sm font-medium text-slate-500">Sectores</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- Features Section -->
        <section id="caracteristicas" class="py-20 px-6">
            <div class="container mx-auto max-w-7xl">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">
                        Características Principales
                    </h2>
                    <p class="text-xl text-white/80 max-w-2xl mx-auto">
                        Herramientas diseñadas para optimizar la gestión de salud comunitaria
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass-card rounded-2xl p-8 hover-lift card-3d fade-in-up">
                        <div class="w-16 h-16 bg-gradient-to-br from-lb-primary to-lb-primary-light rounded-xl flex items-center justify-center mb-6 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">Gestión Familiar</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Registro completo de familias e integrantes con historial médico detallado y seguimiento personalizado.
                        </p>
                        <div class="mt-6 flex items-center text-lb-primary font-semibold group cursor-pointer">
                            <span>Conocer más</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass-card rounded-2xl p-8 hover-lift card-3d fade-in-up" style="animation-delay: 0.1s;">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z" clip-rule="evenodd"/>
                                <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 01-3 0V6.75z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">Organización Territorial</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Estructura por sectores, calles y viviendas para un control geográfico preciso de la comunidad.
                        </p>
                        <div class="mt-6 flex items-center text-emerald-600 font-semibold group cursor-pointer">
                            <span>Conocer más</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass-card rounded-2xl p-8 hover-lift card-3d fade-in-up" style="animation-delay: 0.2s;">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">Reportes y Análisis</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Estadísticas detalladas y reportes en tiempo real sobre la salud de la población atendida.
                        </p>
                        <div class="mt-6 flex items-center text-amber-600 font-semibold group cursor-pointer">
                            <span>Conocer más</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="como-funciona" class="py-20 px-6 pattern-dots">
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">
                        ¿Cómo Funciona?
                    </h2>
                    <p class="text-xl text-white/80 max-w-2xl mx-auto">
                        Proceso simple y eficiente en 4 pasos
                    </p>
                </div>

                <div class="relative">
                    <!-- Timeline Line (visible on desktop) -->
                    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-lb-primary via-lb-secondary to-lb-primary-light transform -translate-x-1/2"></div>

                    <!-- Steps -->
                    <div class="space-y-12">
                        <!-- Step 1 -->
                        <div class="relative fade-in-up">
                            <div class="md:flex items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right">
                                    <div class="glass-card rounded-2xl p-8 hover-lift">
                                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">1. Registro Inicial</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Crea tu cuenta y completa los datos básicos de tu perfil. El proceso es rápido y seguro.
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-lb-primary rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-white font-bold">1</span>
                                </div>
                                <div class="md:w-1/2 md:pl-12"></div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative fade-in-up" style="animation-delay: 0.1s;">
                            <div class="md:flex items-center">
                                <div class="md:w-1/2 md:pr-12"></div>
                                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-lb-secondary rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-white font-bold">2</span>
                                </div>
                                <div class="md:w-1/2 md:pl-12">
                                    <div class="glass-card rounded-2xl p-8 hover-lift">
                                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">2. Configuración</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Configura las familias, sectores y estructura comunitaria según tus necesidades.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative fade-in-up" style="animation-delay: 0.2s;">
                            <div class="md:flex items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right">
                                    <div class="glass-card rounded-2xl p-8 hover-lift">
                                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">3. Gestión Diaria</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Registra visitas, actualiza historias clínicas y mantén el seguimiento de cada familia.
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-emerald-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-white font-bold">3</span>
                                </div>
                                <div class="md:w-1/2 md:pl-12"></div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative fade-in-up" style="animation-delay: 0.3s;">
                            <div class="md:flex items-center">
                                <div class="md:w-1/2 md:pr-12"></div>
                                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-amber-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-white font-bold">4</span>
                                </div>
                                <div class="md:w-1/2 md:pl-12">
                                    <div class="glass-card rounded-2xl p-8 hover-lift">
                                        <h3 class="text-2xl font-display font-bold text-slate-900 mb-3">4. Análisis y Mejora</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Genera reportes, analiza estadísticas y toma decisiones basadas en datos reales.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-20 px-6">
            <div class="container mx-auto max-w-4xl">
                <div class="glass-card rounded-3xl p-12 text-center fade-in-up">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-lb-primary to-lb-secondary rounded-2xl shadow-xl flex items-center justify-center animate-pulse-glow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900 mb-4">
                        ¿Listo para comenzar?
                    </h2>
                    <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                        Únete a nuestra comunidad y lleva la gestión de salud comunitaria al siguiente nivel.
                    </p>
                    @if (Route::has('login'))
                        @guest
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('register') }}" class="btn-premium text-lg px-10 py-4">
                                    Crear Cuenta Ahora
                                </a>
                                <a href="{{ route('login') }}" class="px-10 py-4 text-lg bg-white border-2 border-lb-primary text-lb-primary font-semibold rounded-xl hover:bg-lb-primary hover:text-white transition-all shadow-md hover:shadow-xl">
                                    Ya tengo cuenta
                                </a>
                            </div>
                        @else
                            <a href="{{ url('/home') }}" class="btn-premium text-lg px-10 py-4 inline-block">
                                Ir al Dashboard
                            </a>
                        @endguest
                    @endif
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 border-t border-white/20">
            <div class="container mx-auto max-w-6xl">
                <div class="glass-card rounded-2xl p-8">
                    <div class="grid md:grid-cols-4 gap-8 mb-8">
                        <!-- About -->
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-4">La Batalla</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Sistema integral para la gestión de salud comunitaria.
                            </p>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-4">Enlaces Rápidos</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="#inicio" class="text-slate-600 hover:text-lb-primary transition">Inicio</a></li>
                                <li><a href="#caracteristicas" class="text-slate-600 hover:text-lb-primary transition">Características</a></li>
                                <li><a href="#como-funciona" class="text-slate-600 hover:text-lb-primary transition">Cómo Funciona</a></li>
                            </ul>
                        </div>

                        <!-- Support -->
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-4">Soporte</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Ayuda</a></li>
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Documentación</a></li>
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Contacto</a></li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-4">Legal</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Privacidad</a></li>
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Términos</a></li>
                                <li><a href="#" class="text-slate-600 hover:text-lb-primary transition">Licencia</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-200 text-center">
                        <p class="text-slate-500 text-sm">
                            &copy; {{ date('Y') }} La Batalla - Sistema Comunitario. Todos los derechos reservados.
                        </p>
                        <p class="text-slate-400 text-xs mt-2">
                            Ministerio de Salud | Misión Barrio Adentro | Misión Médica Cubana
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scroll to top button -->
    <button id="scroll-top" class="fixed bottom-8 right-8 w-12 h-12 bg-lb-primary text-white rounded-full shadow-lg opacity-0 pointer-events-none transition-all hover:bg-lb-primary-dark hover-lift z-50">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</body>
</html>
