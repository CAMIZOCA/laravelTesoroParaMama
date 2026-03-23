<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->categoria));
        }

        $products   = $query->orderBy('order')->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('order')->get();

        return view('tienda', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->limit(3)
            ->get();

        return view('producto', compact('product', 'related'));
    }
}
