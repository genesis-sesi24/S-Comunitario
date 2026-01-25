<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 font-sans">
    @include('components.toast')
    
    <div class="w-full max-w-md p-6">
        <div class="bg-white rounded-3xl shadow-xl p-10">
            
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h1 class="font-display text-2xl font-bold text-slate-800 mb-1">Nueva Contraseña</h1>
                <p class="text-slate-500 text-sm">Crea una contraseña segura</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="space-y-5">
                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                               placeholder="tu@ejemplo.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nueva Contraseña</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                               placeholder="Mínimo 8 caracteres">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                               placeholder="Repite la contraseña">
                    </div>
                </div>

                <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 mt-8">
                    ACTUALIZAR CONTRASEÑA
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('blur', () => validateField(input));
                input.addEventListener('input', () => {
                    if (input.classList.contains('border-red-500') || input.value.length > 0) {
                        validateField(input);
                    }
                });
            });

            document.querySelector('form').addEventListener('submit', (e) => {
                let valid = true;
                inputs.forEach(input => {
                    if (!validateField(input)) valid = false;
                });
                
                if (!valid) e.preventDefault();
            });
        });

        function validateField(input) {
            const name = input.name;
            const value = input.value.trim();
            const errorElement = input.parentNode.querySelector('.text-red-500') || createErrorElement(input);
            let isValid = true;
            let msg = '';

            // Reset
            input.classList.remove('border-red-500', 'bg-red-50');
            input.classList.add('border-slate-200');
            errorElement.classList.add('hidden');

            if (name === 'password') {
                if (!value) { isValid = false; msg = 'La contraseña es obligatoria'; }
                else if (value.length < 8) { isValid = false; msg = 'Mínimo 8 caracteres'; }
            }

            if (name === 'password_confirmation') {
                const pass = document.querySelector('input[name="password"]').value;
                if (value !== pass) { isValid = false; msg = 'Las contraseñas no coinciden'; }
            }

            if (!isValid) {
                input.classList.remove('border-slate-200');
                input.classList.add('border-red-500', 'bg-red-50');
                errorElement.textContent = msg;
                errorElement.classList.remove('hidden');
                return false;
            }
            return true;
        }

        function createErrorElement(input) {
            const p = document.createElement('p');
            p.className = 'text-red-500 text-xs mt-1 font-medium hidden';
            input.parentNode.appendChild(p);
            return p;
        }
    </script>
</body>
</html>