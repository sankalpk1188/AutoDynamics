@extends('layouts/frontLayout/front_design')

@section('styles')
<style>
    .career-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

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
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(2.2rem, 4.5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; }
    .ab-sub { color: rgba(255,255,255,0.72); font-size: 1.02rem; max-width: 640px; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .cr-section { padding: 56px 0; position: relative; }
    .cr-section::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(650px 280px at 50% 30%, rgba(62,122,216,0.13), transparent 70%);
        pointer-events: none;
    }
    .cr-section .container { position: relative; z-index: 1; }

    .cr-filter-title {
        color: #d7e7fb;
        font-weight: 700;
        font-size: 1.08rem;
        margin-bottom: 14px;
        letter-spacing: 0.02em;
    }
    .cr-filter-wrap {
        background: rgba(34, 60, 92, 0.55);
        border: 1px solid rgba(170, 205, 255, 0.35);
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 24px;
        position: sticky;
        top: 110px;
    }
    .cr-filter-col {
        align-self: flex-start;
    }
    .cr-form-control {
        width: 100%;
        background: rgba(233, 243, 255, 0.12);
        border: 1px solid rgba(185, 215, 255, 0.45);
        color: #edf5ff;
        border-radius: 10px;
        min-height: 46px;
        padding: 10px 12px;
    }
    .cr-form-control:focus {
        outline: 0;
        border-color: rgba(212, 232, 255, 0.85);
        box-shadow: 0 0 0 2px rgba(155, 196, 247, 0.28);
    }
    select.cr-form-control option {
        color: #0b1725;
        background: #ffffff;
    }
    .cr-filter-btn {
        min-height: 46px;
        border: 0;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 700;
    }
    .cr-btn-primary {
        background: linear-gradient(95deg, #85bdff, #b8d9ff);
        color: #061224;
    }
    .cr-btn-reset {
        background: rgba(19, 38, 62, 0.8);
        color: #dbeafe;
        border: 1px solid rgba(130, 175, 240, 0.24);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .cr-open-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin: 0 0 18px;
    }
    .cr-open-title { color: #f3f7ff; font-size: 1.35rem; font-weight: 700; margin: 0; }
    .cr-open-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eef6ff;
        color: #003a78;
        border: 1px solid #d2e7ff;
        border-radius: 999px;
        padding: 7px 14px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;
    }
    .cr-open-count i {
        color: #004c9b;
        font-size: 0.92rem;
    }
    .cr-layout {
        align-items: flex-start;
    }

    .cr-card {
        background: rgba(13, 24, 40, 0.92);
        border: 1px solid rgba(138, 178, 233, 0.2);
        border-radius: 14px;
        padding: 18px 20px 16px;
        height: 100%;
        transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
    }
    .cr-card:hover {
        transform: translateY(-4px);
        border-color: rgba(150,196,255,0.3);
        box-shadow: 0 16px 30px rgba(12, 36, 78, 0.28);
    }
    .cr-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 8px;
    }
    .cr-job-title { color: #f3f7ff; font-size: 1.14rem; font-weight: 700; margin: 0; line-height: 1.35; text-decoration: none; display: inline-block; }
    .cr-job-title:hover { color: #b9d8ff; }
    .cr-posted-top {
        color: #9fc7ff;
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .cr-job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 10px;
        color: #b7cbe2;
        font-size: 0.95rem;
    }
    .cr-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .cr-meta-item i {
        color: #8fb9ee;
        font-size: 0.86rem;
    }
    .cr-chip {
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(140, 182, 245, 0.26);
        border-radius: 999px;
        padding: 5px 11px;
        color: #c2d7ee;
        font-size: 0.78rem;
    }
    .cr-job-desc { color: #c5d7eb; font-size: 0.98rem; line-height: 1.55; margin-bottom: 14px; }
    .cr-job-footer { display: flex; justify-content: space-between; align-items: center; gap: 10px; }
    .cr-posted { color: #9fc7ff; font-size: 0.86rem; font-weight: 600; }
    .cr-apply {
        border: 0;
        background: linear-gradient(95deg, #85bdff, #b8d9ff);
        color: #061224;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
    }
    .cr-apply:hover,
    .cr-apply:focus,
    .cr-apply:visited {
        color: #061224;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(62, 122, 216, 0.32);
    }

    .cr-form-wrap {
        margin-top: 42px;
        background: rgba(15, 25, 45, 0.72);
        border: 1px solid rgba(130, 175, 240, 0.14);
        border-radius: 12px;
        padding: 24px;
    }
    .cr-form-head { color: #f3f7ff; font-size: 1.2rem; font-weight: 700; margin-bottom: 16px; }
    .cr-label { color: #b5cce5; font-size: 0.84rem; margin-bottom: 6px; }
    .required:after { content: ' *'; color: #ff8a8a; }

    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .ab-wave svg { height: 45px; }
        .cr-filter-wrap { position: static; top: auto; }
    }
    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-wave svg { height: 32px; }
        .cr-form-wrap { padding: 18px; }
    }
</style>
@endsection('styles')

@section('content')
<main class="main career-page">
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a><span class="sep">/</span><span>Career</span>
            </div>
            <h1 class="ab-h1">Careers</h1>
            <p class="ab-sub">Join our team and help shape the future of automotive lightweighting.</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    <section class="cr-section">
        <div class="container">
            <div class="row g-4 align-items-start cr-layout">
                <div class="col-lg-3 cr-filter-col">
                    <div class="cr-filter-wrap">
                        <h3 class="cr-filter-title">Filter Jobs</h3>
                        <form method="GET" action="{{ route('career') }}" class="row g-3 align-items-end">
                            <div class="col-12">
                                <label class="cr-label" for="search">Search</label>
                                <input id="search" type="text" class="cr-form-control" name="search" value="{{ $search ?? '' }}" placeholder="Search">
                            </div>
                            <div class="col-12">
                                <label class="cr-label" for="location">Location</label>
                                <select id="location" class="cr-form-control" name="location">
                                    <option value="">All Locations</option>
                                    @foreach(($locations ?? collect()) as $loc)
                                        <option value="{{ $loc }}" @selected(($location ?? '') === $loc)>{{ $loc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="cr-label" for="department">Department</label>
                                <select id="department" class="cr-form-control" name="department">
                                    <option value="">All Departments</option>
                                    @foreach(($departments ?? collect()) as $dept)
                                        <option value="{{ $dept }}" @selected(($department ?? '') === $dept)>{{ $dept }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="cr-filter-btn cr-btn-primary">Apply</button>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('career') }}" class="cr-filter-btn cr-btn-reset w-100">Clear Filters</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="cr-open-head">
                        <h3 class="cr-open-title">Open Positions</h3>
                        <span class="cr-open-count"><i class="fas fa-briefcase"></i>{{ $opportunities->total() }} Jobs</span>
                    </div>

                    @if($opportunities->isEmpty())
                        <div class="alert alert-warning">There are no vacancies at the moment. Please check back soon.</div>
                    @else
                        <div class="row g-4">
                            @foreach($opportunities as $job)
                                <div class="col-lg-12">
                                    <article class="cr-card">
                                        <div class="cr-card-head">
                                            <a class="cr-job-title" href="{{ url('career/job/' . $job->id . '/' . Str::slug($job->designation_name)) }}">{{ $job->designation_name }}</a>
                                            <span class="cr-posted-top">Posted {{ !empty($job->created_at) ? \Carbon\Carbon::parse($job->created_at)->format('d M Y') : '-' }}</span>
                                        </div>
                                        <div class="cr-job-meta">
                                            <span class="cr-meta-item"><i class="fas fa-map-marker-alt"></i>{{ $job->location ?: 'Location TBA' }}</span>
                                            <span class="cr-meta-item"><i class="fas fa-graduation-cap"></i>{{ $job->qualification ?: 'General' }}</span>
                                            <span class="cr-meta-item"><i class="far fa-clock"></i>{{ $job->employment_type ?? 'Full-time' }}</span>
                                        </div>
                                        <p class="cr-job-desc">{{ Str::limit(strip_tags($job->job_description), 170) }}</p>
                                        <div class="cr-job-footer">
                                            <span></span>
                                            <a href="{{ url('career/job/' . $job->id . '/' . Str::slug($job->designation_name)) }}" class="cr-apply">View Details</a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $opportunities->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection('content')

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof gsap !== 'undefined') {
            if (typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
            }
            gsap.from('.ab-crumb', { opacity: 0, y: -18, duration: 0.5, delay: 0.15 });
            gsap.from('.ab-h1', { opacity: 0, y: 36, duration: 0.75, delay: 0.25, ease: 'power2.out' });
            gsap.from('.ab-sub', { opacity: 0, y: 26, duration: 0.65, delay: 0.38 });
            gsap.to('.ab-banner-lines', {
                y: 70, ease: 'none',
                scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true }
            });
            gsap.from('.cr-filter-title, .cr-open-title', {
                scrollTrigger: { trigger: '.cr-section', start: 'top 80%' },
                opacity: 0, y: 20, duration: 0.6, stagger: 0.15
            });
            gsap.from('.cr-card', {
                scrollTrigger: { trigger: '.cr-card', start: 'top 88%' },
                opacity: 0, y: 28, duration: 0.5, stagger: 0.09
            });

        }
    });
</script>
@endsection('scripts')