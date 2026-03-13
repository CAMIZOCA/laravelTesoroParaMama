@php
    use App\Models\SeoSetting;
    $seo     = SeoSetting::all_settings();
    $defaults = SeoSetting::defaults();

    // Helper to get seo value with page override or default
    $s = fn(string $key) => ($seo[$key] ?? $defaults[$key] ?? '');

    $pageTitle       = trim(View::yieldContent('seo_title') ?: View::yieldContent('title'));
    $pageDescription = trim(View::yieldContent('seo_description') ?: View::yieldContent('meta_description'));

    $finalTitle       = $pageTitle       ?: $s('meta_title');
    $finalDescription = $pageDescription ?: $s('meta_description');
    $finalOgTitle     = $s('og_title') ?: $finalTitle;
    $finalOgDesc      = $s('og_description') ?: $finalDescription;
    $canonicalUrl     = $s('canonical_url') ?: url()->current();
    $ogImage          = $s('og_image') ?: asset('images/og-default.jpg');
@endphp
<!DOCTYPE html>
<html lang="es" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- ── Title ── --}}
    <title>{{ $finalTitle }}</title>

    {{-- ── Basic SEO ── --}}
    <meta name="description"  content="{{ $finalDescription }}">
    @if($s('meta_keywords'))
    <meta name="keywords"     content="{{ $s('meta_keywords') }}">
    @endif
    <meta name="author"       content="{{ $s('site_name') }}">
    <meta name="robots"       content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical"     href="{{ $canonicalUrl }}">

    {{-- ── Open Graph ── --}}
    <meta property="og:type"        content="{{ $s('og_type') ?: 'website' }}">
    <meta property="og:url"         content="{{ $canonicalUrl }}">
    <meta property="og:title"       content="{{ $finalOgTitle }}">
    <meta property="og:description" content="{{ $finalOgDesc }}">
    <meta property="og:site_name"   content="{{ $s('site_name') }}">
    <meta property="og:locale"      content="es_EC">
    @if($ogImage)
    <meta property="og:image"       content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height"content="630">
    <meta property="og:image:alt"   content="{{ $finalOgTitle }}">
    @endif

    {{-- ── Twitter / X Card ── --}}
    <meta name="twitter:card"        content="{{ $s('twitter_card') ?: 'summary_large_image' }}">
    <meta name="twitter:title"       content="{{ $finalOgTitle }}">
    <meta name="twitter:description" content="{{ $finalOgDesc }}">
    @if($ogImage)
    <meta name="twitter:image"       content="{{ $ogImage }}">
    @endif
    @if($s('twitter_site'))
    <meta name="twitter:site"        content="{{ $s('twitter_site') }}">
    @endif
    @if($s('twitter_creator'))
    <meta name="twitter:creator"     content="{{ $s('twitter_creator') }}">
    @endif

    {{-- ── Schema.org JSON-LD ── --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "{{ $s('schema_type') ?: 'LocalBusiness' }}",
        "name": "{{ $s('site_name') }}",
        "description": "{{ $finalDescription }}",
        "url": "{{ url('/') }}"
        @if($s('schema_phone'))
        ,"telephone": "{{ $s('schema_phone') }}"
        @endif
        @if($s('schema_email'))
        ,"email": "{{ $s('schema_email') }}"
        @endif
        @if($s('schema_address'))
        ,"address": {
            "@type": "PostalAddress",
            "addressLocality": "{{ $s('schema_address') }}"
        }
        @endif
        @if($ogImage)
        ,"image": "{{ $ogImage }}"
        @endif
        ,"contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $s('schema_phone') ?: config('app.whatsapp_number') }}",
            "contactType": "sales",
            "availableLanguage": "Spanish"
        }
    }
    </script>

    {{-- ── Favicon ── --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png"     href="{{ asset('favicon.png') }}" sizes="32x32">

    {{-- ── Fonts & Assets ── --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//wa.me">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ── Google Tag Manager ── --}}
    @if($s('google_tag_manager_id'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $s("google_tag_manager_id") }}');</script>
    @endif

    {{-- ── Google Analytics (GA4) ── --}}
    @if($s('google_analytics_id') && !$s('google_tag_manager_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $s('google_analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $s("google_analytics_id") }}');
    </script>
    @endif

    @stack('head')
</head>
<body class="bg-cream-50 text-olive-900 antialiased">

    {{-- ── GTM noscript ── --}}
    @if($s('google_tag_manager_id'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $s('google_tag_manager_id') }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('components.navbar')

    <main id="main-content">
        @yield('content')
    </main>

    @include('components.footer')

    {{-- ── Facebook Pixel ── --}}
    @if($s('facebook_pixel_id'))
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init','{{ $s("facebook_pixel_id") }}');
    fbq('track','PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id={{ $s('facebook_pixel_id') }}&ev=PageView&noscript=1"/></noscript>
    @endif

    {{-- ── WhatsApp flotante ── --}}
    <a href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Hola! Me interesa conocer más sobre los kits de joyería de leche materna. ¿Podría darme información?') }}"
       target="_blank"
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-110"
       aria-label="Contactar por WhatsApp">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    @stack('scripts')
</body>
</html>
