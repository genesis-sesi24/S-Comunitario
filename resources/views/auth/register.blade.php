@extends('layouts.auth_custom')

@section('title', 'Registro')
@section('subtitle', 'Crea tu cuenta para comenzar')

@section('content')
<form action="{{ route('register') }}" method="post" id="registerForm" onsubmit="validateForm('registerForm', event)">
    @csrf

    <div class="mb-5">
        <label for="name" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Name') }}</label>
        <input type="text" name="name" id="name" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition @error('name') border-red-500 @enderror" 
               value="{{ old('name') }}" required autofocus placeholder="Tu nombre completo">
        @error('name')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="email" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition @error('email') border-red-500 @enderror" 
               value="{{ old('email') }}" required placeholder="correo@ejemplo.com">
        @error('email')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="password" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Password') }}</label>
        <input type="password" name="password" id="password" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition @error('password') border-red-500 @enderror" 
               required placeholder="Mínimo 8 caracteres">
        @error('password')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Confirm Password') }}</label>
        <input type="password" name="password_confirmation" id="password_confirmation" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition" 
               required placeholder="Repite tu contraseña">
    </div>

    <button type="submit" class="w-full bg-gradient-to-r from-lb-primary to-lb-primary-dark hover:shadow-xl text-white font-bold py-3 px-6 rounded-xl transition transform hover:-translate-y-0.5">
        {{ __('Register') }}
    </button>
    
    <div class="mt-6 text-center text-sm text-slate-600 space-y-2">
        <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-lb-primary font-bold hover:underline">Inicia sesión</a></p>
        <p><a href="{{ url('/') }}" class="text-lb-primary font-bold hover:underline">← Volver al inicio</a></p>
    </div>
</form>
@endsection