<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen gradient-animated overflow-hidden relative">
    
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-lb-accent/10 rounded-full blur-3xl" style="animation: float 8s ease-in-out infinite;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-lb-primary-light/5 rounded-full blur-3xl" style="animation: float 10s ease-in-out infinite;"></div>
    </div>

    <!-- Main Card -->
    <div class="w-[95%] max-w-5xl h-[85vh] min-h-[650px] flex glass-card rounded-[32px] overflow-hidden shadow-2xl relative z-10 fade-in-up">
        <!-- Visual Side -->
        <div class="hidden lg:flex lg:flex-[1.1] relative bg-gradient-to-br from-lb-primary/90 via-lb-primary-dark/90 to-lb-secondary/90 text-white flex-col justify-between p-12 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 pattern-dots opacity-20 user-select-none pointer-events-none"></div>
            
            <!-- Floating Top Element -->
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/20 mb-8 animate-float">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                
                <h2 class="font-display text-4xl font-bold mb-4 leading-tight">
                    Comunidad saludable,<br>futuro seguro.
                </h2>
                <p class="text-white/80 text-lg leading-relaxed max-w-sm">
                    Gestión integral de salud comunitaria con tecnología al servicio de las personas.
                </p>
            </div>
            
            <!-- Features List -->
            <div class="relative z-10 space-y-6">
                <div class="glass p-4 rounded-xl border border-white/10 flex items-center gap-4 hover-lift transition-transform cursor-default">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-sm">Registro Digital</h4>
                        <p class="text-xs text-white/70">Expedientes seguros y accesibles</p>
                    </div>
                </div>
                
                <div class="glass p-4 rounded-xl border border-white/10 flex items-center gap-4 hover-lift transition-transform cursor-default" style="animation-delay: 0.1s;">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-sm">Control Territorial</h4>
                        <p class="text-xs text-white/70">Gestión por sectores y calles</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="flex-1 p-10 md:p-14 flex flex-col justify-center bg-white/80 backdrop-blur-lg relative overflow-y-auto">
             <!-- Mobile Visual Header (Only visible on small screens) -->
             <div class="lg:hidden mb-8 text-center">
                 <div class="w-12 h-12 bg-lb-primary text-white rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                 </div>
                 <h2 class="text-xl font-bold text-slate-900">La Batalla</h2>
             </div>

            <div class="mb-10">
                <h1 class="font-display text-3xl font-bold text-slate-900 mb-2">@yield('title')</h1>
                <p class="text-slate-500 text-lg">@yield('subtitle')</p>
            </div>

            @yield('content')
            
            <div class="mt-auto pt-6 text-center">
                <p class="text-slate-400 text-xs font-medium">
                    &copy; {{ date('Y') }} La Batalla - Sistema Comunitario
                </p>
            </div>
        </div>
    </div>

    <!-- Premium Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="glass-card rounded-3xl p-8 max-w-md w-[90%] transform scale-90 transition-all duration-300 shadow-2xl border border-white/50">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner animate-pulse">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-slate-900 mb-2">Atención</h3>
                <div id="modalContent" class="text-slate-600 mb-8"></div>
                <button onclick="closeModal()" class="btn-premium w-full text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all">
                    Entendido
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input[required]');
                
                inputs.forEach(input => {
                    // Create error message container if it doesn't exist
                    let errorSpan = input.parentNode.querySelector('.js-error-msg');
                    if (!errorSpan) {
                        errorSpan = document.createElement('span');
                        errorSpan.className = 'absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium opacity-0 transition-opacity duration-300 js-error-msg';
                        input.parentNode.appendChild(errorSpan);
                    }

                    // Validate on input
                    input.addEventListener('input', () => validateField(input));
                    // Validate on blur
                    input.addEventListener('blur', () => validateField(input));
                });
            });
        });

        function validateField(input) {
            const errorSpan = input.parentNode.querySelector('.js-error-msg');
            let isValid = true;
            let message = '';

            // Reset styles
            input.classList.remove('border-green-500', 'focus:border-green-500', 'ring-green-500/20');
            input.classList.remove('border-red-500', 'focus:border-red-500', 'ring-red-500/20');

            // Required check
            if (!input.value.trim()) {
                isValid = false;
               // Don't show "required" error immediately on empty focus, only on blur or if it was previously errored
               if (event.type === 'blur') message = 'Este campo es obligatorio.';
            }

            // Email check
            if (isValid && input.type === 'email' && input.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value.trim())) {
                    isValid = false;
                    message = 'Por favor ingresa un correo válido.';
                }
            }

            // Password length check
            if (isValid && input.name === 'password' && input.value.length > 0) {
                if (input.value.length < 8) {
                    isValid = false;
                    message = 'La contraseña debe tener al menos 8 caracteres.';
                }
            }

            // Confirm Password check
            if (isValid && input.name === 'password_confirmation') {
                const form = input.closest('form');
                const password = form.querySelector('input[name="password"]').value;
                if (password && input.value !== password) {
                    isValid = false;
                    message = 'Las contraseñas no coinciden.';
                }
            }

            // Apply styles and message
            if (!isValid && message) {
                input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                if (errorSpan) {
                    errorSpan.textContent = message;
                    errorSpan.classList.remove('opacity-0');
                }
            } else if (isValid && input.value.trim()) {
                input.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500/20');
                if (errorSpan) {
                    errorSpan.classList.add('opacity-0');
                }
            } else {
                // Empty and valid (e.g. initial state)
                if (errorSpan) errorSpan.classList.add('opacity-0');
            }

            return isValid;
        }

        function showModal(message, errors = []) {
            const modalContent = document.getElementById('modalContent');
            let content = `<p class="mb-4 text-base">${message}</p>`;
            
            if (errors.length > 0) {
                content += '<div class="text-left bg-red-50/80 border border-red-200 rounded-xl p-4 space-y-2.5 text-sm text-red-700 max-h-48 overflow-y-auto">';
                errors.forEach(err => {
                    content += `<div class="flex items-start gap-2.5"><svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>${err}</span></div>`;
                });
                content += '</div>';
            }
            
            modalContent.innerHTML = content;
            const modal = document.getElementById('errorModal');
            modal.classList.remove('opacity-0', 'invisible');
            modal.querySelector('.glass-card').classList.remove('scale-90');
            modal.querySelector('.glass-card').classList.add('scale-100');
        }

        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.querySelector('.glass-card').classList.remove('scale-100');
            modal.querySelector('.glass-card').classList.add('scale-90');
        }
        
        document.getElementById('errorModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function validateForm(formId, event) {
            event.preventDefault();
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input[required]');
            let errors = [];
            let hasError = false;
            
            inputs.forEach(input => {
                // Force validation on submit to catch empty fields
                if (!input.value.trim()) {
                     const labelElement = document.querySelector(`label[for="${input.id}"]`);
                     const label = labelElement ? labelElement.innerText : (input.name === 'name' ? 'Nombre' : input.name);
                     errors.push(`El campo <strong>"${label}"</strong> es obligatorio.`);
                     hasError = true;
                     input.classList.add('border-red-500');
                } else if (!validateField(input)) {
                     // If field is invalid logic-wise (e.g. bad email)
                     hasError = true;
                     // Logic checks usually add their own message to UI, but we collect for modal too
                     if (input.type === 'email') errors.push('El formato del correo electrónico es inválido.');
                     if (input.name === 'password' && input.value.length < 8) errors.push('La contraseña debe tener al menos 8 caracteres.');
                     if (input.name === 'password_confirmation') errors.push('Las contraseñas no coinciden.');
                }
            });

            if (errors.length > 0) {
                // Eliminate duplicates
                errors = [...new Set(errors)];
                showModal('¡Ups! No podemos procesar tu solicitud todavía:', errors);
                return false;
            }

            // Button loading state
            const btn = form.querySelector('button[type="submit"]');
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Procesando...`;
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            form.submit();
        }
    </script>
</body>
</html>
