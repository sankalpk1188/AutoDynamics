@extends('layouts.frontLayout.front_design')
@section('styles')
<style>
  .nv-page { overflow-x: hidden; background: #000; color: #e2eaf5; }
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

  .nv-wrap { position: relative; padding: 56px 0 76px; }
  .nv-card { background: rgba(15, 25, 45, 0.78); color:#dbe9f7; border:1px solid rgba(130,175,240,0.18); border-radius:16px; overflow:hidden; box-shadow:0 14px 28px rgba(2,10,22,.35); display:flex; flex-direction:column; min-height:100%; transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease; }
  .nv-card:hover { transform: translateY(-4px); border-color: rgba(156,199,255,0.34); box-shadow: 0 18px 34px rgba(9,28,56,.38); }
  .nv-thumb { background: rgba(180, 196, 216, 0.14); height:210px; position:relative; display:flex; align-items:center; justify-content:center; }
  .nv-thumb img { width:100%; height:100%; object-fit:cover; }
  .nv-chip { position:absolute; left:14px; top:14px; padding:0px 12px; border-radius:999px; background:#0082c6; color:#fff; font-weight:700; font-size:.8rem; }
  .nv-body { padding:18px 20px 22px; display:flex; flex-direction:column; gap:10px; }
  .nv-date { color:#95b5d8; font-size:.88rem; display:flex; align-items:center; gap:8px; }
  .nv-title { margin:0; font-size:1.1rem; line-height:1.35; font-weight:700; color:#f0f7ff; }
  .nv-excerpt { margin:0; color:#b6cbe2; font-size:.9rem; line-height:1.65; }
  .nv-read { margin-top:4px; color:#9ec8ff; font-weight:700; text-decoration:none; font-size:.86rem; }
  .nv-read:hover { color:#cbe3ff; }
  .nv-empty { color:#b8c6d6; margin:0; font-size:1.1rem; }
  .pagination-wrap nav { margin-top: 28px; }
  .pagination-wrap .pagination { justify-content: center; }
  .pagination-wrap .page-link { background: #0f2236; border-color: rgba(255,255,255,.15); color: #dce8f5; }
  .pagination-wrap .page-item.active .page-link { background: #1e66f5; border-color: #1e66f5; color: #fff; }
  .nv-linkedin-wrap { padding: 8px 0 76px; }
  .nv-linkedin-grid { display:grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
  .nv-linkedin-title { margin: 0 0 14px; color:#f0f7ff; font-size: 1.2rem; font-weight:700; }
  /* LinkedIn embeds: avoid inner iframe scrollbars by sizing tall enough and clipping overflow */
  .nv-linkedin-card {
    overflow: hidden;
    border-radius: 12px;
    background: #fff;
    line-height: 0;
  }
  .nv-linkedin-embed-clip {
    overflow: hidden;
    margin: 0;
    padding: 0;
    border-radius: 12px;
  }
  .nv-linkedin-card iframe,
  .nv-linkedin-embed-clip iframe {
    max-width: 100% !important;
    width: 100% !important;
    display: block;
    margin: 0 auto;
    border: 0 !important;
    min-height: 650px !important;
    height: 650px !important;
    overflow: hidden;
    vertical-align: top;
  }
  .nv-linkedin-frame {
    width: 100% !important;
    max-width: 100%;
    min-height: 1080px;
    height: 1080px;
    border: 0;
    border-radius: 12px;
    background: #fff;
    overflow: hidden;
  }
  @media (max-width: 991px) {
      .ab-banner { padding: 50px 0 80px; }
      .ab-wave svg { height: 45px; }
      .nv-linkedin-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .nv-linkedin-card iframe,
      .nv-linkedin-embed-clip iframe,
      .nv-linkedin-frame { min-height: 980px !important; height: 980px !important; }
  }
  @media (max-width: 575px) {
      .nv-linkedin-grid { grid-template-columns: 1fr; }
  }
</style>
@endsection('styles')

@section('content')
<main class="main nv-page">
  <section class="ab-banner">
    <div class="ab-banner-lines">
      <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
    </div>
    <div class="container ab-banner-inner">
      <div class="ab-crumb">
        <a href="{{ url('/') }}">Home</a><span class="sep">/</span><span>Media</span><span class="sep">/</span><span>News & Views</span>
      </div>
      <h1 class="ab-h1">News & Views</h1>
      <p class="ab-sub">Latest updates, product launches and insights from AutoDynamic.</p>
    </div>
    <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
  </section>

  <section class="nv-wrap">
    <div class="container">
      @if($news->count())
        <div class="row g-4">
          @foreach($news as $row)
            @php
              $newsSlug = \Illuminate\Support\Str::slug($row->title);
              $imagePath = !empty($row->image) ? asset('assets/images/news/'.$row->image) : null;
              $category = $row->category ?: 'News Update';
              $newsDate = !empty($row->date) ? \Carbon\Carbon::parse($row->date)->format('d F Y') : \Carbon\Carbon::parse($row->created_at)->format('d F Y');
            @endphp
            <div class="col-lg-4 col-md-6">
              <article class="nv-card">
                <div class="nv-thumb">
                  <span class="nv-chip">{{ $category }}</span>
                  @if($imagePath)
                    <img src="{{ $imagePath }}" alt="{{ $row->title }}">
                  @else
                    <i class="far fa-image fa-3x text-secondary"></i>
                  @endif
                </div>
                <div class="nv-body">
                  <div class="nv-date"><i class="far fa-calendar-alt"></i> {{ $newsDate }}</div>
                  <h2 class="nv-title">{{ \Illuminate\Support\Str::limit($row->title, 65) }}</h2>
                  <p class="nv-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($row->description), 120) }}</p>
                  <a class="nv-read" href="{{ url('media/news/'.$newsSlug) }}">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
              </article>
            </div>
          @endforeach
        </div>

        <div class="pagination-wrap">{{ $news->links() }}</div>
      @else
        <p class="nv-empty">No news added yet. Please check back soon.</p>
      @endif
    </div>
  </section>

  @if(isset($linkedinPosts) && $linkedinPosts->count())
    <section class="nv-linkedin-wrap">
      <div class="container">
        <h3 class="nv-linkedin-title">LinkedIn Updates</h3>
        <div class="nv-linkedin-grid">
          @foreach($linkedinPosts as $linkedinPost)
            @php
              $embedRaw = trim((string)$linkedinPost->embed_code);
              $isIframe = stripos($embedRaw, '<iframe') !== false;
            @endphp
            <div class="nv-linkedin-card">
              <div class="nv-linkedin-embed-clip">
                @if($isIframe)
                  {!! $embedRaw !!}
                @else
                  <iframe
                    src="{{ $embedRaw }}"
                    class="nv-linkedin-frame"
                    frameborder="0"
                    allowfullscreen
                    title="LinkedIn Embedded Post">
                  </iframe>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</main>
@endsection
