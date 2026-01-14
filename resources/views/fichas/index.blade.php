@extends('layouts.admin')

@section('title', 'Fichas Familiares - ' . $familia->apellidos)

@section('content')
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <a href="{{ route('familias.index') }}" class="flex items-center text-sm text-slate-500 hover:text-lb-primary transition-colors mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Familias
            </a>
            <h1 class="text-3xl font-display font-bold text-slate-900">Fichas Familiares</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $familia->apellidos }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('familias.fichas.create', $familia) }}" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-lb-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-lb-primary-dark transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Ficha Familiar
            </a>
        </div>
    </div>

    @if($fichas->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay fichas familiares registradas</h3>
            <p class="text-slate-500 mb-4">Comienza creando la primera ficha familiar para esta familia</p>
            <a href="{{ route('familias.fichas.create', $familia) }}" class="inline-flex items-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition">
                Crear Primera Ficha
            </a>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($fichas as $ficha)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Historia Clínica Familiar</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-500">HC №:</span>
                                    <span class="ml-1 font-medium text-slate-900">{{ $ficha->numero_hc ?? 'Sin número' }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Consultorio:</span>
                                    <span class="ml-1 font-medium text-slate-900">{{ $ficha->consultorio ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Registrado:</span>
                                    <span class="ml-1 font-medium text-slate-900">{{ $ficha->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Última actualización:</span>
                                    <span class="ml-1 font-medium text-slate-900">{{ $ficha->updated_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('familias.fichas.show', [$familia, $ficha]) }}" class="p-2 text-slate-600 hover:text-lb-primary hover:bg-slate-50 rounded-lg transition" title="Ver/Imprimir">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                            </a>
                            <a href="{{ route('familias.fichas.edit', [$familia, $ficha]) }}" class="p-2 text-slate-600 hover:text-lb-primary hover:bg-slate-50 rounded-lg transition" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('familias.fichas.destroy', [$familia, $ficha]) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta ficha familiar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
