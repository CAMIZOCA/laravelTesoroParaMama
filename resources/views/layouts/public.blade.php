@php
    $seo     = \App\Models\SeoSetting::all_settings();
    $defaults = \App\Models\SeoSetting::defaults();

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
            "telephone": "{{ $s('schema_phone') }}",
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ── Theme CSS Custom Properties ── --}}
    @php
        $themeDefaults = \App\Models\ThemeSetting::defaults();
        $themeSaved    = \App\Models\ThemeSetting::all_settings();
        $t             = array_merge($themeDefaults, $themeSaved);
    @endphp
    <style>
        :root {
            --color-primary:    {{ $t['theme_color_primary'] }};
            --color-secondary:  {{ $t['theme_color_secondary'] }};
            --color-accent:     {{ $t['theme_color_accent'] }};
            --color-bg-main:    {{ $t['theme_color_bg_main'] }};
            --color-bg-section: {{ $t['theme_color_bg_section'] }};
            --color-btn:        {{ $t['theme_color_btn'] }};
            --color-btn-hover:  {{ $t['theme_color_btn_hover'] }};
            --color-btn-text:   {{ $t['theme_color_btn_text'] }};
            --color-title:      {{ $t['theme_color_title'] }};
            --color-text:       {{ $t['theme_color_text'] }};
            --color-link:       {{ $t['theme_color_link'] }};
            --color-card:       {{ $t['theme_color_card'] }};
            --color-border:     {{ $t['theme_color_border'] }};
            --color-badge:      {{ $t['theme_color_badge'] }};
            --color-footer:     {{ $t['theme_color_footer'] }};
            --color-header:     {{ $t['theme_color_header'] }};
        }
    </style>

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

    @stack('scripts')
</body>
</html>
