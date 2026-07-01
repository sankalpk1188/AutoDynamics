@php
    $hero = $showcaseData['hero'] ?? [];
    $categories = $showcaseData['categories'] ?? [];
    $steps = $showcaseData['steps'] ?? [];
    $vehicleImages = $showcaseData['vehicleImages'] ?? [];
    foreach ($vehicleImages as $key => $path) {
        $vehicleImages[$key] = asset($path);
    }
    $showcaseData['vehicleImages'] = $vehicleImages;
    $showcaseAssetVer = '20260703b';
    $svgBase = asset('assets/svg/');
    if (!str_ends_with($svgBase, '/')) {
        $svgBase .= '/';
    }
    $firstVehicleImg = $vehicleImages['interior'] ?? asset('assets/images/automotive/automotive-interior-hero.png');
@endphp

<main class="as-page" id="automotive-showcase"
      data-product-showcase
      data-asset-version="{{ $showcaseAssetVer }}"
      data-svg-base="{{ $svgBase }}">

<script type="application/json" id="as-showcase-config">@json($showcaseData)</script>

    {{-- Intro hero --}}
    <section class="as-hero" aria-label="Automotive products introduction">
        <div class="as-hero-inner">
            @if(!empty($hero['eyebrow']))
                <p class="as-hero-eyebrow">{{ $hero['eyebrow'] }}</p>
            @endif
            @if(!empty($hero['title']))
                <h1 class="as-hero-title">{{ $hero['title'] }}</h1>
            @endif
            @if(!empty($hero['lead']))
                <p class="as-hero-lead">{{ $hero['lead'] }}</p>
            @endif
            <button type="button" class="as-hero-scroll-hint" data-as-scroll-cta aria-label="Scroll down to explore product details">
                <span class="as-hero-scroll-hint-text">Scroll down for product details</span>
                <span class="as-hero-scroll-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M7.41 8.59 12 13.17l4.59-4.58L18 10l-6 6-6-6z"/></svg>
                </span>
            </button>
        </div>
    </section>

    {{-- Pinned scroll storytelling --}}
    <div class="as-scroll-track" data-as-track>
        <div class="as-pinned" data-as-pinned>
            <div class="as-layout">
                <header class="as-section-header">
                    <nav class="as-category-nav" aria-label="Product categories">
                        @foreach($categories as $cat)
                            <button type="button"
                                    class="as-category-btn{{ $loop->first ? ' is-active' : '' }}"
                                    data-as-cat="{{ $cat['id'] }}">
                                {{ $cat['label'] }}
                            </button>
                        @endforeach
                    </nav>

                    <div class="as-step-nav" aria-label="Component navigation">
                        <button type="button" class="as-nav-btn" data-as-prev aria-label="Previous component" disabled>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                        </button>
                        <span class="as-step-counter">
                            <strong data-as-step-current>1</strong> / <span data-as-step-total>{{ count($steps) }}</span>
                        </span>
                        <button type="button" class="as-nav-btn" data-as-next aria-label="Next component">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </button>
                    </div>

                    <div class="as-progress-wrap">
                        <div class="as-progress-track" role="progressbar" aria-valuemin="1" aria-valuemax="{{ count($steps) }}" aria-valuenow="1" aria-label="Showcase progress">
                            <div class="as-progress-fill" data-as-progress-fill style="width: {{ count($steps) ? round(100 / count($steps)) : 0 }}%"></div>
                        </div>
                    </div>
                </header>

                <div class="as-content">
                    <div class="as-visual-stage" data-as-stage>
                        <svg class="as-callout-svg" data-as-callout-svg aria-hidden="true">
                            <line class="as-callout-line" data-as-callout-line></line>
                        </svg>
                        <div class="as-split-visual" data-as-split-visual>
                            <div class="as-grid-overlay" aria-hidden="true"></div>
                            <div class="as-vehicle-bg-layer">
                                <img class="as-vehicle-bg"
                                     data-as-vehicle-bg
                                     src="{{ $firstVehicleImg }}"
                                     alt="Vehicle structural view"
                                     loading="eager">
                                <div class="as-vehicle-bg-vignette"></div>
                            </div>
                            <div class="as-hotspot-layer" data-as-svg-host></div>
                        </div>
                        <aside class="as-part-callout is-visible" data-as-part-name-bar aria-live="polite">
                            <span class="as-part-name-category" data-as-category>{{ $categories[0]['label'] ?? 'Interior' }}</span>
                            <h2 class="as-part-name" data-as-name>{{ $steps[0]['name'] ?? '' }}</h2>
                        </aside>
                    </div>
                </div>
            </div><!-- .as-layout -->

            <div class="as-mobile-dots" data-as-dots aria-label="Step indicators"></div>

            <button type="button" class="as-scroll-down-indicator" data-as-scroll-indicator aria-label="Scroll down to see product information">
                <span class="as-scroll-down-indicator-text">Scroll for details</span>
                <span class="as-scroll-down-indicator-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M7.41 8.59 12 13.17l4.59-4.58L18 10l-6 6-6-6z"/></svg>
                </span>
            </button>
        </div>
    </div>
</main>
