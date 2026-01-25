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
<body class="flex items-center justify-center min-h-screen bg-slate-100 overflow-hidden relative font-sans">
    
    <!-- Background Pattern -->
    <div class="fixed inset-0 pointer-events-none opacity-40 bg-grid-pattern"></div>

    <!-- Main Card -->
    <div class="w-[95%] max-w-5xl h-[85vh] min-h-[650px] flex glass-card rounded-[24px] overflow-hidden shadow-xl relative z-10 fade-in-up border border-slate-200">
        <!-- Visual Side (Dark Slate) -->
        <div class="hidden lg:flex lg:flex-[0.9] relative bg-slate-900 text-white flex-col justify-between p-12 overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 100% 100%, #14b8a6 0%, transparent 50%);"></div>
            
            <!-- Branding -->
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm border border-white/10 mb-8">
                    <span class="font-display font-bold text-xl">L</span>
                </div>
                
                <h2 class="font-display text-4xl font-bold mb-6 leading-tight tracking-tight">
                    Comunidad <br>
                    <span class="text-teal-400">Conectada.</span>
                </h2>
                <p class="text-slate-400 text-lg leading-relaxed max-w-sm font-light">
                    Gestiona tu comunidad con eficiencia y transparencia. Un sistema diseñado para el bienestar social.
                </p>
            </div>
            
            <!-- Features List -->
            <div class="relative z-10 space-y-5">
                <div class="flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-teal-900/30 transition-colors">
                        <svg class="w-5 h-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-slate-200 text-sm">Registro Seguro</h4>
                        <p class="text-xs text-slate-500">Datos protegidos y accesibles</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-teal-900/30 transition-colors">
                        <svg class="w-5 h-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-slate-200 text-sm">Gestión Local</h4>
                        <p class="text-xs text-slate-500">Control por sectores</p>
                    </div>
                </div>
            </div>
            
            <div class="text-xs text-slate-600">
                &copy; {{ date('Y') }} La Batalla
            </div>
        </div>

        <!-- Form Side -->
        <div class="flex-1 p-8 md:p-14 flex flex-col justify-center bg-white relative overflow-y-auto">
             <!-- Mobile Visual Header -->
             <div class="lg:hidden mb-8 text-center">
                 <div class="w-10 h-10 bg-slate-900 text-white rounded-lg flex items-center justify-center mx-auto mb-3 shadow-md font-bold">L</div>
                 <h2 class="text-xl font-bold text-slate-900">La Batalla</h2>
             </div>

            <div class="mb-8 text-center lg:text-left">
                <h1 class="font-display text-2xl font-bold text-slate-900 mb-2">@yield('title')</h1>
                <p class="text-slate-500 text-sm">@yield('subtitle')</p>
            </div>

            @yield('content')
            
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-200">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-[90%] transform scale-95 transition-all duration-200 shadow-2xl">
            <div class="text-center">
                <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-slate-900 mb-2">Atención</h3>
                <div id="modalContent" class="text-slate-600 text-sm mb-6"></div>
                <button onclick="closeModal()" class="w-full bg-slate-900 text-white font-medium py-2.5 rounded-lg hover:bg-slate-800 transition-colors">
                    Entendido
                </button>
            </div>
        </div>
    </div>

    <script>
        // ... (Keep existing script logic but ensure it works with new classes if needed)
        // Re-using the same robust validation script
        document.addEventListener('DOMContentLoaded', () => {
             // ... [Input validation logic remains largely the same, mostly class adjustments]
             // Validation logic implementation
             const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input[required]');
                
                inputs.forEach(input => {
                    let errorSpan = input.parentNode.querySelector('.js-error-msg');
                    if (!errorSpan) {
                        errorSpan = document.createElement('span');
                        errorSpan.className = 'absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium opacity-0 transition-opacity duration-300 js-error-msg';
                        input.parentNode.appendChild(errorSpan);
                    }

                    input.addEventListener('input', () => validateField(input));
                    input.addEventListener('blur', () => validateField(input));
                });
            });
        });

        function validateField(input) {
            const errorSpan = input.parentNode.querySelector('.js-error-msg');
            let isValid = true;
            let message = '';

            input.classList.remove('border-red-500', 'focus:border-red-500', 'ring-red-500/10');
            // We can add a subtle green border for valid state if desired, or keep it clean.
            // Let's keep it clean for this design, only showing errors.

            if (!input.value.trim()) {
                isValid = false;
                if (event.type === 'blur') message = 'Requerido';
            }

            if (isValid && input.type === 'email' && input.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value.trim())) {
                    isValid = false;
                    message = 'Email inválido';
                }
            }

            if (isValid && input.name === 'password' && input.value.length > 0) {
                if (input.value.length < 8) {
                    isValid = false;
                    message = 'Mínimo 8 caracteres';
                }
            }

             if (isValid && input.name === 'password_confirmation') {
                const form = input.closest('form');
                const password = form.querySelector('input[name="password"]').value;
                if (password && input.value !== password) {
                    isValid = false;
                    message = 'No coinciden';
                }
            }

            if (!isValid && message) {
                input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/10');
                if (errorSpan) {
                    errorSpan.textContent = message;
                    errorSpan.classList.remove('opacity-0');
                }
            } else {
                 if (errorSpan) errorSpan.classList.add('opacity-0');
            }

            return isValid;
        }

        function showModal(message, errors = []) {
            const modalContent = document.getElementById('modalContent');
            let content = `<p class="mb-3">${message}</p>`;
            
            if (errors.length > 0) {
                content += '<div class="text-left bg-red-50 p-3 rounded-lg space-y-1 text-xs text-red-700">';
                errors.forEach(err => {
                    content += `<div class="flex items-start gap-2"><span>•</span><span>${err}</span></div>`;
                });
                content += '</div>';
            }
            
            modalContent.innerHTML = content;
            const modal = document.getElementById('errorModal');
            modal.classList.remove('opacity-0', 'invisible');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
        }

         function validateForm(formId, event) {
            event.preventDefault();
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input[required]');
            let errors = [];
            // ... (Simple validation check similar to before)
            
             inputs.forEach(input => {
                if (!input.value.trim()) {
                     input.classList.add('border-red-500');
                     errors.push('Complete todos los campos requeridos');
                }
            });

            if (errors.length > 0) {
                 // simplify error for cleaner UX
                 showModal('Por favor, verifique los campos marcados en rojo.');
                 return false;
            }
            
            // Logic validation
            if(form.querySelector('input[type="email"]') && !validateField(form.querySelector('input[type="email"]'))) return false;
            
            // Loading state
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerHTML = `<span class="inline-block animate-spin mr-2">⟳</span> Procesando...`;
            btn.disabled = true;
            btn.classList.add('opacity-75');

            form.submit();
        }
    </script>
</body>
</html>
