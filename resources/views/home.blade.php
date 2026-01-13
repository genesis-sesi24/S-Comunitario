@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-600 mt-1">Sistema de Gestión de Salud Comunitaria</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-lb-primary/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-lb-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total de Familias</p>
                    <p class="text-2xl font-bold text-slate-900">{{ rand(50, 150) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Personas Registradas</p>
                    <p class="text-2xl font-bold text-slate-900">{{ rand(200, 500) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-amber-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Sectores</p>
                    <p class="text-2xl font-bold text-slate-900">{{ rand(5, 12) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Fichas Activas</p>
                    <p class="text-2xl font-bold text-slate-900">{{ rand(40, 120) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-6">Acciones Rápidas</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <a href="{{ route('users.index') }}" class="flex flex-col items-center p-4 rounded-lg border-2 border-slate-200 hover:border-lb-primary hover:bg-lb-primary/5 transition group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-lb-primary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 text-center">Usuarios</span>
                    </a>

                    <a href="{{ route('sectores.index') }}" class="flex flex-col items-center p-4 rounded-lg border-2 border-slate-200 hover:border-lb-primary hover:bg-lb-primary/5 transition group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-lb-primary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 text-center">Comunidad</span>
                    </a>

                    <a href="#" class="flex flex-col items-center p-4 rounded-lg border-2 border-slate-200 hover:border-lb-primary hover:bg-lb-primary/5 transition group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-lb-primary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 text-center">Fichas Familiares</span>
                    </a>

                    <a href="#" class="flex flex-col items-center p-4 rounded-lg border-2 border-slate-200 hover:border-lb-primary hover:bg-lb-primary/5 transition group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-lb-primary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 text-center">Reportes</span>
                    </a>

                    <a href="{{ route('admin.ajustes') }}" class="flex flex-col items-center p-4 rounded-lg border-2 border-slate-200 hover:border-lb-primary hover:bg-lb-primary/5 transition group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-lb-primary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 text-center">Ajustes</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Actividad Reciente</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm text-slate-900">Nueva ficha familiar registrada</p>
                            <p class="text-xs text-slate-500 mt-1">Hace 2 horas</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm text-slate-900">Tres nuevos usuarios agregados</p>
                            <p class="text-xs text-slate-500 mt-1">Hace 5 horas</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm text-slate-900">Sector actualizado</p>
                            <p class="text-xs text-slate-500 mt-1">Ayer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Info -->
        <div>
            <div class="bg-gradient-to-br from-lb-primary to-lb-primary-dark rounded-xl p-6 text-white shadow-sm">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 mx-auto rounded-full bg-white/20 flex items-center justify-center mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold">Consultorio Comunitario</h3>
                    <p class="text-white/80 text-sm mt-1">La Batalla</p>
                </div>
                <div class="border-t border-white/20 pt-4">
                    <p class="text-sm font-semibold mb-2">Usuario Activo</p>
                    <p class="text-white/90">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-white/70 uppercase tracking-wide mt-1">{{ Auth::user()->getRoleName() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
