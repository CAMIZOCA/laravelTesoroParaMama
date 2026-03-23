<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Support\StoresUniqueUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    use StoresUniqueUploads;

    public function index(): View
    {
        $products = Product::with('category')->orderBy('order')->orderBy('name')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'includes' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['stock'] = $request->filled('stock') ? (int) $request->stock : null;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeUniquePublicFile($request->file('image'), 'products');
        }

        if ($request->filled('includes')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->includes)));
            $validated['includes'] = array_values($lines);
        }

        // Parse variants from name[] / price[] arrays
        $variantNames  = $request->input('variant_names', []);
        $variantPrices = $request->input('variant_prices', []);
        $variants = [];
        foreach ($variantNames as $i => $vname) {
            $vname = trim($vname);
            if ($vname !== '' && isset($variantPrices[$i]) && $variantPrices[$i] !== '') {
                $variants[] = ['name' => $vname, 'price' => (float) $variantPrices[$i], 'stock' => null];
            }
        }
        $validated['variants'] = !empty($variants) ? $variants : null;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $includesText = $product->includes ? implode("\n", $product->includes) : '';
        return view('admin.products.edit', compact('product', 'categories', 'includesText'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'includes' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['stock'] = $request->filled('stock') ? (int) $request->stock : null;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeUniquePublicFile($request->file('image'), 'products');
        }

        if ($request->filled('includes')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->includes)));
            $validated['includes'] = array_values($lines);
        } else {
            $validated['includes'] = null;
        }

        // Parse variants from name[] / price[] arrays
        $variantNames  = $request->input('variant_names', []);
        $variantPrices = $request->input('variant_prices', []);
        $variants = [];
        foreach ($variantNames as $i => $vname) {
            $vname = trim($vname);
            if ($vname !== '' && isset($variantPrices[$i]) && $variantPrices[$i] !== '') {
                $variants[] = ['name' => $vname, 'price' => (float) $variantPrices[$i], 'stock' => null];
            }
        }
        $validated['variants'] = !empty($variants) ? $variants : null;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
