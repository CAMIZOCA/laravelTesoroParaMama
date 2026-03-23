<nav class="fixed top-0 left-0 right-0 z-50 bg-cream-50/90 backdrop-blur-md border-b border-cream-200/50"
     x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gold-400 rounded-full flex items-center justify-center shadow-sm">
                    <span class="text-olive-900 font-serif font-bold text-lg">T</span>
                </div>
                <span class="font-serif text-olive-900 font-semibold text-lg hidden sm:block">Un Tesoro Para Mamá</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}#historia"
                   class="text-olive-800 hover:text-gold-500 font-medium text-sm transition-colors">Historia</a>
                <a href="{{ route('home') }}#kit"
                   class="text-olive-800 hover:text-gold-500 font-medium text-sm transition-colors">El Kit</a>
                <a href="{{ route('home') }}#galeria"
                   class="text-olive-800 hover:text-gold-500 font-medium text-sm transition-colors">Galería</a>
                <a href="{{ route('home') }}#contacto"
                   class="text-olive-800 hover:text-gold-500 font-medium text-sm transition-colors">Contacto</a>
                <a href="{{ route('tienda') }}" class="btn-primary-sm text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                    </svg>
                    Tienda
                </a>
            </div>

            <!-- Mobile hamburger -->
            <button @click="open = !open"
                    class="md:hidden p-2 text-olive-800 hover:text-olive-900 focus:outline-none"
                    aria-label="Abrir menú">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden pb-4 border-t border-cream-200 mt-2 pt-4 space-y-2"
             style="display:none;">
            <a href="{{ route('home') }}#historia" @click="open=false"
               class="block px-3 py-2 text-olive-800 hover:text-gold-500 font-medium">Historia</a>
            <a href="{{ route('home') }}#kit" @click="open=false"
               class="block px-3 py-2 text-olive-800 hover:text-gold-500 font-medium">El Kit</a>
            <a href="{{ route('home') }}#galeria" @click="open=false"
               class="block px-3 py-2 text-olive-800 hover:text-gold-500 font-medium">Galería</a>
            <a href="{{ route('home') }}#contacto" @click="open=false"
               class="block px-3 py-2 text-olive-800 hover:text-gold-500 font-medium">Contacto</a>
            <div class="pt-2">
                <a href="{{ route('tienda') }}" class="btn-primary-sm w-full justify-center">
                    Ver la tienda
                </a>
            </div>
        </div>
    </div>
</nav>
