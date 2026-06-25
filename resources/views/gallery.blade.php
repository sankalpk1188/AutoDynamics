@extends('layouts/frontLayout/front_design')

@section('styles')
<style>
    .gallery-page { overflow-x: hidden; background: #000; color: #e2eaf5; }
    .ab-banner { position: relative; overflow: hidden; background: #0c2340; padding: 62px 0 90px; }
    .ab-banner-lines { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .ab-speed-line { position: absolute; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07) 30%, rgba(255,255,255,0.03) 70%, transparent); animation: abSpeedLine var(--dur) linear infinite; opacity: 0; }
    .ab-speed-line:nth-child(1) { top: 18%; left: -40%; width: 70%; --dur: 3s; animation-delay: 0s; }
    .ab-speed-line:nth-child(2) { top: 35%; left: -50%; width: 85%; --dur: 4s; animation-delay: 0.8s; }
    .ab-speed-line:nth-child(3) { top: 52%; left: -30%; width: 60%; --dur: 2.8s; animation-delay: 0.4s; }
    .ab-speed-line:nth-child(4) { top: 68%; left: -60%; width: 90%; --dur: 4.5s; animation-delay: 1.5s; }
    .ab-speed-line:nth-child(5) { top: 82%; left: -45%; width: 75%; --dur: 3.2s; animation-delay: 0.2s; }
    @keyframes abSpeedLine { 0% { transform: translateX(0); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateX(200%); opacity: 0; } }
    .ab-banner-inner { position: relative; z-index: 2; }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a, .ab-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem, 4.5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 620px; line-height: 1.7; margin: 0; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .gl-wrap { padding: 56px 0 68px; position: relative; }
    .gl-wrap::before { content: ""; position: absolute; inset: 0; background: radial-gradient(760px 340px at 50% 50%, rgba(62,122,216,0.13), rgba(62,122,216,0.03) 48%, transparent 72%); pointer-events: none; }
    .gl-wrap .container { position: relative; z-index: 1; }
    .gl-filters { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 22px; }
    .gl-filter { display: inline-flex; align-items: center; border-radius: 999px; padding: 7px 14px; font-size: 0.84rem; font-weight: 600; border: 1px solid rgba(130,175,240,0.24); color: #c2d7ee; text-decoration: none; }
    .gl-filter.active { background: rgba(124,183,255,0.2); color: #e8f2ff; }

    .gl-card { background: rgba(15, 25, 45, 0.75); border: 1px solid rgba(130,175,240,0.16); border-radius: 14px; overflow: hidden; height: 100%; transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease; }
    .gl-card:hover { transform: translateY(-4px); border-color: rgba(156,199,255,0.32); box-shadow: 0 16px 32px rgba(9,28,56,0.32); }
    .gl-media { position: relative; background: rgba(180, 196, 216, 0.18); min-height: 220px; display: flex; align-items: center; justify-content: center; }
    .gl-media img { width: 100%; height: 220px; object-fit: cover; }
    .gl-index { position: absolute; top: 12px; left: 12px; width: 32px; height: 32px; border-radius: 50%; background: #0c4b8f; color: #fff; font-size: .85rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .gl-body { padding: 14px 16px; }
    .gl-title { color: #f0f7ff; font-size: 1rem; font-weight: 700; line-height: 1.35; margin: 0 0 6px; }
    .gl-cat { color: #95b5d8; font-size: .82rem; margin: 0; }
    .gl-empty { color: #b6cbe2; }
    .gl-pagination .pagination { justify-content: center; }
    .gl-pagination .page-link { background: #0f2236; border-color: rgba(255,255,255,.15); color: #dce8f5; }
    .gl-pagination .page-item.active .page-link { background: #1e66f5; border-color: #1e66f5; color: #fff; }
</style>
@endsection('styles')

@section('content')
<main class="main gallery-page">
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a><span class="sep">/</span><span>Media</span><span class="sep">/</span><span>Gallery</span>
            </div>
            <h1 class="ab-h1">Gallery</h1>
            <p class="ab-sub">A visual tour of our facilities, products and team.</p>
        </div>
        <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
    </section>

    <section class="gl-wrap">
        <div class="container">
            <div class="gl-filters">
                <a class="gl-filter {{ $activeCategory === '' ? 'active' : '' }}" href="{{ url('media/gallery') }}">All</a>
                @foreach($categories as $cat)
                    <a class="gl-filter {{ (string) $cat->id === (string) $activeCategory ? 'active' : '' }}" href="{{ url('media/gallery?category=' . $cat->id) }}">{{ $cat->name }}</a>
                @endforeach
            </div>

            @if($items->count())
                <div class="row g-4">
                    @foreach($items as $key => $item)
                        @php
                            $image = !empty($item->image) ? asset('assets/images/gallery/' . $item->image) : asset('assets/images/media_banner.jpg');
                            $title = !empty($item->title) ? $item->title : ('Gallery Image ' . (method_exists($items, 'firstItem') ? ($items->firstItem() + $key) : ($key + 1)));
                            $counter = method_exists($items, 'firstItem') ? ($items->firstItem() + $key) : ($key + 1);
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <article class="gl-card">
                                <div class="gl-media">
                                    <span class="gl-index">{{ $counter }}</span>
                                    <img src="{{ $image }}" alt="{{ $title }}">
                                </div>
                                <div class="gl-body">
                                    <h3 class="gl-title">{{ \Illuminate\Support\Str::limit($title, 70) }}</h3>
                                    <p class="gl-cat">{{ $item->category_name ?? 'Uncategorized' }}</p>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="gl-pagination mt-4">{{ $items->links() }}</div>
            @else
                <p class="gl-empty">No gallery items available.</p>
            @endif
        </div>
    </section>
</main>
@endsection('content')
