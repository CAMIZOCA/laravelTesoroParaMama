<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\PageContent;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', true)
            ->with(['activeProducts'])
            ->orderBy('order')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->orderBy('order')
            ->get();

        // If no featured products, get all active products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('is_active', true)
                ->with('category')
                ->orderBy('order')
                ->get();
        }

        $galleryItems = GalleryItem::where('is_active', true)
            ->orderBy('order')
            ->get();

        $whatsappNumber = config('app.whatsapp_number', '593999829469');
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode('Hola! Me interesa conocer más sobre los kits de joyería de leche materna. ¿Podría darme información?');

        $defaults = PageContent::defaults();
        $saved    = PageContent::all_settings();
        $c        = array_merge($defaults, $saved);

        return view('home', compact(
            'categories',
            'featuredProducts',
            'galleryItems',
            'whatsappUrl',
            'c'
        ));
    }
}
