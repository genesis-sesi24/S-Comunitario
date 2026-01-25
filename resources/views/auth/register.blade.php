<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-slide-up {
            animation: slideUp 0.4s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 font-sans">
    @include('components.toast')
    
    <div class="w-full max-w-5xl h-full md:h-auto p-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden min-h-[600px]">
            
            <!-- Left Side: Branding (Professional Slate/Dark) -->
            <div class="hidden md:flex flex-col justify-center items-center bg-slate-900 text-white p-12 relative overflow-hidden">
                <!-- Abstract Background Pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 30px 30px;"></div>
                <div class="absolute top-0 left-0 -mt-20 -ml-20 w-80 h-80 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 right-0 -mb-20 -mr-20 w-80 h-80 bg-teal-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

                <div class="relative z-10 w-full max-w-sm">
                    <h2 class="font-display text-4xl font-bold mb-6">Únete a la<br/>Comunidad</h2>
                    
                    <!-- Steps Visualization -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4 group" id="step-preview-1">
                            <div class="w-10 h-10 rounded-full border-2 border-teal-500 bg-teal-500 text-white flex items-center justify-center font-bold transition-all">1</div>
                            <div>
                                <h4 class="font-bold text-white">Datos Personales</h4>
                                <p class="text-xs text-slate-400">Nombre y contacto</p>
                            </div>
                        </div>
                         <div class="w-0.5 h-8 bg-slate-700 ml-5"></div>
                        <div class="flex items-center gap-4 opacity-50 transition-all" id="step-preview-2">
                            <div class="w-10 h-10 rounded-full border-2 border-slate-600 bg-transparent text-slate-400 flex items-center justify-center font-bold transition-all">2</div>
                            <div>
                                <h4 class="font-bold text-slate-300">Seguridad</h4>
                                <p class="text-xs text-slate-500">Contraseña y acceso</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Wizard Form -->
            <div class="p-10 md:p-12 flex flex-col justify-center relative">
                <div class="mb-8">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <h1 class="font-display text-2xl font-bold text-slate-800">Crear Cuenta</h1>
                            <p class="text-sm text-slate-500">Paso <span id="step-number">1</span> de 2</p>
                        </div>
                        <div class="flex gap-1">
                            <div class="w-12 h-1.5 rounded-full bg-teal-600 transition-all" id="bar-1"></div>
                            <div class="w-12 h-1.5 rounded-full bg-slate-100 transition-all" id="bar-2"></div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf
                    
                    <!-- STEP 1 -->
                    <div id="step-1" class="space-y-5 custom-slide-up">
                        <!-- Name -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nombre Completo</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-slate-200' }} rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="Juan Pérez">
                            <p class="text-red-500 text-xs mt-1 {{ $errors->has('name') ? '' : 'hidden' }} font-medium" id="error-name">
                                {{ $errors->first('name') }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-slate-200' }} rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="tu@ejemplo.com">
                            <p class="text-red-500 text-xs mt-1 {{ $errors->has('email') ? '' : 'hidden' }} font-medium" id="error-email">
                                {{ $errors->first('email') }}
                            </p>
                        </div>

                        <button type="button" onclick="goToStep2()" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 mt-8">
                            CONTINUAR
                        </button>
                    </div>

                    <!-- STEP 2 -->
                    <div id="step-2" class="space-y-5 hidden custom-slide-up">
                        <!-- Password -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Contraseña</label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('password') ? 'border-red-500 bg-red-50' : 'border-slate-200' }} rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="Mínimo 8 caracteres">
                            <p class="text-red-500 text-xs mt-1 {{ $errors->has('password') ? '' : 'hidden' }} font-medium" id="error-password">
                                {{ $errors->first('password') }}
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="Repite tu contraseña">
                        </div>

                        <!-- Info - Security Question -->
                        <div class="pt-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pregunta de Seguridad</label>
                             <select name="security_question_id" id="security_question_id" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('security_question_id') ? 'border-red-500 bg-red-50' : 'border-slate-200' }} rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm">
                                <option value="">-- Selecciona una pregunta --</option>
                                @foreach(\App\Models\SecurityQuestion::all() as $question)
                                    <option value="{{ $question->id }}" {{ old('security_question_id') == $question->id ? 'selected' : '' }}>{{ $question->question }}</option>
                                @endforeach
                            </select>
                            <p class="text-red-500 text-xs mt-1 {{ $errors->has('security_question_id') ? '' : 'hidden' }} font-medium" id="error-security_question_id">
                                {{ $errors->first('security_question_id') }}
                            </p>
                        </div>
                        
                        <!-- Security Answer -->
                        <div class="pb-2">
                             <input type="text" name="security_answer" id="security_answer" value="{{ old('security_answer') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('security_answer') ? 'border-red-500 bg-red-50' : 'border-slate-200' }} rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="Tu respuesta">
                             <p class="text-xs text-slate-400 mt-1">Para recuperar tu cuenta si olvidas la contraseña</p>
                             <p class="text-red-500 text-xs mt-1 {{ $errors->has('security_answer') ? '' : 'hidden' }} font-medium" id="error-security_answer">
                                {{ $errors->first('security_answer') }}
                            </p>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" onclick="goToStep1()" class="w-1/3 text-slate-500 font-semibold py-3.5 rounded-xl hover:bg-slate-50 hover:text-slate-700 transition-all border border-transparent hover:border-slate-200">
                                ATRÁS
                            </button>
                            <button type="submit" class="w-2/3 bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20">
                                CREAR CUENTA
                            </button>
                        </div>
                    </div>

                    <div class="mt-8 text-center pt-6 border-t border-slate-100">
                        <p class="text-sm text-slate-500">
                            ¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:text-teal-700">Inicia sesión</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Real-time Validation
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                input.addEventListener('blur', () => validateField(input));
                input.addEventListener('input', () => {
                    // Validar si ya tiene error o si está vacío para quitar borde
                    if (input.classList.contains('border-red-500') || input.value.length > 0) {
                        validateField(input);
                    }
                });
            });
        });

        function validateField(input) {
            const id = input.id;
            const value = input.value.trim();
            let isValid = true;
            let msg = '';

            // Reset
            hideError(id);

            // Name
            if (id === 'name') {
                if (!value) { isValid = false; msg = 'El nombre es obligatorio'; }
            }
            
            // Email
            if (id === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!value) { isValid = false; msg = 'El correo es obligatorio'; }
                else if (!emailRegex.test(value)) { isValid = false; msg = 'Formato de correo inválido'; }
            }

            // Password
            if (id === 'password') {
                if (!value) { isValid = false; msg = 'La contraseña es obligatoria'; }
                else if (value.length < 8) { isValid = false; msg = 'Mínimo 8 caracteres'; }
            }

            // Confirm Password
            if (id === 'password_confirmation') {
                const pass = document.getElementById('password').value;
                if (value !== pass) { isValid = false; msg = 'Las contraseñas no coinciden'; }
            }

            // Security Question & Answer
            if (id === 'security_question_id' || id === 'security_answer') {
                if (!value) { isValid = false; msg = 'Este campo es obligatorio'; }
            }

            if (!isValid) {
                showError(id, msg);
                return false;
            } else {
                if (value.length > 0) showSuccess(input);
                return true;
            }
        }

        function showSuccess(input) {
            input.classList.remove('border-red-500', 'bg-red-50', 'border-slate-200');
            input.classList.add('border-teal-500', 'bg-teal-50');
        }

        function showError(id, msg) {
            const el = document.getElementById('error-' + id);
            const input = document.getElementById(id);
            if(el) {
                el.textContent = msg;
                el.classList.remove('hidden');
            }
            input.classList.remove('border-slate-200', 'border-teal-500', 'bg-teal-50');
            input.classList.add('border-red-500', 'bg-red-50');
        }

        function hideError(id) {
            const el = document.getElementById('error-' + id);
            const input = document.getElementById(id);
            if(el) el.classList.add('hidden');
            input.classList.remove('border-red-500', 'bg-red-50', 'border-teal-500', 'bg-teal-50');
            input.classList.add('border-slate-200');
        }

        function goToStep2() {
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            
            const v1 = validateField(name);
            const v2 = validateField(email);

            if (!v1 || !v2) return;

            // UI Transitions
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
            
            document.getElementById('bar-2').classList.remove('bg-slate-100');
            document.getElementById('bar-2').classList.add('bg-teal-600');
            document.getElementById('step-number').textContent = '2';

            // Left Panel Transitions
            const p1 = document.getElementById('step-preview-1');
            const p2 = document.getElementById('step-preview-2');
            
            p1.classList.add('opacity-50');
            p1.querySelector('div').classList.remove('bg-teal-500', 'border-teal-500', 'text-white');
            p1.querySelector('div').classList.add('border-slate-600', 'text-slate-400', 'bg-transparent');

            p2.classList.remove('opacity-50');
            p2.querySelector('div').classList.remove('border-slate-600', 'bg-transparent', 'text-slate-400');
            p2.querySelector('div').classList.add('bg-teal-500', 'border-teal-500', 'text-white');
            p2.querySelector('h4').classList.remove('text-slate-300');
            p2.querySelector('h4').classList.add('text-white');
        }

        function goToStep1() {
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');
            
            document.getElementById('bar-2').classList.remove('bg-teal-600');
            document.getElementById('bar-2').classList.add('bg-slate-100');
            document.getElementById('step-number').textContent = '1';

            // Left Panel Transitions
            const p1 = document.getElementById('step-preview-1');
            const p2 = document.getElementById('step-preview-2');
            
            p1.classList.remove('opacity-50');
            p1.querySelector('div').classList.add('bg-teal-500', 'border-teal-500', 'text-white');
            p1.querySelector('div').classList.remove('border-slate-600', 'text-slate-400', 'bg-transparent');

            p2.classList.add('opacity-50');
            p2.querySelector('div').classList.add('border-slate-600', 'bg-transparent', 'text-slate-400');
            p2.querySelector('div').classList.remove('bg-teal-500', 'border-teal-500', 'text-white');
            p2.querySelector('h4').classList.add('text-slate-300');
            p2.querySelector('h4').classList.remove('text-white');
        }
    </script>
</body>
</html>