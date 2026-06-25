@extends('layouts/frontLayout/front_design')
@section('content')

@section('styles')
<style>
    html {
        overflow-x: clip;
        overflow-y: scroll;
    }
    body {
        overflow-x: clip;
    }
    .cap-page {
        overflow-x: clip;
        width: 100%;
        max-width: 100%;
        background: #000;
        color: #e2eaf5;
    }

    /* ═══ BANNER ═══ */
    .ab-banner { position: relative; overflow: hidden; background: #0c2340; padding: 62px 0 90px; }
    .ab-banner-lines { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .ab-speed-line { position: absolute; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07) 30%, rgba(255,255,255,0.03) 70%, transparent); animation: abSpeedLine var(--dur) linear infinite; opacity: 0; }
    .ab-speed-line:nth-child(1) { top: 18%; left: -40%; width: 70%; --dur: 3s; }
    .ab-speed-line:nth-child(2) { top: 35%; left: -50%; width: 85%; --dur: 4s; animation-delay: .8s; }
    .ab-speed-line:nth-child(3) { top: 52%; left: -30%; width: 60%; --dur: 2.8s; animation-delay: .4s; }
    .ab-speed-line:nth-child(4) { top: 68%; left: -60%; width: 90%; --dur: 4.5s; animation-delay: 1.5s; }
    .ab-speed-line:nth-child(5) { top: 82%; left: -45%; width: 75%; --dur: 3.2s; animation-delay: .2s; }
    .ab-speed-line:nth-child(6) { top: 26%; left: -35%; width: 55%; --dur: 3.6s; animation-delay: 1.2s; }
    .ab-speed-line:nth-child(7) { top: 44%; left: -55%; width: 80%; --dur: 3s; animation-delay: 2s; }
    .ab-speed-line:nth-child(8) { top: 75%; left: -40%; width: 65%; --dur: 4.2s; animation-delay: .5s; }
    @keyframes abSpeedLine { 0%{transform:translateX(0);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateX(200%);opacity:0} }
    .ab-banner-inner { position: relative; z-index: 2; }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a,.ab-crumb span { color: rgba(255,255,255,.55); text-decoration: none; font-size: .86rem; }
    .ab-crumb a:hover { color: #fff; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem,4.5vw,3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,.72); font-size: 1.02rem; max-width: 640px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    /* ═══ REUSABLE ═══ */
    .cap-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-size: .66rem; letter-spacing: .2em; text-transform: uppercase; color: #9fc7ff; margin-bottom: 14px; }
    .cap-eyebrow::before { content:""; width: 7px; height: 7px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 10px rgba(126,184,255,.8); }
    .cap-title { font-size: clamp(1.5rem,2.8vw,2.15rem); color: #f0f7ff; font-weight: 700; margin-bottom: 18px; line-height: 1.22; }
    .cap-title strong { background: linear-gradient(95deg,#85bdff,#fff 48%,#cbe2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .cap-text { color: #b4c9e0; line-height: 1.78; font-size: .95rem; margin-bottom: 16px; }

    /* ═══ HEXAGON INTRO ═══ */
    .cap-intro { padding: 72px 0 56px; background: #000; position: relative; }
    .cap-intro::before { content:""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%,rgba(62,122,216,.1),transparent); pointer-events: none; }
    .cap-intro-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
    .cap-intro-img { border-radius: 14px; overflow: hidden; }
    .cap-intro-img img { width: 100%; height: auto; display: block; }

    /* ═══ NAV PILLS ═══ */
    .cap-nav { padding: 0 0 48px; background: #000; position: relative; z-index: 5; }
    .cap-nav-inner { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 6; opacity: 1; visibility: visible; }
    .cap-nav-pill { display: inline-flex; align-items: center; gap: 8px; padding: 12px 22px; border-radius: 999px; border: 1px solid rgba(130,175,240,.25); background: rgba(15,25,45,.6); color: #c8ddf5; font-weight: 600; font-size: .88rem; text-decoration: none; transition: all .3s; opacity: 1; visibility: visible; }
    .cap-nav-pill:hover,.cap-nav-pill.active { background: rgba(90,158,245,.15); border-color: #5a9ef5; color: #fff; transform: translateY(-2px); }
    .cap-nav-pill svg { width: 18px; height: 18px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

    /* ═══ CASE STUDY SECTION ═══ */
    .cap-case { padding: 72px 0; position: relative; background: #000; }
    .cap-case:nth-of-type(even) { background: #060d1a; }
    .cap-case::before { content:""; position: absolute; inset: 0; background: radial-gradient(700px 260px at 50% 50%,rgba(62,122,216,.08),transparent); pointer-events: none; }

    .cap-case-header { margin-bottom: 32px; }
    .cap-case-header p { max-width: 800px; }

    .cap-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; align-items: start; }

    /* dark card */
    .cap-card { background: rgba(15,25,45,.7); border: 1px solid rgba(130,175,240,.15); border-radius: 14px; padding: 28px 24px; }
    .cap-card h4 { font-size: 1.08rem; color: #e8f2ff; font-weight: 700; margin: 0 0 16px; display: flex; align-items: center; gap: 10px; }
    .cap-card h4 svg { width: 22px; height: 22px; stroke: #5a9ef5; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
    /* alternate dark card */
    .cap-card--alt { background: rgba(10,20,40,.8); border-color: rgba(90,158,245,.2); }

    .cap-list { list-style: none; padding: 0; margin: 0; }
    .cap-list li { padding: 9px 0 9px 28px; position: relative; color: #b4c9e0; font-size: .92rem; line-height: 1.65; border-bottom: 1px solid rgba(130,175,240,.08); }
    .cap-list li:last-child { border-bottom: 0; }
    .cap-list li::before { content:""; position: absolute; left: 0; top: 14px; width: 6px; height: 6px; border-radius: 50%; background: #7eb8ff; box-shadow: 0 0 6px rgba(126,184,255,.5); }

    /* stats row */
    .cap-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-top: 32px; }
    .cap-stat { text-align: center; padding: 20px 12px; border-radius: 14px; border: 1px solid rgba(130,175,240,.15); background: rgba(15,25,45,.5); }
    .cap-stat strong { display: block; font-size: 1.6rem; font-weight: 800; color: #fff; background: linear-gradient(95deg,#85bdff,#fff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 4px; }
    .cap-stat span { color: #8eaed0; font-size: .82rem; }

    /* img wrap */
    .cap-img { border: 1px solid rgba(130,175,240,.15); border-radius: 14px; overflow: hidden; margin-top: 16px; }
    .cap-img img { width: 100%; height: auto; display: block; }

    /* ═══ FLOATING ORBS ═══ */
    .cap-orb { position: absolute; border-radius: 50%; pointer-events: none; filter: blur(60px); opacity: 0; }
    .cap-orb--cyan { background: rgba(62,198,255,.12); width: 320px; height: 320px; }
    .cap-orb--blue { background: rgba(11,115,192,.1); width: 260px; height: 260px; }
    .cap-orb--purple { background: rgba(120,80,220,.08); width: 200px; height: 200px; }

    /* ═══ CARD GLOW HOVER ═══ */
    .cap-card { transition: transform .35s ease, border-color .35s ease, box-shadow .35s ease; }
    .cap-card:hover { transform: translateY(-6px); border-color: rgba(90,158,245,.4); box-shadow: 0 12px 40px rgba(62,122,216,.15), inset 0 1px 0 rgba(255,255,255,.05); }

    /* ═══ LIST ITEM ANIMATION ═══ */
    .cap-list li { transition: background .3s; }
    .cap-list li:hover { background: rgba(90,158,245,.06); border-radius: 6px; }

    /* ═══ STAT COUNTER GLOW ═══ */
    .cap-stat { transition: transform .3s ease, box-shadow .3s ease; }
    .cap-stat:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(62,198,255,.12); }

    /* ═══ NAV PILL ACTIVE GLOW ═══ */
    .cap-nav-pill.is-active { background: rgba(90,158,245,.2); border-color: #5a9ef5; color: #fff; box-shadow: 0 0 20px rgba(90,158,245,.25); }

    /* ═══ SECTION DIVIDER LINE ═══ */
    .cap-divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(90,158,245,.3) 50%, transparent); margin: 0; border: 0; }

    /* ═══ RESPONSIVE ═══ */
    @media(max-width:991px){
        .ab-banner{padding:50px 0 80px}
        .cap-intro-grid,.cap-detail-grid{grid-template-columns:1fr;gap:24px}
        .cap-stats{grid-template-columns:1fr 1fr}
        .cap-nav-inner{gap:10px}
    }
    @media(max-width:575px){
        .ab-banner{padding:42px 0 68px}
        .ab-h1{font-size:clamp(1.6rem,7vw,2.2rem)}
        .cap-stats{grid-template-columns:1fr 1fr}
        .cap-nav-pill{padding:10px 16px;font-size:.82rem}
    }
</style>
@endsection

<main class="main cap-page">

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
                <span>Capabilities</span>
            </div>
            <h1 class="ab-h1">Our Capabilities</h1>
            <p class="ab-sub">System supplier from concept to production — delivering advanced engineering, world-class manufacturing, accredited quality, and robust supply chain solutions.</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    {{-- ═══ PRODUCT DEVELOPMENT INTRO ═══ --}}
    <section class="cap-intro">
        <div class="container">
            <div class="cap-intro-grid">
                <div>
                    <div class="cap-eyebrow">Our Value Proposition</div>
                    <h2 class="cap-title">System Supplier from <strong>Concept to Production</strong></h2>
                    <p class="cap-text">Our full-cycle product development capability covers every stage — from concept design and engineering through material selection, simulation, prototyping, and final production &amp; supply. This integrated approach ensures faster time-to-market with optimized performance.</p>
                    <div class="cap-stats">
                        <div class="cap-stat"><strong>Expert</strong><span>Engineering Team</span></div>
                        <div class="cap-stat"><strong>State</strong><span>of-the-Art Machinery</span></div>
                        <div class="cap-stat"><strong>Robust</strong><span>Product Development</span></div>
                        <div class="cap-stat"><strong>Strong</strong><span>Internal Systems</span></div>
                    </div>
                </div>
                <div class="cap-intro-img">
                    <img src="{{ asset('assets/images/technology/capability-hexagon.png') }}" alt="Product Development Capability — Concept Design, Engineering, Material Selection, Simulation & Testing, Prototype & Validation, Production & Supply">
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ CASE STUDY NAV ═══ --}}
    <section class="cap-nav">
        <div class="container">
            <div class="cap-nav-inner">
                <a href="#advanced-engineering" class="cap-nav-pill">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.6.85 1 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    Advanced Engineering
                </a>
                <a href="#manufacturing-tooling" class="cap-nav-pill">
                    <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    Manufacturing &amp; Tooling
                </a>
                <a href="#quality-lab" class="cap-nav-pill">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    NABL Quality Lab
                </a>
                <a href="#scm" class="cap-nav-pill">
                    <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    SCM Capabilities
                </a>
            </div>
        </div>
    </section>

    <hr class="cap-divider">

    {{-- ═══ 1. ADVANCED ENGINEERING ═══ --}}
    <section class="cap-case" id="advanced-engineering">
        <div class="cap-orb cap-orb--cyan" style="top:-80px;right:-100px;"></div>
        <div class="cap-orb cap-orb--purple" style="bottom:-60px;left:-80px;"></div>
        <div class="container">
            <div class="cap-case-header">
                <div class="cap-eyebrow">Case Study 01</div>
                <h2 class="cap-title">Advanced <strong>Engineering</strong></h2>
                <p class="cap-text">Our in-house engineering team provides end-to-end product development support — from lightweight design exploration and CAE-driven analysis to prototype validation and production-ready designs.</p>
            </div>
            <div class="cap-detail-grid">
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                        Engineering Capabilities
                    </h4>
                    <ul class="cap-list">
                        <li>Concept design &amp; feasibility studies</li>
                        <li>Lightweight design exploration — material benchmarking</li>
                        <li>3D CAD modelling (NX / CATIA)</li>
                        <li>Mold flow simulation &amp; fiber orientation analysis</li>
                        <li>Structural FEA / CAE analysis (crash, NVH, stiffness)</li>
                        <li>DFM &amp; DFA optimization</li>
                        <li>Tolerance stack-up &amp; GD&amp;T</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        Simulation &amp; Testing
                    </h4>
                    <ul class="cap-list">
                        <li>Moldflow analysis for fill, pack &amp; warp prediction</li>
                        <li>Fiber length &amp; orientation mapping</li>
                        <li>Integrated CAE for structural validation</li>
                        <li>Multi-physics simulation environment</li>
                        <li>Prototype build &amp; physical testing support</li>
                        <li>Correlation between simulation &amp; test results</li>
                    </ul>
                </div>
            </div>
            <div class="cap-stats" style="margin-top:28px;">
                <div class="cap-stat"><strong>NX / CATIA</strong><span>3D CAD Tools</span></div>
                <div class="cap-stat"><strong>Moldflow</strong><span>Simulation Suite</span></div>
                <div class="cap-stat"><strong>FEA</strong><span>Structural Analysis</span></div>
                <div class="cap-stat"><strong>DFM</strong><span>Design for Mfg</span></div>
            </div>
        </div>
    </section>

    <hr class="cap-divider">

    {{-- ═══ 2. MANUFACTURING & TOOLING ═══ --}}
    <section class="cap-case" id="manufacturing-tooling">
        <div class="cap-orb cap-orb--blue" style="top:40px;left:-120px;"></div>
        <div class="cap-orb cap-orb--cyan" style="bottom:-40px;right:-60px;"></div>
        <div class="container">
            <div class="cap-case-header">
                <div class="cap-eyebrow">Case Study 02</div>
                <h2 class="cap-title">Manufacturing &amp; <strong>Tooling</strong></h2>
                <p class="cap-text">ATSPL has established a state-of-the-art manufacturing facility equipped with advanced injection molding machines, in-house tool design, and automated production lines for high-volume production.</p>
            </div>
            <div class="cap-detail-grid">
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        Manufacturing Facility
                    </h4>
                    <ul class="cap-list">
                        <li>Injection Molding: 400T – 2300T clamping force</li>
                        <li>IMC (Injection Molded Composite) production line</li>
                        <li>LIM (Laminate Insert Molding) capability</li>
                        <li>Automated part handling &amp; robotic systems</li>
                        <li>In-line quality inspection stations</li>
                        {{-- <li>Clean room assembly area</li> --}}
                    </ul>
                </div>
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Tooling Capabilities
                    </h4>
                    <ul class="cap-list">
                        <li>In-house mould design & development (DFM support)</li>
                        <li>Injection moulds incl. automotive, appliance & packaging</li>
                        <li>Prototype / soft tooling & rapid prototyping solutions</li>
                        <li>Mold flow analysis, cooling optimization & cycle improvement</li>
                        <li>Warpage, shrinkage control & engineering validation</li>
                        <li>Tool maintenance, modifications & breakdown support</li>
                    </ul>
                </div>
            </div>
            <div class="cap-stats" style="margin-top:28px;">
                <div class="cap-stat"><strong>400T–2300T</strong><span>Clamping Range</span></div>
                <div class="cap-stat"><strong>In-House</strong><span>Tool Design</span></div>
                <div class="cap-stat"><strong>Robotic</strong><span>Automation</span></div>
                <div class="cap-stat"><strong>IMC + LIM</strong><span>Tech Lines</span></div>
            </div>
        </div>
    </section>

    <hr class="cap-divider">

    {{-- ═══ 3. NABL ACCREDITED QUALITY LAB ═══ --}}
    <section class="cap-case" id="quality-lab">
        <div class="cap-orb cap-orb--purple" style="top:-50px;right:-80px;"></div>
        <div class="cap-orb cap-orb--blue" style="bottom:20px;left:-100px;"></div>
        <div class="container">
            <div class="cap-case-header">
                <div class="cap-eyebrow">Case Study 03</div>
                <h2 class="cap-title">NABL Accredited <strong>Quality Lab</strong></h2>
                <p class="cap-text">Our in-house NABL accredited laboratory ensures comprehensive material and product testing to meet global OEM standards with full traceability and documentation.</p>
            </div>
            <div class="cap-detail-grid">
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        Testing Capabilities
                    </h4>
                    <ul class="cap-list">
                        <li>NABL Accredited Quality Lab</li>
                        <li>HDT / Vicat softening point measurement</li>
                        <li>Ash content &amp; fiber content analysis</li>
                        <li>Melt flow index (MFI) testing</li>
                        <li>Density &amp; specific gravity measurement</li>
                        <li>Moisture content analysis</li>
                        <li>Color measurement (spectrophotometer)</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Quality Systems
                    </h4>
                    <ul class="cap-list">
                        <li>ISO 9001:2015 & ISO 14001:2015 Certified</li>
                        <li>IATF 16949:2016 certified quality management</li>
                        <li>VDA 6.3 Certified Process Compliance</li>
                        <li>SPC &amp; process capability monitoring</li>
                        <li>APQP Process and PPAP documentation &amp; submission</li>
                        <li>Full material traceability system</li>
                        <li>Incoming, in-process &amp; final inspection protocols</li>
                    </ul>
                </div>
            </div>
            <div class="cap-stats" style="margin-top:28px;">
                <div class="cap-stat"><strong>ISO </strong><span>Certified</span></div>
                <div class="cap-stat"><strong>IATF 16949</strong><span>Certified</span></div>
                <div class="cap-stat"><strong>VDA 6.3</strong><span>Audited</span></div>
                <div class="cap-stat"><strong>NABL</strong><span>Accredited Lab</span></div>
            </div>
        </div>
    </section>

    <hr class="cap-divider">

    {{-- ═══ 4. SCM CAPABILITIES ═══ --}}
    <section class="cap-case" id="scm">
        <div class="cap-orb cap-orb--cyan" style="top:60px;left:-90px;"></div>
        <div class="cap-orb cap-orb--purple" style="bottom:-70px;right:-110px;"></div>
        <div class="container">
            <div class="cap-case-header">
                <div class="cap-eyebrow">Case Study 04</div>
                <h2 class="cap-title">SCM <strong>Capabilities</strong></h2>
                <p class="cap-text">ATSPL delivers a fully integrated supply chain model — from raw material sourcing and vendor development to JIT/JIS delivery systems, ensuring seamless OEM production support.</p>
            </div>
            <div class="cap-detail-grid">
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        Supply Chain Management
                    </h4>
                    <ul class="cap-list">
                        <li>Strategic raw material sourcing — global polymer suppliers</li>
                        <li>Vendor development &amp; qualification programs</li>
                        <li>JIT / JIS delivery to OEM production lines</li>
                        <li>ERP-integrated inventory management (SAP)</li>
                        <li>Warehouse &amp; logistics optimization</li>
                        <li>Consignment stock programs for key OEMs</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h4>
                        <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Operational Excellence
                    </h4>
                    <ul class="cap-list">
                        <li>Lean manufacturing &amp; continuous improvement (Kaizen)</li>
                        <li>Supplier performance scorecards &amp; audits</li>
                        <li>Risk mitigation &amp; business continuity planning</li>
                        <li>Cost optimization through localization strategy</li>
                        <li>Packaging design for damage-free transportation</li>
                        <li>Real-time shipment tracking &amp; EDI integration</li>
                    </ul>
                </div>
            </div>
            <div class="cap-stats" style="margin-top:28px;">
                <div class="cap-stat"><strong>SAP</strong><span>ERP Integrated</span></div>
                <div class="cap-stat"><strong>JIT/JIS</strong><span>Delivery</span></div>
                <div class="cap-stat"><strong>Lean</strong><span>Manufacturing</span></div>
                <div class="cap-stat"><strong>Global</strong><span>Sourcing</span></div>
            </div>
        </div>
    </section>

</main>

@endsection('content')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

    /* ═══ BANNER ENTRANCE ═══ */
    var bannerTL = gsap.timeline({delay:.15});
    bannerTL
        .from('.ab-crumb', {opacity:0, y:-20, duration:.5})
        .from('.ab-h1', {opacity:0, y:50, duration:.7, ease:'power3.out'}, '-=.2')
        .from('.ab-sub', {opacity:0, y:30, duration:.6}, '-=.35');

    gsap.to('.ab-banner-lines', {
        scrollTrigger:{trigger:'.ab-banner', start:'top top', end:'bottom top', scrub:true},
        y:100, ease:'none'
    });

    /* ═══ INTRO SECTION ═══ */
    gsap.from('.cap-intro-grid > div:first-child', {
        scrollTrigger:{trigger:'.cap-intro', start:'top 80%'},
        opacity:0, x:-60, duration:.8, ease:'power2.out'
    });
    gsap.from('.cap-intro-img', {
        scrollTrigger:{trigger:'.cap-intro', start:'top 80%'},
        opacity:0, x:60, scale:.92, duration:.8, ease:'power2.out', delay:.15
    });
    gsap.from('.cap-intro .cap-stat', {
        scrollTrigger:{trigger:'.cap-intro', start:'top 70%'},
        opacity:0, y:30, scale:.85, duration:.5, stagger:.1, ease:'back.out(1.6)', delay:.3
    });

    /* ═══ NAV PILLS BOUNCE IN ═══ */
    gsap.fromTo('.cap-nav-pill',
        {autoAlpha: 0, y: 30, scale: .8},
        {
            autoAlpha: 1, y: 0, scale: 1, duration: .5, stagger: .12, ease: 'back.out(2)',
            clearProps: 'opacity,visibility,transform',
            scrollTrigger:{trigger:'.cap-nav', start:'top 92%', once:true}
        }
    );

    /* ═══ DIVIDER LINES DRAW ═══ */
    document.querySelectorAll('.cap-divider').forEach(function(hr){
        gsap.from(hr, {
            scrollTrigger:{trigger:hr, start:'top 90%'},
            scaleX:0, duration:.8, ease:'power2.inOut'
        });
    });

    /* ═══ FLOATING ORBS ═══ */
    document.querySelectorAll('.cap-orb').forEach(function(orb){
        var sec = orb.closest('.cap-case');
        if(!sec) return;
        gsap.to(orb, {
            scrollTrigger:{trigger:sec, start:'top 90%', end:'bottom 10%', scrub:1.5},
            opacity:1, x: gsap.utils.random(-40,40), y: gsap.utils.random(-30,50),
            scale: gsap.utils.random(.9,1.2), ease:'none'
        });
    });

    /* ═══ CASE STUDY SECTIONS ═══ */
    document.querySelectorAll('.cap-case').forEach(function(sec, idx){
        var tl = gsap.timeline({
            scrollTrigger:{trigger:sec, start:'top 80%'}
        });

        var eyebrow = sec.querySelector('.cap-eyebrow');
        var title = sec.querySelector('.cap-title');
        var text = sec.querySelector('.cap-case-header .cap-text');

        tl.from(eyebrow, {opacity:0, x:-30, duration:.4, ease:'power2.out'})
          .from(title, {opacity:0, y:35, duration:.6, ease:'power3.out'}, '-=.15')
          .from(text, {opacity:0, y:25, duration:.5}, '-=.25');

        var cards = sec.querySelectorAll('.cap-card');
        cards.forEach(function(card, cIdx){
            var dir = cIdx % 2 === 0 ? -50 : 50;
            gsap.from(card, {
                scrollTrigger:{trigger:card, start:'top 85%'},
                opacity:0, x:dir, rotateY: cIdx % 2 === 0 ? 5 : -5,
                duration:.65, ease:'power2.out', delay: cIdx * .1
            });

            var items = card.querySelectorAll('.cap-list li');
            gsap.from(items, {
                scrollTrigger:{trigger:card, start:'top 80%'},
                opacity:0, x:-20, duration:.35, stagger:.06, delay:.3 + cIdx * .1,
                ease:'power2.out'
            });
        });

        var stats = sec.querySelectorAll('.cap-stat');
        gsap.from(stats, {
            scrollTrigger:{trigger:sec, start:'top 60%'},
            opacity:0, y:30, scale:.8, duration:.45, stagger:.1,
            ease:'back.out(1.8)', delay:.5
        });
    });

    /* ═══ PARALLAX ON INTRO IMAGE ═══ */
    gsap.to('.cap-intro-img img', {
        scrollTrigger:{trigger:'.cap-intro', start:'top bottom', end:'bottom top', scrub:1.2},
        y:-30, scale:1.04, ease:'none'
    });

    /* ═══ ACTIVE NAV PILL ON SCROLL ═══ */
    var pills = document.querySelectorAll('.cap-nav-pill');
    var sections = [];
    pills.forEach(function(p){
        var href = p.getAttribute('href');
        var target = document.querySelector(href);
        if(target) sections.push({pill:p, section:target});
    });

    ScrollTrigger.create({
        trigger: '.cap-page',
        start: 'top top',
        end: 'bottom bottom',
        onUpdate: function(){
            var scrollY = window.scrollY;
            var headerH = document.querySelector('.main-header') ? document.querySelector('.main-header').offsetHeight : 80;
            var activeIdx = -1;
            sections.forEach(function(s, i){
                if(scrollY >= s.section.offsetTop - headerH - 100) activeIdx = i;
            });
            pills.forEach(function(p){ p.classList.remove('is-active'); });
            if(activeIdx >= 0) sections[activeIdx].pill.classList.add('is-active');
        }
    });

    /* ═══ SMOOTH SCROLL NAV ═══ */
    var headerH = document.querySelector('.main-header') ? document.querySelector('.main-header').offsetHeight : 80;
    pills.forEach(function(pill){
        pill.addEventListener('click', function(e){
            var target = document.querySelector(this.getAttribute('href'));
            if(target){
                e.preventDefault();
                gsap.to(window, {duration:1, scrollTo:{y:target, offsetY:headerH+20}, ease:'power2.inOut'});
            }
        });
    });

    /* ═══ CARD SVG ICON PULSE ═══ */
    document.querySelectorAll('.cap-card h4 svg').forEach(function(svg){
        svg.parentElement.parentElement.addEventListener('mouseenter', function(){
            gsap.to(svg, {scale:1.2, rotation:10, duration:.3, ease:'back.out(2)'});
        });
        svg.parentElement.parentElement.addEventListener('mouseleave', function(){
            gsap.to(svg, {scale:1, rotation:0, duration:.3, ease:'power2.out'});
        });
    });
});
</script>
@endsection('scripts')
