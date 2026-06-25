@extends('layouts/frontLayout/front_design')

@php
    $recaptchaSiteKey = config('app.google_recaptcha_key');
@endphp

@section('styles')
<style>
    .contact-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

    .error { font-size: 13.5px; color: #ff8a8a !important; }
    .required:after { content: ' *'; color: #ff8a8a; }

    .swal-button:not([disabled]):hover { background-color: #142e41; }
    .swal-footer { text-align: center; padding: 13px 16px; border-top: 1px solid #eee; }
    .swal-button { background-color: #0b1725; color: #fff; border: none; border-radius: 5px; font-weight: 600; font-size: 14px; padding: 8px 20px; cursor: pointer; }
    .swal-text { font-size: 16px; color: rgb(10 22 35); }
    .swal-title { color: rgb(20 46 65); font-weight: 600; font-size: 22px; text-align: center; }

    /* Banner (aligned with about page) */
    .ab-banner {
        position: relative;
        overflow: hidden;
        background: #0c2340;
        padding: 62px 0 90px;
    }
    .ab-banner-lines { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .ab-speed-line {
        position: absolute;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07) 30%, rgba(255,255,255,0.03) 70%, transparent);
        animation: abSpeedLine var(--dur) linear infinite;
        opacity: 0;
    }
    .ab-speed-line:nth-child(1) { top: 18%; left: -40%; width: 70%; --dur: 3s; animation-delay: 0s; }
    .ab-speed-line:nth-child(2) { top: 35%; left: -50%; width: 85%; --dur: 4s; animation-delay: 0.8s; }
    .ab-speed-line:nth-child(3) { top: 52%; left: -30%; width: 60%; --dur: 2.8s; animation-delay: 0.4s; }
    .ab-speed-line:nth-child(4) { top: 68%; left: -60%; width: 90%; --dur: 4.5s; animation-delay: 1.5s; }
    .ab-speed-line:nth-child(5) { top: 82%; left: -45%; width: 75%; --dur: 3.2s; animation-delay: 0.2s; }
    .ab-speed-line:nth-child(6) { top: 26%; left: -35%; width: 55%; --dur: 3.6s; animation-delay: 1.2s; }
    .ab-speed-line:nth-child(7) { top: 44%; left: -55%; width: 80%; --dur: 3s; animation-delay: 2s; }
    .ab-speed-line:nth-child(8) { top: 75%; left: -40%; width: 65%; --dur: 4.2s; animation-delay: 0.5s; }
    @keyframes abSpeedLine {
        0% { transform: translateX(0); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateX(200%); opacity: 0; }
    }
    .ab-banner-inner { position: relative; z-index: 2; }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a, .ab-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ab-crumb a:hover { color: #fff; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem, 4.5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 560px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .cp-section { padding: 56px 0; background: #000; position: relative; }
    .cp-section::before {
        content: ""; position: absolute; inset: 0;
        background: radial-gradient(620px 320px at 50% 50%, rgba(62,122,216,0.16), rgba(62,122,216,0.03) 45%, transparent 72%);
        pointer-events: none;
    }
    .cp-section .container { position: relative; z-index: 1; }

    .cp-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 0.66rem; letter-spacing: 0.2em; text-transform: uppercase; color: #9fc7ff; margin-bottom: 14px;
    }
    .cp-eyebrow::before {
        content: ""; width: 7px; height: 7px; border-radius: 50%;
        background: #7eb8ff; box-shadow: 0 0 10px rgba(126,184,255,0.8);
    }
    .cp-h2 {
        font-size: clamp(1.45rem, 2.6vw, 2rem); color: #f0f7ff; font-weight: 700; margin-bottom: 16px; line-height: 1.22;
    }
    .cp-h2 strong {
        background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff);
        -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
    }
    .cp-lead { color: #b4c9e0; line-height: 1.78; font-size: 0.95rem; margin-bottom: 22px; max-width: 640px; }

    .cp-contact-list { margin-bottom: 30px; }
    .cp-contact-line {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #c5d6ea;
        line-height: 1.75;
        font-size: 0.96rem;
        margin-bottom: 6px;
    }
    .cp-contact-line svg {
        flex: 0 0 auto;
        width: 22px;
        height: 22px;
        color: #9fc7ff;
        margin-top: 3px;
    }
    .cp-contact-line a {
        color: #9fc7ff;
        text-decoration: none;
        font-weight: 600;
    }
    .cp-contact-line a:hover {
        color: #cfe4ff;
        text-decoration: underline;
    }

    .cp-loc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 14px;
        margin-top: 20px;
    }
    .cp-loc-card {
        background: rgba(15, 25, 45, 0.65);
        border: 1px solid rgba(130, 175, 240, 0.14);
        border-radius: 12px;
        padding: 16px 18px;
    }
    .cp-loc-title { color: #f0f7ff; font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
    .cp-loc-sub { color: #8aa4c4; font-size: 0.82rem; line-height: 1.45; }

    .cp-form-card {
        background: rgba(15, 25, 45, 0.72);
        border: 1px solid rgba(130, 175, 240, 0.14);
        border-radius: 14px;
        padding: 28px 26px 32px;
    }
    .cp-form-title { color: #f0f7ff; font-size: 1.35rem; font-weight: 700; margin-bottom: 20px; }
    .cp-form .form-label { color: #b4c9e0; font-size: 0.88rem; margin-bottom: 6px; }
    .cp-form .form-control {
        background: rgba(6, 18, 36, 0.65);
        border: 1px solid rgba(130, 175, 240, 0.2);
        color: #e8f1fc;
        border-radius: 8px;
        padding: 10px 14px;
    }
    .cp-form .form-control:focus {
        border-color: rgba(126, 184, 255, 0.55);
        box-shadow: 0 0 0 2px rgba(62, 122, 216, 0.25);
        background: rgba(6, 18, 36, 0.85);
        color: #fff;
    }
    .cp-form .form-control::placeholder { color: rgba(180, 201, 224, 0.45); }
    .cp-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 100%;
        padding: 12px 22px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        color: #061224;
        background: linear-gradient(95deg, #85bdff, #b8d9ff);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .cp-btn:hover { color: #041018; box-shadow: 0 8px 24px rgba(62, 122, 216, 0.35); transform: translateY(-1px); }
    .cp-btn:disabled { opacity: 0.75; cursor: not-allowed; transform: none; }

    .cp-map-wrap {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(130, 175, 240, 0.14);
        line-height: 0;
    }
    .cp-map-wrap iframe { width: 100%; height: 380px; border: 0; }
    .cp-loc-card,
    .cp-form-card,
    .cp-map-wrap {
        transition: transform 0.28s ease, border-color 0.28s ease, box-shadow 0.28s ease;
    }
    .cp-loc-card:hover,
    .cp-form-card:hover {
        transform: translateY(-4px);
        border-color: rgba(150, 196, 255, 0.3);
        box-shadow: 0 16px 34px rgba(20, 60, 120, 0.24);
    }
    .cp-map-wrap:hover {
        box-shadow: 0 12px 28px rgba(20, 60, 120, 0.2);
    }

    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .ab-wave svg { height: 45px; }
        .cp-section { padding: 40px 0; }
        .cp-map-wrap iframe { height: 320px; }
    }
    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-wave svg { height: 36px; }
        .cp-map-wrap iframe { height: 280px; }
    }
</style>
@endsection('styles')

@section('content')

<main class="main contact-page">

    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="sep">/</span>
                <span>Contact</span>
            </div>
            <h1 class="ab-h1">Contact Us</h1>
            <p class="ab-sub">Get in touch with our team for any inquiries or project discussions</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    <section class="cp-section">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <div class="cp-eyebrow">Connect</div>
                    <h2 class="cp-h2">Let&rsquo;s Discuss Your <strong>Project</strong></h2>
                    <p class="cp-lead">Whether you need a feasibility study, a prototype, or full-scale production support, our team is ready to help you develop lightweight composite solutions.</p>
                    <div class="cp-contact-list">
                        <p class="cp-contact-line">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                                    <path stroke-dasharray="64" stroke-dashoffset="64" d="M8 3c0.5 0 2.5 4.5 2.5 5c0 1 -1.5 2 -2 3c-0.5 1 0.5 2 1.5 3c0.39 0.39 2 2 3 1.5c1 -0.5 2 -2 3 -2c0.5 0 5 2 5 2.5c0 2 -1.5 3.5 -3 4c-1.5 0.5 -2.5 0.5 -4.5 0c-2 -0.5 -3.5 -1 -6 -3.5c-2.5 -2.5 -3 -4 -3.5 -6c-0.5 -2 -0.5 -3 0 -4.5c0.5 -1.5 2 -3 4 -3Z">
                                        <animate attributeName="stroke-dashoffset" values="64;0" dur="0.6s" fill="freeze"></animate>
                                        <animateTransform attributeName="transform" type="rotate" dur="2.7s" repeatCount="indefinite" begin="0.6s" values="0 12 12;15 12 12;0 12 12;-12 12 12;0 12 12;12 12 12;0 12 12;-15 12 12;0 12 12;0 12 12" keyTimes="0;0.035;0.07;0.105;0.14;0.175;0.21;0.245;0.28;1" fill="freeze"></animateTransform>
                                    </path>
                                    <path stroke-dasharray="4" stroke-dashoffset="4" d="M15.76 8.28c-0.5 -0.51 -1.1 -0.93 -1.76 -1.24 M15.76 8.28c0.49 0.49 0.9 1.08 1.2 1.72">
                                        <animate attributeName="stroke-dashoffset" values="4;0;0;4;4" keyTimes="0;0.111;0.259;0.37;1" dur="2.7s" begin="0.6s" repeatCount="indefinite"></animate>
                                    </path>
                                    <path stroke-dasharray="6" stroke-dashoffset="6" d="M18.67 5.35c-1 -1 -2.26 -1.73 -3.67 -2.1 M18.67 5.35c0.99 1 1.72 2.25 2.08 3.65">
                                        <animate attributeName="stroke-dashoffset" values="6;6;0;0;6;6" keyTimes="0;0.074;0.185;0.333;0.444;1" dur="2.7s" begin="0.8s" repeatCount="indefinite"></animate>
                                    </path>
                                </g>
                            </svg>
                            <a href="tel:+918484015983">+91 8484015983</a>
                        </p>
                        <p class="cp-contact-line">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                                    <path stroke-dasharray="64" stroke-dashoffset="64" d="M8 3c0.5 0 2.5 4.5 2.5 5c0 1 -1.5 2 -2 3c-0.5 1 0.5 2 1.5 3c0.39 0.39 2 2 3 1.5c1 -0.5 2 -2 3 -2c0.5 0 5 2 5 2.5c0 2 -1.5 3.5 -3 4c-1.5 0.5 -2.5 0.5 -4.5 0c-2 -0.5 -3.5 -1 -6 -3.5c-2.5 -2.5 -3 -4 -3.5 -6c-0.5 -2 -0.5 -3 0 -4.5c0.5 -1.5 2 -3 4 -3Z">
                                        <animate attributeName="stroke-dashoffset" values="64;0" dur="0.6s" fill="freeze"></animate>
                                        <animateTransform attributeName="transform" type="rotate" dur="2.7s" repeatCount="indefinite" begin="0.6s" values="0 12 12;15 12 12;0 12 12;-12 12 12;0 12 12;12 12 12;0 12 12;-15 12 12;0 12 12;0 12 12" keyTimes="0;0.035;0.07;0.105;0.14;0.175;0.21;0.245;0.28;1" fill="freeze"></animateTransform>
                                    </path>
                                    <path stroke-dasharray="4" stroke-dashoffset="4" d="M15.76 8.28c-0.5 -0.51 -1.1 -0.93 -1.76 -1.24 M15.76 8.28c0.49 0.49 0.9 1.08 1.2 1.72">
                                        <animate attributeName="stroke-dashoffset" values="4;0;0;4;4" keyTimes="0;0.111;0.259;0.37;1" dur="2.7s" begin="0.6s" repeatCount="indefinite"></animate>
                                    </path>
                                    <path stroke-dasharray="6" stroke-dashoffset="6" d="M18.67 5.35c-1 -1 -2.26 -1.73 -3.67 -2.1 M18.67 5.35c0.99 1 1.72 2.25 2.08 3.65">
                                        <animate attributeName="stroke-dashoffset" values="6;6;0;0;6;6" keyTimes="0;0.074;0.185;0.333;0.444;1" dur="2.7s" begin="0.8s" repeatCount="indefinite"></animate>
                                    </path>
                                </g>
                            </svg>
                            <a href="tel:+919766914220">+91 9766914220</a>
                        </p>
                        <p class="cp-contact-line">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1">
                                    <path stroke-linejoin="round" d="M5 9l4.5 3L14 9" stroke-dasharray="30" stroke-dashoffset="30">
                                        <animate attributeName="stroke-dashoffset" values="30;0" dur="0.6s" fill="freeze"></animate>
                                    </path>
                                    <path d="M17 19H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h13a2 2 0 0 1 2 2v2" stroke-dasharray="60" stroke-dashoffset="60">
                                        <animate attributeName="stroke-dashoffset" values="60;0" begin="0.3s" dur="0.6s" fill="freeze"></animate>
                                    </path>
                                    <path stroke-linejoin="round" d="M23 14h-6m0 0l3-3m-3 3l3 3" stroke-dasharray="40" stroke-dashoffset="40">
                                        <animate attributeName="stroke-dashoffset" values="40;0" begin="0.6s" dur="0.6s" fill="freeze"></animate>
                                        <animateTransform attributeName="transform" type="translate" begin="1.2s" dur="0.8s" values="0 0;2 0;0 0" repeatCount="indefinite"></animateTransform>
                                    </path>
                                </g>
                            </svg>
                            <a href="mailto:info@autodynamics.co.in">info@autodynamics.co.in</a>
                        </p>
                        <p class="cp-contact-line">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <g>
                                        <animateTransform attributeName="transform" type="scale" values="1;1.05;1;0.95;1" dur="1.5s" repeatCount="indefinite" additive="sum"></animateTransform>
                                        <path d="m37.5 33.26l.58.032c1.215.068 2.301.733 2.848 1.82a33.5 33.5 0 0 1 2.423 6.38c.44 1.657-.775 3.19-2.487 3.26C37.998 44.87 32.824 45 24 45s-13.998-.13-16.864-.247c-1.712-.07-2.926-1.605-2.487-3.26a33.5 33.5 0 0 1 2.423-6.381c.547-1.087 1.633-1.752 2.848-1.82l.58-.031"></path>
                                        <path d="M39 18.07c0 10.63-10.748 18.26-14.048 20.353a1.77 1.77 0 0 1-1.904 0C19.748 36.331 9 28.7 9 18.07C9 9.747 15.716 3 24 3s15 6.747 15 15.07"></path>
                                        <path d="M30 18a6 6 0 1 1-12 0a6 6 0 0 1 12 0"></path>
                                    </g>
                                </g>
                            </svg>
                            <span>Survey No. 279/1 &amp; 2, Raisoni Industrial Park, Ph-II, Maan, Tal - Mulshi, Pune, Maharashtra 411057</span>
                        </p>
                    </div>

                    <h3 class="cp-h2 mt-5" style="font-size: 1.15rem;">Our Locations</h3>
                    <div class="cp-loc-grid">
                        <div class="cp-loc-card"><div class="cp-loc-title">Pune HQ (Plant 1)</div><div class="cp-loc-sub">Hinjewadi, Pune</div></div>
                        <div class="cp-loc-card"><div class="cp-loc-title">Pune (Plant 2)</div><div class="cp-loc-sub">Chakan, Pune</div></div>
                        <div class="cp-loc-card"><div class="cp-loc-title">Warehouse</div><div class="cp-loc-sub">Chakan, Pune</div></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="cp-form-card">
                        <h3 class="cp-form-title">Send Us a Message</h3>
                        @if ($errors->any())
                            <div class="alert alert-warning text-dark mb-3" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ url('contact-us') }}" id="contactPage" class="cp-form" method="POST" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label required" for="c_name">Full Name</label>
                                    <input class="form-control" id="c_name" name="name" type="text" value="{{ old('name') }}" placeholder="Your name" autocomplete="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required" for="c_email">Email</label>
                                    <input class="form-control" id="c_email" name="email" type="email" value="{{ old('email') }}" placeholder="you@company.com" autocomplete="email">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="c_phone">Phone</label>
                                    <input class="form-control" id="c_phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="+91 …" autocomplete="tel">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="c_company">Company</label>
                                    <input class="form-control" id="c_company" name="company" type="text" value="{{ old('company') }}" placeholder="Company name" autocomplete="organization">
                                </div>
                                <div class="col-12">
                                    <label class="form-label required" for="c_subject">Subject</label>
                                    <input class="form-control" id="c_subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="How can we help?">
                                </div>
                                <div class="col-12">
                                    <label class="form-label required" for="c_message">Message</label>
                                    <textarea class="form-control" id="c_message" name="comment" rows="5" placeholder="Your message">{{ old('comment') }}</textarea>
                                </div>
                                <div class="col-12">
                                    @if(!empty($recaptchaSiteKey))
                                        <div class="g-recaptcha mb-2" data-sitekey="{{ $recaptchaSiteKey }}"></div>
                                    @else
                                        <small class="error d-block mb-2">Captcha is temporarily unavailable. Please contact administrator.</small>
                                    @endif
                                    <button class="cp-btn cbtn ad-submit-btn" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cp-section pt-0 pb-5">
        <div class="container">
            <div class="cp-map-wrap">
                <iframe title="Auto Dynamics head office map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    src="https://maps.google.com/maps?q={{ urlencode('Survey No. 279/1 & 2, Raisoni Industrial Park, Ph-II, Village Maan, Mulshi, Pune, Maharashtra 411057') }}&amp;z=12&amp;output=embed"></iframe>
            </div>
        </div>
    </section>

</main>

@endsection('content')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(!empty($recaptchaSiteKey))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<script>
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Thank you', text: @json(session('success')), confirmButtonColor: '#0b1725' });
    @endif
    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Something went wrong', text: @json(session('error')), confirmButtonColor: '#0b1725' });
    @endif
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof gsap === 'undefined') return;

        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        gsap.from('.ab-crumb', { opacity: 0, y: -16, duration: 0.5, delay: 0.12 });
        gsap.from('.ab-h1', { opacity: 0, y: 34, duration: 0.75, delay: 0.22, ease: 'power2.out' });
        gsap.from('.ab-sub', { opacity: 0, y: 26, duration: 0.65, delay: 0.36, ease: 'power2.out' });

        gsap.to('.ab-banner-lines', {
            y: 65,
            ease: 'none',
            scrollTrigger: {
                trigger: '.ab-banner',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });

        gsap.from('.cp-eyebrow', {
            scrollTrigger: { trigger: '.cp-section', start: 'top 78%' },
            opacity: 0, x: -24, duration: 0.45
        });
        gsap.from('.cp-h2, .cp-lead', {
            scrollTrigger: { trigger: '.cp-section', start: 'top 74%' },
            opacity: 0, y: 22, duration: 0.55, stagger: 0.15
        });
        gsap.from('.cp-contact-item', {
            scrollTrigger: { trigger: '.cp-contact-list', start: 'top 80%' },
            opacity: 0, x: -20, duration: 0.42, stagger: 0.12
        });
        gsap.from('.cp-form-card', {
            scrollTrigger: { trigger: '.cp-form-card', start: 'top 82%' },
            opacity: 0, x: 40, duration: 0.7, ease: 'power2.out'
        });
        gsap.from('.cp-loc-card', {
            scrollTrigger: { trigger: '.cp-loc-grid', start: 'top 84%' },
            opacity: 0, y: 28, duration: 0.45, stagger: 0.08
        });
        gsap.from('.cp-map-wrap', {
            scrollTrigger: { trigger: '.cp-map-wrap', start: 'top 88%' },
            opacity: 0, y: 26, duration: 0.6
        });
    });
</script>

<script>
    jQuery.validator.addMethod("phoneFlexible", function(value, element) {
        if (this.optional(element)) return true;
        var v = String(value).replace(/[\s\-+]/g, '');
        return /^[0-9]{7,15}$/.test(v);
    }, "Please enter a valid phone number");

    $("#contactPage").validate({
        rules: {
            name: { required: true, maxlength: 255 },
            email: { required: true, email: true },
            phone: { phoneFlexible: true },
            company: { maxlength: 255 },
            subject: { required: true, maxlength: 255 },
            comment: { required: true }
        },
        messages: {
            name: { required: "Please enter your name." },
            email: { required: "Please enter your email.", email: "Please enter a valid email." },
            subject: { required: "Please enter a subject." },
            comment: { required: "Please enter your message." }
        },
        errorClass: "error",
        errorElement: "small",
        errorPlacement: function(error, element) {
            error.addClass("d-block mt-1");
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            var $btn = $(form).find("button.cbtn");
            $btn.prop("disabled", true).text("Sending…");
            form.submit();
        }
    });
</script>
@endsection('scripts')
