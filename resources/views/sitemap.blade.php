<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    {{-- Homepage --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Static sections (anchor links) --}}
    @foreach(['historia', 'kit', 'galeria', 'productos', 'contacto'] as $section)
    <url>
        <loc>{{ url('/#' . $section) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- Products --}}
    @foreach($products as $product)
    <url>
        <loc>{{ url('/#productos') }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        @if($product->image)
        <image:image>
            <image:loc>{{ $product->image_url }}</image:loc>
            <image:title>{{ $product->name }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
