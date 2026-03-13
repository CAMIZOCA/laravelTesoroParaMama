<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $products = Product::where('is_active', true)
            ->select('slug', 'updated_at')
            ->get();

        $content = view('sitemap', compact('products'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
