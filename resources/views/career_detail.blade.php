@extends('layouts/frontLayout/front_design')

@section('styles')
<style>
    .career-detail-page { overflow-x: hidden; background: #000; color: #e2eaf5; }
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
    .ab-speed-line:nth-child(6) { top: 26%; left: -35%; width: 55%; --dur: 3.6s; animation-delay: 1.2s; }
    .ab-speed-line:nth-child(7) { top: 44%; left: -55%; width: 80%; --dur: 3s; animation-delay: 2s; }
    .ab-speed-line:nth-child(8) { top: 75%; left: -40%; width: 65%; --dur: 4.2s; animation-delay: 0.5s; }
    @keyframes abSpeedLine { 0% { transform: translateX(0); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateX(200%); opacity: 0; } }
    .ab-banner-inner { position: relative; z-index: 2; }
    .ab-crumb { margin-bottom: 16px; }
    .ab-crumb a, .ab-crumb span { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.86rem; }
    .ab-crumb .sep { margin: 0 6px; }
    .ab-h1 { color: #fff; font-size: clamp(1.7rem, 3.8vw, 2.6rem); font-weight: 800; margin: 0 0 14px; line-height: 1.18; max-width: 900px; }
    .ab-sub { color: rgba(255,255,255,0.76); font-size: 1.02rem; line-height: 1.7; }
    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    .cd-wrap { padding: 58px 0; position: relative; }
    .cd-wrap::before { content: ""; position: absolute; inset: 0; background: radial-gradient(680px 300px at 50% 20%, rgba(62,122,216,0.13), transparent 70%); pointer-events: none; }
    .cd-wrap .container { position: relative; z-index: 1; }
    .cd-top-meta { color: #9fc7ff; font-size: 0.9rem; margin-bottom: 18px; display: flex; gap: 12px; flex-wrap: wrap; }
    .cd-chip { border: 1px solid rgba(140,182,245,0.25); border-radius: 999px; padding: 3px 10px; }
    .cd-chip i { margin-right: 6px; color: #9fc7ff; }
    .cd-section-title { color: #f1f7ff; font-size: 1.24rem; font-weight: 700; margin: 26px 0 12px; }
    .cd-text { color: #b7cadf; line-height: 1.8; }
    .cd-list { margin: 0; padding-left: 18px; color: #b7cadf; line-height: 1.8; }
    .cd-list li { margin-bottom: 8px; }
    .cd-side {
        background: rgba(15, 25, 45, 0.72);
        border: 1px solid rgba(130,175,240,0.15);
        border-radius: 12px;
        padding: 18px;
    }
    .cd-qi { margin-bottom: 12px; }
    .cd-qi .k { color: #8fb6e6; font-size: 0.78rem; text-transform: uppercase; letter-spacing: .08em; }
    .cd-qi .k i { margin-right: 6px; }
    .cd-qi .v { color: #e7f1fc; font-weight: 600; margin-top: 2px; }
    .cd-apply-btn {
        border: 0;
        background: linear-gradient(95deg, #85bdff, #b8d9ff);
        color: #061224;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: .9rem;
        font-weight: 700;
        width: 100%;
    }

    .modal-content { background: #091a30; color: #dce9f8; border: 1px solid rgba(130,175,240,0.2); }
    .modal-header { border-bottom-color: rgba(130,175,240,0.2); }
    .modal-footer { border-top-color: rgba(130,175,240,0.2); }
    .btn-close { filter: invert(1); }
    .cd-input {
        width: 100%;
        background: rgba(6, 18, 36, 0.68);
        border: 1px solid rgba(130, 175, 240, 0.26);
        color: #dce9f8;
        border-radius: 8px;
        min-height: 42px;
        padding: 10px 12px;
    }
</style>
@endsection('styles')

@section('content')
<main class="main career-detail-page">
    <section class="ab-banner">
        <div class="ab-banner-lines">
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
            <span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span><span class="ab-speed-line"></span>
        </div>
        <div class="container ab-banner-inner">
            <div class="ab-crumb">
                <a href="{{ url('/') }}">Home</a><span class="sep">/</span>
                <a href="{{ url('career') }}">Career</a><span class="sep">/</span>
                <span>{{ $job->designation_name }}</span>
            </div>
            <h1 class="ab-h1">{{ $job->designation_name }}</h1>
            <p class="ab-sub">{{ $job->qualification ?: 'General' }} | {{ $job->location ?: 'Location TBA' }}</p>
        </div>
        <div class="ab-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/></svg></div>
    </section>

    <section class="cd-wrap">
        <div class="container">
            @if(session('success_message'))
                <div class="alert alert-success">{{ session('success_message') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-warning">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="cd-top-meta">
                        <span class="cd-chip"><i class="fas fa-map-marker-alt"></i>{{ $job->location ?: 'Location TBA' }}</span>
                        <span class="cd-chip"><i class="fas fa-graduation-cap"></i>{{ $job->qualification ?: 'General' }}</span>
                        <span class="cd-chip"><i class="far fa-clock"></i>{{ $job->employment_type ?? 'Full-time' }}</span>
                        <span class="cd-chip"><i class="far fa-calendar-alt"></i>{{ !empty($job->created_at) ? \Carbon\Carbon::parse($job->created_at)->format('d F Y') : '-' }}</span>
                    </div>
                    <h3 class="cd-section-title">About the Role</h3>
                    <p class="cd-text">{{ $job->job_description }}</p>
                    <h3 class="cd-section-title">Requirements</h3>
                    <ul class="cd-list">
                        <li>{{ $job->experience ?: 'Relevant experience as per role requirements' }}</li>
                        <li>{{ $job->qualification ?: 'Relevant educational background' }}</li>
                        <li>Strong communication and teamwork skills</li>
                        <li>Problem-solving approach with ownership mindset</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <aside class="cd-side">
                        <h4 class="cd-section-title mt-0">Quick Info</h4>
                        <div class="cd-qi"><div class="k"><i class="fas fa-briefcase"></i>Experience</div><div class="v">{{ $job->experience ?: '-' }}</div></div>
                        <div class="cd-qi"><div class="k"><i class="fas fa-map-marker-alt"></i>Location</div><div class="v">{{ $job->location ?: '-' }}</div></div>
                        <div class="cd-qi"><div class="k"><i class="fas fa-graduation-cap"></i>Department</div><div class="v">{{ $job->qualification ?: '-' }}</div></div>
                        <div class="cd-qi"><div class="k"><i class="far fa-clock"></i>Type</div><div class="v">{{ $job->employment_type ?? 'Full-time' }}</div></div>
                        <button type="button" class="cd-apply-btn mt-3" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="applyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white">Apply for {{ $job->designation_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('submit-job-application') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="mb-1">Full Name *</label><input class="cd-input" name="name" value="{{ old('name') }}" required></div>
                        <div class="col-md-6"><label class="mb-1">Email *</label><input type="email" class="cd-input" name="email" value="{{ old('email') }}" required></div>
                        <div class="col-md-6"><label class="mb-1">Phone *</label><input class="cd-input" name="phone" value="{{ old('phone') }}" required></div>
                        <div class="col-md-6"><label class="mb-1">Resume</label><input type="file" class="cd-input" name="resume" accept=".pdf,.doc,.docx"></div>
                        <div class="col-12"><label class="mb-1">Message *</label><textarea class="cd-input" name="comment" rows="4" required>{{ old('comment') }}</textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ad-submit-btn">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap === 'undefined') return;
    if (typeof ScrollTrigger !== 'undefined') { gsap.registerPlugin(ScrollTrigger); }
    gsap.from('.ab-crumb', { opacity: 0, y: -16, duration: 0.5, delay: 0.12 });
    gsap.from('.ab-h1', { opacity: 0, y: 34, duration: 0.75, delay: 0.2 });
    gsap.from('.ab-sub', { opacity: 0, y: 26, duration: 0.6, delay: 0.35 });
    gsap.to('.ab-banner-lines', { y: 65, ease: 'none', scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true } });
    gsap.from('.cd-section-title, .cd-text, .cd-list li', { scrollTrigger: { trigger: '.cd-wrap', start: 'top 82%' }, opacity: 0, y: 20, duration: 0.45, stagger: 0.08 });
    gsap.from('.cd-side', { scrollTrigger: { trigger: '.cd-side', start: 'top 85%' }, opacity: 0, x: 30, duration: 0.6 });

    @if($errors->any())
    var modalEl = document.getElementById('applyModal');
    if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        var m = new bootstrap.Modal(modalEl);
        m.show();
    }
    @endif
});
</script>
@endsection('scripts')
