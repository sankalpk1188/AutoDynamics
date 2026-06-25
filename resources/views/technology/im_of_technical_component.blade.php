@extends('layouts/frontLayout/front_design')
@section('content')

@section('styles')
<style>
    .tech-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

    /* ═══ BANNER ═══ */
    .ab-banner { position: relative; overflow: hidden; background: #0c2340; padding: 62px 0 90px; }
    .ab-banner-lines { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .ab-speed-line { position: absolute; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07) 30%, rgba(255,255,255,0.03) 70%, transparent); animation: abSpeedLine var(--dur) linear infinite; opacity: 0; }
    .ab-speed-line:nth-child(1) { top: 18%; left: -40%; width: 70%; --dur: 3s; animation-delay: 0s; }
    .ab-speed-line:nth-child(2) { top: 35%; left: -50%; width: 85%; --dur: 4s; animation-delay: 0.8s; }
    .ab-speed-line:nth-child(3) { top: 52%; left: -30%; width: 60%; --dur: 2.8s; animation-delay: 0.4s; }
    .ab-speed-line:nth-child(4) { top: 68%; left: -60%; width: 90%; --dur: 4.5s; animation-delay: 1.5s; }
    .ab-speed-line:nth-child(5) { top: 82%; left: -45%; width: 75%; --dur: 3.2s; animation-delay: 0.2s; }
    .ab-speed-line:nth-child(6) { top: 26%; left: -35%; width: 55%; --dur: 3.6s; animation-delay: 1.2s; }
    .ab-speed-line:nth-child(7) { top: 44%; left: -55%; width: 80%; --dur: 3s; animation-delay: 2s; }
    .ab-speed-line:nth-child(8) { top: 75%; left: -40%; width: 65%; --dur: 4.2s; animation-delay: 0.5s; }
    @keyframes abSpeedLine { 0% { transform: translateX(0); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateX(200%); opacity: 0; } }
    .ab-banner-inner { position: relative; z-index: 2; }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a, .ab-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ab-crumb a:hover { color: #fff; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem, 4.5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 640px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    /* ═══ REUSABLE ═══ */
    .im-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-size: 0.66rem; letter-spacing: 0.2em; text-transform: uppercase; color: #9fc7ff; margin-bottom: 14px; }
    .im-eyebrow::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 10px rgba(126,184,255,0.8); }
    .im-section-title { font-size: clamp(1.5rem, 2.8vw, 2.15rem); color: #f0f7ff; font-weight: 700; margin-bottom: 18px; line-height: 1.22; }
    .im-section-title strong { background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .im-text { color: #b4c9e0; line-height: 1.78; font-size: 0.95rem; margin-bottom: 16px; }

    /* ═══ HIGHLIGHTS ═══ */
    .im-highlights { padding: 72px 0 56px; background: #000; position: relative; }
    .im-highlights::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .im-highlight-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .im-hl-card { border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 22px; background: rgba(15, 25, 45, 0.7); text-align: center; transition: transform .3s, box-shadow .3s; }
    .im-hl-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.2); }
    .im-hl-icon { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(90,158,245,0.15), rgba(90,158,245,0.05)); display: grid; place-items: center; margin: 0 auto 16px; }
    .im-hl-icon svg { width: 26px; height: 26px; stroke: #5a9ef5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .im-hl-card h4 { font-size: 1.02rem; color: #e8f2ff; font-weight: 600; margin: 0 0 8px; }
    .im-hl-card p { margin: 0; color: #9bb3ce; line-height: 1.62; font-size: 0.92rem; }

    /* ═══ ABOUT IM ═══ */
    .im-about { padding: 72px 0 56px; background: #000; position: relative; }
    .im-about::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .im-about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
    .im-ensures-card { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 30px 28px; }
    .im-ensures-card h3 { font-size: 1.15rem; color: #e8f2ff; font-weight: 700; margin-bottom: 18px; }
    .im-ensures-list { list-style: none; padding: 0; margin: 0; }
    .im-ensures-list li { padding: 10px 0 10px 28px; position: relative; color: #b4c9e0; font-size: 0.93rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); }
    .im-ensures-list li:last-child { border-bottom: 0; }
    .im-ensures-list li::before { content: ""; position: absolute; left: 0; top: 15px; width: 16px; height: 16px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); }
    .im-ensures-list li::after { content: ""; position: absolute; left: 4px; top: 20px; width: 8px; height: 4px; border-left: 2px solid #5a9ef5; border-bottom: 2px solid #5a9ef5; transform: rotate(-45deg); }

    /* ═══ IMAGES ═══ */
    .im-img-wrap { margin-top: 36px; border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; overflow: hidden; background: rgba(15,25,45,0.7); }
    .im-img-wrap img { max-width: 100%; height: auto; display: block; margin: 0 auto; }
    .im-img-wrap-light { margin-top: 36px; border: 1px solid #dce5f0; border-radius: 14px; overflow: hidden; background: #fff; }
    .im-img-wrap-light img { max-width: 100%; height: auto; display: block; margin: 0 auto; }
    .im-img-caption { padding: 14px 20px; font-size: 0.86rem; color: #8eaed0; text-align: center; border-top: 1px solid rgba(130,175,240,0.1); }

    /* ═══ PROCESS FLOW ═══ */
    .im-process { padding: 64px 0; background: #f5f8fc; position: relative; }
    .im-process .im-eyebrow { color: #3672b8; }
    .im-process .im-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .im-process .im-section-title { color: #0f1f36; }
    .im-process .im-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .im-steps-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-top: 28px; }
    .im-step { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 22px 16px; text-align: center; position: relative; transition: transform .3s, box-shadow .3s; }
    .im-step:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.1); }
    .im-step-num { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #2a6cb8, #5a9ef5); color: #fff; font-weight: 700; font-size: 0.92rem; display: grid; place-items: center; margin: 0 auto 12px; }
    .im-step h4 { font-size: 0.88rem; color: #0f1f36; font-weight: 600; margin: 0 0 6px; line-height: 1.4; }
    .im-step p { margin: 0; color: #4b6280; font-size: 0.82rem; line-height: 1.55; }
    .im-step-arrow { position: absolute; right: -12px; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-top: 8px solid transparent; border-bottom: 8px solid transparent; border-left: 10px solid #5a9ef5; z-index: 2; }
    .im-step:last-child .im-step-arrow { display: none; }
    .im-process-note { margin-top: 24px; padding: 16px 20px; background: #e8f1fd; border-left: 4px solid #2a6cb8; border-radius: 8px; color: #1a3a5c; font-size: 0.92rem; line-height: 1.6; }

    /* ═══ WHY IM ═══ */
    .im-why { padding: 72px 0; background: #070f1b; position: relative; overflow: hidden; }
    .im-why-bg { position: absolute; inset: 0; pointer-events: none; }
    .im-why-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(90,158,245,0.08); animation: imRingPulse 6s ease-in-out infinite; }
    .im-why-ring:nth-child(1) { width: 500px; height: 500px; top: -180px; right: -120px; animation-delay: 0s; }
    .im-why-ring:nth-child(2) { width: 350px; height: 350px; top: -100px; right: -50px; animation-delay: 2s; border-color: rgba(90,158,245,0.05); }
    .im-why-glow { position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(90,158,245,0.08), transparent 70%); bottom: -200px; left: -100px; }
    @keyframes imRingPulse { 0%, 100% { transform: scale(1); opacity: 0.6; } 50% { transform: scale(1.12); opacity: 1; } }
    .im-why-content { position: relative; z-index: 2; }
    .im-why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .im-why-card { border: 1px solid rgba(130,175,240,0.12); border-radius: 18px; padding: 30px 24px; background: linear-gradient(145deg, rgba(15, 28, 52, 0.8), rgba(8, 16, 34, 0.9)); position: relative; overflow: hidden; }
    .im-why-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #5a9ef5 30%, #8cc2ff 50%, #5a9ef5 70%, transparent); background-size: 200% 100%; animation: imShimmer 3s linear infinite; }
    @keyframes imShimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    .im-why-card h4 { color: #e8f2ff; font-size: 1.1rem; font-weight: 700; margin: 0 0 14px; }
    .im-why-card p { color: #9bb3ce; line-height: 1.72; font-size: 0.92rem; margin: 0; }

    /* ═══ BENEFITS ═══ */
    .im-benefits { padding: 64px 0 80px; background: #000; position: relative; }
    .im-benefits::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .im-benefits-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 28px; }
    .im-ben-col { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 24px; }
    .im-ben-col h4 { font-size: 1.08rem; color: #e8f2ff; font-weight: 700; margin: 0 0 18px; display: flex; align-items: center; gap: 10px; }
    .im-ben-col h4 svg { width: 22px; height: 22px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
    .im-ben-list { list-style: none; padding: 0; margin: 0; counter-reset: ben; }
    .im-ben-list li { padding: 10px 0 10px 36px; position: relative; color: #b4c9e0; font-size: 0.92rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); counter-increment: ben; }
    .im-ben-list li:last-child { border-bottom: 0; }
    .im-ben-list li::before { content: counter(ben); position: absolute; left: 0; top: 10px; width: 24px; height: 24px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); color: #5a9ef5; font-size: 0.72rem; font-weight: 700; display: grid; place-items: center; }

    /* ═══ OEM ═══ */
    .im-oem { padding: 64px 0; background: #f5f8fc; }
    .im-oem .im-eyebrow { color: #3672b8; }
    .im-oem .im-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .im-oem .im-section-title { color: #0f1f36; }
    .im-oem .im-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .im-oem-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 28px; }
    .im-oem-card { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 22px 18px; display: flex; align-items: center; gap: 14px; transition: transform .3s, box-shadow .3s; }
    .im-oem-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(15,31,54,0.1); }
    .im-oem-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #e8f1fd, #d4e4f8); display: grid; place-items: center; flex-shrink: 0; }
    .im-oem-icon svg { width: 22px; height: 22px; stroke: #2e6db5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .im-oem-card span { color: #0f1f36; font-weight: 600; font-size: 0.95rem; }
    .im-oem-stat { display: flex; align-items: center; gap: 24px; margin-top: 36px; padding: 24px 28px; border-radius: 14px; background: linear-gradient(135deg, #0c2340, #1c4c7a); }
    .im-oem-stat-num { font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #fff; line-height: 1; }
    .im-oem-stat-label { color: rgba(255,255,255,0.8); font-size: 0.95rem; }

    /* ═══ INJECTION MOLDING MATERIALS ═══ */
    .im-materials { padding: 72px 0; background: #000; position: relative; }
    .im-materials::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 40%, rgba(62,122,216,0.12), transparent); pointer-events: none; }
    .im-materials-inner { position: relative; z-index: 2; }
    .im-mat-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin: 28px 0 20px; justify-content: center; }
    .im-mat-tab { padding: 10px 16px; border: 1px solid rgba(130,175,240,0.22); border-radius: 8px; background: rgba(15, 25, 45, 0.65); color: #b4c9e0; font-size: 0.82rem; font-weight: 600; line-height: 1.3; cursor: pointer; transition: background .25s, border-color .25s, color .25s, box-shadow .25s; text-align: center; }
    .im-mat-tab:hover { border-color: rgba(90,158,245,0.45); color: #e8f2ff; }
    .im-mat-tab.is-active { background: linear-gradient(135deg, #2a7a9a, #5a9ef5); border-color: transparent; color: #fff; box-shadow: 0 6px 20px rgba(42,122,184,0.35); }
    .im-mat-panel-wrap { border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; overflow: hidden; background: rgba(15, 25, 45, 0.7); min-height: 280px; }
    .im-mat-panel { display: none; grid-template-columns: 1fr 1fr; align-items: stretch; }
    .im-mat-panel.is-active { display: grid; }
    .im-mat-panel-body { padding: 32px 28px 36px; display: flex; flex-direction: column; justify-content: center; }
    .im-mat-panel-title { font-size: clamp(1.35rem, 2.2vw, 1.75rem); color: #f0f7ff; font-weight: 700; margin: 0 0 16px; line-height: 1.2; }
    .im-mat-panel-desc { color: #9bb3ce; line-height: 1.78; font-size: 0.94rem; margin: 0; }
    .im-mat-subblock { margin-top: 22px; padding-top: 20px; border-top: 1px solid rgba(130,175,240,0.12); }
    .im-mat-subblock:first-of-type { margin-top: 0; padding-top: 0; border-top: 0; }
    .im-mat-subtitle { font-size: 1.02rem; color: #c5daf5; font-weight: 600; margin: 0 0 10px; line-height: 1.3; }
    .im-mat-apps { margin-top: 18px; }
    .im-mat-apps-label { font-size: 0.88rem; color: #9fc7ff; font-weight: 600; margin: 0 0 10px; letter-spacing: 0.02em; }
    .im-mat-apps-list { list-style: none; margin: 0; padding: 0; color: #9bb3ce; font-size: 0.9rem; line-height: 1.65; }
    .im-mat-apps-list li { position: relative; padding: 6px 0 6px 22px; margin: 0; list-style: none; }
    .im-mat-apps-list li::before { content: ""; position: absolute; left: 0; top: 13px; width: 7px; height: 7px; border-radius: 50%; background: #5a9ef5; box-shadow: 0 0 8px rgba(90,158,245,0.55); }
    .im-mat-apps-list li:last-child { padding-bottom: 0; }
    .im-mat-panel-media { position: relative; min-height: 240px; background: rgba(8, 16, 34, 0.5); }
    .im-mat-panel-media img { width: 100%; height: 100%; object-fit: cover; display: block; min-height: 240px; }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .im-highlight-grid, .im-why-grid, .im-benefits-grid { grid-template-columns: 1fr 1fr; }
        .im-about-grid { grid-template-columns: 1fr; gap: 28px; }
        .im-steps-grid { grid-template-columns: repeat(3, 1fr); }
        .im-step-arrow { display: none !important; }
        .im-oem-grid { grid-template-columns: 1fr 1fr; }
        .im-mat-panel { grid-template-columns: 1fr; }
        .im-mat-panel-media { min-height: 220px; order: -1; }
    }
    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-h1 { font-size: clamp(1.6rem, 7vw, 2.2rem); }
        .ab-sub { font-size: 0.92rem; }
        .im-highlight-grid, .im-why-grid, .im-benefits-grid, .im-oem-grid { grid-template-columns: 1fr; }
        .im-steps-grid { grid-template-columns: 1fr 1fr; }
        .im-oem-stat { flex-direction: column; align-items: flex-start; gap: 8px; }
        .im-mat-tabs { gap: 6px; }
        .im-mat-tab { padding: 8px 12px; font-size: 0.76rem; flex: 1 1 calc(50% - 6px); max-width: calc(50% - 3px); }
        .im-mat-panel-body { padding: 24px 18px 28px; }
    }
</style>
@endsection

<main class="main tech-page">

    {{-- ═══ BANNER ═══ --}}
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="sep">/</span>
                <a href="#">Technology</a>
                <span class="sep">/</span>
                <span>Injection Molding of Technical Component</span>
            </div>
            <h1 class="ab-h1">IM of Technical Component</h1>
            <p class="ab-sub">Injection molding of fiber-reinforced thermoplastics enables the production of high-strength, lightweight technical components with excellent stiffness and impact resistance with increased toughness.</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    {{-- ═══ HIGHLIGHTS ═══ --}}
    <section class="im-highlights">
        <div class="container">
            <div class="im-eyebrow">IM Highlights</div>
            <h2 class="im-section-title">Injection molding of Fiber-Reinforced <strong>Technical Components</strong></h2>
            <div class="im-highlight-grid">
                <div class="im-hl-card">
                    <div class="im-hl-icon">
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h4>Long &amp; Short Fiber Parts</h4>
                    <p>Long and short fiber parts can be manufactured with excellent structural integrity and consistency.</p>
                </div>
                <div class="im-hl-card">
                    <div class="im-hl-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h4>High Process Stability</h4>
                    <p>High process stability in automated mass production with repeatable quality output.</p>
                </div>
                <div class="im-hl-card">
                    <div class="im-hl-icon">
                        <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h4>Optimized Weight-to-Performance</h4>
                    <p>Optimized weight-to-performance ratio for demanding structural applications.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ ABOUT IM ═══ --}}
    <section class="im-about">
        <div class="container">
            <div class="im-about-grid">
                <div>
                    <div class="im-eyebrow">About IM</div>
                    <h2 class="im-section-title">High-Performance Thermoplastic Solutions for <strong>Structural Applications</strong></h2>
                    <p class="im-text">Injection Molding of fiber-reinforced thermoplastics enables the production of <strong style="color:#e8f2ff">high-strength, lightweight technical components</strong> with excellent stiffness and impact resistance with increased toughness.</p>
                    <p class="im-text">Thermoplastics are commonly reinforced with <strong style="color:#e8f2ff">short or long glass fibers</strong>, typically ranging from <strong style="color:#e8f2ff">15–50% fiber content</strong>, while advanced structural applications may require fiber contents exceeding 60%.</p>
                </div>
                <div>
                    <div class="im-ensures-card">
                        <h3>This Integration Ensures</h3>
                        <ul class="im-ensures-list">
                            <li>Improved stiffness and strength compared to unfilled materials</li>
                            <li>Optimized weight-to-performance ratio</li>
                            <li>Flexibility in material formulation and reinforcement strategies</li>
                            <li>Reliable performance under dynamic loads and vibration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:40px;">
            <div class="im-img-wrap">
                <img src="{{ asset('assets/images/technology/im-machine-diagrammmm.png') }}" alt="Injection Molding Machine — Ram and Screw mechanism for fiber-reinforced thermoplastic processing">
                <div class="im-img-caption">Injection Molding Machine — Ram and screw mechanism for fiber-reinforced thermoplastic processing</div>
            </div>
        </div>
    </section>

    {{-- ═══ PROCESS FLOW ═══ --}}
    <section class="im-process">
        <div class="container">
            <div class="im-eyebrow">Process Flow</div>
            <h2 class="im-section-title">Fiber-Reinforced Thermoplastic Processing in <strong>Injection Molding</strong></h2>
            <div class="im-steps-grid">
                <div class="im-step">
                    <div class="im-step-num">1</div>
                    <h4>Plasticization</h4>
                    <p>Fiber-reinforced thermoplastic pellets are plasticized in a wear-protected plasticizing unit</p>
                    <div class="im-step-arrow"></div>
                </div>
                <div class="im-step">
                    <div class="im-step-num">2</div>
                    <h4>Screw Geometry</h4>
                    <p>Special screw geometries reduce fiber breakage and material degradation</p>
                    <div class="im-step-arrow"></div>
                </div>
                <div class="im-step">
                    <div class="im-step-num">3</div>
                    <h4>Injection</h4>
                    <p>Melt is injected into mould cavity with optimized flow control</p>
                    <div class="im-step-arrow"></div>
                </div>
                <div class="im-step">
                    <div class="im-step-num">4</div>
                    <h4>Compression</h4>
                    <p>Injection compression and tailored mould design improve fiber integrity</p>
                    <div class="im-step-arrow"></div>
                </div>
                <div class="im-step">
                    <div class="im-step-num">5</div>
                    <h4>Ejection</h4>
                    <p>Component is cooled and ejected as a structural part</p>
                </div>
            </div>
            <div class="im-process-note">
                <strong>Note:</strong> Advanced plasticizing units ensure consistent process parameters and extended machine life.
            </div>
        </div>
    </section>

    {{-- ═══ WHY IM ═══ --}}
    <section class="im-why">
        <div class="im-why-bg">
            <div class="im-why-ring"></div>
            <div class="im-why-ring"></div>
            <div class="im-why-glow"></div>
        </div>
        <div class="container im-why-content">
            <div class="im-eyebrow">Value Proposition</div>
            <h2 class="im-section-title">Why Fiber-Reinforced <strong>Injection Molding?</strong></h2>
            <div class="im-why-grid">
                <div class="im-why-card">
                    <h4>Semi-Structural &amp; Impact Resistant</h4>
                    <p>Long-fiber solutions are particularly suited for semi-structural and impact-resistant automotive components, providing exceptional durability under real-world conditions.</p>
                </div>
                <div class="im-why-card">
                    <h4>Enhanced Mechanical Performance</h4>
                    <p>The use of long-fiber-reinforced thermoplastic pellets (12–25 mm fiber length) significantly enhances the mechanical performance of structural components.</p>
                </div>
                <div class="im-why-card">
                    <h4>Fiber Retention During Processing</h4>
                    <p>Specialized processing solutions ensure that the reinforcing advantages of long fibers are retained during plasticizing and mould filling for optimal performance.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ INJECTION MOLDING MATERIALS ═══ --}}
    <section class="im-materials" id="im-materials">
        <div class="container im-materials-inner">
            <div class="im-eyebrow">Thermoplastics</div>
            <h2 class="im-section-title">Injection Molding <strong>Materials</strong></h2>
            <p class="im-text" style="margin-bottom: 0;">Autodynamics can mold the below available thermoplastic. Please reach out to your specific resin need.</p>

            <div class="im-mat-tabs" role="tablist" aria-label="Injection molding materials">
                <button type="button" class="im-mat-tab is-active" role="tab" aria-selected="true" data-mat="pp-lgf-gf" id="im-mat-tab-pp-lgf-gf" aria-controls="im-mat-pp-lgf-gf">PP LGF / PP GF</button>
                <button type="button" class="im-mat-tab" role="tab" aria-selected="false" data-mat="pa-nylon" id="im-mat-tab-pa-nylon" aria-controls="im-mat-pa-nylon">PA6 / PA66 / Nylon Glass Filled</button>
                <button type="button" class="im-mat-tab" role="tab" aria-selected="false" data-mat="pc-abs-asa" id="im-mat-tab-pc-abs-asa" aria-controls="im-mat-pc-abs-asa">PC-ABS / PC-ASA</button>
                <button type="button" class="im-mat-tab" role="tab" aria-selected="false" data-mat="pp-pp-td" id="im-mat-tab-pp-pp-td" aria-controls="im-mat-pp-pp-td">PP / PP-TD</button>
            </div>

            <div class="im-mat-panel-wrap">
                <div class="im-mat-panel is-active" role="tabpanel" id="im-mat-pp-lgf-gf" aria-labelledby="im-mat-tab-pp-lgf-gf">
                    <div class="im-mat-panel-body">
                        <h3 class="im-mat-panel-title">PP LGF / PP GF</h3>
                        <div class="im-mat-subblock">
                            <h4 class="im-mat-subtitle">PP-LGF (Long Glass Fiber Polypropylene)</h4>
                            <p class="im-mat-panel-desc">Long glass fiber reinforced PP delivers high stiffness, impact strength, and structural performance in molded components. It supports metal replacement strategies with significant weight savings in demanding load paths.</p>
                            <div class="im-mat-apps">
                                <p class="im-mat-apps-label">Common applications</p>
                                <ul class="im-mat-apps-list">
                                    <li>Battery trays and EV structural modules</li>
                                    <li>Door modules and intrusion beams</li>
                                    <li>Front-end carriers and tailgate inners</li>
                                    <li>Seat structures and load floors</li>
                                    <li>Spare-wheel wells and semi-structural chassis components</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="im-mat-panel-media">
                        <img src="{{ asset('assets/images/technology/im-materials-pp-lgf.png') }}" alt="PP LGF and PP GF glass fiber polypropylene pellets" loading="lazy">
                    </div>
                </div>
                <div class="im-mat-panel" role="tabpanel" id="im-mat-pa-nylon" aria-labelledby="im-mat-tab-pa-nylon" hidden>
                    <div class="im-mat-panel-body">
                        <h3 class="im-mat-panel-title">PA6 / PA66 / Nylon Glass Filled</h3>
                        <p class="im-mat-panel-desc">Glass-filled nylon grades (PA6 and PA66) offer high strength, stiffness, and heat resistance for demanding automotive environments. They perform reliably under elevated temperatures and sustained mechanical loads.</p>
                        <div class="im-mat-apps">
                            <p class="im-mat-apps-label">Common applications</p>
                            <ul class="im-mat-apps-list">
                                <li>Engine covers and intake manifold components</li>
                                <li>Cooling system parts and oil pans</li>
                                <li>Under-hood brackets and pedal box structures</li>
                                <li>Wheel arch liners and structural mounts</li>
                                <li>Technical housings for powertrain and chassis systems</li>
                            </ul>
                        </div>
                    </div>
                    <div class="im-mat-panel-media">
                        <img src="{{ asset('assets/images/technology/im-materials-pa-nylon.png') }}" alt="Glass filled nylon PA6 PA66 resin pellets" loading="lazy">
                    </div>
                </div>
                <div class="im-mat-panel" role="tabpanel" id="im-mat-pc-abs-asa" aria-labelledby="im-mat-tab-pc-abs-asa" hidden>
                    <div class="im-mat-panel-body">
                        <h3 class="im-mat-panel-title">PC-ABS / PC-ASA</h3>
                        <div class="im-mat-subblock">
                            <h4 class="im-mat-subtitle">ABS (Acrylonitrile Butadiene Styrene)</h4>
                            <p class="im-mat-panel-desc">ABS combines toughness, rigidity, and excellent surface finish for painted or textured interior components. It balances impact performance, aesthetic quality, and efficient high-volume production.</p>
                            <h4 class="im-mat-subtitle mt-3">ASA (Acrylonitrile Styrene Acrylate)</h4>
                            <p class="im-mat-panel-desc">ASA offers excellent UV stability, weather resistance, and color retention for exterior automotive applications. It maintains appearance and performance under long-term sunlight and environmental exposure.</p>
                            <div class="im-mat-apps">
                                <p class="im-mat-apps-label">Common applications</p>
                                <ul class="im-mat-apps-list">
                                    <li>Instrument panel bezels and trim rings</li>
                                    <li>Center console and door trim panels</li>
                                    <li>Pillar trim and interior garnish parts</li>
                                    <li>A / B / C Pillar & Spoiler</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="im-mat-panel-media">
                        <img src="{{ asset('assets/images/technology/im-materials-asa.png') }}" alt="PC-ABS and PC-ASA resin pellets" loading="lazy">
                    </div>
                </div>
                <div class="im-mat-panel" role="tabpanel" id="im-mat-pp-pp-td" aria-labelledby="im-mat-tab-pp-pp-td" hidden>
                    <div class="im-mat-panel-body">
                        <h3 class="im-mat-panel-title">PP / PP-TD</h3>
                        <div class="im-mat-subblock">
                            <h4 class="im-mat-subtitle">PP (Polypropylene)</h4>
                            <p class="im-mat-panel-desc">Polypropylene is a lightweight, cost-effective thermoplastic with excellent chemical resistance and good fatigue performance. It offers strong durability and efficient processability for high-volume automotive programs.</p>
                            <h4 class="im-mat-subtitle mt-3">PP-TD (Talc-Filled Polypropylene)</h4>
                            <p class="im-mat-panel-desc">Talc-filled PP improves stiffness, dimensional stability, and heat deflection compared to unfilled grades. It reduces shrinkage and warpage while maintaining efficient molding cycles for semi-structural parts.</p>
                            <div class="im-mat-apps">
                                <p class="im-mat-apps-label">Common applications</p>
                                <ul class="im-mat-apps-list">
                                    <li>Air ducts and HVAC components</li>
                                    <li>Battery covers and EV battery enclosures</li>
                                    <li>Interior trim panels and door panels</li>
                                    <li>Bumper fascias, fender liners, and wheel arch liners</li>
                                    <li>Storage bins, cup holders, and console parts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="im-mat-panel-media">
                        <img src="{{ asset('assets/images/technology/im-materials-pp-td.png') }}" alt="PP and PP-TD polypropylene resin pellets" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ OEM APPLICATIONS ═══ --}}
    <section class="im-oem">
        <div class="container">
            <div class="im-eyebrow">OEM Applications</div>
            <h2 class="im-section-title">Typical Automotive <strong>Applications</strong></h2>
            <p style="color:#4b6280; margin-bottom:8px;">Technical molding applications include:</p>
            <div class="im-oem-grid">
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg></div>
                    <span>Battery Tray</span>
                </div>
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg></div>
                    <span>IP and Console Structure</span>
                </div>
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div>
                    <span>PC ABS Interior Parts</span>
                </div>
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/></svg></div>
                    <span>Glass Filled Interior Parts</span>
                </div>
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
                    <span>Under Hood Components</span>
                </div>
                <div class="im-oem-card">
                    <div class="im-oem-icon"><svg viewBox="0 0 24 24"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/></svg></div>
                    <span>Door Module</span>
                </div>
            </div>
            <div class="im-oem-stat d-none">
                <div class="im-oem-stat-num">300,000 – 600,000</div>
                <div class="im-oem-stat-label">Typical annual production volumes per application</div>
            </div>
        </div>
    </section>

    {{-- ═══ BENEFITS ═══ --}}
    <section class="im-benefits">
        <div class="container">
            <div class="im-eyebrow">Key Benefits</div>
            <h2 class="im-section-title">Advantages, Material &amp; <strong>Production Benefits</strong></h2>
            <div class="im-benefits-grid">
                <div class="im-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Key Advantages
                    </h4>
                    <ol class="im-ben-list">
                        <li>Proven and familiar processing technology</li>
                        <li>Injection compression Molding improves fiber orientation</li>
                        <li>Fully automated production capability</li>
                        <li>Lower fiber content can achieve similar stiffness → weight reduction</li>
                        <li>High durability under dynamic loads</li>
                    </ol>
                </div>
                <div class="im-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Material Benefits
                    </h4>
                    <ol class="im-ben-list">
                        <li>Flexible reinforcement strategies (short or long fibers)</li>
                        <li>Wide supplier ecosystem for materials</li>
                        <li>Adaptability to fillers and reinforcement systems</li>
                        <li>Stable and repeatable process conditions</li>
                        <li>Improved impact resistance</li>
                        <li>Reduced material usage through reinforcement efficiency</li>
                    </ol>
                </div>
                <div class="im-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        Production Benefits
                    </h4>
                    <ol class="im-ben-list">
                        <li>Short cycle time</li>
                        <li>Fully automated production capability</li>
                        <li>Special screw designs minimize shear and fiber damage</li>
                        <li>Optimized hot runner systems reduce thermal and mechanical stress</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection('content')

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.registerPlugin(ScrollTrigger);

        gsap.from('.ab-crumb', { opacity: 0, y: -20, duration: 0.6, delay: 0.2 });
        gsap.from('.ab-h1', { opacity: 0, y: 40, duration: 0.8, delay: 0.4 });
        gsap.from('.ab-sub', { opacity: 0, y: 30, duration: 0.7, delay: 0.7 });

        gsap.from('.im-hl-card', {
            scrollTrigger: { trigger: '.im-highlight-grid', start: 'top 80%' },
            opacity: 0, y: 40, duration: 0.5, stagger: 0.15
        });

        gsap.from('.im-about-grid > div', {
            scrollTrigger: { trigger: '.im-about', start: 'top 80%' },
            opacity: 0, y: 40, duration: 0.6, stagger: 0.2
        });

        gsap.from('.im-step', {
            scrollTrigger: { trigger: '.im-steps-grid', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.4, stagger: 0.12
        });

        gsap.from('.im-why-card', {
            scrollTrigger: { trigger: '.im-why-grid', start: 'top 80%' },
            opacity: 0, y: 40, duration: 0.5, stagger: 0.15
        });

        gsap.from('.im-mat-panel-wrap', {
            scrollTrigger: { trigger: '.im-mat-panel-wrap', start: 'top 85%' },
            opacity: 0, y: 30, duration: 0.6
        });

        gsap.from('.im-ben-col', {
            scrollTrigger: { trigger: '.im-benefits-grid', start: 'top 80%' },
            opacity: 0, y: 40, duration: 0.5, stagger: 0.15
        });

        gsap.from('.im-oem-card', {
            scrollTrigger: { trigger: '.im-oem-grid', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.4, stagger: 0.08
        });

        gsap.from('.im-oem-stat', {
            scrollTrigger: { trigger: '.im-oem-stat', start: 'top 85%' },
            opacity: 0, x: -50, duration: 0.7
        });

        gsap.to('.ab-banner-lines', {
            scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true },
            y: 80, ease: 'none'
        });

        document.querySelectorAll('.im-highlights, .im-about, .im-process, .im-why, .im-materials, .im-benefits, .im-oem').forEach(function(sec) {
            gsap.from(sec, {
                scrollTrigger: { trigger: sec, start: 'top 90%', toggleActions: 'play none none none' },
                opacity: 0.4, duration: 0.6
            });
        });

        var matTabs = document.querySelectorAll('.im-mat-tab');
        var matPanels = document.querySelectorAll('.im-mat-panel');
        matTabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var id = tab.getAttribute('data-mat');
                matTabs.forEach(function(t) {
                    t.classList.remove('is-active');
                    t.setAttribute('aria-selected', 'false');
                });
                matPanels.forEach(function(p) {
                    p.classList.remove('is-active');
                    p.setAttribute('hidden', '');
                });
                tab.classList.add('is-active');
                tab.setAttribute('aria-selected', 'true');
                var panel = document.getElementById('im-mat-' + id);
                if (panel) {
                    panel.classList.add('is-active');
                    panel.removeAttribute('hidden');
                }
            });
        });
    });
</script>
@endsection('scripts')
