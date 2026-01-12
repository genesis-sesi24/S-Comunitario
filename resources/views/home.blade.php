@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-lb-primary to-lb-primary-dark text-white p-6 rounded-2xl shadow-lg hover:-translate-y-1 transition">
            <div class="text-sm opacity-90 mb-2">Pacientes Activos</div>
            <div class="text-4xl font-display font-bold">{{ rand(50, 150) }}</div>
        </div>
        <div class="bg-gradient-to-br from-lb-secondary to-emerald-700 text-white p-6 rounded-2xl shadow-lg hover:-translate-y-1 transition">
            <div class="text-sm opacity-90 mb-2">Citas Hoy</div>
            <div class="text-4xl font-display font-bold">{{ rand(10, 40) }}</div>
        </div>
        <div class="bg-gradient-to-br from-amber-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg hover:-translate-y-1 transition">
            <div class="text-sm opacity-90 mb-2">En Espera</div>
            <div class="text-4xl font-display font-bold">{{ rand(5, 20) }}</div>
        </div>
        <div class="bg-gradient-to-br from-lb-accent to-sky-600 text-white p-6 rounded-2xl shadow-lg hover:-translate-y-1 transition">
            <div class="text-sm opacity-90 mb-2">Atendidos</div>
            <div class="text-4xl font-display font-bold">{{ rand(20, 60) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Column -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h3 class="font-display text-2xl font-bold mb-6">Acciones del Sistema</h3>
                
                <h4 class="text-lg font-semibold mb-4 text-slate-700">Gestión Principal</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <a href="{{ route('users.index') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 hover:bg-white border-2 border-transparent hover:border-lb-primary rounded-xl transition group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition">👥</span>
                        <span class="text-sm font-semibold text-slate-700 text-center">Gestión de Usuarios</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-50 hover:bg-white border-2 border-transparent hover:border-lb-primary rounded-xl transition group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition">🏥</span>
                        <span class="text-sm font-semibold text-slate-700 text-center">Nuevo Paciente</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-50 hover:bg-white border-2 border-transparent hover:border-lb-primary rounded-xl transition group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition">📅</span>
                        <span class="text-sm font-semibold text-slate-700 text-center">Nueva Cita</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-50 hover:bg-white border-2 border-transparent hover:border-lb-primary rounded-xl transition group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition">📝</span>
                        <span class="text-sm font-semibold text-slate-700 text-center">Nueva Consulta</span>
                    </a>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-lb-primary flex items-center gap-2">
                            <span class="text-xl">📊</span> Resumen del Día
                        </h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="text-sm text-slate-700">{{ rand(15, 30) }} Consultas completadas</span>
                            </li>
                            <li class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <span class="text-sm text-slate-700">{{ rand(3, 10) }} Consultas pendientes</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-lb-accent"></div>
                                <span class="text-sm text-slate-700">{{ rand(5, 15) }} Citas programadas</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-red-600 flex items-center gap-2">
                            <span class="text-xl">🔔</span> Recordatorios
                        </h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <span class="text-sm text-slate-700">Inventario de medicamentos</span>
                            </li>
                            <li class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-2 h-2 rounded-full bg-lb-primary"></div>
                                <span class="text-sm text-slate-700">Seguimiento de pacientes</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-slate-900"></div>
                                <span class="text-sm text-slate-700">Reportes mensuales</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Column -->
        <div>
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h3 class="font-display text-2xl font-bold mb-6">Información</h3>
                <div class="text-center mb-6">
                    <div class="text-6xl mb-3">🏥</div>
                    <h5 class="font-display text-xl font-bold">La Batalla</h5>
                    <p class="text-slate-600 text-sm">Consultorio Médico Comunitario</p>
                </div>
                <hr class="border-slate-100 mb-6">
                <div class="text-sm space-y-3 mb-6">
                    <p class="font-bold">Horario de Atención:</p>
                    <p class="flex items-center gap-2 text-slate-700">
                        <span class="text-lb-primary">●</span> Lun - Vie: 8:00 - 18:00
                    </p>
                    <p class="flex items-center gap-2 text-slate-700">
                        <span class="text-lb-primary">●</span> Sábado: 8:00 - 14:00
                    </p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl text-center">
                    <p class="text-xs text-slate-600 mb-1">Sesión iniciada como:</p>
                    <p class="font-bold text-lb-primary">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-semibold text-slate-800 uppercase tracking-wide">{{ Auth::user()->getRoleName() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
