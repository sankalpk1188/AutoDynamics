<!DOCTYPE html>
<html lang="en" class="aex-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="color-scheme" content="dark">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/fevicon_deepdive.png') }}">
    <title>@if(!empty($meta_title)){{ $meta_title }}@else{{ config('app.name') }} — Automotive@endif</title>
    <meta name="description" content="Automotive systems storytelling — premium scroll experience.">
    {{-- Core stack: GSAP 3 + ScrollTrigger (local), Lenis (CDN), Tailwind 3 (CDN, tw- prefix) — avoids Bootstrap conflicts. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            prefix: 'tw-',
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        aex: { ink: '#020508', panel: '#0a1218', line: 'rgba(148, 188, 220, 0.12)', cyan: '#3ee7c7', dim: 'rgba(62, 231, 199, 0.14)' }
                    },
                    fontFamily: { display: ['"DM Sans"', 'system-ui', 'sans-serif'], sans: ['"Inter"', 'system-ui', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9,40,300;0,9,40,500;0,9,40,600;0,9,40,800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @stack('aex_head')
    @stack('aex_styles')
    <style>
        .aex-html, .aex-body { margin: 0; background: #020508; }
        #automotive-experience { isolation: isolate; }
        @@media (prefers-reduced-motion: reduce) {
            .aex-reduced [data-aex-anim] { transition: none !important; animation: none !important; }
        }
    </style>
</head>
<body class="aex-body tw-bg-aex-ink tw-text-slate-200 tw-font-sans aex-reduced" id="aex-page">
    @include('layouts.frontLayout.front_header')
    <main id="automotive-experience" class="tw-relative">
        @yield('content')
    </main>
    @include('layouts.frontLayout.front_footer')

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js" crossorigin="anonymous"></script>
    <script>
        if (window.gsap && window.ScrollTrigger) { gsap.registerPlugin(ScrollTrigger); }
    </script>
    @stack('aex_scripts')
</body>
</html>
