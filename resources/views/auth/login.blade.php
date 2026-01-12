@extends('layouts.auth_custom')

@section('title', 'Iniciar Sesión')
@section('subtitle', 'Ingresa tus credenciales para acceder')

@section('content')
<form action="{{ route('login') }}" method="post" id="loginForm" onsubmit="validateForm('loginForm', event)">
    @csrf

    <div class="mb-6">
        <label for="email" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition @error('email') border-red-500 @enderror" 
               value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com">
        @error('email')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password" class="block text-slate-800 font-semibold text-sm mb-2">{{ __('Password') }}</label>
        <input type="password" name="password" id="password" 
               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition @error('password') border-red-500 @enderror" 
               required placeholder="••••••••">
        @error('password')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-between mb-6 text-sm">
        <label class="flex items-center gap-2 cursor-pointer select-none">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} 
                   class="w-4 h-4 rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
            <span class="text-slate-600">{{ __('Remember Me') }}</span>
        </label>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-lb-primary hover:text-lb-primary-dark font-semibold">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>

    <button type="submit" class="w-full bg-gradient-to-r from-lb-primary to-lb-primary-dark hover:shadow-xl text-white font-bold py-3 px-6 rounded-xl transition transform hover:-translate-y-0.5">
        {{ __('Login') }}
    </button>
    
    <div class="mt-6 text-center text-sm text-slate-600 space-y-2">
        <p>¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-lb-primary font-bold hover:underline">Regístrate aquí</a></p>
        <p><a href="{{ url('/') }}" class="text-lb-primary font-bold hover:underline">← Volver al inicio</a></p>
    </div>
</form>
@endsection