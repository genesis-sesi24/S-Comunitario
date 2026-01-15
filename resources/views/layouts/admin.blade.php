<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebarContent" class="hidden md:flex md:flex-shrink-0 transition-all duration-300 w-64 overflow-hidden border-r border-slate-200">
            <div class="flex flex-col w-full bg-white overflow-hidden">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-slate-200 overflow-hidden">
                    <h1 id="logoText" class="font-display text-xl font-bold text-lb-primary truncate transition-opacity duration-300">La Batalla</h1>
                    <button id="sidebarToggle" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition-colors flex-shrink-0">
                        <svg id="toggleIcon" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                        </svg>
                    </button>
                </div>

                <!-- User Info -->
                <div class="p-4 border-b border-slate-200 overflow-hidden">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-lb-primary to-lb-primary-light flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div id="userInfo" class="flex-1 min-w-0 transition-opacity duration-300">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ auth()->user()->getRoleName() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('home') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('home') ? 'bg-lb-primary text-white' : 'text-slate-700 hover:bg-slate-100' }}" title="Dashboard">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Dashboard</span>
                    </a>

                    <a href="{{ route('familias.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('familias.*') ? 'bg-lb-primary text-white' : 'text-slate-700 hover:bg-slate-100' }}" title="Familias">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Familias</span>
                    </a>

                    <a href="{{ route('users.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('users.*') ? 'bg-lb-primary text-white' : 'text-slate-700 hover:bg-slate-100' }}" title="Usuarios">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Usuarios</span>
                    </a>

                    <a href="{{ route('sectores.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('sectores.*') ? 'bg-lb-primary text-white' : 'text-slate-700 hover:bg-slate-100' }}" title="Comunidad">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Comunidad</span>
                    </a>

                    <a href="{{ route('admin.ajustes') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.ajustes') ? 'bg-lb-primary text-white' : 'text-slate-700 hover:bg-slate-100' }}" title="Ajustes">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Ajustes</span>
                    </a>
                </nav>

                <!-- Logout -->
                <div class="p-3 border-t border-slate-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-3 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Cerrar Sesión">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="nav-label ml-3 transition-opacity duration-300 truncate opacity-100">Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top bar for mobile -->
            <header class="md:hidden bg-white border-b border-slate-200 px-4 py-3 flex items-center justify-between">
                <h1 class="font-display text-lg font-bold text-lb-primary">La Batalla</h1>
                <button class="p-2" onclick="alert('Menú móvil en desarrollo')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 px-6 py-4 rounded-r-lg" role="alert">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg" role="alert">
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    <!-- Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebarContent');
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            const logoText = document.getElementById('logoText');
            const userInfo = document.getElementById('userInfo');
            const navLabels = document.querySelectorAll('.nav-label');
            
            // Check for saved state
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                applyCollapsedState(true);
            }

            toggleBtn.addEventListener('click', () => {
                const currentlyCollapsed = sidebar.classList.contains('w-20');
                applyCollapsedState(!currentlyCollapsed);
            });

            function applyCollapsedState(collapse) {
                if (collapse) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                    logoText.classList.add('opacity-0', 'pointer-events-none');
                    userInfo.classList.add('opacity-0', 'pointer-events-none');
                    navLabels.forEach(label => label.classList.add('opacity-0', 'pointer-events-none'));
                    toggleIcon.classList.add('rotate-180');
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                    logoText.classList.remove('opacity-0', 'pointer-events-none');
                    userInfo.classList.remove('opacity-0', 'pointer-events-none');
                    navLabels.forEach(label => label.classList.remove('opacity-0', 'pointer-events-none'));
                    toggleIcon.classList.remove('rotate-180');
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
