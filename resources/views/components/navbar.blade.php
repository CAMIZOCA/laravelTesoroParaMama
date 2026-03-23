<nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-cream-200/60 shadow-sm"
     x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-champagne-300 rounded-full flex items-center justify-center shadow-sm">
                    <span class="text-taupe-800 font-serif font-bold text-base">T</span>
                </div>
                <span class="font-serif text-taupe-900 font-semibold text-base hidden sm:block tracking-tight">
                    Un Tesoro Para Mamá
                </span>
            </a>

            {{-- Desktop nav --}}
            <div class="hidden md:flex items-center gap-7">
                <a href="{{ route('home') }}#historia"
                   class="text-taupe-500 hover:text-taupe-900 text-sm transition-colors duration-200">
                    Historia
                </a>
                <a href="{{ route('home') }}#proceso"
                   class="text-taupe-500 hover:text-taupe-900 text-sm transition-colors duration-200">
                    Cómo funciona
                </a>
                <a href="{{ route('home') }}#galeria"
                   class="text-taupe-500 hover:text-taupe-900 text-sm transition-colors duration-200">
                    Galería
                </a>
                <a href="{{ route('home') }}#contacto"
                   class="text-taupe-500 hover:text-taupe-900 text-sm transition-colors duration-200">
                    Contacto
                </a>

                <div class="w-px h-4 bg-cream-200 mx-1"></div>

                <a href="{{ route('tienda') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-medium
                          border border-taupe-300 hover:border-champagne-400
                          text-taupe-700 hover:text-taupe-900
                          px-4 py-2 rounded-full transition-all duration-200 hover:bg-champagne-100">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                    </svg>
                    Tienda
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="open = !open"
                    class="md:hidden p-2 text-taupe-600 hover:text-taupe-900 focus:outline-none"
                    aria-label="Abrir menú">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-cream-200 pt-4 pb-5 space-y-1"
             style="display:none;">
            <a href="{{ route('home') }}#historia" @click="open=false"
               class="block px-3 py-2.5 text-taupe-600 hover:text-taupe-900 text-sm">Historia</a>
            <a href="{{ route('home') }}#proceso" @click="open=false"
               class="block px-3 py-2.5 text-taupe-600 hover:text-taupe-900 text-sm">Cómo funciona</a>
            <a href="{{ route('home') }}#galeria" @click="open=false"
               class="block px-3 py-2.5 text-taupe-600 hover:text-taupe-900 text-sm">Galería</a>
            <a href="{{ route('home') }}#contacto" @click="open=false"
               class="block px-3 py-2.5 text-taupe-600 hover:text-taupe-900 text-sm">Contacto</a>
            <div class="pt-3 px-3">
                <a href="{{ route('tienda') }}"
                   class="w-full inline-flex items-center justify-center gap-2 text-sm font-medium
                          bg-taupe-900 hover:bg-taupe-800 text-white
                          py-3 px-5 rounded-xl transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                    </svg>
                    Ver la tienda
                </a>
            </div>
        </div>
    </div>
</nav>
