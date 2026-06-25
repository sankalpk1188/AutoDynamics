@extends('layouts.frontLayout.front_design')
@section('styles')
<style>
  .nd-page { overflow-x: hidden; background:#000; color:#dce8f5; }
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
  .ab-h1 { color:#fff; font-size:clamp(2rem,4.2vw,2.9rem); font-weight:800; margin:0; line-height:1.2; max-width:900px; }
  .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
  .ab-wave svg { display: block; width: 100%; height: 50px; }
  .nd-wrap { padding: 56px 0 78px; }
  .nd-card { background:#0f2236; border:1px solid rgba(255,255,255,.12); border-radius:18px; overflow:hidden; }
  .nd-image { width:100%; max-height:480px; object-fit:cover; display:block; }
  .nd-body { padding:26px; }
  .nd-meta { display:flex; flex-wrap:wrap; gap:14px; margin-bottom:14px; color:#b6c8db; }
  .nd-meta span { display:inline-flex; align-items:center; gap:7px; }
  .nd-content { color:#d7e3f0; line-height:1.8; }
  .nd-content p:last-child { margin-bottom: 0; }
</style>
@endsection('styles')

@section('content')
<div class="nd-page">
  <section class="ab-banner">
    <div class="ab-banner-lines">
      <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
    </div>
    <div class="container ab-banner-inner">
      <div class="ab-crumb">
        <a href="{{ url('/') }}">Home</a><span class="sep">/</span><a href="{{ url('media/news') }}">Media / News & Views</a><span class="sep">/</span><span>{{ $item->title }}</span>
      </div>
      <h1 class="ab-h1">{{ $item->title }}</h1>
    </div>
    <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
  </section>

  <section class="nd-wrap">
    <div class="container">
      <article class="nd-card">
        @if(!empty($item->image))
          <img class="nd-image" src="{{ asset('assets/images/news/'.$item->image) }}" alt="{{ $item->title }}">
        @endif
        <div class="nd-body">
          <div class="nd-meta">
            <span><i class="fas fa-tag"></i>{{ $item->category ?: 'News Update' }}</span>
            <span><i class="far fa-calendar-alt"></i>{{ !empty($item->date) ? \Carbon\Carbon::parse($item->date)->format('d F Y') : \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
          </div>
          <div class="nd-content">{!! $item->description !!}</div>
        </div>
      </article>
    </div>
  </section>
</div>
@endsection
