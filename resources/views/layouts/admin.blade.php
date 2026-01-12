<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300..700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-900">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-lb-primary to-lb-primary-dark text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="font-display text-2xl font-bold hover:opacity-90 transition">
                    La Batalla
                </a>
                
                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <div class="font-semibold text-sm">{{ auth()->user()->name }}</div>
                        <div class="text-xs opacity-90">{{ auth()->user()->getRoleName() }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium transition">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mx-auto px-6 py-8 max-w-7xl">
        <!-- Navigation Menu -->
        <nav class="bg-white rounded-xl p-4 shadow-sm mb-8">
            <ul class="flex flex-wrap gap-3">
                <li>
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg font-medium text-slate-600 hover:bg-lb-primary hover:text-white transition {{ request()->routeIs('home') ? 'bg-lb-primary text-white' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="px-4 py-2 rounded-lg font-medium text-slate-600 hover:bg-lb-primary hover:text-white transition {{ request()->routeIs('users.*') ? 'bg-lb-primary text-white' : '' }}">
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ajustes') }}" class="px-4 py-2 rounded-lg font-medium text-slate-600 hover:bg-lb-primary hover:text-white transition {{ request()->routeIs('admin.ajustes') ? 'bg-lb-primary text-white' : '' }}">
                        Ajustes
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl mb-8 animate-[slideDown_0.4s_ease]">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-8 animate-[slideDown_0.4s_ease]">
                {{ session('error') }}
            </div>
        @endif

        <!-- Content -->
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
