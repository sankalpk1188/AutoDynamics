@extends('layouts/frontLayout/front_design')

@section('styles')
<style>
    .blog-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

    .ab-banner {
        position: relative;
        overflow: hidden;
        background: #0c2340;
        padding: 62px 0 90px;
    }
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
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 620px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .bl-wrap { padding: 56px 0 64px; position: relative; }
    .bl-wrap::before { content: ""; position: absolute; inset: 0; background: radial-gradient(720px 320px at 50% 50%, rgba(62,122,216,0.13), rgba(62,122,216,0.03) 48%, transparent 72%); pointer-events: none; }
    .bl-wrap .container { position: relative; z-index: 1; }

    .bl-tabs { display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; }
    .bl-tab { display: inline-flex; align-items: center; border-radius: 999px; padding: 7px 14px; font-size: 0.84rem; font-weight: 600; border: 1px solid rgba(130,175,240,0.24); color: #c2d7ee; text-decoration: none; }
    .bl-tab.active { background: rgba(124,183,255,0.2); color: #e8f2ff; }

    .bl-card {
        display: grid;
        grid-template-columns: 42% 58%;
        background: rgba(15, 25, 45, 0.75);
        border: 1px solid rgba(130,175,240,0.16);
        border-radius: 14px;
        overflow: hidden;
        height: 100%;
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
    }
    .bl-card:hover { transform: translateY(-4px); border-color: rgba(156,199,255,0.32); box-shadow: 0 16px 32px rgba(9,28,56,0.32); }
    .bl-media {
        position: relative;
        background: rgba(180, 196, 216, 0.18);
        min-height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }
    .bl-category-pill {
        position: absolute;
        top: 14px;
        left: 14px;
        display: inline-flex;
        align-items: center;
        background: #0c4b8f;
        color: #fff;
        border-radius: 999px;
        padding: 0px 15px;
        font-size: 0.76rem;
        font-weight: 700;
    }
    .bl-image {
        width: 100%;
        max-width: 210px;
        height: 120px;
        border-radius: 10px;
        object-fit: cover;
        background: rgba(145, 167, 195, 0.25);
    }
    .bl-body { padding: 18px 20px 16px; }
    .bl-meta { display: flex; flex-wrap: wrap; gap: 12px; color: #95b5d8; font-size: .78rem; margin-bottom: 10px; }
    .bl-meta i { margin-right: 5px; }
    .bl-title { color: #f0f7ff; font-size: 1.08rem; font-weight: 700; line-height: 1.35; margin-bottom: 10px; }
    .bl-desc { color: #b6cbe2; font-size: .9rem; line-height: 1.65; margin-bottom: 12px; }
    .bl-read { color: #9ec8ff; text-decoration: none; font-size: .86rem; font-weight: 700; }
    .bl-read:hover { color: #cbe3ff; }

    @media (max-width: 767px) {
        .bl-card { grid-template-columns: 1fr; }
        .bl-media { min-height: 180px; }
    }

    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .ab-wave svg { height: 45px; }
    }
</style>
@endsection('styles')

@section('content')
<main class="main blog-page">
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a><span class="sep">/</span><span>Media</span><span class="sep">/</span><span>Blogs</span>
            </div>
            <h1 class="ab-h1">Blogs</h1>
            <p class="ab-sub">Insights, research, and thought leadership from our engineering team</p>
        </div>
        <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
    </section>

    <section class="bl-wrap">
        <div class="container">
            @if($blogs->count() > 0)
                <div class="row g-4">
                    @foreach($blogs as $blog)
                        @php
                            $img = !empty($blog->image) ? asset('assets/images/blogs/'.$blog->image) : asset('assets/images/media_banner.jpg');
                            $blogDate = !empty($blog->date) ? \Carbon\Carbon::parse($blog->date) : \Carbon\Carbon::parse($blog->created_at);
                            $words = str_word_count(strip_tags((string) $blog->description));
                            $readMins = max(1, (int) ceil($words / 200));
                        @endphp
                        <div class="col-lg-6">
                            <article class="bl-card">
                                <div class="bl-media">
                                    <span class="bl-category-pill">{{ $blog->category ?? 'Technology' }}</span>
                                    <img class="bl-image" src="{{ $img }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="bl-body">
                                    <div class="bl-meta">
                                        <span><i class="far fa-calendar-alt"></i>{{ $blogDate->format('d M Y') }}</span>
                                        <span><i class="far fa-clock"></i>{{ $readMins }} min read</span>
                                        {{-- <span><i class="far fa-user"></i>Engineering Team</span> --}}
                                    </div>
                                    <h3 class="bl-title">{{ \Illuminate\Support\Str::limit($blog->title, 95) }}</h3>
                                    <p class="bl-desc">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 180) }}</p>
                                    <a class="bl-read" href="{{ url('media/blogs/' . \Illuminate\Support\Str::slug($blog->title)) }}">Read Article <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $blogs->links() }}</div>
            @else
                <div class="alert alert-info">No blogs available.</div>
            @endif
        </div>
    </section>
</main>
@endsection('content')