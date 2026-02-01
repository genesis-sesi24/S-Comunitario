<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')

    @php
    // Helper function to adjust color brightness
    if (!function_exists('adjustBrightness')) {
        function adjustBrightness($hex, $steps) {
            // Remove # if present
            $hex = ltrim($hex, '#');
            
            // Convert to RGB
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            
            // Adjust
            $r = max(0, min(255, $r + $steps));
            $g = max(0, min(255, $g + $steps));
            $b = max(0, min(255, $b + $steps));
            
            // Convert back to hex
            return sprintf("#%02x%02x%02x", $r, $g, $b);
        }
    }
    @endphp

    <style>
        :root {
            --theme-color: {{ auth()->user()->getThemeColor() }};
            --theme-color-dark: {{ adjustBrightness(auth()->user()->getThemeColor(), -20) }};
            --theme-color-light: {{ adjustBrightness(auth()->user()->getThemeColor(), 20) }};
            
            /* Override LB Primary Colors with Dynamic Theme */
            --color-lb-primary: var(--theme-color);
            --color-lb-primary-light: var(--theme-color-light);
            --color-lb-primary-dark: var(--theme-color-dark);
        }
        
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-display { font-family: 'Outfit', sans-serif; }
        
        .sidebar-active {
            background-color: color-mix(in srgb, var(--theme-color) 10%, white);
            color: var(--theme-color-dark);
            border-right: 3px solid var(--theme-color);
        }
        .sidebar-link:hover:not(.sidebar-active) {
            background-color: #f8fafc;
            color: var(--theme-color);
        }
        
        /* Apply theme color to gradients */
        .theme-bg-gradient {
            background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color-dark) 100%);
        }
        
        .theme-text {
            color: var(--theme-color);
        }
        
        .theme-bg {
            background-color: var(--theme-color);
        }
        
        .theme-border {
            border-color: var(--theme-color);
        }
    </style>
</head>
<body class="bg-[#f1f5f9] text-slate-700 antialiased h-screen flex flex-col md:flex-row overflow-hidden">

    <!-- Mobile Header -->
    <header class="md:hidden bg-white/90 backdrop-blur-md border-b border-slate-200 h-16 flex items-center justify-between px-4 z-20">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-cyan-600 flex items-center justify-center text-white font-bold text-lg shadow-sm overflow-hidden">
                @if($settings->logo_Cm && $settings->logo_Cm != 'default-logo-sm.png')
                    <img src="{{ asset('storage/' . $settings->logo_Cm) }}" class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr($settings->nombre, 0, 1)) }}
                @endif
            </div>
            <span class="font-display font-bold text-xl text-slate-800">{{ $settings->nombre }}</span>
        </div>
        <button id="mobileMenuBtn" class="p-2 text-slate-500 rounded-lg hover:bg-slate-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </header>

    <!-- Sidebar (Desktop & Mobile) -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-30 flex flex-col h-full shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                @if($settings->logo_Cm && $settings->logo_Cm != 'default-logo-sm.png')
                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center overflow-hidden border border-slate-100">
                        <img src="{{ asset('storage/' . $settings->logo_Cm) }}" class="w-8 h-8 object-contain">
                    </div>
                @else
                    <div class="w-10 h-10 rounded-xl theme-bg-gradient shadow-lg flex items-center justify-center text-white font-display font-bold text-xl">
                        {{ strtoupper(substr($settings->nombre, 0, 1)) }}
                    </div>
                @endif
                
                <div class="flex flex-col">
                    <span class="font-display font-bold text-lg leading-tight text-slate-800 line-clamp-1" title="{{ $settings->nombre }}">{{ $settings->nombre }}</span>
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400">Comunidad Digital</span>
                </div>
            </div>
            <button id="closeSidebar" class="md:hidden ml-auto text-slate-400 p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- User Profile Minimal -->
        <div class="px-6 py-6">
            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-slate-300 hover:shadow-sm transition-all group">
                @if(auth()->user()->getAvatarUrl())
                    <img src="{{ auth()->user()->getAvatarUrl() }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 theme-border shadow-sm object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-white theme-text flex items-center justify-center font-bold text-sm border-2 theme-border shadow-sm">
                        {{ auth()->user()->getInitials() }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate group-hover:theme-text transition-colors">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->getRoleName() }}</p>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto py-2">
            <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-2">Principal</p>
            
            <a href="{{ route('home') }}" class="sidebar-link flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('home') ? 'sidebar-active' : 'text-slate-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Gestión Comunitaria</p>

            <a href="{{ route('familias.index') }}" class="sidebar-link flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('familias.*') ? 'sidebar-active' : 'text-slate-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Familias
            </a>

            <a href="{{ route('manzanas.index') }}" class="sidebar-link flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('manzanas.*') ? 'sidebar-active' : 'text-slate-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Manzanas
            </a>

            <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Administración</p>

            <a href="{{ route('users.index') }}" class="sidebar-link flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('users.*') ? 'sidebar-active' : 'text-slate-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Usuarios
            </a>
            
            <a href="{{ route('admin.ajustes') }}" class="sidebar-link flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.ajustes') ? 'sidebar-active' : 'text-slate-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Ajustes
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-100">
             <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-slate-600 bg-slate-50 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto w-full relative">
        <!-- Cool oceanic gradient background -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#f1f5f9] via-[#eff6ff] to-[#ecfeff] -z-10"></div>
        
        <!-- Header Desktop -->
        <header class="hidden md:flex items-center justify-between h-20 px-8 bg-white/70 backdrop-blur-sm border-b border-slate-200/60 sticky top-0 z-10 transition-all">
            <h2 class="text-2xl font-display font-bold text-slate-800">@yield('title', 'Admin')</h2>
            
            <div class="flex items-center gap-4">
               <div class="flex items-center gap-2 px-3 py-1 rounded-full border text-xs font-semibold shadow-sm" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color-dark); border-color: color-mix(in srgb, var(--theme-color) 20%, white);">
                    <span class="w-2 h-2 rounded-full theme-bg"></span>
                    Sistema Activo
               </div>
               <span class="text-slate-300">|</span>
               <p class="text-sm font-medium text-slate-500">{{ now()->isoFormat('D [de] MMMM, YYYY') }}</p>
            </div>
        </header>

        <div class="p-6 md:p-8 max-w-7xl mx-auto pb-20">
            
@yield('content')
        </div>
    </main>

    <!-- Overlay for Mobile Sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/20 z-20 hidden md:hidden backdrop-blur-sm"></div>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        closeSidebar.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
    @yield('scripts')
    <x-toast />
</body>
</html>
