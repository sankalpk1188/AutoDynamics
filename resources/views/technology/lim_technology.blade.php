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
    .ab-banner-grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 28px 32px; align-items: center; }
    .ab-banner-copy { min-width: 0; }
    .ab-banner-visual {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        min-width: 0;
        margin-right: calc(50% - 50vw);
    }
    .ab-banner-img-wrap {
        width: min(58vw, 680px);
        margin-left: auto;
        margin-right: 30%;
        border-radius: 16px 0 0 16px;
        overflow: hidden;
    }
    .ab-banner-img-wrap img {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: right center;
    }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a, .ab-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ab-crumb a:hover { color: #fff; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem, 4.5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 640px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    /* ═══ REUSABLE ═══ */
    .lim-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-size: 0.66rem; letter-spacing: 0.2em; text-transform: uppercase; color: #9fc7ff; margin-bottom: 14px; }
    .lim-eyebrow::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 10px rgba(126,184,255,0.8); }
    .lim-section-title { font-size: clamp(1.5rem, 2.8vw, 2.15rem); color: #f0f7ff; font-weight: 700; margin-bottom: 18px; line-height: 1.22; }
    .lim-section-title strong { background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .lim-text { color: #b4c9e0; line-height: 1.78; font-size: 0.95rem; margin-bottom: 16px; }

    /* ═══ HIGHLIGHTS ═══ */
    .lim-highlights { padding: 72px 0 56px; background: #000; position: relative; }
    .lim-highlights::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .lim-highlight-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .lim-hl-card { border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 22px; background: rgba(15, 25, 45, 0.7); text-align: center; transition: transform .3s, box-shadow .3s; }
    .lim-hl-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.2); }
    .lim-hl-icon { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(90,158,245,0.15), rgba(90,158,245,0.05)); display: grid; place-items: center; margin: 0 auto 16px; }
    .lim-hl-icon svg { width: 26px; height: 26px; stroke: #5a9ef5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .lim-hl-card h4 { font-size: 1.02rem; color: #e8f2ff; font-weight: 600; margin: 0 0 8px; }
    .lim-hl-card p { margin: 0; color: #9bb3ce; line-height: 1.62; font-size: 0.92rem; }

    /* ═══ ABOUT LIM ═══ */
    .lim-about { padding: 72px 0 56px; background: #000; position: relative; }
    .lim-about::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .lim-about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
    .lim-ensures-card { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 30px 28px; }
    .lim-ensures-card h3 { font-size: 1.15rem; color: #e8f2ff; font-weight: 700; margin-bottom: 18px; }
    .lim-ensures-list { list-style: none; padding: 0; margin: 0; }
    .lim-ensures-list li { padding: 10px 0 10px 28px; position: relative; color: #b4c9e0; font-size: 0.93rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); }
    .lim-ensures-list li:last-child { border-bottom: 0; }
    .lim-ensures-list li::before { content: ""; position: absolute; left: 0; top: 15px; width: 16px; height: 16px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); }
    .lim-ensures-list li::after { content: ""; position: absolute; left: 4px; top: 20px; width: 8px; height: 4px; border-left: 2px solid #5a9ef5; border-bottom: 2px solid #5a9ef5; transform: rotate(-45deg); }

    /* ═══ IMAGES ═══ */
    .lim-img-wrap { margin-top: 36px; border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; overflow: hidden; background: rgba(15,25,45,0.7); }
    .lim-img-wrap img { max-width: 100%; height: auto; display: block; margin: 0 auto; }
    .lim-img-wrap-light { margin-top: 36px; border: 1px solid #dce5f0; border-radius: 14px; overflow: hidden; background: #fff; }
    .lim-img-wrap-light img { max-width: 100%; height: auto; display: block; margin: 0 auto; }
    .lim-img-caption { padding: 14px 20px; font-size: 0.86rem; color: #8eaed0; text-align: center; border-top: 1px solid rgba(130,175,240,0.1); }
    .lim-img-caption-light { padding: 14px 20px; font-size: 0.86rem; color: #4b6280; text-align: center; border-top: 1px solid #dce5f0; }

    /* ═══ PROCESS FLOW ═══ */
    .lim-process { padding: 64px 0; background: #f5f8fc; position: relative; }
    .lim-process .lim-eyebrow { color: #3672b8; }
    .lim-process .lim-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .lim-process .lim-section-title { color: #0f1f36; }
    .lim-process .lim-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .lim-steps-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 14px; margin-top: 28px; }
    .lim-step { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 20px 14px; text-align: center; position: relative; transition: transform .3s, box-shadow .3s; }
    .lim-step:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.1); }
    .lim-step-num { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #2a6cb8, #5a9ef5); color: #fff; font-weight: 700; font-size: 0.92rem; display: grid; place-items: center; margin: 0 auto 12px; }
    .lim-step h4 { font-size: 0.86rem; color: #0f1f36; font-weight: 600; margin: 0 0 6px; line-height: 1.4; }
    .lim-step p { margin: 0; color: #4b6280; font-size: 0.8rem; line-height: 1.55; }
    .lim-step-arrow { position: absolute; right: -10px; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-top: 8px solid transparent; border-bottom: 8px solid transparent; border-left: 10px solid #5a9ef5; z-index: 2; }
    .lim-step:last-child .lim-step-arrow { display: none; }
    .lim-process-note { margin-top: 24px; padding: 16px 20px; background: #e8f1fd; border-left: 4px solid #2a6cb8; border-radius: 8px; color: #1a3a5c; font-size: 0.92rem; line-height: 1.6; }

    /* ═══ WHY LIM ═══ */
    .lim-why { padding: 72px 0; background: #070f1b; position: relative; overflow: hidden; }
    .lim-why-bg { position: absolute; inset: 0; pointer-events: none; }
    .lim-why-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(90,158,245,0.08); animation: limRingPulse 6s ease-in-out infinite; }
    .lim-why-ring:nth-child(1) { width: 500px; height: 500px; top: -180px; right: -120px; animation-delay: 0s; }
    .lim-why-ring:nth-child(2) { width: 350px; height: 350px; top: -100px; right: -50px; animation-delay: 2s; border-color: rgba(90,158,245,0.05); }
    .lim-why-glow { position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(90,158,245,0.08), transparent 70%); bottom: -200px; left: -100px; }
    @keyframes limRingPulse { 0%, 100% { transform: scale(1); opacity: 0.6; } 50% { transform: scale(1.12); opacity: 1; } }
    .lim-why-content { position: relative; z-index: 2; }
    .lim-why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .lim-why-card { border: 1px solid rgba(130,175,240,0.12); border-radius: 18px; padding: 30px 24px; background: linear-gradient(145deg, rgba(15, 28, 52, 0.8), rgba(8, 16, 34, 0.9)); position: relative; overflow: hidden; }
    .lim-why-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #5a9ef5 30%, #8cc2ff 50%, #5a9ef5 70%, transparent); background-size: 200% 100%; animation: limShimmer 3s linear infinite; }
    @keyframes limShimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    .lim-why-card h4 { color: #e8f2ff; font-size: 1.1rem; font-weight: 700; margin: 0 0 14px; }
    .lim-why-card p { color: #9bb3ce; line-height: 1.72; font-size: 0.92rem; margin: 0; }

    /* ═══ BENEFITS ═══ */
    .lim-benefits { padding: 64px 0 80px; background: #000; position: relative; }
    .lim-benefits::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .lim-benefits-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 28px; }
    .lim-ben-col { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 24px; }
    .lim-ben-col h4 { font-size: 1.08rem; color: #e8f2ff; font-weight: 700; margin: 0 0 18px; display: flex; align-items: center; gap: 10px; }
    .lim-ben-col h4 svg { width: 22px; height: 22px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
    .lim-ben-list { list-style: none; padding: 0; margin: 0; counter-reset: ben; }
    .lim-ben-list li { padding: 10px 0 10px 36px; position: relative; color: #b4c9e0; font-size: 0.92rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); counter-increment: ben; }
    .lim-ben-list li:last-child { border-bottom: 0; }
    .lim-ben-list li::before { content: counter(ben); position: absolute; left: 0; top: 10px; width: 24px; height: 24px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); color: #5a9ef5; font-size: 0.72rem; font-weight: 700; display: grid; place-items: center; }

    /* ═══ OEM ═══ */
    .lim-oem { padding: 64px 0; background: #f5f8fc; }
    .lim-oem .lim-eyebrow { color: #3672b8; }
    .lim-oem .lim-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .lim-oem .lim-section-title { color: #0f1f36; }
    .lim-oem .lim-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .lim-oem-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 28px; }
    .lim-oem-card { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 22px 18px; display: flex; align-items: center; gap: 14px; transition: transform .3s, box-shadow .3s; }
    .lim-oem-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(15,31,54,0.1); }
    .lim-oem-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #e8f1fd, #d4e4f8); display: grid; place-items: center; flex-shrink: 0; }
    .lim-oem-icon svg { width: 22px; height: 22px; stroke: #2e6db5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .lim-oem-card span { color: #0f1f36; font-weight: 600; font-size: 0.95rem; }
    .lim-oem-stat { display: flex; align-items: center; gap: 24px; margin-top: 36px; padding: 24px 28px; border-radius: 14px; background: linear-gradient(135deg, #0c2340, #1c4c7a); }
    .lim-oem-stat-num { font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #fff; line-height: 1; }
    .lim-oem-stat-label { color: rgba(255,255,255,0.8); font-size: 0.95rem; }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .ab-banner-grid { grid-template-columns: 1fr; gap: 28px; }
        .ab-banner-visual { justify-content: center; margin-right: 0; }
        .ab-banner-img-wrap {
            width: min(100%, 460px);
            margin: 0 auto;
            border-radius: 16px;
        }
        .ab-banner-img-wrap img { object-position: center center; }
        .lim-highlight-grid, .lim-why-grid, .lim-benefits-grid { grid-template-columns: 1fr 1fr; }
        .lim-about-grid { grid-template-columns: 1fr; gap: 28px; }
        .lim-steps-grid { grid-template-columns: repeat(3, 1fr); }
        .lim-step-arrow { display: none !important; }
        .lim-oem-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-h1 { font-size: clamp(1.6rem, 7vw, 2.2rem); }
        .ab-sub { font-size: 0.92rem; }
        .lim-highlight-grid, .lim-why-grid, .lim-benefits-grid, .lim-oem-grid { grid-template-columns: 1fr; }
        .lim-steps-grid { grid-template-columns: 1fr 1fr; }
        .lim-oem-stat { flex-direction: column; align-items: flex-start; gap: 8px; }
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
            <div class="ab-banner-grid">
                <div class="ab-banner-copy">
                    <div class="ab-crumb">
                        <a href="{{ url('/') }}">Home</a>
                        <span class="sep">/</span>
                        <a href="#">Technology</a>
                        <span class="sep">/</span>
                        <span>LIM Technology</span>
                    </div>
                    <h1 class="ab-h1">LIM Technology</h1>
                    <p class="ab-sub">Laminate Insert Molding (LIM) — an advanced process combining pre-formed laminate sheets with injection moulding to create high-performance structural and aesthetic thermoplastic components.</p>
                </div>
                <div class="ab-banner-visual">
                    <div class="ab-banner-img-wrap">
                        <img src="{{ asset('assets/images/technology/lim-hero-materials.png') }}" alt="LIM composite laminate materials — carbon fiber, glass fiber, and thermoplastic sheets" loading="eager">
                    </div>
                </div>
            </div>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    {{-- ═══ LIM HIGHLIGHTS ═══ --}}
    <section class="lim-highlights">
        <div class="container">
            <div class="lim-eyebrow">LIM Highlights</div>
            <h2 class="lim-section-title">Laminate Insert Molding <strong>(LIM)</strong></h2>
            <p class="lim-text">To further improve the strength of fiber-reinforced injection molded parts, our process combines injection molding with thermoforming of continuous fiber-reinforced thermoplastic organo sheets, including glass fiber (GF) and carbon fiber (CF) based woven, unidirectional (UD), and hybrid laminate sheets using matrices such as PP, PA6, PA66, PC, PPS, TPU, and PEEK.</p>
            <div class="lim-highlight-grid">
                <div class="lim-hl-card">
                    <div class="lim-hl-icon">
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h4>Composite Fiber Parts</h4>
                    <p>Composite fiber parts can be manufactured with excellent structural integrity.</p>
                </div>
                <div class="lim-hl-card">
                    <div class="lim-hl-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h4>Fully Automated & Reproducible</h4>
                    <p>Fully automated and highly reproducible process ensuring consistent output quality.</p>
                </div>
                <div class="lim-hl-card">
                    <div class="lim-hl-icon">
                        <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h4>Weight Reduction & Consolidation</h4>
                    <p>Further weight reduction and part consolidation for lighter, stronger components.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ ABOUT LIM ═══ --}}
    <section class="lim-about">
        <div class="container">
            <div class="lim-about-grid">
                <div>
                    <div class="lim-eyebrow">About LIM</div>
                    <h2 class="lim-section-title">Thermoplastic Structural Component with <strong>Structural Integration</strong></h2>
                    <p class="lim-text">Laminate Insert Moulding (LIM) is an advanced manufacturing process that combines <strong style="color:#e8f2ff">pre-formed laminate sheets with injection moulding</strong> to create high-performance structural and aesthetic thermoplastic components.</p>
                    <p class="lim-text">Unlike conventional injection moulding or post-lamination processes, LIM enables <strong style="color:#e8f2ff">direct integration of structural layers in a single moulding cycle</strong>, resulting in improved part performance and reduced secondary operations.</p>
                </div>
                <div>
                    <div class="lim-ensures-card">
                        <h3>This Integration Ensures</h3>
                        <ul class="lim-ensures-list">
                            <li>Structural reinforcement through laminate integration</li>
                            <li>Reduced part weight with high stiffness</li>
                            <li>High design freedom with functional integration</li>
                            <li>Improved process efficiency and reduced assembly steps</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ PROCESS FLOW ═══ --}}
    <section class="lim-process">
        <div class="container">
            <div class="lim-eyebrow">Process Flow</div>
            <h2 class="lim-section-title">Laminate Integration + Injection Moulding in <strong>One Integrated Process</strong></h2>
            <div class="lim-steps-grid">
                <div class="lim-step">
                    <div class="lim-step-num">1</div>
                    <h4>Pick Up Insert</h4>
                    <p>Structural laminate is pre-formed to part geometry</p>
                    <div class="lim-step-arrow"></div>
                </div>
                <div class="lim-step">
                    <div class="lim-step-num">2</div>
                    <h4>Preheat Insert</h4>
                    <p>Laminate insert is placed inside injection mould cavity</p>
                    <div class="lim-step-arrow"></div>
                </div>
                <div class="lim-step">
                    <div class="lim-step-num">3</div>
                    <h4>Transfer to Mold</h4>
                    <p>Thermoplastic melt is injected behind laminate</p>
                    <div class="lim-step-arrow"></div>
                </div>
                <div class="lim-step">
                    <div class="lim-step-num">4</div>
                    <h4>Thermoforming</h4>
                    <p>Polymer bonds with laminate forming structural composite</p>
                    <div class="lim-step-arrow"></div>
                </div>
                <div class="lim-step">
                    <div class="lim-step-num">5</div>
                    <h4>Back Injection</h4>
                    <p>Component is cooled and ejected as finished part</p>
                    <div class="lim-step-arrow"></div>
                </div>
                <div class="lim-step">
                    <div class="lim-step-num">6</div>
                    <h4>Remove from Mold</h4>
                    <p>Finished component removed for quality inspection</p>
                </div>
            </div>
            <div class="lim-process-note">
                <strong>Note:</strong> Integrated moulding ensures consistent bonding and high surface quality throughout the production cycle.
            </div>

            <div class="lim-img-wrap-light">
                <img src="{{ asset('assets/images/technology/lim-process-flow.png') }}" alt="LIM Process Flow — Pick up insert, Preheat insert, Transfer to mold, Thermoforming, Back injection, Remove from mold">
                <div class="lim-img-caption-light">LIM 6-Step Process — From insert pick-up to finished component removal</div>
            </div>
        </div>
    </section>

    {{-- ═══ WHY LIM ═══ --}}
    <section class="lim-why">
        <div class="lim-why-bg">
            <div class="lim-why-ring"></div>
            <div class="lim-why-ring"></div>
            <div class="lim-why-glow"></div>
        </div>
        <div class="container lim-why-content">
            <div class="lim-eyebrow">Value Proposition</div>
            <h2 class="lim-section-title">Why <strong>LIM?</strong></h2>
            <div class="lim-why-grid">
                <div class="lim-why-card">
                    <h4>Enhanced Stiffness & Consolidation</h4>
                    <p>Fabric made of continuous fibers in a thermoplastic matrix is heated, formed inside the injection mould, and then back-injected. This enables the integration of ribs for enhanced stiffness and part consolidation.</p>
                </div>
                <div class="lim-why-card">
                    <h4>Crash Performance & Impact</h4>
                    <p>Multi-layer laminate stack enables engineers to control stiffness, strength, crash performance and impact resistance for demanding structural applications.</p>
                </div>
                <div class="lim-why-card">
                    <h4>Precision & Inline Compounding</h4>
                    <p>Injection moulding ensures precision and high productivity. IMC enhances it with inline compounding for better material integrity and performance.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ OEM APPLICATIONS ═══ --}}
    <section class="lim-oem">
        <div class="container">
            <div class="lim-eyebrow">OEM Applications</div>
            <h2 class="lim-section-title">Typical Automotive <strong>Applications</strong></h2>
            <p style="color:#4b6280; margin-bottom:8px;">Laminate Insert Moulding is widely adopted for <strong style="color:#0f1f36">functional interior/exterior components</strong>:</p>
            <div class="lim-oem-grid">
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg></div>
                    <span>Seat Pan and Seat Back</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div>
                    <span>Underbody Assemblies / Door Module</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg></div>
                    <span>Instrument Panel Supports</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/></svg></div>
                    <span>Soft Top Compartments</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <span>Side Impact Protection</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
                    <span>Technical Underhood Components</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></div>
                    <span>Semi-structural Components</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/></svg></div>
                    <span>Center Armrests</span>
                </div>
                <div class="lim-oem-card">
                    <div class="lim-oem-icon"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg></div>
                    <span>Battery Supports</span>
                </div>
            </div>
            <div class="lim-oem-stat d-none">
                <div class="lim-oem-stat-num">300,000 – 1,000,000</div>
                <div class="lim-oem-stat-label">Typical annual production volumes per application</div>
            </div>
        </div>
    </section>

    {{-- ═══ BENEFITS ═══ --}}
    <section class="lim-benefits">
        <div class="container">
            <div class="lim-eyebrow">Key Benefits</div>
            <h2 class="lim-section-title">Advantages, Material &amp; <strong>Production Benefits</strong></h2>
            <div class="lim-benefits-grid">
                <div class="lim-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Key Advantages
                    </h4>
                    <ol class="lim-ben-list">
                        <li>Eliminates painting &amp; coating processes</li>
                        <li>High stiffness-to-weight ratio</li>
                        <li>Reduced assembly operations</li>
                        <li>Improved impact resistance</li>
                        <li>Shorter overall manufacturing chain</li>
                        <li>Dimensional stability in terms of component assembly</li>
                        <li>Sustainable option with recyclable thermoplastics</li>
                    </ol>
                </div>
                <div class="lim-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Material Benefits
                    </h4>
                    <ol class="lim-ben-list">
                        <li>Lightweight potential upto 30–40%</li>
                        <li>Reduced tooling &amp; system complexity</li>
                        <li>Short cycle times, typical of injection molding process</li>
                        <li>Consistent surface quality</li>
                        <li>Tailored laminate material combinations</li>
                        <li>No support structures necessary</li>
                    </ol>
                </div>
                <div class="lim-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        Production Benefits
                    </h4>
                    <ol class="lim-ben-list">
                        <li>Shorter overall manufacturing chain</li>
                        <li>Fully automated production capability</li>
                        <li>Reduced tooling &amp; system complexity</li>
                        <li>Reduced logistics &amp; handling</li>
                        <li>Enables thin-wall structural components</li>
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
    gsap.from('.ab-banner-img-wrap', { opacity: 0, x: 40, duration: 0.9, delay: 0.55 });

    gsap.from('.lim-hl-card', {
        scrollTrigger: { trigger: '.lim-highlight-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.lim-about-grid > div', {
        scrollTrigger: { trigger: '.lim-about', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.6, stagger: 0.2
    });

    gsap.from('.lim-step', {
        scrollTrigger: { trigger: '.lim-steps-grid', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.4, stagger: 0.1
    });

    gsap.from('.lim-why-card', {
        scrollTrigger: { trigger: '.lim-why-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.lim-ben-col', {
        scrollTrigger: { trigger: '.lim-benefits-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.lim-oem-card', {
        scrollTrigger: { trigger: '.lim-oem-grid', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.4, stagger: 0.08
    });

    gsap.from('.lim-oem-stat', {
        scrollTrigger: { trigger: '.lim-oem-stat', start: 'top 85%' },
        opacity: 0, x: -50, duration: 0.7
    });

    gsap.to('.ab-banner-lines', {
        scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true },
        y: 80, ease: 'none'
    });

    document.querySelectorAll('.lim-highlights, .lim-about, .lim-process, .lim-why, .lim-benefits, .lim-oem').forEach(function(sec) {
        gsap.from(sec, {
            scrollTrigger: { trigger: sec, start: 'top 90%', toggleActions: 'play none none none' },
            opacity: 0.4, duration: 0.6
        });
    });
});
</script>
@endsection('scripts')
