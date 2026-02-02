@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')
    <!-- Hero Warning/Welcome -->
    @php
        $hour = now()->hour;
        if ($hour >= 6 && $hour < 12) {
            $greeting = 'Buenos días';
            $emoji = '☀️';
        } elseif ($hour >= 12 && $hour < 19) {
            $greeting = 'Buenas tardes';
            $emoji = '🌤️';
        } else {
            $greeting = 'Buenas noches';
            $emoji = '🌙';
        }
    @endphp
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-slate-800">{{ $greeting }}, {{ explode(' ', Auth::user()->name)[0] }} {{ $emoji }}</h1>
        <p class="text-slate-500 text-lg mt-1">Aquí tienes un resumen de la actividad en <span class="font-bold theme-text">{{ $settings->nombre }}</span> hoy.</p>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card: Familias -->
        <a href="{{ route('familias.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between hover:shadow-md transition-all group cursor-pointer" style="border-color: color-mix(in srgb, var(--theme-color) 20%, #e2e8f0);">
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wide group-hover:text-slate-600 transition-colors">Total Familias</p>
                <h3 class="text-4xl font-display font-bold text-slate-800 mt-2">{{ $stats['familias'] }}</h3>
                <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium border" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color-dark); border-color: color-mix(in srgb, var(--theme-color) 20%, white);">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    +{{ $stats['nuevas_familias_mes'] }} este mes
                </span>
            </div>
            <div class="p-3 rounded-xl group-hover:scale-110 transition-transform" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color);">
               <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </a>

        <!-- Card: Personas (Linked to Families for now as main entry) -->
        <a href="{{ route('familias.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between hover:border-sky-200 hover:shadow-md transition-all group cursor-pointer">
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wide group-hover:text-slate-600 transition-colors">Habitantes</p>
                <h3 class="text-4xl font-display font-bold text-slate-800 mt-2">{{ $stats['integrantes'] }}</h3>
                 <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-50 text-sky-700 border border-sky-100">
                    Censo Activo
                </span>
            </div>
             <div class="p-3 bg-sky-50 text-sky-600 rounded-xl group-hover:scale-110 transition-transform">
               <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </a>

        <!-- Card: Manzanas -->
        <a href="{{ route('manzanas.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between hover:border-indigo-200 hover:shadow-md transition-all group cursor-pointer">
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wide group-hover:text-slate-600 transition-colors">Manzanas</p>
                <h3 class="text-4xl font-display font-bold text-slate-800 mt-2">{{ $stats['sectores'] }}</h3>
                <span class="text-xs text-slate-400 mt-2 block">Cobertura Total</span>
            </div>
             <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:scale-110 transition-transform">
               <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </a>

        <!-- Card: Fichas -->
        <a href="{{ route('familias.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between hover:shadow-md transition-all group cursor-pointer" style="border-color: color-mix(in srgb, var(--theme-color) 20%, #e2e8f0);">
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wide group-hover:text-slate-600 transition-colors">Fichas Médicas</p>
                <h3 class="text-4xl font-display font-bold text-slate-800 mt-2">{{ $stats['fichas'] }}</h3>
                <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium border" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color-dark); border-color: color-mix(in srgb, var(--theme-color) 20%, white);">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    {{ $stats['nuevas_fichas_hoy'] }} hoy
                </span>
            </div>
             <div class="p-3 rounded-xl group-hover:scale-110 transition-transform" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color);">
               <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <!-- Main Area: Pathologies -->
        <div class="xl:col-span-2 space-y-8">
            
            <!-- Quick Actions Bar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex md:items-center justify-between gap-4 flex-col md:flex-row">
                <h3 class="font-bold text-slate-700 whitespace-nowrap px-2">Acciones Rápidas</h3>
                <div class="flex gap-3 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto">
                    <a href="{{ route('familias.index') }}" class="flex items-center px-4 py-2 theme-bg hover:opacity-90 text-white rounded-lg text-sm font-bold transition-all whitespace-nowrap shadow-sm hover:shadow">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Nueva Familia
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-600 rounded-lg text-sm font-bold transition-colors whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Registrar Usuario
                    </a>
                </div>
            </div>

            <!-- Pathologies List -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                         <h3 class="text-lg font-bold text-slate-800">Salud Comunitaria</h3>
                         <p class="text-sm text-slate-500">Patologías frecuentes registradas</p>
                    </div>
                </div>
                
                <div class="divide-y divide-slate-50">
                    @forelse($patologias as $patologia)
                        <a href="{{ route('patologias.index', $patologia->slug) }}" class="p-4 flex items-center hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-4 
                                @if($patologia->color == 'red') bg-red-50 text-red-600
                                @elseif($patologia->color == 'purple') bg-purple-50 text-purple-600
                                @elseif($patologia->color == 'blue') bg-blue-50 text-blue-600
                                @elseif($patologia->color == 'green') bg-emerald-50 text-emerald-600
                                @elseif($patologia->color == 'orange') bg-orange-50 text-orange-600
                                @else bg-slate-100 text-slate-500 @endif border border-slate-100">
                                
                                @if($patologia->color == 'red')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                @elseif($patologia->color == 'purple')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                @elseif($patologia->color == 'blue')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @elseif($patologia->color == 'green')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 008 10.172V5L7 4z"/></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-800 group-hover:text-{{ $patologia->color }}-600 transition-colors">{{ $patologia->nombre }}</h4>
                                <span class="text-xs text-slate-500">{{ Str::limit($patologia->descripcion, 50) }}</span>
                            </div>
                            
                            <div class="text-right">
                                <span class="block text-lg font-bold text-slate-800">{{ $patologia->registros_count }}</span>
                                <span class="text-xs text-slate-400">Pacientes</span>
                            </div>
                            
                            <svg class="w-5 h-5 text-slate-300 ml-4 group-hover:text-{{ $patologia->color }}-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500">
                            No hay tipos de patologías configurados.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="space-y-6">
            
            <!-- User Info Card -->
            <a href="{{ route('profile.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center block hover:shadow-md transition-shadow cursor-pointer">
                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4 border-2 theme-border relative overflow-hidden" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white);">
                    @if(Auth::user()->getAvatarUrl())
                        <img src="{{ Auth::user()->getAvatarUrl() }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-2xl font-bold theme-text">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg text-slate-800">{{ Auth::user()->name }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ Auth::user()->getRoleName() }}</p>
                
                <div class="grid grid-cols-2 gap-2 text-sm border-t border-slate-100 pt-4">
                    <div class="text-center p-2 rounded-lg bg-slate-50">
                        <span class="block font-bold text-slate-700">{{ $stats['familias'] }}</span>
                        <span class="text-xs text-slate-400">Total Fam.</span>
                    </div>
                    <div class="text-center p-2 rounded-lg bg-slate-50">
                        <span class="block font-bold text-emerald-600">Activo</span>
                        <span class="text-xs text-slate-400">Estado</span>
                    </div>
                </div>
            </a>

            <!-- Recent Activity List -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Actividad Reciente</h3>
                <ul class="space-y-4">
                    @forelse($activities as $activity)
                        <li class="flex gap-3">
                            <a href="{{ $activity['url'] ?? '#' }}" class="flex gap-3 w-full hover:bg-slate-50 p-2 rounded-lg -m-2 transition-colors cursor-pointer group">
                                <div class="flex-shrink-0 w-2 h-2 mt-1.5 rounded-full {{ $activity['icon'] }}"></div>
                                <div>
                                    <p class="text-sm text-slate-800 font-medium group-hover:text-blue-600 transition-colors">{{ $activity['title'] }}</p>
                                    <span class="text-xs text-slate-400 block">{{ $activity['time'] }}</span>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="p-2 text-center text-slate-400 text-sm">No hay actividad reciente registrada.</li>
                    @endforelse
                </ul>
            </div>
            
        </div>
    </div>
@endsection
