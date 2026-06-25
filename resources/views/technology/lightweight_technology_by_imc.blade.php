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
    .imc-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-size: 0.66rem; letter-spacing: 0.2em; text-transform: uppercase; color: #9fc7ff; margin-bottom: 14px; }
    .imc-eyebrow::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 10px rgba(126,184,255,0.8); }
    .imc-section-title { font-size: clamp(1.5rem, 2.8vw, 2.15rem); color: #f0f7ff; font-weight: 700; margin-bottom: 18px; line-height: 1.22; }
    .imc-section-title strong { background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .imc-text { color: #b4c9e0; line-height: 1.78; font-size: 0.95rem; margin-bottom: 16px; }

    /* ═══ HIGHLIGHTS ═══ */
    .imc-highlights { padding: 72px 0 56px; background: #000; position: relative; }
    .imc-highlights::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .imc-highlight-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .imc-hl-card { border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 22px; background: rgba(15, 25, 45, 0.7); text-align: center; transition: transform .3s, box-shadow .3s; }
    .imc-hl-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.2); }
    .imc-hl-icon { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(90,158,245,0.15), rgba(90,158,245,0.05)); display: grid; place-items: center; margin: 0 auto 16px; }
    .imc-hl-icon svg { width: 26px; height: 26px; stroke: #5a9ef5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .imc-hl-card h4 { font-size: 1.02rem; color: #e8f2ff; font-weight: 600; margin: 0 0 8px; }
    .imc-hl-card p { margin: 0; color: #9bb3ce; line-height: 1.62; font-size: 0.92rem; }

    /* ═══ BEST OF BOTH ═══ */
    .imc-bestof { padding: 56px 0; background: #070f1b; position: relative; overflow: hidden; }
    .imc-bestof-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(90,158,245,0.06); }
    .imc-bestof-ring:nth-child(1) { width: 450px; height: 450px; top: -150px; right: -100px; }
    .imc-bestof-ring:nth-child(2) { width: 300px; height: 300px; top: -80px; right: -30px; border-color: rgba(90,158,245,0.04); }
    .imc-bestof-grid { display: grid; grid-template-columns: 1fr auto 1fr; gap: 28px; align-items: start; position: relative; z-index: 2; margin-top: 28px; }
    .imc-bestof-col { background: rgba(15,25,45,0.6); border: 1px solid rgba(130,175,240,0.12); border-radius: 14px; padding: 28px 24px; }
    .imc-bestof-col h4 { font-size: 1.1rem; color: #e8f2ff; font-weight: 700; margin: 0 0 16px; display: flex; align-items: center; gap: 10px; }
    .imc-bestof-col h4 svg { width: 22px; height: 22px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
    .imc-bestof-list { list-style: none; margin: 0; padding: 0; }
    .imc-bestof-list li { padding: 10px 0; border-bottom: 1px solid rgba(130,175,240,0.08); color: #b4c9e0; font-size: 0.93rem; display: flex; align-items: center; gap: 10px; }
    .imc-bestof-list li:last-child { border-bottom: 0; }
    .imc-bestof-list li::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 6px rgba(126,184,255,0.5); flex-shrink: 0; }
    .imc-bestof-plus { display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #5a9ef5; font-weight: 200; padding-top: 60px; }

    /* ═══ ABOUT IMC ═══ */
    .imc-about { padding: 72px 0 56px; background: #000; position: relative; }
    .imc-about::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .imc-about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
    .imc-ensures-card { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 30px 28px; }
    .imc-ensures-card h3 { font-size: 1.15rem; color: #e8f2ff; font-weight: 700; margin-bottom: 18px; }
    .imc-ensures-list { list-style: none; padding: 0; margin: 0; }
    .imc-ensures-list li { padding: 10px 0 10px 28px; position: relative; color: #b4c9e0; font-size: 0.93rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); }
    .imc-ensures-list li:last-child { border-bottom: 0; }
    .imc-ensures-list li::before { content: ""; position: absolute; left: 0; top: 15px; width: 16px; height: 16px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); }
    .imc-ensures-list li::after { content: ""; position: absolute; left: 4px; top: 20px; width: 8px; height: 4px; border-left: 2px solid #5a9ef5; border-bottom: 2px solid #5a9ef5; transform: rotate(-45deg); }

    /* ═══ PROCESS FLOW ═══ */
    .imc-process { padding: 64px 0; background: #f5f8fc; position: relative; }
    .imc-process .imc-eyebrow { color: #3672b8; }
    .imc-process .imc-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .imc-process .imc-section-title { color: #0f1f36; }
    .imc-process .imc-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .imc-steps-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-top: 28px; }
    .imc-step { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 22px 16px; text-align: center; position: relative; transition: transform .3s, box-shadow .3s; }
    .imc-step:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,31,54,0.1); }
    .imc-step-num { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #2a6cb8, #5a9ef5); color: #fff; font-weight: 700; font-size: 0.92rem; display: grid; place-items: center; margin: 0 auto 12px; }
    .imc-step h4 { font-size: 0.88rem; color: #0f1f36; font-weight: 600; margin: 0 0 6px; line-height: 1.4; }
    .imc-step p { margin: 0; color: #4b6280; font-size: 0.82rem; line-height: 1.55; }
    .imc-step-arrow { position: absolute; right: -12px; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-top: 8px solid transparent; border-bottom: 8px solid transparent; border-left: 10px solid #5a9ef5; z-index: 2; }
    .imc-step:last-child .imc-step-arrow { display: none; }
    .imc-process-note { margin-top: 24px; padding: 16px 20px; background: #e8f1fd; border-left: 4px solid #2a6cb8; border-radius: 8px; color: #1a3a5c; font-size: 0.92rem; line-height: 1.6; }

    /* ═══ WHY IMC (VALUE PROPOSITION) ═══ */
    .imc-why { padding: 72px 0; background: #070f1b; position: relative; overflow: hidden; }
    .imc-why-bg { position: absolute; inset: 0; pointer-events: none; }
    .imc-why-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(90,158,245,0.08); animation: imcRingPulse 6s ease-in-out infinite; }
    .imc-why-ring:nth-child(1) { width: 500px; height: 500px; top: -180px; right: -120px; animation-delay: 0s; }
    .imc-why-ring:nth-child(2) { width: 350px; height: 350px; top: -100px; right: -50px; animation-delay: 2s; border-color: rgba(90,158,245,0.05); }
    .imc-why-glow { position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(90,158,245,0.08), transparent 70%); bottom: -200px; left: -100px; }
    @keyframes imcRingPulse { 0%, 100% { transform: scale(1); opacity: 0.6; } 50% { transform: scale(1.12); opacity: 1; } }
    .imc-why-content { position: relative; z-index: 2; }
    .imc-why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
    .imc-why-card { border: 1px solid rgba(130,175,240,0.12); border-radius: 18px; padding: 30px 24px; background: linear-gradient(145deg, rgba(15, 28, 52, 0.8), rgba(8, 16, 34, 0.9)); position: relative; overflow: hidden; }
    .imc-why-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #5a9ef5 30%, #8cc2ff 50%, #5a9ef5 70%, transparent); background-size: 200% 100%; animation: abShimmer 3s linear infinite; }
    @keyframes abShimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    .imc-why-card h4 { color: #e8f2ff; font-size: 1.1rem; font-weight: 700; margin: 0 0 14px; }
    .imc-why-card p { color: #9bb3ce; line-height: 1.72; font-size: 0.92rem; margin: 0; }

    /* ═══ BENEFITS (3-COL) ═══ */
    .imc-benefits { padding: 64px 0 80px; background: #000; position: relative; }
    .imc-benefits::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .imc-benefits-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 28px; }
    .imc-ben-col { background: rgba(15, 25, 45, 0.7); border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; padding: 28px 24px; }
    .imc-ben-col h4 { font-size: 1.08rem; color: #e8f2ff; font-weight: 700; margin: 0 0 18px; display: flex; align-items: center; gap: 10px; }
    .imc-ben-col h4 svg { width: 22px; height: 22px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
    .imc-ben-list { list-style: none; padding: 0; margin: 0; counter-reset: ben; }
    .imc-ben-list li { padding: 10px 0 10px 36px; position: relative; color: #b4c9e0; font-size: 0.92rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,0.08); counter-increment: ben; }
    .imc-ben-list li:last-child { border-bottom: 0; }
    .imc-ben-list li::before { content: counter(ben); position: absolute; left: 0; top: 10px; width: 24px; height: 24px; border-radius: 50%; background: rgba(90,158,245,0.12); border: 1.5px solid rgba(90,158,245,0.3); color: #5a9ef5; font-size: 0.72rem; font-weight: 700; display: grid; place-items: center; }

    /* ═══ OEM APPLICATIONS ═══ */
    .imc-oem { padding: 64px 0; background: #f5f8fc; }
    .imc-oem .imc-eyebrow { color: #3672b8; }
    .imc-oem .imc-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .imc-oem .imc-section-title { color: #0f1f36; }
    .imc-oem .imc-section-title strong { background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .imc-oem-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 28px; }
    .imc-oem-card { background: #fff; border: 1px solid #dce5f0; border-radius: 14px; padding: 22px 18px; display: flex; align-items: center; gap: 14px; transition: transform .3s, box-shadow .3s; }
    .imc-oem-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(15,31,54,0.1); }
    .imc-oem-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #e8f1fd, #d4e4f8); display: grid; place-items: center; flex-shrink: 0; }
    .imc-oem-icon svg { width: 22px; height: 22px; stroke: #2e6db5; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .imc-oem-card span { color: #0f1f36; font-weight: 600; font-size: 0.95rem; }
    .imc-oem-stat { display: flex; align-items: center; gap: 24px; margin-top: 36px; padding: 24px 28px; border-radius: 14px; background: linear-gradient(135deg, #0c2340, #1c4c7a); }
    .imc-oem-stat-num { font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #fff; line-height: 1; }
    .imc-oem-stat-label { color: rgba(255,255,255,0.8); font-size: 0.95rem; }

    /* ═══ COMPARISON ═══ */
    .imc-compare { padding: 72px 0 80px; background: #000; position: relative; }
    .imc-compare::before { content: ""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent); pointer-events: none; }
    .imc-compare-table { margin-top: 28px; border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; overflow: hidden; }
    .imc-compare-table table { width: 100%; border-collapse: collapse; }
    .imc-compare-table th { background: rgba(15, 25, 45, 0.9); color: #e8f2ff; font-weight: 700; font-size: 0.92rem; padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(130,175,240,0.15); }
    .imc-compare-table td { padding: 14px 20px; color: #b4c9e0; font-size: 0.9rem; border-bottom: 1px solid rgba(130,175,240,0.08); }
    .imc-compare-table tr:last-child td { border-bottom: 0; }
    .imc-compare-table .imc-win { color: #5a9ef5; font-weight: 600; }
    .imc-img-wrap { margin-top: 36px; border: 1px solid rgba(130,175,240,0.15); border-radius: 14px; overflow: hidden; }
    .imc-img-wrap img { max-width: 50%; height: auto; display: block; margin: 0 auto; }
    .imc-img-pair { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 36px; }
    .imc-img-wrap-light { margin-top: 0; border: 1px solid #dce5f0; border-radius: 14px; overflow: hidden; background: #fff; }
    .imc-img-wrap-light img { width: 100%; height: auto; display: block; }
    .imc-img-caption { padding: 14px 20px; font-size: 0.86rem; color: #8eaed0; text-align: center; border-top: 1px solid rgba(130,175,240,0.1); }
    .imc-img-caption-light { padding: 14px 20px; font-size: 0.86rem; color: #4b6280; text-align: center; border-top: 1px solid #dce5f0; }

    /* ═══ CTA ═══ */
    .imc-cta { padding: 56px 0; background: linear-gradient(135deg, #0c2340, #1c4c7a); text-align: center; }
    .imc-cta h2 { color: #fff; font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 700; margin: 0 0 12px; }
    .imc-cta p { color: rgba(255,255,255,0.7); font-size: 1rem; margin: 0 0 28px; }
    .imc-cta-btn { display: inline-flex; align-items: center; gap: 10px; background: #fff; color: #0c2340; font-weight: 700; font-size: 0.95rem; padding: 14px 32px; border-radius: 999px; text-decoration: none; letter-spacing: 0.5px; transition: transform .3s, box-shadow .3s; }
    .imc-cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.2); color: #0c2340; }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .imc-highlight-grid, .imc-why-grid, .imc-benefits-grid { grid-template-columns: 1fr 1fr; }
        .imc-bestof-grid { grid-template-columns: 1fr; }
        .imc-bestof-plus { padding-top: 0; font-size: 2rem; }
        .imc-about-grid { grid-template-columns: 1fr; gap: 28px; }
        .imc-steps-grid { grid-template-columns: repeat(3, 1fr); }
        .imc-step-arrow { display: none !important; }
        .imc-oem-grid { grid-template-columns: 1fr 1fr; }
        .imc-compare-table { overflow-x: auto; }
        .imc-img-pair { grid-template-columns: 1fr; }
    }
    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-h1 { font-size: clamp(1.6rem, 7vw, 2.2rem); }
        .ab-sub { font-size: 0.92rem; }
        .imc-highlight-grid, .imc-why-grid, .imc-benefits-grid, .imc-oem-grid { grid-template-columns: 1fr; }
        .imc-steps-grid { grid-template-columns: 1fr 1fr; }
        .imc-oem-stat { flex-direction: column; align-items: flex-start; gap: 8px; }
        .imc-chart-bars { gap: 16px; height: 160px; }
        .imc-bar { width: 40px; }
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
                <span>IMC Technology</span>
            </div>
            <h1 class="ab-h1">IMC Technology</h1>
            <p class="ab-sub">Injection Molded Composite (IMC) — an advanced manufacturing process combining continuous extrusion-based compounding with discontinuous injection molding for high-performance fiber-reinforced thermoplastic components.</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    {{-- ═══ IMC HIGHLIGHTS ═══ --}}
    <section class="imc-highlights">
        <div class="container">
            <div class="imc-eyebrow">IMC Highlights</div>
            <h2 class="imc-section-title">Injection Molded Composite <strong>(IMC)</strong></h2>
            <div class="imc-highlight-grid">
                <div class="imc-hl-card">
                    <div class="imc-hl-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h4>Short Cycle Times</h4>
                    <p>Short cycle times enable fully automated production of higher quantities with consistent quality.</p>
                </div>
                <div class="imc-hl-card">
                    <div class="imc-hl-icon">
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h4>Superior Material Properties</h4>
                    <p>Continuous long fibers for better material properties and high stiffness in structural applications.</p>
                </div>
                <div class="imc-hl-card">
                    <div class="imc-hl-icon">
                        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h4>Lower Material Cost</h4>
                    <p>Significant material cost savings of 15–20% compared to conventional LFT pellets.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ BEST OF BOTH ═══ --}}
    <section class="imc-bestof">
        <div class="imc-bestof-ring"></div>
        <div class="imc-bestof-ring"></div>
        <div class="container">
            <div class="imc-eyebrow">Best of Both Worlds</div>
            <h2 class="imc-section-title">Get the <strong>Best of Both Together</strong></h2>
            <div class="imc-bestof-grid">
                <div class="imc-bestof-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        Injection Molding
                    </h4>
                    <ul class="imc-bestof-list">
                        <li>High volume production</li>
                        <li>Material processing</li>
                        <li>Precision & tolerance</li>
                        <li>Diverse material & performance</li>
                    </ul>
                </div>
                <div class="imc-bestof-plus">+</div>
                <div class="imc-bestof-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                        Extrusion
                    </h4>
                    <ul class="imc-bestof-list">
                        <li>Thermoplastic processing</li>
                        <li>Material compounding</li>
                        <li>Customizing pellets</li>
                        <li>Continuous production</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ ABOUT IMC ═══ --}}
    <section class="imc-about">
        <div class="container">
            <div class="imc-about-grid">
                <div>
                    <div class="imc-eyebrow">About IMC</div>
                    <h2 class="imc-section-title">Lightweight Technology by <strong>Injection Molded Composite</strong></h2>
                    <p class="imc-text">Injection Molded Composite (IMC) is an advanced manufacturing process that combines continuous extrusion-based compounding with discontinuous injection molding to produce high-performance fiber-reinforced thermoplastic components.</p>
                    <p class="imc-text">Unlike conventional pellet-based processes, IMC enables <strong style="color:#e8f2ff">direct fiber integration and inline processing</strong>, resulting in improved mechanical performance and reduced material handling loss.</p>
                </div>
                <div>
                    <div class="imc-ensures-card">
                        <h3>The Integrated Line Ensures</h3>
                        <ul class="imc-ensures-list">
                            <li>Consistent material quality</li>
                            <li>Optimized fiber length retention</li>
                            <li>Reduced thermal degradation</li>
                            <li>High process efficiency</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:40px;">
            <div class="imc-img-wrap">
                <img src="{{ asset('assets/images/technology/im-machine-diagram.png') }}" alt="IMC Machine Diagram — Continuous Glass Fibers, Plastic Matrix, Glass Fiber Reinforcement, Platform Scale">
                <div class="imc-img-caption">IMC Integrated Process — Continuous compounding with injection molding in one line</div>
            </div>
        </div>
    </section>

    {{-- ═══ PROCESS FLOW ═══ --}}
    <section class="imc-process">
        <div class="container">
            <div class="imc-eyebrow">Process Flow</div>
            <h2 class="imc-section-title">Continuous Compounding → Injection Molding in <strong>One Integrated Process</strong></h2>
            <div class="imc-steps-grid">
                <div class="imc-step">
                    <div class="imc-step-num">1</div>
                    <h4>Plasticization</h4>
                    <p>Polymer resin is plasticized in a twin-screw extruder</p>
                    <div class="imc-step-arrow"></div>
                </div>
                <div class="imc-step">
                    <div class="imc-step-num">2</div>
                    <h4>Fiber Integration</h4>
                    <p>Continuous glass fibers are fed and impregnated with molten polymer</p>
                    <div class="imc-step-arrow"></div>
                </div>
                <div class="imc-step">
                    <div class="imc-step-num">3</div>
                    <h4>Buffering</h4>
                    <p>BMC buffer decouples continuous compounding from injection cycle</p>
                    <div class="imc-step-arrow"></div>
                </div>
                <div class="imc-step">
                    <div class="imc-step-num">4</div>
                    <h4>Injection</h4>
                    <p>Injection plunger transfers compound into mould cavity</p>
                    <div class="imc-step-arrow"></div>
                </div>
                <div class="imc-step">
                    <div class="imc-step-num">5</div>
                    <h4>Ejection</h4>
                    <p>Component is cooled and ejected</p>
                </div>
            </div>
            <div class="imc-process-note">
                <strong>Note:</strong> Continuous melt flow ensures constant material formulation and reproducibility throughout the production process.
            </div>

            <div class="imc-img-pair">
                <div class="imc-img-wrap-light">
                    <img src="{{ asset('assets/images/technology/imc-fiber-length-chart.png') }}" alt="Qualitative influence of fiber length for stiffness, strength and toughness in polypropylene matrix">
                    <div class="imc-img-caption-light">Mechanical Property Comparison of Short Fiber vs Long Fiber</div>
                </div>
                <div class="imc-img-wrap-light">
                    <img src="{{ asset('assets/images/technology/imc-direct-compounding-comparison.png') }}" alt="Conventional processing versus direct compounding flow with CO2 reduction and cost savings">
                    <div class="imc-img-caption-light">Conventional Processing vs Direct Compounding — fewer process steps with CO2 reduction and cost savings</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ WHY IMC ═══ --}}
    <section class="imc-why">
        <div class="imc-why-bg">
            <div class="imc-why-ring"></div>
            <div class="imc-why-ring"></div>
            <div class="imc-why-glow"></div>
        </div>
        <div class="container imc-why-content">
            <div class="imc-eyebrow">Value Proposition</div>
            <h2 class="imc-section-title">Why <strong>IMC?</strong></h2>
            <div class="imc-why-grid">
                <div class="imc-why-card">
                    <h4>Process Efficiency</h4>
                    <p>Short compounding eliminates multiple intermediate steps such as pelletizing, cooling, and remelting — improving material process efficiency and reducing manufacturing cost.</p>
                </div>
                <div class="imc-why-card">
                    <h4>Performance & Sustainability</h4>
                    <p>IMC enables the production of lightweight components at enhanced mechanical and sustainable performance, making it a strong alternative to metal and conventional thermoplastics.</p>
                </div>
                <div class="imc-why-card">
                    <h4>Precision & Productivity</h4>
                    <p>Injection moulding ensures precision and high productivity. IMC enhances it with inline compounding for better material integrity and consistent quality output.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ OEM APPLICATIONS ═══ --}}
    <section class="imc-oem">
        <div class="container">
            <div class="imc-eyebrow">OEM Applications</div>
            <h2 class="imc-section-title">Typical Automotive <strong>Applications</strong></h2>
            <p style="color:#4b6280; margin-bottom:8px;">IMC is widely adopted for semi-structural and lightweight mobility components:</p>
            <div class="imc-oem-grid">
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/></svg></div>
                    <span>Front-End Assembly Carrier</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg></div>
                    <span>Door Module Inner Structure</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div>
                    <span>Instrument Panel Support</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                    <span>Underbody Shields</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
                    <span>Tail Doors</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></div>
                    <span>Spare Wheel Wells</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="16" y2="13"/></svg></div>
                    <span>Battery Housing &amp; Tub</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><path d="M4 14h16"/><path d="M6 14l2-6h8l2 6"/><path d="M9 14v3"/><path d="M15 14v3"/></svg></div>
                    <span>Oil Sumps</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><path d="M4 16h16"/><path d="M7 16v-4h10v4"/><path d="M9 12V9h6v3"/></svg></div>
                    <span>Foot Step</span>
                </div>
                <div class="imc-oem-card">
                    <div class="imc-oem-icon"><svg viewBox="0 0 24 24"><path d="M3 14h18"/><path d="M6 14l2-3h8l2 3"/><path d="M5 14v3h2"/><path d="M19 14v3h-2"/></svg></div>
                    <span>Bumper Beam</span>
                </div>
            </div>
            <div class="imc-oem-stat d-none">
                <div class="imc-oem-stat-num">300,000 – 600,000</div>
                <div class="imc-oem-stat-label">Typical annual production volumes per application</div>
            </div>
        </div>
    </section>

    {{-- ═══ BENEFITS ═══ --}}
    <section class="imc-benefits">
        <div class="container">
            <div class="imc-eyebrow">Key Benefits</div>
            <h2 class="imc-section-title">Advantages, Material &amp; <strong>Production Benefits</strong></h2>
            <div class="imc-benefits-grid">
                <div class="imc-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Key Advantages
                    </h4>
                    <ol class="imc-ben-list">
                        <li>Material cost savings up to 15–20% (₹1.1–1.5/kg cheaper than conventional LFT pellets)</li>
                        <li>Improved fiber retention → higher stiffness</li>
                        <li>Energy saving through reduced thermal cycles</li>
                        <li>Consistent melt behavior → improved part quality</li>
                        <li>Enhanced cost effectiveness thanks to elimination of pelletizing</li>
                        <li>Most suitable for recyclables due to lower resin temperature molded</li>
                        <li>Most suitable for regulatory, utilities and fibers due to high mixing degree</li>
                    </ol>
                </div>
                <div class="imc-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Material Benefits
                    </h4>
                    <ol class="imc-ben-list">
                        <li>Long fiber retention</li>
                        <li>High impact resistance</li>
                        <li>Improved thermal stability</li>
                        <li>Weight reduction potential up to 30%</li>
                        <li>Tailored material combinations</li>
                    </ol>
                </div>
                <div class="imc-ben-col">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        Production Benefits
                    </h4>
                    <ol class="imc-ben-list">
                        <li>Short cycle times</li>
                        <li>Fully automated production</li>
                        <li>Higher production output/margins</li>
                        <li>Reduced integration complexity</li>
                        <li>Inline quality control</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ COMPARISON ═══ --}}
    <section class="imc-compare d-none">
        <div class="container">
            <div class="imc-eyebrow">Comparison</div>
            <h2 class="imc-section-title">IMC vs Conventional <strong>Long Fiber Thermoplastic</strong></h2>
            <div class="imc-compare-table">
                <table>
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>IMC Technology</th>
                            <th>Conventional LFT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fiber Length Retention</td>
                            <td class="imc-win">Excellent (long fibers preserved)</td>
                            <td>Moderate (fiber breakage during pelletizing)</td>
                        </tr>
                        <tr>
                            <td>Material Cost</td>
                            <td class="imc-win">15–20% lower</td>
                            <td>Higher (pelletizing overhead)</td>
                        </tr>
                        <tr>
                            <td>Thermal Degradation</td>
                            <td class="imc-win">Minimal (single heat cycle)</td>
                            <td>Higher (multiple remelts)</td>
                        </tr>
                        <tr>
                            <td>Stiffness</td>
                            <td class="imc-win">Higher</td>
                            <td>Standard</td>
                        </tr>
                        <tr>
                            <td>Impact Resistance</td>
                            <td class="imc-win">Superior</td>
                            <td>Good</td>
                        </tr>
                        <tr>
                            <td>Process Efficiency</td>
                            <td class="imc-win">Inline compounding (no intermediate steps)</td>
                            <td>Separate compounding + molding</td>
                        </tr>
                        <tr>
                            <td>Recyclability</td>
                            <td class="imc-win">Better (lower resin temperature)</td>
                            <td>Standard</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="imc-img-wrap">
                <img src="{{ asset('assets/images/technology/fiber-length-chart.png') }}" alt="Qualitative Influence of Fiber Length — Stiffness, Strength, Toughness vs Fiber Length in Polypropylene Matrix">
                <div class="imc-img-caption">Qualitative Influence of Fiber Length — Glass Fiber in Polypropylene Matrix</div>
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

    gsap.from('.imc-hl-card', {
        scrollTrigger: { trigger: '.imc-highlight-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.imc-bestof-col', {
        scrollTrigger: { trigger: '.imc-bestof-grid', start: 'top 80%' },
        opacity: 0, x: function(i) { return i === 0 ? -50 : 50; }, duration: 0.7, stagger: 0.2
    });
    gsap.from('.imc-bestof-plus', {
        scrollTrigger: { trigger: '.imc-bestof-grid', start: 'top 80%' },
        opacity: 0, scale: 0, duration: 0.5, delay: 0.3, ease: 'back.out(1.7)'
    });

    gsap.from('.imc-about-grid > div', {
        scrollTrigger: { trigger: '.imc-about', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.6, stagger: 0.2
    });

    gsap.from('.imc-step', {
        scrollTrigger: { trigger: '.imc-steps-grid', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.4, stagger: 0.12
    });

    gsap.from('.imc-why-card', {
        scrollTrigger: { trigger: '.imc-why-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.imc-ben-col', {
        scrollTrigger: { trigger: '.imc-benefits-grid', start: 'top 80%' },
        opacity: 0, y: 40, duration: 0.5, stagger: 0.15
    });

    gsap.from('.imc-oem-card', {
        scrollTrigger: { trigger: '.imc-oem-grid', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.4, stagger: 0.1
    });

    gsap.from('.imc-oem-stat', {
        scrollTrigger: { trigger: '.imc-oem-stat', start: 'top 85%' },
        opacity: 0, x: -50, duration: 0.7
    });

    gsap.from('.imc-compare-table', {
        scrollTrigger: { trigger: '.imc-compare-table', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.6
    });

    gsap.from('.imc-fiber-chart', {
        scrollTrigger: { trigger: '.imc-fiber-chart', start: 'top 80%' },
        opacity: 0, y: 30, duration: 0.6
    });

    gsap.to('.ab-banner-lines', {
        scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true },
        y: 80, ease: 'none'
    });

    document.querySelectorAll('.imc-highlights, .imc-bestof, .imc-about, .imc-process, .imc-why, .imc-benefits, .imc-oem, .imc-compare').forEach(function(sec) {
        gsap.from(sec, {
            scrollTrigger: { trigger: sec, start: 'top 90%', toggleActions: 'play none none none' },
            opacity: 0.4, duration: 0.6
        });
    });
});
</script>
@endsection('scripts')
