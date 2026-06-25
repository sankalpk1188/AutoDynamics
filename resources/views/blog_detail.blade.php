@extends('layouts/frontLayout/front_design')

@section('styles')
<style>
    .blog-detail-page { overflow-x: hidden; background: #000; color: #e2eaf5; }
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
    .ab-h1 { color: #fff; font-size: clamp(2rem, 4.2vw, 2.9rem); font-weight: 800; margin: 0; line-height: 1.2; max-width: 900px; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .bd-wrap { padding: 56px 0 64px; }
    .bd-card { background: rgba(15, 25, 45, 0.72); border: 1px solid rgba(130,175,240,0.16); border-radius: 14px; padding: 20px; }
    .bd-image { width: 100%; border-radius: 12px; object-fit: cover; max-height: 420px; background: #102139; margin-bottom: 16px; }
    .bd-meta { display: flex; gap: 14px; flex-wrap: wrap; color: #95b5d8; font-size: .84rem; margin-bottom: 18px; }
    .bd-meta i { margin-right: 6px; }
    .bd-content { color: #c0d3e7; line-height: 1.82; }
    .bd-content h1, .bd-content h2, .bd-content h3, .bd-content h4, .bd-content h5 { color: #eef6ff; margin-top: 20px; }
    .bd-back { color: #9ec8ff; text-decoration: none; font-weight: 700; font-size: .88rem; display: inline-flex; align-items: center; margin-bottom: 14px; }
    .bd-back:hover { color: #cae4ff; }
</style>
@endsection('styles')

@section('content')
<main class="main blog-detail-page">
    @php
        $blogDate = !empty($blog->date) ? \Carbon\Carbon::parse($blog->date) : \Carbon\Carbon::parse($blog->created_at);
        $words = str_word_count(strip_tags((string) $blog->description));
        $readMins = max(1, (int) ceil($words / 200));
        $img = !empty($blog->image) ? asset('assets/images/blogs/'.$blog->image) : asset('assets/images/media_banner.jpg');
    @endphp
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a><span class="sep">/</span><a href="{{ route('blogs') }}">Media / Blogs</a><span class="sep">/</span><span>{{ $blog->title }}</span>
            </div>
            <h1 class="ab-h1">{{ $blog->title }}</h1>
        </div>
        <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
    </section>

    <section class="bd-wrap">
        <div class="container">
            <a href="{{ route('blogs') }}" class="bd-back"><i class="fas fa-arrow-left me-2"></i>Back to Blogs</a>
            <article class="bd-card">
                <img src="{{ $img }}" alt="{{ $blog->title }}" class="bd-image">
                <div class="bd-meta">
                    <span><i class="fas fa-tag"></i>{{ $blog->category ?? 'Technology' }}</span>
                    <span><i class="far fa-calendar-alt"></i>{{ $blogDate->format('d M Y') }}</span>
                    <span><i class="far fa-clock"></i>{{ $readMins }} min read</span>
                    <span><i class="far fa-user"></i>Engineering Team</span>
                </div>
                <div class="bd-content">{!! $blog->description !!}</div>
            </article>
        </div>
    </section>
</main>
@endsection('content')