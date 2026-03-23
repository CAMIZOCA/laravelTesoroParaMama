<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructionsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

// ── Public routes ──────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/instrucciones', [InstructionsController::class, 'index'])->name('instrucciones');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');
Route::get('/media/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.show');

// ── Store ──────────────────────────────────────────────────────────────────────
Route::get('/tienda', [StoreController::class, 'index'])->name('tienda');
Route::get('/productos/{slug}', [StoreController::class, 'show'])->name('producto.show');

// ── Cart ───────────────────────────────────────────────────────────────────────
Route::get('/carrito', [CartController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/{cartKey}', [CartController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/{cartKey}', [CartController::class, 'remove'])->name('carrito.remove');
Route::get('/carrito/count', [CartController::class, 'count'])->name('carrito.count');

// ── Checkout ───────────────────────────────────────────────────────────────────
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// ── Payment (PayPhone) ─────────────────────────────────────────────────────────
Route::get('/pago', [PaymentController::class, 'index'])->name('pago.index');
Route::post('/pago/preparar', [PaymentController::class, 'prepare'])->name('pago.preparar');
Route::get('/pago/respuesta', [PaymentController::class, 'response'])->name('pago.respuesta');
Route::get('/pago/cancelado', [PaymentController::class, 'cancelled'])->name('pago.cancelado');

// ── Admin routes ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);

    Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
    Route::post('seo', [SeoController::class, 'update'])->name('seo.update');

    Route::get('content', [PageContentController::class, 'index'])->name('content.index');
    Route::post('content', [PageContentController::class, 'update'])->name('content.update');

    Route::get('theme', [ThemeController::class, 'index'])->name('theme.index');
    Route::post('theme', [ThemeController::class, 'update'])->name('theme.update');
    Route::post('theme/palette', [ThemeController::class, 'applyPalette'])->name('theme.palette');
});

// ── Profile ────────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
