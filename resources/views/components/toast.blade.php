@if (session('status') || session('success') || session('error') || (isset($errors) && $errors->any()))
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3">
        @if (session('status'))
            <div class="toast-item flex items-center w-full max-w-xs p-4 bg-white/90 backdrop-blur-md rounded-xl shadow-2xl border-l-4 transform transition-all duration-300 translate-x-full theme-border theme-text" role="alert" style="border-color: var(--theme-color); color: var(--theme-color-dark);">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color-dark);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="ml-3 text-sm font-medium text-slate-700">{{ session('status') }}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white/50 text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

        @if (session('success'))
            <div class="toast-item flex items-center w-full max-w-xs p-4 bg-white/90 backdrop-blur-md rounded-xl shadow-2xl border-l-4 transform transition-all duration-300 translate-x-full theme-border theme-text" role="alert" style="border-color: var(--theme-color); color: var(--theme-color-dark);">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white); color: var(--theme-color-dark);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="ml-3 text-sm font-medium text-slate-700">{{ session('success') }}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white/50 text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="toast-item flex items-center w-full max-w-xs p-4 text-red-500 bg-white/90 backdrop-blur-md rounded-xl shadow-2xl border-l-4 border-red-500 transform transition-all duration-300 translate-x-full" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-800 bg-red-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="ml-3 text-sm font-medium text-slate-700">{{ session('error') }}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white/50 text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast-item flex items-center w-full max-w-xs p-4 text-red-500 bg-white/90 backdrop-blur-md rounded-xl shadow-2xl border-l-4 border-red-500 transform transition-all duration-300 translate-x-full" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-800 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="ml-3 text-sm font-medium text-slate-700">{{ $error }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white/50 text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
                        <span class="sr-only">Cerrar</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toasts = document.querySelectorAll('.toast-item');
            toasts.forEach((toast, index) => {
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                }, 100 * (index + 1));

                // Auto dismiss
                setTimeout(() => {
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 300);
                }, 5000);
            });
        });
    </script>
@endif
