<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La Batalla - Sistema de Gestión Comunitario</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-slate-600 bg-slate-50 font-sans selection:bg-teal-100 selection:text-teal-900">

        <!-- Navigation -->
        <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/60 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <a href="#" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-xl shadow-md group-hover:scale-105 transition-transform">
                            L
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-slate-900 leading-none">La Batalla</span>
                            <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Comunidad Digital</span>
                        </div>
                    </a>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Características</a>
                        <a href="#how-it-works" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Cómo funciona</a>
                        <div class="flex items-center gap-4 pl-4 border-l border-slate-200">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                                        Ir al Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                                        Iniciar Sesión
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-premium text-sm py-2 px-5 rounded-lg shadow-sm hover:shadow-md">
                                            Registrarse
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown -->
             <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-b border-slate-200 p-4 shadow-xl md:hidden flex-col gap-2">
                <a href="#features" class="block py-2 px-4 rounded-lg hover:bg-slate-50 text-slate-600 font-medium">Características</a>
                <a href="#how-it-works" class="block py-2 px-4 rounded-lg hover:bg-slate-50 text-slate-600 font-medium">Cómo funciona</a>
                <div class="h-px bg-slate-100 my-2"></div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="block py-2 px-4 rounded-lg hover:bg-slate-50 text-slate-900 font-bold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 px-4 rounded-lg hover:bg-slate-50 text-slate-600 font-medium">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block mt-2 py-3 px-4 rounded-lg bg-teal-700 text-white font-bold text-center">Registrarse Ahora</a>
                        @endif
                    @endauth
                @endif
             </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-grid-pattern">
            <!-- Subtle decoration -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-slate-200/50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-slate-200/50 rounded-full blur-3xl opacity-50"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-8 animate-fade-in-up">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-600"></span>
                    </span>
                    <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Gestión Integral 2.0</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-display font-bold text-slate-900 leading-tight mb-8 max-w-4xl mx-auto tracking-tight animate-fade-in-up" style="animation-delay: 100ms;">
                    Tu comunidad, <br>
                    <span class="text-slate-500">gestionada de forma inteligente.</span>
                </h1>

                <p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed font-light animate-fade-in-up" style="animation-delay: 200ms;">
                    Plataforma moderna para la administración de familias, sectores y servicios comunitarios. Eficiencia y transparencia en un solo lugar.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 300ms;">
                    <a href="{{ route('register') }}" class="btn-premium text-lg w-full sm:w-auto shadow-lg hover:shadow-xl">
                        <span>Comenzar Ahora</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#how-it-works" class="btn-outline text-lg w-full sm:w-auto">
                        Conocer más
                    </a>
                </div>

                <!-- Clean Stats -->
                <div class="mt-24 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto border-t border-slate-200 pt-12 animate-fade-in-up" style="animation-delay: 400ms;">
                    <div class="text-center">
                        <p class="stat-number mb-1">1.2k+</p>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Familias</p>
                    </div>
                    <div class="text-center">
                        <p class="stat-number mb-1">100%</p>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Digital</p>
                    </div>
                    <div class="text-center">
                        <p class="stat-number mb-1">24/7</p>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Disponibilidad</p>
                    </div>
                    <div class="text-center">
                        <p class="stat-number mb-1">5+</p>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Sectores</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Features Section -->
        <section id="features" class="py-24 px-6 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20 max-w-3xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900 mb-6">
                        Todo lo que necesitas para una gestión eficiente
                    </h2>
                    <p class="text-lg text-slate-600 font-light">
                        Herramientas diseñadas específicamente para optimizar el control y seguimiento de la salud y bienestar comunitario.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass-card p-10 rounded-2xl hover-lift">
                        <div class="w-14 h-14 bg-slate-50 rounded-xl flex items-center justify-center mb-6 border border-slate-100">
                            <svg class="w-7 h-7 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Gestión Familiar</h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            Registro detallado de núcleos familiares, integrantes e historial médico unificado en una interfaz intuitiva.
                        </p>
                        <a href="#" class="text-sm font-semibold text-slate-900 hover:text-teal-700 transition-colors flex items-center gap-1 group">
                            Saber más <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass-card p-10 rounded-2xl hover-lift">
                        <div class="w-14 h-14 bg-slate-50 rounded-xl flex items-center justify-center mb-6 border border-slate-100">
                            <svg class="w-7 h-7 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Control Territorial</h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            Organización precisa por sectores, calles y viviendas para un mapeo exacto de la comunidad.
                        </p>
                        <a href="#" class="text-sm font-semibold text-slate-900 hover:text-teal-700 transition-colors flex items-center gap-1 group">
                            Saber más <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass-card p-10 rounded-2xl hover-lift">
                        <div class="w-14 h-14 bg-slate-50 rounded-xl flex items-center justify-center mb-6 border border-slate-100">
                            <svg class="w-7 h-7 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Reportes Avanzados</h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            Generación de estadísticas y análisis poblacionales en tiempo real para la toma de decisiones.
                        </p>
                        <a href="#" class="text-sm font-semibold text-slate-900 hover:text-teal-700 transition-colors flex items-center gap-1 group">
                            Saber más <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 px-6 bg-slate-50 border-t border-slate-200">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-16">
                    <span class="text-teal-700 font-semibold tracking-wider uppercase text-sm">Flujo de Trabajo</span>
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900 mt-2 mb-6">
                        Simple y Estructurado
                    </h2>
                </div>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-slate-300 transform -translate-x-1/2"></div>

                    <div class="space-y-16">
                        <!-- Step 1 -->
                        <div class="md:flex items-center justify-between group">
                            <div class="md:w-[45%] mb-6 md:mb-0 md:text-right">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2 group-hover:text-teal-700 transition-colors">1. Registro</h3>
                                <p class="text-slate-600">Creación de cuenta y configuración inicial del perfil administrativo.</p>
                            </div>
                            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-white border-4 border-slate-200 rounded-full items-center justify-center z-10 group-hover:border-teal-500 transition-colors">
                                <div class="w-2.5 h-2.5 bg-slate-400 rounded-full group-hover:bg-teal-600 transition-colors"></div>
                            </div>
                            <div class="md:w-[45%] pl-10 md:pl-0"></div>
                        </div>

                        <!-- Step 2 -->
                        <div class="md:flex items-center justify-between group">
                            <div class="md:w-[45%]"></div>
                            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-white border-4 border-slate-200 rounded-full items-center justify-center z-10 group-hover:border-teal-500 transition-colors">
                                <div class="w-2.5 h-2.5 bg-slate-400 rounded-full group-hover:bg-teal-600 transition-colors"></div>
                            </div>
                            <div class="md:w-[45%] pl-10 md:pl-0">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2 group-hover:text-teal-700 transition-colors">2. Configuración</h3>
                                <p class="text-slate-600">Parametrización de calles, sectores y consejos comunales.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="md:flex items-center justify-between group">
                            <div class="md:w-[45%] mb-6 md:mb-0 md:text-right">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2 group-hover:text-teal-700 transition-colors">3. Carga de Datos</h3>
                                <p class="text-slate-600">Registro de familias, integrantes y actualización de historias médicas.</p>
                            </div>
                            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-white border-4 border-slate-200 rounded-full items-center justify-center z-10 group-hover:border-teal-500 transition-colors">
                                <div class="w-2.5 h-2.5 bg-slate-400 rounded-full group-hover:bg-teal-600 transition-colors"></div>
                            </div>
                            <div class="md:w-[45%] pl-10 md:pl-0"></div>
                        </div>

                        <!-- Step 4 -->
                        <div class="md:flex items-center justify-between group">
                            <div class="md:w-[45%]"></div>
                            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-white border-4 border-slate-200 rounded-full items-center justify-center z-10 group-hover:border-teal-500 transition-colors">
                                <div class="w-2.5 h-2.5 bg-slate-400 rounded-full group-hover:bg-teal-600 transition-colors"></div>
                            </div>
                            <div class="md:w-[45%] pl-10 md:pl-0">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2 group-hover:text-teal-700 transition-colors">4. Gestión y Análisis</h3>
                                <p class="text-slate-600">Monitoreo continuo y generación de reportes para la toma de decisiones.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 px-6 bg-white border-t border-slate-200">
            <div class="container mx-auto max-w-4xl text-center">
                <div class="bg-slate-50 rounded-3xl p-12 border border-slate-100 shadow-sm">
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900 mb-6">
                        Comienza a gestionar tu comunidad hoy
                    </h2>
                    <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto font-light">
                        Únete a la plataforma y digitaliza el control de salud comunitaria de manera segura y profesional.
                    </p>
                    
                    @if (Route::has('login'))
                        @guest
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('register') }}" class="btn-premium text-lg px-8 py-3 shadow-lg hover:shadow-xl">
                                    Crear Cuenta
                                </a>
                                <a href="{{ route('login') }}" class="btn-outline text-lg px-8 py-3 bg-white hover:bg-slate-50">
                                    Iniciar Sesión
                                </a>
                            </div>
                        @else
                            <a href="{{ url('/home') }}" class="btn-premium text-lg px-8 py-3 inline-block shadow-lg">
                                Ir al Dashboard
                            </a>
                        @endguest
                    @endif
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 py-16 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-white font-bold">L</div>
                            <span class="text-white font-bold text-xl">La Batalla</span>
                        </div>
                        <p class="text-sm leading-relaxed">
                            Sistema integral para la gestión de salud comunitaria, enfocado en la eficiencia y el bienestar social.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-6">Plataforma</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Inicio</a></li>
                            <li><a href="#features" class="hover:text-white transition-colors">Características</a></li>
                            <li><a href="#how-it-works" class="hover:text-white transition-colors">Cómo funciona</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-6">Soporte</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Documentación</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Ayuda</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contacto</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-6">Legales</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Privacidad</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Términos</a></li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-800 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-xs">
                    <p>&copy; {{ date('Y') }} La Batalla. Todos los derechos reservados.</p>
                    <p class="mt-4 md:mt-0 opacity-60">Ministerio de Salud | Misión Barrio Adentro</p>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            // Simple Mobile Menu Toggle
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if(btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('flex');
                });
            }

            // Scroll Animation Observer
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in-up, .fade-in').forEach(el => {
                observer.observe(el);
            });
        </script>
    </body>
</html>
