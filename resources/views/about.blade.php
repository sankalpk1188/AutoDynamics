@extends('layouts/frontLayout/front_design')
@section('content')

@section('styles')
<style>
    .about-page { overflow-x: hidden; background: #000; color: #e2eaf5; }

    /* ═══ BANNER ═══ */
    .ab-banner {
        position: relative;
        overflow: hidden;
        background: #0c2340;
        padding: 62px 0 90px;
    }

    .ab-banner-lines {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
    }

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

    .ab-h1 {
        color: #fff;
        font-size: clamp(2.2rem, 4.5vw, 3.2rem);
        font-weight: 800;
        margin: 0 0 14px;
        line-height: 1.12;
    }

    .ab-sub {
        color: rgba(255,255,255,0.72);
        font-size: 1.02rem;
        max-width: 560px;
        line-height: 1.7;
    }

    .ab-wave { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 3; line-height: 0; }
    .ab-wave svg { display: block; width: 100%; height: 50px; }

    /* ═══ REUSABLE ═══ */
    .ab-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.66rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #9fc7ff;
        margin-bottom: 14px;
    }
    .ab-eyebrow::before {
        content: "";
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #7eb8ff;
        box-shadow: 0 0 10px rgba(126,184,255,0.8);
    }

    .ab-section-title {
        font-size: clamp(1.5rem, 2.8vw, 2.15rem);
        color: #f0f7ff;
        font-weight: 700;
        margin-bottom: 18px;
        line-height: 1.22;
    }
    .ab-section-title strong {
        background: linear-gradient(95deg, #85bdff, #fff 48%, #cbe2ff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ═══ OUR STORY (ref layout — 2 cols: text left, objectives card right) ═══ */
    .ab-story {
        padding: 72px 0 56px;
        background: #000;
        position: relative;
    }
    .ab-story::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent);
        pointer-events: none;
    }

    .ab-story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .ab-story-left .ab-eyebrow { color: #9fc7ff; }
    .ab-story-left .ab-eyebrow::before { background: #9fc7ff; box-shadow: 0 0 10px rgba(232,93,93,0.6); }

    .ab-story-left .ab-section-title {
        font-size: clamp(1.55rem, 2.8vw, 2.15rem);
        color: #f0f7ff;
        margin-bottom: 22px;
    }

    .ab-story-text {
        color: #b4c9e0;
        line-height: 1.78;
        font-size: 0.95rem;
        margin-bottom: 16px;
    }

    /* ── Objectives card (right column) ── */
    .ab-obj-card {
        background: rgba(15, 25, 45, 0.7);
        border: 1px solid rgba(130,175,240,0.15);
        border-radius: 14px;
        padding: 30px 28px;
    }

    .ab-obj-card-title {
        font-size: 1.15rem;
        color: #e8f2ff;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .ab-obj-card-text {
        color: #9bb3ce;
        line-height: 1.72;
        font-size: 0.93rem;
        margin-bottom: 12px;
    }

    .ab-obj-frame {
        margin-top: 18px;
        border: 1px solid rgba(130,175,240,0.18);
        border-radius: 12px;
        padding: 22px 24px;
        background: rgba(8, 16, 32, 0.6);
        text-align: center;
    }

    .ab-obj-metric {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 6px;
    }

    .ab-obj-num {
        font-size: clamp(2rem, 4vw, 2.6rem);
        font-weight: 800;
        line-height: 1;
        color: #0c2340;
        background: linear-gradient(95deg, #85bdff, #fff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .ab-obj-label {
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #8eaed0;
        margin-top: 2px;
    }

    .ab-obj-note {
        color: #7d98b5;
        font-size: 0.88rem;
        line-height: 1.7;
        margin-top: 14px;
        border-top: 1px solid rgba(130,175,240,0.12);
        padding-top: 14px;
    }

    /* ═══ WHY CHOOSE (ref: 6 values + stats, light section) ═══ */
    .ab-values {
        padding: 64px 0 100px;
        background: #f5f8fc;
        position: relative;
    }

    .ab-values .ab-eyebrow { color: #3672b8; }
    .ab-values .ab-eyebrow::before { background: #3672b8; box-shadow: 0 0 10px rgba(54,114,184,0.6); }
    .ab-values .ab-section-title { color: #0f1f36; }
    .ab-values .ab-section-title strong {
        background: linear-gradient(95deg, #2a6cb8, #0f1f36 48%, #3a7fd4);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .ab-values-sub { color: #4b6280; margin-bottom: 24px; font-size: 1rem; }

    .ab-values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .ab-vcard {
        border: 1px solid #dce5f0;
        border-radius: 14px;
        padding: 22px 18px;
        background: #fff;
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .ab-vcard:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15,31,54,0.1);
    }

    .ab-vcard-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e8f1fd, #d4e4f8);
        display: grid;
        place-items: center;
        margin-bottom: 14px;
    }
    .ab-vcard-icon svg {
        width: 24px; height: 24px;
        stroke: #2e6db5;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .ab-vcard h4 { font-size: 1.02rem; color: #0f1f36; font-weight: 600; margin: 0 0 6px; }
    .ab-vcard p { margin: 0; color: #4b6280; line-height: 1.62; font-size: 0.92rem; }

    .ab-stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-top: 36px;
        padding-top: 24px;
        border-top: 1px solid #dce5f0;
        text-align: center;
    }
    .ab-stat strong { display: block; font-size: 2rem; font-weight: 800; color: #1e40af; line-height: 1; margin-bottom: 4px; }
    .ab-stat span { color: #64748b; font-size: 0.88rem; }

    /* ═══ VISION & MISSION ═══ */
    .ab-vm {
        padding: 72px 0;
        background: #070f1b8a;
        position: relative;
        overflow: hidden;
    }

    .ab-vm-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
    }
    .ab-vm-ring {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(90,158,245,0.08);
        animation: abRingPulse 6s ease-in-out infinite;
    }
    .ab-vm-ring:nth-child(1) { width: 500px; height: 500px; top: -180px; right: -120px; animation-delay: 0s; }
    .ab-vm-ring:nth-child(2) { width: 350px; height: 350px; top: -100px; right: -50px; animation-delay: 2s; border-color: rgba(90,158,245,0.05); }
    .ab-vm-ring:nth-child(3) { width: 200px; height: 200px; top: -20px; right: 20px; animation-delay: 4s; border-color: rgba(90,158,245,0.04); }

    @keyframes abRingPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.12); opacity: 1; }
    }

    .ab-vm-glow {
        position: absolute;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(90,158,245,0.08), transparent 70%);
        bottom: -200px; left: -100px;
        animation: abGlowDrift 8s ease-in-out infinite alternate;
    }
    @keyframes abGlowDrift {
        0% { transform: translate(0, 0); }
        100% { transform: translate(60px, -40px); }
    }

    .ab-vm-content {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }

    .ab-vm-left .ab-section-title {
        font-size: clamp(1.6rem, 3vw, 2.3rem);
        margin-bottom: 16px;
    }

    .ab-vm-tagline {
        color: #8eaed0;
        font-size: 1.02rem;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .ab-vm-icon-row {
        display: flex;
        gap: 20px;
    }

    .ab-vm-icon-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        border: 1px solid rgba(90,158,245,0.15);
        border-radius: 10px;
        background: rgba(10, 20, 40, 0.5);
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .ab-vm-icon-item:hover {
        border-color: rgba(90,158,245,0.35);
        box-shadow: 0 4px 20px rgba(90,158,245,0.1);
    }
    .ab-vm-icon-item svg {
        width: 20px; height: 20px;
        stroke: #5a9ef5;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }
    .ab-vm-icon-item span {
        color: #c8ddf5;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.03em;
    }

    .ab-mission-card {
        border: 1px solid rgba(130,175,240,0.12);
        border-radius: 18px;
        padding: 38px 34px;
        background: linear-gradient(145deg, rgba(15, 28, 52, 0.8), rgba(8, 16, 34, 0.9));
        position: relative;
        overflow: hidden;
    }
    .ab-mission-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #5a9ef5 30%, #8cc2ff 50%, #5a9ef5 70%, transparent);
        animation: abShimmer 3s linear infinite;
    }
    @keyframes abShimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .ab-mission-card::after {
        content: "";
        position: absolute;
        top: 0; right: 0;
        width: 120px; height: 120px;
        background: radial-gradient(circle, rgba(90,158,245,0.06), transparent 70%);
        pointer-events: none;
    }

    .ab-mission-card h4 {
        color: #e8f2ff;
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0 0 22px;
        letter-spacing: 0.02em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ab-mission-card h4 svg {
        width: 22px; height: 22px;
        stroke: #5a9ef5;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .ab-mission-card ul { margin: 0; padding-left: 0; list-style: none; }
    .ab-mission-li {
        color: #b4c9e0;
        line-height: 1.75;
        margin-bottom: 18px;
        padding-left: 32px;
        position: relative;
        font-size: 0.95rem;
        opacity: 0;
        transform: translateX(-12px);
        animation: abMissionFadeIn 0.6s ease forwards;
    }
    .ab-mission-li:nth-child(1) { animation-delay: 0.2s; }
    .ab-mission-li:nth-child(2) { animation-delay: 0.5s; }
    .ab-mission-li:nth-child(3) { animation-delay: 0.8s; }
    .ab-mission-li:last-child { margin-bottom: 0; }

    @keyframes abMissionFadeIn {
        to { opacity: 1; transform: translateX(0); }
    }

    .ab-mission-li::before {
        content: "";
        position: absolute;
        left: 0; top: 7px;
        width: 18px; height: 18px;
        border-radius: 50%;
        background: rgba(90,158,245,0.12);
        border: 1.5px solid rgba(90,158,245,0.3);
    }
    .ab-mission-li::after {
        content: "";
        position: absolute;
        left: 5px; top: 12px;
        width: 8px; height: 4px;
        border-left: 2px solid #5a9ef5;
        border-bottom: 2px solid #5a9ef5;
        transform: rotate(-45deg);
    }

    /* ═══ CORE VALUES ═══ */
    .ab-core {
        padding: 88px 0 92px;
        background: #010509;
        position: relative;
        overflow: hidden;
    }
    .ab-core::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 1000px 480px at 15% 10%, rgba(62,122,216,0.18), transparent 58%),
            radial-gradient(ellipse 800px 440px at 88% 70%, rgba(90,158,245,0.11), transparent 52%),
            radial-gradient(ellipse 600px 300px at 50% 100%, rgba(54,114,184,0.08), transparent 60%),
            linear-gradient(180deg, rgba(7,15,27,0.55) 0%, transparent 40%, rgba(0,0,0,0.92) 100%);
        pointer-events: none;
    }
    .ab-core::after {
        content: "";
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(130,175,240,0.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(130,175,240,0.035) 1px, transparent 1px);
        background-size: 56px 56px;
        mask-image: linear-gradient(180deg, black 0%, transparent 88%);
        pointer-events: none;
    }

    .ab-core .container { position: relative; z-index: 2; }

    .ab-core .ab-eyebrow { color: #9fc7ff; margin-bottom: 12px; }
    .ab-core .ab-eyebrow::before {
        background: linear-gradient(135deg, #7eb8ff, #cbe2ff);
        box-shadow: 0 0 16px rgba(126,184,255,0.65);
    }

    .ab-core .ab-section-title {
        margin-bottom: 44px;
        max-width: 640px;
    }

    .ab-core-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .ab-core-card {
        position: relative;
        border-radius: 18px;
        padding: 24px 24px 28px;
        border: 1px solid rgba(130,175,240,0.16);
        background: linear-gradient(158deg, rgba(14,26,48,0.88) 0%, rgba(5,10,22,0.94) 45%, rgba(8,14,28,0.92) 100%);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow:
            0 4px 28px rgba(0,0,0,0.42),
            inset 0 1px 0 rgba(255,255,255,0.06),
            inset 0 -1px 0 rgba(0,0,0,0.22);
        transition: transform 0.45s cubic-bezier(0.22, 1, 0.36, 1), border-color 0.4s ease, box-shadow 0.45s ease;
        isolation: isolate;
    }
    .ab-core-card::before {
        content: "";
        position: absolute;
        top: 0; left: 28px; right: 28px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(90,158,245,0.5) 32%, rgba(180,220,255,0.65) 50%, rgba(90,158,245,0.5) 68%, transparent);
        opacity: 0.85;
        z-index: 1;
    }
    .ab-core-card::after {
        content: "";
        position: absolute;
        inset: -1px;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, rgba(90,158,245,0.25), transparent 42%, transparent 58%, rgba(90,158,245,0.12));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        opacity: 0.35;
        transition: opacity 0.45s ease;
        z-index: 0;
    }
    .ab-core-card:hover {
        transform: translateY(-8px);
        border-color: rgba(130,175,240,0.38);
        box-shadow:
            0 28px 56px rgba(0,0,0,0.5),
            0 0 0 1px rgba(90,158,245,0.15),
            0 0 80px rgba(62,122,216,0.12),
            inset 0 1px 0 rgba(255,255,255,0.09);
    }
    .ab-core-card:hover::after { opacity: 0.75; }
    .ab-core-card:hover .ab-core-icon-wrap {
        box-shadow:
            0 0 0 1px rgba(90,158,245,0.35),
            0 8px 28px rgba(62,122,216,0.28),
            inset 0 1px 0 rgba(255,255,255,0.12);
    }
    .ab-core-card:hover .ab-core-icon-aura {
        opacity: 1;
        transform: scale(1.15);
    }

    .ab-core-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        position: relative;
        z-index: 2;
    }

    .ab-core-icon-wrap {
        position: relative;
        width: 58px;
        height: 58px;
        border-radius: 15px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        background: linear-gradient(145deg, rgba(30,58,110,0.55), rgba(12,24,48,0.85));
        border: 1px solid rgba(130,175,240,0.22);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.1),
            0 4px 16px rgba(0,0,0,0.35);
        transition: box-shadow 0.45s ease, transform 0.45s ease;
    }
    .ab-core-card:hover .ab-core-icon-wrap {
        transform: scale(1.04);
    }
    .ab-core-icon-aura {
        position: absolute;
        inset: -8px;
        border-radius: 22px;
        background: radial-gradient(circle, rgba(90,158,245,0.35), transparent 68%);
        opacity: 0.45;
        z-index: -1;
        pointer-events: none;
        transition: opacity 0.45s ease, transform 0.55s ease;
        animation: abCoreAuraBreath 4s ease-in-out infinite;
    }
    @keyframes abCoreAuraBreath {
        0%, 100% { opacity: 0.35; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.08); }
    }

    .ab-core-svg {
        width: 30px;
        height: 30px;
        overflow: visible;
    }
    .ab-core-svg path,
    .ab-core-svg circle,
    .ab-core-svg line,
    .ab-core-svg polyline,
    .ab-core-svg polygon,
    .ab-core-svg rect {
        stroke: #9fc7ff;
        fill: none;
        stroke-width: 1.65;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .ab-core-svg .ab-core-fill {
        fill: rgba(90,158,245,0.18);
        stroke: none;
        animation: abCoreFillPulse 3s ease-in-out infinite;
    }
    @keyframes abCoreFillPulse {
        0%, 100% { fill: rgba(90,158,245,0.12); opacity: 0.85; }
        50% { fill: rgba(90,158,245,0.26); opacity: 1; }
    }

    .ab-core-draw {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: abCoreStrokeDraw 4s ease-in-out infinite;
    }
    @keyframes abCoreStrokeDraw {
        0%, 12% { stroke-dashoffset: 100; }
        38%, 62% { stroke-dashoffset: 0; }
        88%, 100% { stroke-dashoffset: 100; }
    }

    .ab-core-star {
        transform-box: fill-box;
        transform-origin: center;
        animation: abCoreStarGlow 3.2s ease-in-out infinite;
    }
    @keyframes abCoreStarGlow {
        0%, 100% { transform: scale(1) rotate(0deg); filter: drop-shadow(0 0 2px rgba(159,199,255,0.3)); }
        50% { transform: scale(1.06) rotate(4deg); filter: drop-shadow(0 0 8px rgba(159,199,255,0.55)); }
    }

    .ab-core-orbit {
        transform-origin: 12px 10px;
        transform-box: fill-box;
        animation: abCoreOrbit 14s linear infinite;
    }
    @keyframes abCoreOrbit {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .ab-core-pulse-ring {
        transform-box: fill-box;
        transform-origin: center;
        animation: abCoreRingPulse 2.8s ease-out infinite;
    }
    .ab-core-pulse-ring--d1 { animation-delay: 0.35s; }
    .ab-core-pulse-ring--d2 { animation-delay: 0.7s; }
    @keyframes abCoreRingPulse {
        0% { opacity: 0.55; transform: scale(0.35); }
        70%, 100% { opacity: 0; transform: scale(2.4); }
    }

    .ab-core-trace {
        animation: abCoreTraceBlink 2.2s ease-in-out infinite;
    }
    .ab-core-trace--2 { animation-delay: 0.45s; }
    .ab-core-trace--3 { animation-delay: 0.9s; }
    @keyframes abCoreTraceBlink {
        0%, 100% { opacity: 0.28; }
        50% { opacity: 1; }
    }

    .ab-core-scale-swing {
        transform-origin: 12px 21px;
        transform-box: fill-box;
        animation: abCoreScaleSwing 3.5s ease-in-out infinite;
    }
    @keyframes abCoreScaleSwing {
        0%, 100% { transform: rotate(-6deg); }
        50% { transform: rotate(6deg); }
    }

    .ab-core-num {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.24em;
        text-transform: uppercase;
        color: rgba(159,199,255,0.65);
        padding-top: 6px;
        line-height: 1.2;
        text-align: right;
    }

    .ab-core-title {
        font-size: 1.08rem;
        font-weight: 700;
        color: #f4f9ff;
        margin: 0 0 12px;
        line-height: 1.35;
        position: relative;
        z-index: 2;
    }
    .ab-core-title .ab-core-paren {
        display: block;
        font-size: 0.82rem;
        font-weight: 500;
        color: #8eaed0;
        margin-top: 4px;
        letter-spacing: 0.02em;
    }

    .ab-core-text {
        margin: 0;
        color: #9bb3ce;
        font-size: 0.93rem;
        line-height: 1.74;
        position: relative;
        z-index: 2;
    }

    @media (prefers-reduced-motion: reduce) {
        .ab-core-icon-aura,
        .ab-core-draw,
        .ab-core-star,
        .ab-core-orbit,
        .ab-core-pulse-ring,
        .ab-core-pulse-ring--d1,
        .ab-core-pulse-ring--d2,
        .ab-core-trace,
        .ab-core-trace--2,
        .ab-core-trace--3,
        .ab-core-scale-swing,
        .ab-core-fill {
            animation: none !important;
        }
        .ab-core-draw { stroke-dashoffset: 0; }
        .ab-core-card:hover { transform: none; }
        .ab-core-card:hover .ab-core-icon-wrap { transform: none; }
    }

    /* ═══ QUALITY POLICY ═══ */
    .ab-quality {
        padding: 56px 0 68px;
        background: #000;
        position: relative;
    }
    .ab-quality::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(700px 260px at 50% 50%, rgba(62,122,216,0.1), transparent);
        pointer-events: none;
    }

    .ab-quality-text { color: #b4c9e0; line-height: 1.78; font-size: 0.96rem; margin-bottom: 10px; max-width: 900px; }
    .ab-quality-sub { font-size: 1.08rem; color: #e0ecfa; font-weight: 600; margin: 24px 0 14px; }
    .ab-quality-list { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

    .ab-quality-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid rgba(130,175,240,0.18);
        background: rgba(10,22,40,0.6);
        color: #b4c9e0;
        font-size: 0.93rem;
        line-height: 1.6;
    }
    .ab-quality-item::before {
        content: "";
        flex-shrink: 0;
        width: 7px; height: 7px;
        margin-top: 7px;
        border-radius: 50%;
        background: #7eb8ff;
        box-shadow: 0 0 8px rgba(126,184,255,0.5);
    }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 991px) {
        .ab-banner { padding: 50px 0 80px; }
        .ab-wave svg { height: 45px; }
        .ab-story, .ab-vm, .ab-core, .ab-quality { padding: 40px 0; }
        .ab-values { padding: 44px 0 40px; }
        .ab-story-grid { grid-template-columns: 1fr; gap: 28px; }
        .ab-values-grid { grid-template-columns: 1fr 1fr; }
        .ab-stats-row { grid-template-columns: 1fr 1fr; }
        .ab-vm-content { grid-template-columns: 1fr; gap: 32px; }
        .ab-mission-card { padding: 28px 24px; }
        .ab-vm-icon-row { flex-wrap: wrap; }
        .ab-quality-list { grid-template-columns: 1fr; }
        .ab-obj-card { padding: 24px 20px; }
        .ab-obj-frame { padding: 18px 16px; }
        .ab-core-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 575px) {
        .ab-banner { padding: 42px 0 68px; }
        .ab-wave svg { height: 32px; }
        .ab-h1 { font-size: clamp(1.6rem, 7vw, 2.2rem); }
        .ab-sub { font-size: 0.92rem; }
        .ab-story, .ab-vm, .ab-core, .ab-quality { padding: 32px 0; }
        .ab-values { padding: 36px 0 32px; }
        .ab-values-grid { grid-template-columns: 1fr; }
        .ab-stats-row { grid-template-columns: 1fr 1fr; }
        .ab-obj-card { padding: 20px 16px; }
        .ab-obj-frame { padding: 16px 14px; }
        .ab-mission-card { padding: 22px 18px; }
        .ab-vm-icon-row { gap: 12px; }
        .ab-vm-icon-item { padding: 8px 14px; }
        .ab-vm { padding: 48px 0; }
        .ab-core { padding: 44px 0 48px; }
        .ab-core-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection('styles')

<main class="main about-page">

    {{-- ═══ BANNER ═══ --}}
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
                <span>About</span>
            </div>
            <h1 class="ab-h1">About Us</h1>
            <p class="ab-sub">We are among the pioneers in India for metal-to-plastic conversion, delivering innovative lightweighting solutions.</p>
        </div>
        <div class="ab-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 L1440,0 L1440,60 Z" fill="#000"/>
            </svg>
        </div>
    </section>

    {{-- ═══ OUR STORY (ref: 2-col — text left, objectives card right) ═══ --}}
    <section class="ab-story" id="our-company">
        <div class="container">
            <div class="ab-story-grid">
                <div class="ab-story-left">
                    <div class="ab-eyebrow">Our Company</div>
                    <h2 class="ab-section-title">Delivering Ideas to <strong>Products</strong></h2>
                    <p class="ab-story-text">Founded in 2016, ATSPL was incorporated with the Vision to bring New Technologies to the Industry with the theme of “Delivering Ideas to Products”. One such Idea was “Light Weighting”.  ATSPL has been a pioneer in India to introduce Technology for converting products from Metal to Plastics. The Technology was coupled with Innovative Solutions to provide Light Weighting Solutions.</p>
                    <p class="ab-story-text">Our Company has a highly qualified team of professionals with more than 25 years' experience with a Technology and Research Centre in Pune.</p>
                </div>
                <div class="ab-story-right">
                    <div class="ab-obj-card">
                        <h3 class="ab-obj-card-title">Core Objective</h3>
                        <p class="ab-obj-card-text">In ATSPL, we strive to achieve vehicle weight reduction in the range of 20% to 52% by implementing holistic lightweighting strategies that balance technical performance, production feasibility, and commercial viability.</p>
                        <div class="ab-obj-frame">
                            <div class="ab-obj-metric">
                                <div class="ab-obj-num">20% – 52%</div>
                            </div>
                            <div class="ab-obj-label">Weight Reduction Target</div>
                        </div>
                        <p class="ab-obj-note">A 10% reduction in vehicle weight can result in a 6–8% reduction in fuel consumption, making lightweighting one of the most impactful strategies for the automotive industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ WHY CHOOSE (ref: 6 values + stats, light section) ═══ --}}
    <section class="ab-values" id="why-us">
        <div class="container">
            <h2 class="ab-section-title">Why Choose <strong>AutoDynamics</strong></h2>
            <div class="ab-values-grid">
                <article class="ab-vcard">
                    <div class="ab-vcard-icon">
                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h4>Highly Skilled & Experienced Team</h4>
                    <p>In ATSPL, Engineering, Production, Purchase, Logistics, Manufacturing team have joined forces to commonly address the high fee of innovations in vehicle lightweighting.</p>
                </article>
                <article class="ab-vcard">
                    <div class="ab-vcard-icon">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h4>Solutions and Support</h4>
                    <p>We provide the best solutions and support to our clients.</p>
                </article>
                <article class="ab-vcard">
                    <div class="ab-vcard-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h4>Quality, Cost, and Delivery (QCD)</h4>
                    <p>We give 100% Quality, Cost, and Delivery on time.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- ═══ MISSION ═══ --}}
    <section class="ab-vm" id="our-vision">
        <div class="ab-vm-bg">
            <div class="ab-vm-ring"></div>
            <div class="ab-vm-ring"></div>
            <div class="ab-vm-ring"></div>
            <div class="ab-vm-glow"></div>
        </div>
        <div class="container">
            <div class="ab-vm-content">
                <div class="ab-vm-left">
                    <div class="ab-eyebrow">Our Vision</div>
                    <h2 class="ab-section-title">What <strong>Drives Us</strong></h2>
                    <p class="ab-vm-tagline">We are committed to pushing boundaries in lightweight automotive solutions, driven by passion, innovation, quality, and an unwavering dedication to our partners.</p>
                    <div class="ab-vm-icon-row">
                        <div class="ab-vm-icon-item">
                            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span>Quality</span>
                        </div>
                        <div class="ab-vm-icon-item">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                            <span>Customer First</span>
                        </div>
                        <div class="ab-vm-icon-item">
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span>Excellence</span>
                        </div>
                        <div class="ab-vm-icon-item">
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span>Passion</span>
                        </div>
                    </div>
                </div>
                <div class="ab-vm-right">
                    <article class="ab-mission-card">
                        <h4>
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Vision
                        </h4>
                        <ul>
                            <li class="ab-mission-li">To bring Unique, Innovative Products and Solutions that are ahead of the times which satisfy a wide range of basic and implied needs in the Indian and Export Market</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ CORE VALUES ═══ --}}
    <section class="ab-core" id="core-values">
        <div class="container">
            <div class="ab-eyebrow">Core Values</div>
            <h2 class="ab-section-title">The Principles We <strong>Live By</strong></h2>
            <div class="ab-core-grid">
                <article class="ab-core-card">
                    <header class="ab-core-card-head">
                        <div class="ab-core-icon-wrap" aria-hidden="true">
                            <span class="ab-core-icon-aura"></span>
                            <svg class="ab-core-svg" viewBox="0 0 24 24" focusable="false">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path class="ab-core-draw" pathLength="100" d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <span class="ab-core-num">01</span>
                    </header>
                    <h3 class="ab-core-title">Integrity<span class="ab-core-paren">(in all our dealings)</span></h3>
                    <p class="ab-core-text">All our actions and dealings should reflect honesty, transparency, and ethical conduct, capable of withstanding public scrutiny.</p>
                </article>
                <article class="ab-core-card">
                    <header class="ab-core-card-head">
                        <div class="ab-core-icon-wrap" aria-hidden="true">
                            <span class="ab-core-icon-aura"></span>
                            <svg class="ab-core-svg" viewBox="0 0 24 24" focusable="false">
                                <polygon class="ab-core-star" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                        <span class="ab-core-num">02</span>
                    </header>
                    <h3 class="ab-core-title">(Passion for) Excellence</h3>
                    <p class="ab-core-text">Relentlessly striving for continuous improvement and raising the benchmark in everything we do.</p>
                </article>
                <article class="ab-core-card">
                    <header class="ab-core-card-head">
                        <div class="ab-core-icon-wrap" aria-hidden="true">
                            <span class="ab-core-icon-aura"></span>
                            <svg class="ab-core-svg" viewBox="0 0 24 24" focusable="false">
                                <circle class="ab-core-pulse-ring" cx="12" cy="10" r="4" fill="none"/>
                                <circle class="ab-core-pulse-ring ab-core-pulse-ring--d1" cx="12" cy="10" r="4" fill="none"/>
                                <circle class="ab-core-pulse-ring ab-core-pulse-ring--d2" cx="12" cy="10" r="4" fill="none"/>
                                <g class="ab-core-orbit" opacity="0.45">
                                    <circle cx="12" cy="10" r="7.5" fill="none" stroke-width="1" stroke-dasharray="2 5"/>
                                </g>
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <span class="ab-core-num">03</span>
                    </header>
                    <h3 class="ab-core-title">Customer Focus</h3>
                    <p class="ab-core-text">Proactively understanding customer needs and directing our efforts toward delivering value beyond expectations.</p>
                </article>
                <article class="ab-core-card">
                    <header class="ab-core-card-head">
                        <div class="ab-core-icon-wrap" aria-hidden="true">
                            <span class="ab-core-icon-aura"></span>
                            <svg class="ab-core-svg" viewBox="0 0 24 24" focusable="false">
                                <rect x="4" y="4" width="16" height="16" rx="2"/>
                                <rect class="ab-core-fill" x="9" y="9" width="6" height="6" rx="0.5"/>
                                <line class="ab-core-trace" x1="12" y1="2" x2="12" y2="4"/>
                                <line class="ab-core-trace ab-core-trace--2" x1="12" y1="20" x2="12" y2="22"/>
                                <line class="ab-core-trace ab-core-trace--3" x1="2" y1="12" x2="4" y2="12"/>
                                <line class="ab-core-trace" x1="20" y1="12" x2="22" y2="12"/>
                            </svg>
                        </div>
                        <span class="ab-core-num">04</span>
                    </header>
                    <h3 class="ab-core-title">Technology Edge</h3>
                    <p class="ab-core-text">We strive to deliver advanced technological solutions and maintain leadership in the fields we operate in.</p>
                </article>
                <article class="ab-core-card">
                    <header class="ab-core-card-head">
                        <div class="ab-core-icon-wrap" aria-hidden="true">
                            <span class="ab-core-icon-aura"></span>
                            <svg class="ab-core-svg" viewBox="0 0 24 24" focusable="false">
                                <g class="ab-core-scale-swing" fill="none">
                                    <path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="M7 21h10"/>
                                    <path d="M12 3v18"/>
                                    <path d="M3 7h2c2 0 4.5-2 8-2s6 2 8 2h2"/>
                                </g>
                            </svg>
                        </div>
                        <span class="ab-core-num">05</span>
                    </header>
                    <h3 class="ab-core-title">Responsibility</h3>
                    <p class="ab-core-text">Taking ownership and accountability for the outcomes of our decisions and actions.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- ═══ QUALITY POLICY ═══ --}}
    <section class="ab-quality" id="quality-policy">
        <div class="container">
            <div class="ab-eyebrow">Quality Policy</div>
            <h2 class="ab-section-title">Our Quality <strong>Commitment</strong></h2>
            <p class="ab-quality-text">We all at "ATSPL" are committed to Manufacturing cutting edge products of an extremely high level of Quality to our existing and growing customer base in an accurate and timely manner. We satisfy customer's and ISO standard Requirements with cost effective solutions.</p>
            <p class="ab-quality-text">We shall strive to achieve customer's delight through continual improvement by effective use of "Quality Management System".</p>

            <h3 class="ab-quality-sub">Quality Objectives</h3>
            <div class="ab-quality-list">
                <div class="ab-quality-item">To maintain highly skilled, motivated and disciplined team.</div>
                <div class="ab-quality-item">To ensure effective utilization of resources.</div>
                <div class="ab-quality-item">To understand customer perception and promptly meet their requirements.</div>
                <div class="ab-quality-item">To adopt latest technologies and the best international practices as a way of life.</div>
                <div class="ab-quality-item">To improve quality in the manufacturing process.</div>
                <div class="ab-quality-item">To minimize dependence on inspection.</div>
                <div class="ab-quality-item">To minimize rejection/wastages.</div>
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

        /* ── Banner text entrance ── */
        gsap.from('.ab-crumb', { opacity: 0, y: -20, duration: 0.6, delay: 0.2 });
        gsap.from('.ab-h1', { opacity: 0, y: 40, duration: 0.8, delay: 0.4 });
        gsap.from('.ab-sub', { opacity: 0, y: 30, duration: 0.7, delay: 0.7 });

        /* ── Our Company section ── */
        gsap.from('.ab-story-left .ab-eyebrow', {
            scrollTrigger: { trigger: '.ab-story', start: 'top 80%' },
            opacity: 0, x: -30, duration: 0.5
        });
        gsap.from('.ab-story-left .ab-section-title', {
            scrollTrigger: { trigger: '.ab-story', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.6, delay: 0.15
        });
        gsap.from('.ab-story-text', {
            scrollTrigger: { trigger: '.ab-story', start: 'top 75%' },
            opacity: 0, y: 25, duration: 0.5, stagger: 0.15, delay: 0.3
        });
        gsap.from('.ab-obj-card', {
            scrollTrigger: { trigger: '.ab-story-right', start: 'top 80%' },
            opacity: 0, x: 50, duration: 0.7, delay: 0.2
        });
        gsap.from('.ab-obj-num', {
            scrollTrigger: { trigger: '.ab-obj-frame', start: 'top 85%' },
            opacity: 0, scale: 0.5, duration: 0.6, ease: 'back.out(1.7)'
        });

        /* ── Why Choose section ── */
        gsap.from('.ab-values .ab-section-title', {
            scrollTrigger: { trigger: '.ab-values', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.6
        });
        gsap.from('.ab-vcard', {
            scrollTrigger: { trigger: '.ab-values-grid', start: 'top 80%' },
            opacity: 0, y: 40, duration: 0.5, stagger: 0.2, delay: 0.15
        });
        gsap.from('.ab-vcard-icon', {
            scrollTrigger: { trigger: '.ab-values-grid', start: 'top 80%' },
            opacity: 0, scale: 0, rotation: -90, duration: 0.6, stagger: 0.2, delay: 0.3, ease: 'back.out(1.7)'
        });

        /* ── Mission section ── */
        gsap.from('.ab-vm-left .ab-eyebrow', {
            scrollTrigger: { trigger: '.ab-vm', start: 'top 80%' },
            opacity: 0, x: -30, duration: 0.5
        });
        gsap.from('.ab-vm-left .ab-section-title', {
            scrollTrigger: { trigger: '.ab-vm', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.6, delay: 0.1
        });
        gsap.from('.ab-vm-tagline', {
            scrollTrigger: { trigger: '.ab-vm', start: 'top 75%' },
            opacity: 0, y: 20, duration: 0.5, delay: 0.25
        });
        gsap.from('.ab-vm-icon-item', {
            scrollTrigger: { trigger: '.ab-vm-icon-row', start: 'top 85%' },
            opacity: 0, y: 20, scale: 0.8, duration: 0.4, stagger: 0.12, delay: 0.3, ease: 'back.out(1.4)'
        });
        gsap.from('.ab-mission-card', {
            scrollTrigger: { trigger: '.ab-vm-right', start: 'top 80%' },
            opacity: 0, x: 60, duration: 0.7, delay: 0.15
        });

        /* ── Core Values section ── */
        gsap.from('.ab-core .ab-eyebrow', {
            scrollTrigger: { trigger: '.ab-core', start: 'top 80%' },
            opacity: 0, x: -28, duration: 0.5
        });
        gsap.from('.ab-core .ab-section-title', {
            scrollTrigger: { trigger: '.ab-core', start: 'top 80%' },
            opacity: 0, y: 28, duration: 0.6, delay: 0.1
        });
        gsap.from('.ab-core-card', {
            scrollTrigger: { trigger: '.ab-core-grid', start: 'top 82%' },
            opacity: 0, y: 36, duration: 0.55, stagger: 0.1, ease: 'power2.out'
        });
        gsap.from('.ab-core-icon-wrap', {
            scrollTrigger: { trigger: '.ab-core-grid', start: 'top 82%' },
            opacity: 0, scale: 0.72, duration: 0.55, stagger: 0.1, delay: 0.05, ease: 'back.out(1.45)'
        });

        /* ── Quality Policy section ── */
        gsap.from('.ab-quality .ab-eyebrow', {
            scrollTrigger: { trigger: '.ab-quality', start: 'top 80%' },
            opacity: 0, x: -30, duration: 0.5
        });
        gsap.from('.ab-quality .ab-section-title', {
            scrollTrigger: { trigger: '.ab-quality', start: 'top 80%' },
            opacity: 0, y: 30, duration: 0.6, delay: 0.1
        });
        gsap.from('.ab-quality-text', {
            scrollTrigger: { trigger: '.ab-quality', start: 'top 75%' },
            opacity: 0, y: 20, duration: 0.5, stagger: 0.12, delay: 0.2
        });
        gsap.from('.ab-quality-sub', {
            scrollTrigger: { trigger: '.ab-quality-sub', start: 'top 88%' },
            opacity: 0, x: -20, duration: 0.5
        });
        gsap.from('.ab-quality-item', {
            scrollTrigger: { trigger: '.ab-quality-list', start: 'top 85%' },
            opacity: 0, y: 30, duration: 0.4, stagger: 0.08
        });

        /* ── Parallax depth on scroll ── */
        gsap.to('.ab-banner-lines', {
            scrollTrigger: { trigger: '.ab-banner', start: 'top top', end: 'bottom top', scrub: true },
            y: 80, ease: 'none'
        });
        gsap.to('.ab-vm-bg', {
            scrollTrigger: { trigger: '.ab-vm', start: 'top bottom', end: 'bottom top', scrub: true },
            y: 60, ease: 'none'
        });

        /* ── Section dividers fade-in ── */
        document.querySelectorAll('.ab-story, .ab-values, .ab-vm, .ab-core, .ab-quality').forEach(function(sec) {
            gsap.from(sec, {
                scrollTrigger: { trigger: sec, start: 'top 90%', toggleActions: 'play none none none' },
                opacity: 0.4, duration: 0.6
            });
        });

        /* ── Smooth scroll to sections ── */
        var headerH = document.querySelector('.main-header') ? document.querySelector('.main-header').offsetHeight : 80;
        var sectionMap = { 'our-company': '#our-company', 'why-us': '#why-us', 'our-mission': '#our-mission', 'our-vision': '#our-vision', 'core-values': '#core-values', 'quality-policy': '#quality-policy' };

        var pathParts = window.location.pathname.split('/');
        var lastSegment = pathParts[pathParts.length - 1];
        if (sectionMap[lastSegment]) {
            var target = document.querySelector(sectionMap[lastSegment]);
            if (target) {
                setTimeout(function() {
                    gsap.to(window, { duration: 1, scrollTo: { y: target, offsetY: headerH + 20 }, ease: 'power2.inOut' });
                }, 400);
            }
        }

        document.querySelectorAll('a[href*="about-us/our-company"], a[href*="about-us/why-us"], a[href*="about-us/our-mission"], a[href*="about-us/our-vision"], a[href*="about-us/core-values"], a[href*="about-us/quality-policy"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                var parts = href.split('/');
                var section = parts[parts.length - 1];
                var target = document.getElementById(section);
                if (target) {
                    e.preventDefault();
                    gsap.to(window, { duration: 1, scrollTo: { y: target, offsetY: headerH + 20 }, ease: 'power2.inOut' });
                    history.pushState(null, null, href);
                }
            });
        });
    });
</script>
@endsection('scripts')
