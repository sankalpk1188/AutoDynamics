@extends('layouts/frontLayout/front_design')

@php
    $recaptchaSiteKey = config('app.google_recaptcha_key');
@endphp

@section('styles')
<style>
    .ud-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

    /* ── Top banner ── */
    .ud-top {
        position: relative;
        background: #0c2340;
        padding: 48px 0 56px;
        overflow: hidden;
    }
    .ud-top-lines { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .ud-top-line {
        position: absolute; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
        animation: udLine 4s linear infinite; opacity: 0;
    }
    .ud-top-line:nth-child(1) { top: 30%; width: 60%; left: -30%; --dur: 3.5s; }
    .ud-top-line:nth-child(2) { top: 55%; width: 75%; left: -40%; --dur: 4.2s; animation-delay: 1s; }
    @keyframes udLine {
        0% { transform: translateX(0); opacity: 0; }
        15% { opacity: 1; }
        85% { opacity: 1; }
        100% { transform: translateX(180%); opacity: 0; }
    }
    .ud-top .container { position: relative; z-index: 2; }
    .ud-crumb { margin-bottom: 0; }
    .ud-crumb a, .ud-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ud-crumb a:hover { color: #fff; }
    .ud-crumb .sep { margin: 0 6px; }

    /* ── Shared typography ── */
    .ud-kicker {
        font-size: 0.72rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: #9fc7ff;
        font-weight: 700;
        margin: 0 0 14px;
    }
    .ud-h1 {
        font-size: clamp(1.65rem, 3.2vw, 2.45rem);
        line-height: 1.18;
        color: #f5f9ff;
        font-weight: 800;
        margin: 0 0 16px;
    }
    .ud-h1 em, .ud-h1 .ud-accent {
        font-style: normal;
        background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .ud-lead {
        color: #b4c9e0;
        font-size: 0.98rem;
        line-height: 1.75;
        margin: 0 0 24px;
        max-width: 520px;
    }

    /* ── Hero: content + image ── */
    .ud-hero {
        padding: 48px 0 40px;
        background: #000;
        position: relative;
    }
    .ud-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(800px 320px at 10% 30%, rgba(74, 134, 228, 0.1), transparent 65%);
        pointer-events: none;
    }
    .ud-hero .container { position: relative; z-index: 2; }

    .ud-features { list-style: none; padding: 0; margin: 0; }
    .ud-features li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(130, 175, 240, 0.1);
    }
    .ud-features li:last-child { border-bottom: 0; }
    .ud-feat-icon {
        flex: 0 0 40px;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(90, 158, 245, 0.2), rgba(90, 158, 245, 0.06));
        border: 1px solid rgba(130, 175, 240, 0.25);
        display: grid;
        place-items: center;
        color: #7eb8ff;
    }
    .ud-feat-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .ud-feat-text strong { display: block; color: #eef6ff; font-size: 0.92rem; font-weight: 600; margin-bottom: 2px; }
    .ud-feat-text span { color: #8aa4c4; font-size: 0.82rem; line-height: 1.45; }

    .ud-hero-form .ud-form-card {
        height: 100%;
    }

    /* ── Concept panel (below hero) ── */
    .ud-concept-section {
        padding: 0 0 48px;
        background: #000;
        position: relative;
    }
    .ud-concept-section .container { position: relative; z-index: 2; }
    .ud-concept-section .ud-concept-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0 24px;
    }
    @media (max-width: 575px) {
        .ud-concept-section .ud-concept-list { grid-template-columns: 1fr; }
    }

    .ud-concept-panel {
        padding: 28px 24px;
        border-radius: 16px;
        border: 1px solid rgba(130, 175, 240, 0.15);
        background: linear-gradient(165deg, rgba(12, 28, 52, 0.95), rgba(6, 14, 28, 0.98));
        height: 100%;
    }
    .ud-concept-panel .ud-h2 {
        font-size: clamp(1.25rem, 2.2vw, 1.65rem);
        line-height: 1.25;
        color: #f0f7ff;
        font-weight: 700;
        margin: 0 0 12px;
    }
    .ud-concept-panel .ud-h2 strong {
        background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .ud-concept-list { list-style: none; padding: 0; margin: 20px 0 0; }
    .ud-concept-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        color: #b4c9e0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(130, 175, 240, 0.08);
    }
    .ud-concept-list li:last-child { border-bottom: 0; }
    .ud-concept-list svg { flex-shrink: 0; width: 18px; height: 18px; stroke: #7eb8ff; fill: none; stroke-width: 1.8; }

    .ud-form-card {
        border-radius: 16px;
        padding: 28px 26px 32px;
        background: #f5f8fc;
        border: 1px solid #dce5f0;
        box-shadow: 0 20px 48px rgba(0, 0, 0, 0.25);
    }
    .ud-form-card .ud-form-title {
        color: #0f1f36;
        font-size: 1.4rem;
        font-weight: 800;
        margin: 0 0 4px;
    }
    .ud-form-card .ud-form-sub {
        color: #3672b8;
        font-size: 0.88rem;
        font-weight: 600;
        margin: 0 0 22px;
    }

    .ud-dropzone {
        border: 2px dashed #b8cfe8;
        border-radius: 12px;
        padding: 26px 16px;
        text-align: center;
        cursor: pointer;
        background: #fff;
        transition: border-color 0.2s, background 0.2s;
        margin-bottom: 18px;
    }
    .ud-dropzone:hover, .ud-dropzone.is-dragover {
        border-color: #5a9ef5;
        background: #eef5ff;
    }
    .ud-dropzone-icon {
        width: 44px; height: 44px; margin: 0 auto 10px;
        border-radius: 50%;
        background: #e8f1fd;
        display: grid; place-items: center;
        color: #2a6cb8;
    }
    .ud-dropzone-icon svg { width: 22px; height: 22px; stroke: currentColor; fill: none; stroke-width: 1.8; }
    .ud-dropzone-text { color: #1a3a5c; font-size: 0.9rem; margin-bottom: 4px; }
    .ud-dropzone-text a { color: #2a6cb8; font-weight: 600; text-decoration: underline; }
    .ud-dropzone-hint { color: #6b849e; font-size: 0.76rem; margin: 0; }

    .ud-file-list { list-style: none; padding: 0; margin: -6px 0 14px; }
    .ud-file-list li {
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
        padding: 8px 12px; margin-bottom: 6px;
        border-radius: 8px; background: #e8f1fd;
        border: 1px solid #d4e4f8;
        font-size: 0.82rem; color: #1a3a5c;
    }
    .ud-file-list .ud-remove {
        border: none; background: transparent; color: #c0392b; cursor: pointer; font-size: 1.1rem; line-height: 1;
    }

    .ud-form .form-label { color: #1a3a5c; font-size: 0.84rem; font-weight: 600; margin-bottom: 6px; }
    .ud-form .form-control, .ud-form .form-select {
        background: #fff;
        border: 1px solid #c5d6ea;
        color: #0f1f36;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.92rem;
    }
    .ud-form .form-control:focus, .ud-form .form-select:focus {
        border-color: #5a9ef5;
        box-shadow: 0 0 0 3px rgba(90, 158, 245, 0.2);
    }
    .ud-form .form-control::placeholder { color: #8aa4c4; }
    .ud-form .form-select option { color: #0f1f36; }
    .required:after { content: ' *'; color: #c0392b; }

    .ud-formats { color: #6b849e; font-size: 0.76rem; margin: 12px 0 16px; text-align: center; }

    .ud-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; padding: 14px 22px; border: none; border-radius: 8px;
        font-weight: 700; font-size: 0.84rem; letter-spacing: 0.06em; text-transform: capitalize;
        color: #061224;
        background: linear-gradient(135deg, #66afff, #3888d9);
        border: 1px solid rgba(42, 108, 184, 0.3);
        box-shadow: 0 8px 22px rgba(39, 120, 195, 0.3);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .ud-btn:hover { transform: translateY(-1px); box-shadow: 0 12px 28px rgba(39, 120, 195, 0.4); color: #061224; }
    .ud-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .ud-form .form-control.is-invalid,
    .ud-form .form-select.is-invalid {
        border-color: #e74c3c !important;
        box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.15);
    }
    .ud-form small.error,
    .ud-form label.error {
        display: block;
        font-size: 12px;
        color: #c0392b !important;
        font-weight: 600;
        margin-top: 4px;
    }
    #udCaptchaError.error {
        font-size: 12px;
        color: #c0392b !important;
        font-weight: 600;
    }
    .ud-dropzone.ud-dropzone-error {
        border-color: #e74c3c;
        background: #fff5f5;
    }

    /* ── Process strip ── */
    .ud-process-strip {
        padding: 48px 0 64px;
        background: #070f1b;
        border-top: 1px solid rgba(130, 175, 240, 0.12);
        position: relative;
    }
    .ud-process-strip::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(700px 200px at 50% 0%, rgba(62, 122, 216, 0.12), transparent 70%);
        pointer-events: none;
    }
    .ud-process-strip .container { position: relative; z-index: 2; }
    .ud-process-head {
        text-align: center;
        font-size: clamp(0.78rem, 1.5vw, 0.88rem);
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #9fc7ff;
        font-weight: 700;
        margin: 0 0 32px;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.5;
    }
    .ud-process-flow {
        display: grid;
        grid-template-columns: 1fr auto 1fr auto 1fr auto 1fr;
        align-items: start;
        gap: 8px;
        max-width: 1000px;
        margin: 0 auto;
    }
    .ud-pstep { text-align: center; padding: 0 6px; }
    .ud-pstep-icon {
        width: 48px; height: 48px;
        margin: 0 auto 12px;
        border-radius: 12px;
        background: rgba(90, 158, 245, 0.12);
        border: 1px solid rgba(130, 175, 240, 0.22);
        display: grid;
        place-items: center;
        color: #7eb8ff;
    }
    .ud-pstep-icon svg { width: 22px; height: 22px; stroke: currentColor; fill: none; stroke-width: 1.8; }
    .ud-pstep h4 {
        margin: 0 0 6px;
        font-size: 0.82rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #eef6ff;
        font-weight: 700;
    }
    .ud-pstep p { margin: 0; font-size: 0.78rem; color: #8aa4c4; line-height: 1.45; }
    .ud-parrow {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 14px;
        color: rgba(126, 184, 255, 0.5);
        font-size: 1.2rem;
    }

    @media (max-width: 991px) {
        .ud-hero { padding: 36px 0 28px; }
        .ud-hero-form { margin-bottom: 8px; }
        .ud-process-flow {
            grid-template-columns: 1fr 1fr;
            gap: 20px 12px;
        }
        .ud-parrow { display: none; }
        .ud-pstep { grid-column: span 1; }
    }

    @media (max-width: 575px) {
        .ud-top { padding: 36px 0 44px; }
        .ud-hero { padding: 28px 0 24px; }
        .ud-concept-section { padding: 0 0 32px; }
        .ud-form-card { padding: 22px 18px 26px; }
        .ud-process-strip { padding: 36px 0 48px; }
        .ud-process-flow { grid-template-columns: 1fr; gap: 16px; }
        .ud-process-head { font-size: 0.72rem; margin-bottom: 24px; }
    }
</style>
@endsection

@section('content')
<main class="main ud-page">

    <section class="ud-top d-none">
        <div class="ud-top-lines">
            <span class="ud-top-line"></span>
            <span class="ud-top-line"></span>
        </div>
        <div class="container">
            <div class="ud-crumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="sep">/</span>
                <span>Upload Your Design</span>
            </div>
        </div>
    </section>

    <section class="ud-process-strip" aria-label="How it works">
        <div class="container">
            <p class="ud-process-head">A Simple Process &middot; Clear Communication &middot; Reliable Results</p>
            <div class="ud-process-flow">
                <div class="ud-pstep">
                    <div class="ud-pstep-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    </div>
                    <h4>Upload Your Design</h4>
                    <p>Share CAD or drawings securely</p>
                </div>
                <div class="ud-parrow" aria-hidden="true">→</div>
                <div class="ud-pstep">
                    <div class="ud-pstep-icon">
                        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                    <h4>We Review &amp; Analyze</h4>
                    <p>Engineering &amp; feasibility check</p>
                </div>
                <div class="ud-parrow" aria-hidden="true">→</div>
                <div class="ud-pstep">
                    <div class="ud-pstep-icon">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <h4>Receive Your Quote</h4>
                    <p>Proposal within 7 working days</p>
                </div>
                <div class="ud-parrow" aria-hidden="true">→</div>
                <div class="ud-pstep">
                    <div class="ud-pstep-icon">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h4>Start Your Project</h4>
                    <p>Tooling &amp; production kickoff</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Hero: content left + form right --}}
    <section class="ud-hero" id="upload-form">
        <div class="container">
            <div class="row align-items-start g-4 g-lg-5">
                <div class="col-lg-5">
                    <p class="ud-kicker">Delivering ideas to products</p>
                    <h1 class="ud-h1">Upload Your Drawing. <span class="ud-accent">Explore Lightweighting Possibilities.</span></h1>
                    <p class="ud-lead">Submit your CAD or drawings for expert evaluation. Our team reviews technical feasibility, recommends the right process, and returns a structured quote for your program.</p>
                    <ul class="ud-features">
                        <li>
                            <span class="ud-feat-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            </span>
                            <span class="ud-feat-text">
                                <strong>Technical Feasibility Review</strong>
                                <span>Engineering assessment of your part and material options</span>
                            </span>
                        </li>
                        <li>
                            <span class="ud-feat-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                            </span>
                            <span class="ud-feat-text">
                                <strong>DFM &amp; Process Recommendation</strong>
                                <span>Design-for-manufacturing and production path guidance</span>
                            </span>
                        </li>
                        <li>
                            <span class="ud-feat-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </span>
                            <span class="ud-feat-text">
                                <strong>Quote Within 7 Working Days</strong>
                                <span>Clear timeline from upload to commercial proposal</span>
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-7 ud-hero-form">
                    <div class="ud-form-card">
                        <h3 class="ud-form-title">Get a Quote Within a Week</h3>
                        <p class="ud-form-sub">Upload your design files and project details</p>

                        @if ($errors->any())
                            <div class="alert alert-warning mb-3" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('upload-design') }}" method="POST" enctype="multipart/form-data" class="ud-form" id="uploadDesignForm" novalidate>
                            @csrf

                            <div class="ud-dropzone" id="udDropzone" role="button" tabindex="0" aria-label="Upload design files">
                                <input type="file" name="design_files[]" id="udFiles" class="d-none" multiple accept=".step,.stp,.iges,.igs,.pdf,.dwg,.dxf">
                                <div class="ud-dropzone-icon">
                                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                </div>
                                <p class="ud-dropzone-text">Drag &amp; drop your files here or <a href="#" id="udBrowse">browse files</a></p>
                                <p class="ud-dropzone-hint">Max file size: 50MB per file (up to 5 files)</p>
                                <p class="ud-formats">We support: STEP, STP, IGS, PDF, DWG, DXF</p>
                            </div>
                            <ul class="ud-file-list" id="udFileList" hidden></ul>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label required" for="ud_name">Full Name</label>
                                    <input class="form-control" id="ud_name" name="name" type="text" value="{{ old('name') }}" placeholder="Your full name" autocomplete="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required" for="ud_email">Work Email</label>
                                    <input class="form-control" id="ud_email" name="email" type="email" value="{{ old('email') }}" placeholder="you@company.com" autocomplete="email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label required" for="ud_company">Company Name</label>
                                    <input class="form-control" id="ud_company" name="company" type="text" value="{{ old('company') }}" placeholder="Company name" autocomplete="organization" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label required" for="ud_looking">What are you looking for?</label>
                                    <select class="form-select" id="ud_looking" name="looking_for" required>
                                        <option value="" disabled {{ old('looking_for') ? '' : 'selected' }}>Select an option</option>
                                        <option value="Engineering & Design Support" {{ old('looking_for') == 'Engineering & Design Support' ? 'selected' : '' }}>Engineering &amp; Design Support</option>
                                        <option value="Tooling Development" {{ old('looking_for') == 'Tooling Development' ? 'selected' : '' }}>Tooling Development</option>
                                        <option value="Injection Molding / Manufacturing" {{ old('looking_for') == 'Injection Molding / Manufacturing' ? 'selected' : '' }}>Injection Molding / Manufacturing</option>
                                        <option value="Material Selection & Validation" {{ old('looking_for') == 'Material Selection & Validation' ? 'selected' : '' }}>Material Selection &amp; Validation</option>
                                        <option value="Metal Conversion / Lightweighting" {{ old('looking_for') == 'Metal Conversion / Lightweighting' ? 'selected' : '' }}>Metal Conversion / Lightweighting</option>
                                        <option value="Full Program (Concept to Production)" {{ old('looking_for') == 'Full Program (Concept to Production)' ? 'selected' : '' }}>Full Program (Concept to Production)</option>
                                        <option value="Other" {{ old('looking_for') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required" for="ud_material">Preferred Material</label>
                                    <input class="form-control" id="ud_material" name="preferred_material" type="text" value="{{ old('preferred_material') }}" placeholder="e.g. PP, PA6, PC-ABS" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required" for="ud_volume">Annual Volume</label>
                                    <input class="form-control" id="ud_volume" name="annual_volume" type="text" value="{{ old('annual_volume') }}" placeholder="e.g. 50,000 units/year" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="ud_part_desc">Part Description <span class="text-muted fw-normal">(optional)</span></label>
                                    <textarea class="form-control ud-optional" id="ud_part_desc" name="part_description" rows="3" placeholder="Brief description of the part or assembly">{{ old('part_description') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="ud_program">Program Name <span class="text-muted fw-normal">(optional)</span></label>
                                    <input class="form-control ud-optional" id="ud_program" name="program_name" type="text" value="{{ old('program_name') }}" placeholder="OEM program or project name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="ud_sop">SOP Timeline <span class="text-muted fw-normal">(optional)</span></label>
                                    <input class="form-control ud-optional" id="ud_sop" name="sop_timeline" type="text" value="{{ old('sop_timeline') }}" placeholder="e.g. Q3 2026, 12 months">
                                </div>
                                <div class="col-12">
                                    <div id="udCaptchaWrap">
                                        @if(!empty($recaptchaSiteKey))
                                            <div class="g-recaptcha mb-2" data-sitekey="{{ $recaptchaSiteKey }}"></div>
                                        @else
                                            <small class="error d-block mb-2">Captcha is temporarily unavailable. Please contact administrator.</small>
                                        @endif
                                        <small id="udCaptchaError" class="error" style="display: none;"></small>
                                    </div>
                                    <button type="submit" class="ud-btn ad-submit-btn" id="udSubmit">Submit Request <span aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ud-concept-section d-none">
        <div class="container">
            <div class="ud-concept-panel">
                <p class="ud-kicker">From Concept to Production</p>
                <h2 class="ud-h2">Submit Your Design. <strong>We Engineer the Rest.</strong></h2>
                <p class="ud-lead" style="margin-bottom: 0; max-width: 720px;">Share your requirements and receive a proposal aligned with automotive quality, tooling, and delivery expectations.</p>
                <ul class="ud-concept-list">
                    <li>
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                        Advanced Engineering Support
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg>
                        Decorative &amp; Functional Solutions
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Global Quality Standards
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16"/></svg>
                        On-Time Delivery
                    </li>
                </ul>
            </div>
        </div>
    </section>

</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(!empty($recaptchaSiteKey))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
<script>
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Request Submitted', text: @json(session('success')), confirmButtonColor: '#0b1725' });
    @endif
</script>
<script>
    (function () {
        var dropzone = document.getElementById('udDropzone');
        var fileInput = document.getElementById('udFiles');
        var browse = document.getElementById('udBrowse');
        var fileList = document.getElementById('udFileList');
        var allowedExt = ['step', 'stp', 'iges', 'igs', 'pdf', 'dwg', 'dxf'];
        var maxSize = 50 * 1024 * 1024;
        var maxFiles = 5;
        var selectedFiles = [];

        if (!dropzone || !fileInput) return;

        function extOk(name) {
            var ext = (name.split('.').pop() || '').toLowerCase();
            return allowedExt.indexOf(ext) !== -1;
        }

        function syncInput() {
            var dt = new DataTransfer();
            selectedFiles.forEach(function (f) { dt.items.add(f); });
            fileInput.files = dt.files;
        }

        function renderList() {
            fileList.innerHTML = '';
            if (!selectedFiles.length) {
                fileList.hidden = true;
                return;
            }
            fileList.hidden = false;
            selectedFiles.forEach(function (file, idx) {
                var li = document.createElement('li');
                li.innerHTML = '<span>' + file.name + ' (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)</span>';
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'ud-remove';
                btn.innerHTML = '&times;';
                btn.setAttribute('aria-label', 'Remove ' + file.name);
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    selectedFiles.splice(idx, 1);
                    syncInput();
                    renderList();
                });
                li.appendChild(btn);
                fileList.appendChild(li);
            });
        }

        function addFiles(files) {
            Array.prototype.forEach.call(files, function (file) {
                if (selectedFiles.length >= maxFiles) return;
                if (!extOk(file.name)) {
                    Swal.fire({ icon: 'warning', title: 'Invalid file', text: file.name + ' is not an allowed type.', confirmButtonColor: '#0b1725' });
                    return;
                }
                if (file.size > maxSize) {
                    Swal.fire({ icon: 'warning', title: 'File too large', text: file.name + ' exceeds 50MB.', confirmButtonColor: '#0b1725' });
                    return;
                }
                if (!selectedFiles.some(function (f) { return f.name === file.name && f.size === file.size; })) {
                    selectedFiles.push(file);
                }
            });
            syncInput();
            renderList();
        }

        browse.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
        });

        dropzone.addEventListener('click', function (e) {
            if (e.target.closest('#udBrowse') || e.target.closest('.ud-remove')) return;
            fileInput.click();
        });

        dropzone.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', function () {
            addFiles(fileInput.files);
        });

        ['dragenter', 'dragover'].forEach(function (ev) {
            dropzone.addEventListener(ev, function (e) {
                e.preventDefault();
                dropzone.classList.add('is-dragover');
            });
        });
        ['dragleave', 'drop'].forEach(function (ev) {
            dropzone.addEventListener(ev, function (e) {
                e.preventDefault();
                dropzone.classList.remove('is-dragover');
            });
        });
        dropzone.addEventListener('drop', function (e) {
            e.preventDefault();
            if (e.dataTransfer && e.dataTransfer.files) addFiles(e.dataTransfer.files);
        });

    })();
</script>

<script>
    jQuery(function ($) {
        $.validator.addMethod('designFileType', function (value, element) {
            if (!element.files || !element.files.length) return true;
            var allowed = ['step', 'stp', 'iges', 'igs', 'pdf', 'dwg', 'dxf'];
            for (var i = 0; i < element.files.length; i++) {
                var ext = (element.files[i].name.split('.').pop() || '').toLowerCase();
                if (allowed.indexOf(ext) === -1) return false;
            }
            return true;
        }, 'Allowed file types: STEP, STP, IGS, PDF, DWG, DXF.');

        $.validator.addMethod('designFileSize', function (value, element) {
            if (!element.files || !element.files.length) return true;
            var max = 50 * 1024 * 1024;
            for (var i = 0; i < element.files.length; i++) {
                if (element.files[i].size > max) return false;
            }
            return true;
        }, 'Each file must be 50MB or smaller.');

        $.validator.addMethod('designFileCount', function (value, element) {
            if (!element.files) return false;
            return element.files.length >= 1 && element.files.length <= 5;
        }, 'Please upload 1 to 5 design files.');

        $('#uploadDesignForm').validate({
            ignore: ':hidden:not(#udFiles), .ud-optional',
            rules: {
                name: { required: true, maxlength: 255 },
                email: { required: true, email: true, maxlength: 255 },
                company: { required: true, maxlength: 255 },
                looking_for: { required: true },
                preferred_material: { required: true, maxlength: 255 },
                annual_volume: { required: true, maxlength: 255 },
                'design_files[]': { required: true, designFileCount: true, designFileType: true, designFileSize: true }
            },
            messages: {
                name: { required: 'Please enter your full name.' },
                email: {
                    required: 'Please enter your work email.',
                    email: 'Please enter a valid email address.'
                },
                company: { required: 'Please enter your company name.' },
                looking_for: { required: 'Please select what you are looking for.' },
                preferred_material: { required: 'Please enter your preferred material.' },
                annual_volume: { required: 'Please enter the annual volume.' },
                'design_files[]': {
                    required: 'Please upload at least one design file.'
                }
            },
            errorClass: 'error',
            errorElement: 'small',
            errorPlacement: function (error, element) {
                error.addClass('d-block mt-1');
                if (element.attr('name') === 'design_files[]') {
                    error.insertAfter('#udDropzone');
                    $('#udDropzone').addClass('ud-dropzone-error');
                } else if (element.attr('name') === 'looking_for') {
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            },
            success: function (label, element) {
                label.remove();
                if ($(element).attr('name') === 'design_files[]') {
                    $('#udDropzone').removeClass('ud-dropzone-error');
                }
            },
            highlight: function (element) {
                if ($(element).attr('name') === 'design_files[]') {
                    $('#udDropzone').addClass('ud-dropzone-error');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
                if ($(element).attr('name') === 'design_files[]') {
                    $('#udDropzone').removeClass('ud-dropzone-error');
                }
            },
            invalidHandler: function () {
                $('#udCaptchaError').hide();
                var first = $('.is-invalid').first();
                if (first.length) {
                    $('html, body').animate({
                        scrollTop: Math.max(first.offset().top - 100, 0)
                    }, 400);
                }
            },
            submitHandler: function (form) {
                var captchaOk = typeof grecaptcha !== 'undefined' && grecaptcha.getResponse().length > 0;
                if (!captchaOk) {
                    $('#udCaptchaError').text('Please complete the captcha verification.').show();
                    $('html, body').animate({
                        scrollTop: Math.max($('#udCaptchaWrap').offset().top - 100, 0)
                    }, 400);
                    return false;
                }
                $('#udCaptchaError').hide();
                var $btn = $('#udSubmit');
                $btn.prop('disabled', true).html('Submitting…');
                form.submit();
            }
        });

        $('#udFiles').on('change', function () {
            $(this).valid();
        });
    });
</script>
@endsection
