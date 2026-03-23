<footer id="contacto" class="bg-olive-900 text-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gold-400 rounded-full flex items-center justify-center">
                        <span class="text-olive-900 font-serif font-bold text-xl">T</span>
                    </div>
                    <span class="font-serif text-cream-50 font-semibold text-xl">Un Tesoro Para Mamá</span>
                </div>
                <p class="text-cream-200 opacity-75 text-sm leading-relaxed">
                    Transformamos lo sagrado y pasajero de la lactancia en un recuerdo duradero.
                    Un kit DIY para honrar tu camino de maternidad.
                </p>
                <!-- Social media -->
                <div class="flex gap-4 mt-6">
                    <a href="{{ config('app.instagram_url') ?: '#' }}" aria-label="Instagram" {{ config('app.instagram_url') ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                       class="text-cream-200 opacity-60 hover:opacity-100 hover:text-gold-400 transition-all">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    <a href="{{ config('app.facebook_url') ?: '#' }}" aria-label="Facebook" {{ config('app.facebook_url') ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                       class="text-cream-200 opacity-60 hover:opacity-100 hover:text-gold-400 transition-all">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-serif text-cream-50 text-lg font-semibold mb-4">Explora</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}#historia" class="text-cream-200 opacity-75 hover:opacity-100 hover:text-gold-400 transition-all">Nuestra Historia</a></li>
                    <li><a href="{{ route('home') }}#kit" class="text-cream-200 opacity-75 hover:opacity-100 hover:text-gold-400 transition-all">El Kit DIY</a></li>
                    <li><a href="{{ route('home') }}#galeria" class="text-cream-200 opacity-75 hover:opacity-100 hover:text-gold-400 transition-all">Galería</a></li>
                    <li><a href="{{ route('home') }}#productos" class="text-cream-200 opacity-75 hover:opacity-100 hover:text-gold-400 transition-all">Productos</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-serif text-cream-50 text-lg font-semibold mb-4">Tienda</h4>
                <p class="text-cream-200 opacity-75 text-sm mb-4">¿Lista para crear tu joya? Encuentra el kit perfecto para ti.</p>
                <a href="{{ route('tienda') }}"
                   class="inline-flex items-center gap-2 bg-gold-400 hover:bg-gold-500 text-olive-900 px-5 py-3 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105 shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11H4L5 9z"/>
                    </svg>
                    Ver los kits
                </a>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-olive-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-cream-200 opacity-50 text-sm">
                &copy; {{ date('Y') }} Un Tesoro Para Mamá. Todos los derechos reservados.
            </p>
            @auth
                <a href="{{ route('admin.products.index') }}"
                   class="text-cream-200 opacity-40 hover:opacity-70 text-xs transition-all">
                    Panel Admin
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-cream-200 opacity-30 hover:opacity-60 text-xs transition-all">
                    Admin
                </a>
            @endauth
        </div>
    </div>
</footer>
