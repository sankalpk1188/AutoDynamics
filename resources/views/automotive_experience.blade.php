@extends('layouts/frontLayout/front_design')
@section('content')

@php
    $pdir = 'assets/images/automotive/products/';
    $autoPlaceholderImg = asset('assets/images/metal_inner_structure_of_an_automotive_tailgate.png');

    /* Exterior — footstep, ducts, roof, pillar trim, and door claddings. */
    $autoProductsExterior = [
        ['title' => 'Footstep', 'text' => 'Exterior side footstep / running board providing convenient ingress–egress and protecting lower rocker areas.', 'location' => 'Side sill — below doors, passenger entry zone', 'img' => asset($pdir . 'product-footstep.png')],
        ['title' => 'Plenum Applique', 'text' => 'Lightweight plenum applique module at the cowl and windshield base — integrated styling and airflow management.', 'location' => 'Cowl / IP upper — base of windshield', 'img' => asset($pdir . 'product-defrost-duct.png')],
        ['title' => 'Sun Roof', 'text' => 'Lightweight sun roof module engineered for structural performance, sealing, and integration with the roof panel assembly.', 'location' => 'Roof — upper vehicle body', 'img' => asset($pdir . 'product-defrost-duct.png')],
        ['title' => 'B & C Pillar Trim MIC', 'text' => 'Molded-in-color B- and C-pillar trim MIC on the door-glass verticals — black vertical trim panels between front and rear door windows for sealing, NVH, and exterior styling.', 'location' => 'Side body — B- and C-pillar vertical trim at door glass (black MIC panels)', 'img' => asset($pdir . 'product-b-pillar.png')],
        ['title' => 'Door Claddings', 'text' => 'Exterior lower-door cladding panels mounted above the footstep — protective trim bridging the door outer surface and rocker zone.', 'location' => 'Side doors — lower exterior panel, directly above footstep', 'img' => asset($pdir . 'product-footstep-base-plate.png')],
    ];

    /* Interior — door trim, carrier plate, tailgate, and console modules. */
    $autoProductsInterior = [
        ['title' => 'Front Door', 'text' => 'Interior door panel for four-wheeler applications — integrated trim, armrest, speaker grille, and map pocket with multi-material molding.', 'location' => 'Driver-side front door — interior trim panel', 'img' => asset($pdir . 'product-front-door.png')],
        ['title' => 'RR Carrier Plate', 'text' => 'Rear door carrier plate with integrated mounting features and structural ribbing for window regulator and trim module integration.', 'location' => 'Rear door — interior carrier plate module', 'img' => asset($pdir . 'product-rr-carrier-plate.png')],
        ['title' => 'Tail Gate', 'text' => 'Interior tailgate trim for four-wheeler rear closure — upper housing, handle zone, and lower insert interfaces.', 'location' => 'Rear hatch — interior lining (tailgate open)', 'img' => asset($pdir . 'product-tail-gate-interior.png')],
        ['title' => 'Console Structure', 'text' => 'Structural center-console backbone with reinforcement ribbing, mounting points, and tunnel integration for shifter and storage.', 'location' => 'Center tunnel — between front seats', 'img' => asset($pdir . 'product-console-structure.png')],
        ['title' => 'Console Back Cover', 'text' => 'Rear console closure panel with vent slots and cubby openings — interfaces between front and rear cabin.', 'location' => 'Center console — rear face toward second row', 'img' => asset($pdir . 'product-console-back-cover.png')],
    ];

    /* Underbody — FES, crash beam, EV frunk, battery tray, and underfloor modules. */
    $autoProductsUnderbody = [
        ['title' => 'Crash Beam', 'text' => 'Front crash beam integrated at the leading face of the vehicle — mounted ahead of the front end structure (FES) for impact energy management.', 'location' => 'Front underbody — forward of FES, front crash zone', 'img' => asset($pdir . 'product-front-impact-beam.png')],
        ['title' => 'CCB Bracket', 'text' => 'CCB bracket at the cockpit cross-car beam — reinforced mounting for steering and dashboard module integration.', 'location' => 'Center underbody — dashboard / cockpit beam zone', 'img' => asset($pdir . 'product-steering-wheel.png')],
        ['title' => 'EV Frunk', 'text' => 'EV front trunk (frunk) structural module — lightweight underhood storage enclosure with integrated mounting and sealing interfaces.', 'location' => 'Front underbody — EV frunk / front storage bay', 'img' => asset($pdir . 'product-fes.png')],
        ['title' => 'Battery Tray', 'text' => 'EV battery tray module along the side of the frunk zone — underfloor pack enclosure with structural retention for battery systems.', 'location' => 'Side underbody — adjacent to EV frunk, battery pack zone', 'img' => asset($pdir . 'product-battery-tray.png')],
        ['title' => 'Front End Structure (FES)', 'text' => 'Front end structure (FES) — primary front carrier frame for crash load management and front-module mounting.', 'location' => 'Front end — vertical carrier frame', 'img' => asset($pdir . 'product-front-end-carrier-s220.png')],
        ['title' => 'Battery Top Cover', 'text' => 'Battery top cover — sealed underfloor cover with raised sections for pack clearance and thermal management.', 'location' => 'Center underbody — battery top cover', 'img' => asset($pdir . 'product-tamor-top-cover.png')],
        ['title' => 'Battery Cell Holder', 'text' => 'Battery cell holder — honeycomb-grid retention structure with standoffs for secure battery pack mounting.', 'location' => 'Center underbody — beneath battery top cover', 'img' => asset($pdir . 'product-battery-holder-592.png')],
    ];

    $autoTabs = [
        'interior' => [
            'label' => 'Interior',
            'desc' => 'Door trim, tailgate, carrier plates, and center-console modules.',
            'image' => asset('assets/images/automotive/automotive-interior-hero.png'),
            'image_alt' => 'Four-wheeler interior view with front door, RR carrier plate, tailgate, and console applications highlighted',
            'overlay' => 'exterior',
            'flip_x' => false,
            'products' => $autoProductsInterior,
            'points' => [
                ['x' => 84, 'y' => 48],
                ['x' => 30, 'y' => 48],
                ['x' => 70, 'y' => 20],
                ['x' => 46, 'y' => 50],
                ['x' => 50, 'y' => 58],
            ],
        ],
        'exterior' => [
            'label' => 'Exterior',
            'desc' => 'Footstep, door claddings, pillar trim, ducts, and roof systems.',
            'image' => asset('assets/images/automotive/automotive-exterior-hero.png'),
            'image_alt' => 'Exterior vehicle with footstep, door claddings, pillar trim, and roof applications highlighted',
            'overlay' => 'exterior',
            'flip_x' => true,
            'products' => $autoProductsExterior,
            'points' => [
                ['x' => 72, 'y' => 68],
                ['x' => 38, 'y' => 38],
                ['x' => 50, 'y' => 14],
                ['x' => 74, 'y' => 33],
                ['x' => 69, 'y' => 60],
            ],
        ],
        'underbody' => [
            'label' => 'Underbody',
            'desc' => 'FES, crash beam, EV frunk, battery tray, and underfloor structures.',
            'image' => asset('assets/images/automotive/automotive-underbody-hero.png'),
            'image_alt' => 'Vehicle underbody with crash beam, EV frunk, battery tray, and FES applications highlighted',
            'overlay' => 'exterior',
            'flip_x' => false,
            'products' => $autoProductsUnderbody,
            'points' => [
                ['x' => 85, 'y' => 68],
                ['x' => 50, 'y' => 45],
                ['x' => 69, 'y' => 46],
                ['x' => 60, 'y' => 52],
                ['x' => 88, 'y' => 50],
                ['x' => 50, 'y' => 56],
                ['x' => 50, 'y' => 66],
            ],
        ],
    ];

    $autoDefaultTab = 'interior';
    $autoDefaultProducts = $autoTabs[$autoDefaultTab]['products'];
@endphp

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9,40,600;0,9,40,800;1,9,40,500&family=Inter:wght@400;500;600&display=swap');
    :root {
        --ad-navy: #040d1a;
        --ad-ink: #0a1929;
        --ad-blue: #0b4f8c;
        --ad-cyan: #0082c6;
        --ad-cyan-dim: #0082c6;
        --ad-line: rgba(255, 255, 255, 0.08);
    }

    html, body { overflow-x: hidden; }

    .ad-auto {
        position: relative;
        overflow: hidden;
        font-family: 'Inter', system-ui, sans-serif;
        /*background: var(--ad-navy);*/
        /*padding-bottom: 64px;*/
    }

    .ad-auto::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        /*background:
            radial-gradient(ellipse 80% 50% at 15% 0%, rgba(45, 225, 194, 0.09) 0%, transparent 55%),
            linear-gradient(180deg, #061018 0%, var(--ad-navy) 38%, #030810 100%);*/
    }

    .ad-auto::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0.35;
        background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 100% 32px;
    }

    .ad-hero {
        position: relative;
        z-index: 1;
        padding: 48px 0 32px;
        border-bottom: 1px solid var(--ad-line);
    }

    .ad-hero-eyebrow {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--ad-cyan);
        margin: 0 0 8px;
        font-weight: 600;
    }

    .ad-hero-title {
        font-family: "DM Sans", "Inter", sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.25rem);
        font-weight: 800;
        line-height: 1.05;
        color: #f4fbff;
        margin: 0 0 16px;
        letter-spacing: -0.03em;
    }

    .ad-hero-lead {
        max-width: 640px;
        font-size: 1.02rem;
        line-height: 1.7;
        color: rgba(200, 220, 240, 0.88);
        margin: 0 0 22px;
    }

    .ad-hero-actions { display: flex; flex-wrap: wrap; gap: 12px; }

    .ad-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }

    .ad-btn-primary {
        background: var(--ad-cyan);
        color: #04121a;
        box-shadow: 0 4px 24px rgba(45, 225, 194, 0.25);
    }
    .ad-btn-primary:hover { color: #04121a; filter: brightness(1.05); }

    .ad-btn-ghost {
        border: 1px solid var(--ad-line);
        color: rgba(230, 245, 255, 0.9);
    }
    .ad-btn-ghost:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }

    .ad-stage { position: relative; z-index: 1; }

    .ad-auto-intro {
        position: relative;
        z-index: 1;
        padding: 40px 0 8px;
    }
    .ad-auto-intro-title {
        font-family: "DM Sans", "Inter", sans-serif;
        font-size: clamp(1.75rem, 3.5vw, 2.5rem);
        font-weight: 800;
        color: #f4fbff;
        margin: 0 0 10px;
        letter-spacing: -0.03em;
    }
    .ad-auto-intro-lead {
        max-width: 720px;
        margin: 0 0 24px;
        font-size: 0.98rem;
        line-height: 1.65;
        color: rgba(200, 220, 240, 0.82);
    }

    .ad-auto-tabs-wrap {
        position: relative;
        z-index: 1;
        margin-bottom: 28px;
    }
    .ad-auto-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 6px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(4, 14, 28, 0.75);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
    }
    .ad-auto-tab {
        flex: 1 1 120px;
        min-width: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
        padding: 12px 16px;
        border: 1px solid transparent;
        border-radius: 8px;
        background: transparent;
        color: rgba(200, 220, 240, 0.78);
        cursor: pointer;
        text-align: left;
        transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }
    .ad-auto-tab:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.04);
    }
    .ad-auto-tab.is-active {
        color: #fff;
        background: rgba(0, 130, 198, 0.14);
        border-color: rgba(0, 130, 198, 0.45);
        box-shadow: 0 4px 20px rgba(0, 130, 198, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.06);
    }
    .ad-auto-tab-label {
        font-family: "DM Sans", sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    .ad-auto-tab-desc {
        font-size: 0.72rem;
        line-height: 1.35;
        color: rgba(180, 200, 220, 0.65);
    }
    .ad-auto-tab.is-active .ad-auto-tab-desc {
        color: rgba(200, 230, 255, 0.82);
    }
    .ad-auto-tab:focus-visible {
        outline: 2px solid var(--ad-cyan);
        outline-offset: 2px;
    }

    .ad-tab-panel[hidden] { display: none !important; }

    .ad-ext-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ad-cyan);
        background: rgba(45, 225, 194, 0.08);
        border: 1px solid rgba(45, 225, 194, 0.28);
    }
    .ad-ext-label::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--ad-cyan);
        box-shadow: 0 0 10px rgba(45, 225, 194, 0.8);
    }

    /* Right column: HRC-style compact list + single detail panel */
    .ad-side-hrc {
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(6, 18, 32, 0.65);
        overflow: hidden;
    }
    @media (min-width: 992px) {
        .ad-col-side { position: sticky; top: 96px; align-self: start; }
    }

    .ad-side-hrc-head {
        padding: 18px 18px 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(0, 0, 0, 0.15);
    }
    .ad-side-hrc-head h2 {
        font-family: "DM Sans", sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #f4f9ff;
        margin: 0 0 6px;
        letter-spacing: -0.02em;
    }
    .ad-side-hrc-head p {
        font-size: 0.78rem;
        line-height: 1.5;
        color: rgba(180, 200, 220, 0.72);
        margin: 0;
    }

    .ad-picker-list {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: min(220px, 32vh);
        overflow-y: auto;
    }
    .ad-picker-list::-webkit-scrollbar { width: 3px; }
    .ad-picker-list::-webkit-scrollbar-thumb {
        background: rgba(45, 225, 194, 0.25);
        border-radius: 3px;
    }

    .ad-picker-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        text-align: left;
        padding: 11px 16px;
        margin: 0;
        border: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        background: transparent;
        color: rgba(210, 225, 240, 0.9);
        font-size: 0.84rem;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s;
    }
    .ad-picker-item:last-child { border-bottom: none; }
    .ad-picker-item:hover {
        background: rgba(255, 255, 255, 0.04);
        color: #fff;
    }
    .ad-picker-item.is-active {
        background: rgba(45, 225, 194, 0.08);
        color: #fff;
        box-shadow: inset 3px 0 0 var(--ad-cyan);
    }
    .ad-picker-num {
        flex: 0 0 26px;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        font-family: "DM Sans", sans-serif;
        color: rgba(255, 255, 255, 0.88);
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .ad-picker-item.is-active .ad-picker-num {
        background: var(--ad-cyan);
        color: #04121a;
        border-color: transparent;
    }
    .ad-picker-title { flex: 1; line-height: 1.35; font-weight: 500; }

    .ad-detail-panel {
        padding: 22px 20px 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.03);
        min-height: 200px;
    }

    .ad-detail-kicker {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: #0082c6;
        margin: 0 0 10px;
    }
    .ad-detail-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        padding: 0 8px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 800;
        font-family: "DM Sans", sans-serif;
        color: #fff;
        background: var(--ad-cyan);
        margin-bottom: 14px;
    }
    .ad-detail-media {
        width: 100%;
        max-height: 200px;
        margin: 0 0 16px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: #f0f4f8;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .ad-detail-img {
        width: 100%;
        height: 100%;
        max-height: 200px;
        object-fit: contain;
        display: block;
        padding: 10px;
        box-sizing: border-box;
        transition: transform 0.35s ease;
    }
    .ad-detail-media:hover .ad-detail-img {
        transform: scale(1.06);
    }
    @media (prefers-reduced-motion: reduce) {
        .ad-detail-media:hover .ad-detail-img {
            transform: none;
        }
    }
    .ad-detail-title {
        font-family: "DM Sans", sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 14px;
        line-height: 1.25;
        letter-spacing: -0.02em;
    }
    .ad-detail-body {
        margin: 0;
        padding: 0 0 0 1rem;
        font-size: 0.88rem;
        line-height: 1.65;
        color: rgba(200, 218, 235, 0.92);
    }
    .ad-detail-body li {
        margin-bottom: 0.5rem;
    }
    .ad-detail-body li:last-child { margin-bottom: 0; }
    .ad-detail-loc {
        margin: 16px 0 0;
        padding-top: 14px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        font-size: 0.78rem;
        line-height: 1.5;
        color: rgba(160, 190, 215, 0.8);
    }
    .ad-detail-loc strong {
        color: rgba(210, 230, 245, 0.95);
        font-weight: 600;
    }

    .ad-auto .animate-image {
        width: 100%;
        max-width: 720px;
        margin: 0 auto;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ad-auto .ad-schematic-drawing { vector-effect: non-scaling-stroke; }
    .ad-auto .ad-schematic-drawing .schematic-ground { stroke: rgba(120, 180, 220, 0.35); stroke-width: 0.4; }
    .ad-auto .ad-schematic-drawing .schematic-body {
        fill: rgba(255, 255, 255, 0.02);
        stroke: rgba(200, 230, 255, 0.5);
        stroke-width: 1.1;
    }
    .ad-auto .ad-schematic-drawing .schematic-glass { fill: none; stroke: rgba(200, 230, 255, 0.25); stroke-width: 0.6; }
    .ad-auto .ad-schematic-drawing .schematic-wheel {
        fill: rgba(0, 0, 0, 0.15);
        stroke: rgba(200, 230, 255, 0.45);
        stroke-width: 0.7;
    }
    .ad-auto .ad-schematic-drawing .schematic-wheel.tire { fill: none; }

    .ad-auto .vehicle-map-box,
    .ad-auto .ad-where-creative {
        width: 100%;
        max-width: 700px;
        margin-top: 0;
        margin-bottom: 0;
        border-radius: 16px;
        /*border: 1px solid rgba(45, 225, 194, 0.18);*/
        overflow: hidden;
        background: radial-gradient(120% 80% at 20% 0%, rgba(45, 225, 194, 0.12) 0%, transparent 45%),
            linear-gradient(165deg, rgba(6, 16, 28, 0.98) 0%, rgba(2, 6, 12, 0.99) 100%);
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.04);
    }

    .ad-auto .ad-where-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }
    .ad-auto .ad-where-chip {
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        color: var(--ad-cyan);
        border: 1px solid rgba(45, 225, 194, 0.35);
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(45, 225, 194, 0.08);
    }
    .ad-auto .ad-where-stage {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.2) 0%, transparent 40%);
    }
    .ad-auto .ad-where-mesh {
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0.4;
        background:
            linear-gradient(90deg, rgba(45, 225, 194, 0.03) 1px, transparent 1px) 0 0 / 24px 100%,
            linear-gradient(0deg, rgba(45, 225, 194, 0.03) 1px, transparent 1px) 0 0 / 100% 24px;
    }
    .ad-auto .vehicle-map-box:has(.ad-xray-img) .ad-where-mesh {
        opacity: 0.18;
    }
    .ad-auto .ad-where-diagram {
        position: relative;
        width: 100%;
    }
    /* Exterior: Ghost / x-ray vehicle PNG + hotspots (% of overlay). Interior: SVG cabin (220×100 artboard). */
    .ad-auto .ad-map-overlay {
        position: relative;
        width: 100%;
        margin: 0 auto;
    }
    .ad-auto .ad-map-overlay--exterior-xray:not(.ad-map-overlay--interior) {
        aspect-ratio: 16 / 9;
        max-height: 440px;
    }
    .ad-auto .ad-map-overlay--interior {
        aspect-ratio: 11 / 5;
        max-height: 280px;
    }
    .ad-auto .ad-xray-frame {
        position: absolute;
        inset: 0;
        border-radius: 10px;
        overflow: hidden;
        background: #000;
        --spot-x: 50%;
        --spot-y: 50%;
        --spot-mag: 1.55;
        --spot-r: 13%;
    }
    .ad-auto .ad-xray-img.ad-xray-base {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center bottom;
        display: block;
        position: relative;
        z-index: 1;
    }
    /* Circular loupe: duplicate vehicle image scaled at hotspot */
    .ad-auto .ad-xray-img.ad-xray-spot {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center bottom;
        z-index: 2;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s ease;
        transform: scale(var(--spot-mag));
        transform-origin: var(--spot-x) var(--spot-y);
        clip-path: circle(var(--spot-r) at var(--spot-x) var(--spot-y));
        -webkit-clip-path: circle(var(--spot-r) at var(--spot-x) var(--spot-y));
    }
    .ad-auto .ad-xray-frame.is-spot-zoom .ad-xray-spot {
        opacity: 1;
    }
    @media (prefers-reduced-motion: reduce) {
        .ad-auto .ad-xray-img.ad-xray-spot {
            transition: none;
        }
        .ad-auto .ad-xray-frame.is-spot-zoom .ad-xray-spot {
            opacity: 0;
        }
    }
    .ad-auto .ad-map-overlay .product-callout {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
        margin: 0;
    }
    .ad-auto .ad-map-overlay .map-exterior,
    .ad-auto .ad-map-overlay .map-interior {
        position: relative;
        width: 100%;
        min-height: 100%;
        height: 100%;
    }
    .ad-auto .ad-map-overlay .callout-map-svg {
        position: absolute;
        left: 0;
        top: 0;
        display: block;
        width: 100% !important;
        height: 100% !important;
        min-height: 0 !important;
        max-height: none !important;
    }
    .ad-auto .ad-map-overlay .hotspots {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        z-index: 4;
    }

    .ad-auto .vehicle-map-box .callout-map-block {
        border-bottom: none;
        background: transparent;
    }

    .ad-auto .ad-col-main { position: relative; z-index: 1; }

    .ad-auto .hotspot {
        position: absolute;
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 50%;
        background: rgb(0 130 198);
        border: 2px solid rgba(255,255,255,.95);
        transform: translate(-50%, -50%);
        box-shadow: 0 2px 12px rgba(0,0,0,.25);
        animation: none;
        pointer-events: auto;
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .ad-auto .hotspot .hotspot-num {
        position: relative;
        z-index: 2;
        font-size: 0.72rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
        text-shadow: none;
        pointer-events: none;
        font-family: 'Inter', sans-serif;
    }
    .ad-auto .hotspot:hover:not(.active) {
        transform: translate(-50%, -50%) scale(1.08);
        z-index: 5;
    }
    .ad-auto .hotspot.active {
        transform: translate(-50%, -50%) scale(1.12);
        box-shadow: 0 0 0 3px rgb(56 55 57), 0 4px 20px rgba(0, 0, 0, .3);
        background: #0082c6;
        z-index: 6;
    }

    /* Real part thumbnails on skeleton / cabin map */
    .ad-auto .hotspot.hotspot--part {
        width: auto;
        height: auto;
        min-width: 0;
        min-height: 0;
        border-radius: 0;
        background: transparent;
        border: none;
        animation: none;
        box-shadow: none;
    }
    .ad-auto .hotspot.hotspot--part .hotspot-thumb-wrap {
        position: relative;
        display: block;
        width: 58px;
        height: 58px;
        border-radius: 11px;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.95);
        background: #f8fafc;
        box-shadow:
            0 6px 18px rgba(0, 0, 0, 0.28),
            0 0 0 1px rgba(45, 225, 194, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        pointer-events: none;
    }
    .ad-auto .ad-map-overlay--interior .hotspot.hotspot--part .hotspot-thumb-wrap {
        width: 48px;
        height: 48px;
        border-radius: 9px;
    }
    .ad-auto .hotspot.hotspot--part .hotspot-thumb {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        padding: 3px;
        box-sizing: border-box;
    }
    .ad-auto .hotspot.hotspot--part .hotspot-num-badge {
        position: absolute;
        right: 3px;
        bottom: 3px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        background: linear-gradient(145deg, #ff5566 0%, #d01028 100%);
        border: 1px solid rgba(255, 255, 255, 0.9);
        font-size: 0.62rem;
        font-weight: 800;
        color: #fff;
        line-height: 17px;
        text-align: center;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);
        pointer-events: none;
    }
    .ad-auto .hotspot.hotspot--part.active .hotspot-thumb-wrap {
        transform: scale(1.08);
        box-shadow:
            0 8px 22px rgba(0, 0, 0, 0.35),
            0 0 0 2px rgba(62, 198, 255, 0.85),
            0 0 20px rgba(62, 198, 255, 0.35);
    }

    .ad-auto .hotspot::after { display: none; }

    .ad-auto .hotspot.hotspot--part.active {
        transform: translate(-50%, -50%);
        box-shadow: none;
    }

    @keyframes capHotspotPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(255,53,90,.5), 0 0 10px rgba(62,198,255,.3); }
        50% { box-shadow: 0 0 0 10px rgba(255,53,90,0), 0 0 16px rgba(62,198,255,.2); }
    }

    .ad-auto .auto-badge {
        border: 1px solid rgba(255, 255, 255, 0.22);
        background: rgba(255, 255, 255, 0.08);
        color: rgba(255, 255, 255, 0.88);
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 10px;
        letter-spacing: 1.2px;
        font-weight: 600;
    }

    .ad-auto .btn-contact {
        border: 1px solid rgba(255,255,255,0.32);
        padding: 10px 22px;
        border-radius: 8px;
        color: #fff;
        font-weight: 500;
        text-decoration: none;
        transition: all .3s ease;
    }

    .ad-auto .btn-contact:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }

    .ad-auto .btn-accent {
        background: #0b73c0;
        color: #fff;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 8px 22px rgba(11,115,192,0.35);
        transition: all .3s ease;
    }

    .ad-auto .btn-accent:hover {
        background: #1590eb;
        color: #fff;
    }

    .ad-auto .product-info {
        padding: 18px 18px 20px;
        border-radius: 16px;
        border: 1px solid rgba(62, 198, 255, 0.28);
        background: linear-gradient(145deg, rgba(7, 24, 44, 0.75) 0%, rgba(4, 16, 32, 0.85) 100%);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        min-height: 300px;
        box-shadow: 0 20px 50px rgba(0,0,0,.25);
    }

    .ad-auto .product-info-title {
        margin: 0 0 8px;
        color: #eaf6ff;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .ad-auto .product-info-text {
        margin: 0;
        color: #b7d2ea;
        line-height: 1.65;
        font-size: 0.9rem;
    }

    .ad-auto .product-preview-wrap {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(62, 198, 255, 0.22);
        overflow: hidden;
        margin-bottom: 14px;
        background: rgba(1, 10, 20, 0.55);
    }

    .ad-auto .callout-kicker {
        display: block;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: rgba(180, 210, 235, 0.75);
        margin-bottom: 4px;
    }

    .ad-auto .callout-legend {
        display: block;
        font-size: 0.7rem;
        line-height: 1.4;
        color: rgba(200, 220, 245, 0.85);
        margin-bottom: 8px;
    }

    .ad-auto .callout-map-block {
        padding: 10px 12px 8px;
        background: linear-gradient(180deg, rgba(8, 28, 52, 0.95) 0%, rgba(4, 14, 28, 0.98) 100%);
        border-bottom: 1px solid rgba(62, 198, 255, 0.12);
    }

    .ad-auto .callout-location {
        font-size: 0.78rem;
        line-height: 1.45;
        color: rgba(200, 230, 255, 0.9);
        margin: 0;
        min-height: 2.2em;
    }

    .ad-auto .product-callout { position: relative; }

    .ad-auto .map-exterior,
    .ad-auto .map-interior { display: contents; width: 100%; }
    .ad-auto .product-callout[data-view="external"] .map-exterior { display: block; }
    .ad-auto .product-callout[data-view="internal"] .map-interior { display: block; }

    .ad-auto .callout-map-svg {
        width: 100%;
        display: block;
    }

    .ad-auto .map-exterior .zone,
    .ad-auto .map-interior .zone {
        fill: rgba(62, 198, 255, 0.1);
        stroke: rgba(62, 198, 255, 0.28);
        stroke-width: 1.2;
        transition: fill 0.25s ease, stroke 0.25s ease, filter 0.25s ease;
    }

    .ad-auto .map-exterior .map-zone-num,
    .ad-auto .map-interior .map-zone-num {
        fill: rgba(255, 255, 255, 0.35);
        font-size: 11px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        pointer-events: none;
    }

    .ad-auto .product-callout[data-view="external"][data-active="0"] .map-exterior .map-num-0,
    .ad-auto .product-callout[data-view="external"][data-active="1"] .map-exterior .map-num-1,
    .ad-auto .product-callout[data-view="external"][data-active="2"] .map-exterior .map-num-2,
    .ad-auto .product-callout[data-view="external"][data-active="3"] .map-exterior .map-num-3,
    .ad-auto .product-callout[data-view="external"][data-active="4"] .map-exterior .map-num-4,
    .ad-auto .product-callout[data-view="external"][data-active="5"] .map-exterior .map-num-5,
    .ad-auto .product-callout[data-view="internal"][data-active="0"] .map-interior .map-num-0,
    .ad-auto .product-callout[data-view="internal"][data-active="1"] .map-interior .map-num-1 {
        fill: #5dd8ff;
    }

    .ad-auto .product-callout[data-view="external"][data-active="0"] .map-exterior .z-0,
    .ad-auto .product-callout[data-view="external"][data-active="1"] .map-exterior .z-1,
    .ad-auto .product-callout[data-view="external"][data-active="2"] .map-exterior .z-2,
    .ad-auto .product-callout[data-view="external"][data-active="3"] .map-exterior .z-3,
    .ad-auto .product-callout[data-view="external"][data-active="4"] .map-exterior .z-4,
    .ad-auto .product-callout[data-view="external"][data-active="5"] .map-exterior .z-5,
    .ad-auto .product-callout[data-view="internal"][data-active="0"] .map-interior .z-0,
    .ad-auto .product-callout[data-view="internal"][data-active="1"] .map-interior .z-1 {
        fill: rgba(62, 198, 255, 0.45);
        stroke: #5dd8ff;
        stroke-width: 2;
        filter: drop-shadow(0 0 6px rgba(62, 198, 255, 0.75));
    }

    .ad-auto .map-car-outline {
        fill: none;
        stroke: rgba(255, 255, 255, 0.2);
        stroke-width: 1.4;
    }

    .ad-auto .callout-cad-block {
        padding: 10px 12px 12px;
    }

    .ad-auto .callout-cad-frame {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(62, 198, 255, 0.15);
        background: #fff;
    }

    .ad-auto .product-preview {
        width: 100%;
        height: 180px;
        object-fit: contain;
        display: block;
        padding: 6px;
        background: #fafbfc;
    }

    @media (max-width: 992px) {
        .ad-col-main .animate-image { margin: 0 auto; max-width: 640px; }
        .ad-picker-list { max-height: min(200px, 28vh); }
    }

    @media (max-width: 576px) {
        .ad-hero { padding: 32px 0 24px; }
        .ad-auto .ad-map-overlay--exterior-xray:not(.ad-map-overlay--interior) { max-height: 260px; }
        .ad-auto .ad-map-overlay--interior { max-height: 200px; }
        .ad-auto .product-preview { height: 200px; }
        .ad-auto .hotspot.hotspot--part .hotspot-thumb-wrap { width: 48px; height: 48px; }
    }
</style>
@endsection

    <section class="ad-auto mt-50">
        <div class="container ad-auto-intro">
            <p class="ad-hero-eyebrow">Automotive Products</p>
            <h1 class="ad-auto-intro-title">Structural solutions across the vehicle</h1>
            <p class="ad-auto-intro-lead">Explore interior, exterior, and underbody applications. Select a zone on the vehicle or choose a part from the list to view specifications.</p>
        </div>

        <div class="ad-stage">
            <div class="container pb-4 pb-lg-5">
                <div class="ad-auto-tabs-wrap">
                    <div class="ad-auto-tabs" role="tablist" aria-label="Automotive product views">
                        @foreach($autoTabs as $tabId => $tab)
                        <button
                            type="button"
                            class="ad-auto-tab{{ $tabId === $autoDefaultTab ? ' is-active' : '' }}"
                            role="tab"
                            id="adAutoTab-{{ $tabId }}"
                            aria-selected="{{ $tabId === $autoDefaultTab ? 'true' : 'false' }}"
                            aria-controls="adAutoPanel-{{ $tabId }}"
                            data-tab-id="{{ $tabId }}"
                        >
                            <span class="ad-auto-tab-label">{{ $tab['label'] }}</span>
                            <span class="ad-auto-tab-desc">{{ $tab['desc'] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="row g-4 g-xl-5 align-items-start">
                    <div class="col-lg-7 ad-col-main">
                        <p class="ad-ext-label" id="adTabViewLabel">{{ $autoTabs[$autoDefaultTab]['label'] }} view</p>
                        <div class="animate-image">
                            <div class="vehicle-map-box ad-where-creative text-md-start">
                                <div class="callout-map-block p-0">
                                    <div class="ad-where-stage">
                                        <div class="ad-where-mesh" aria-hidden="true"></div>
                                        <div class="ad-where-diagram" id="adWhereDiagram">
                                            <div class="ad-map-overlay ad-map-overlay--exterior-xray{{ $autoTabs[$autoDefaultTab]['overlay'] === 'interior' ? ' ad-map-overlay--interior' : '' }}" id="adMapOverlay" role="region" aria-label="{{ $autoTabs[$autoDefaultTab]['image_alt'] }}">
                                                <div id="productCallout" class="product-callout" data-active="0">
                                                    <div class="map-exterior" aria-hidden="true">
                                                        <div class="ad-xray-frame" id="adXrayFrame">
                                                            <img class="ad-xray-img ad-xray-base" id="adXrayBase" src="{{ $autoTabs[$autoDefaultTab]['image'] }}" alt="{{ $autoTabs[$autoDefaultTab]['image_alt'] }}" width="1024" height="691" loading="lazy" decoding="async">
                                                            <img class="ad-xray-img ad-xray-spot" id="adXraySpot" src="{{ $autoTabs[$autoDefaultTab]['image'] }}" alt="" width="1024" height="691" loading="lazy" decoding="async" aria-hidden="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="hotspots" class="hotspots"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 ad-col-side">
                        <div class="ad-side-hrc">
                            <div class="ad-side-hrc-head">
                                <h2 id="adSideTitle">Parts &amp; applications</h2>
                                <p id="adSideDesc">Select a numbered point on the vehicle or choose a part below.</p>
                            </div>
                            <ul class="ad-picker-list" id="autoAppList" role="listbox" aria-label="Product parts list"></ul>
                            <div class="ad-detail-panel" id="adDetailPanel" aria-live="polite">
                                <p class="ad-detail-kicker" id="adDetailKicker">Product application</p>
                                <span class="ad-detail-num" id="adDetailNum">1</span>
                                <div class="ad-detail-media">
                                    <img id="adDetailImg" class="ad-detail-img" src="{{ $autoDefaultProducts[0]['img'] }}" alt="{{ $autoDefaultProducts[0]['title'] }}" width="320" height="200" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ $autoPlaceholderImg }}';">
                                </div>
                                <h3 class="ad-detail-title" id="adDetailTitle">{{ $autoDefaultProducts[0]['title'] }}</h3>
                                <ul class="ad-detail-body" id="adDetailBody"><li>{{ $autoDefaultProducts[0]['text'] }}</li></ul>
                                <p class="ad-detail-loc" id="adDetailLoc"><strong>On vehicle:</strong> {{ $autoDefaultProducts[0]['location'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        const autoTabs = @json($autoTabs);
        const autoPlaceholderImg = @json($autoPlaceholderImg);
        const autoDefaultTab = @json($autoDefaultTab);

        const hotspotsElement = document.getElementById("hotspots");
        const productCallout = document.getElementById("productCallout");
        const autoAppList = document.getElementById("autoAppList");
        const adMapOverlay = document.getElementById("adMapOverlay");
        const adXrayBase = document.getElementById("adXrayBase");
        const adXraySpot = document.getElementById("adXraySpot");
        const adTabViewLabel = document.getElementById("adTabViewLabel");
        const adDetailKicker = document.getElementById("adDetailKicker");
        const adDetailNum = document.getElementById("adDetailNum");
        const adDetailImg = document.getElementById("adDetailImg");
        const adDetailTitle = document.getElementById("adDetailTitle");
        const adDetailBody = document.getElementById("adDetailBody");
        const adDetailLoc = document.getElementById("adDetailLoc");
        const tabButtons = document.querySelectorAll(".ad-auto-tab[data-tab-id]");

        let currentTabId = autoDefaultTab;
        let currentPointIndex = 0;

        function escText(s) {
            const t = String(s == null ? "" : s);
            return t
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;");
        }

        function textToDetailBullets(text) {
            const raw = String(text || "").trim();
            if (!raw) return "<li></li>";
            const chunks = raw.split(/\.\s+/).map(function (s) { return s.trim(); }).filter(Boolean);
            if (chunks.length <= 1) {
                return "<li>" + escText(raw) + "</li>";
            }
            return chunks.map(function (c) {
                var line = c.endsWith(".") ? c : c + ".";
                return "<li>" + escText(line) + "</li>";
            }).join("");
        }

        function getTabConfig() {
            return autoTabs[currentTabId] || autoTabs[autoDefaultTab];
        }

        function setDetailImage(src, alt) {
            if (!adDetailImg) return;
            var media = adDetailImg.closest(".ad-detail-media");
            if (!src) {
                adDetailImg.removeAttribute("src");
                if (media) media.style.display = "none";
                return;
            }
            if (media) media.style.display = "";
            adDetailImg.onerror = function () {
                this.onerror = null;
                if (autoPlaceholderImg) this.src = autoPlaceholderImg;
            };
            adDetailImg.src = src;
            adDetailImg.alt = alt || "Product";
        }

        function updateTabChrome() {
            var tab = getTabConfig();
            if (!tab) return;

            tabButtons.forEach(function (btn) {
                var id = btn.getAttribute("data-tab-id");
                var on = id === currentTabId;
                btn.classList.toggle("is-active", on);
                btn.setAttribute("aria-selected", on ? "true" : "false");
            });

            if (adTabViewLabel) {
                adTabViewLabel.textContent = tab.label + " view";
            }
            if (adDetailKicker) {
                adDetailKicker.textContent = tab.label + " — product application";
            }
            if (adMapOverlay) {
                adMapOverlay.setAttribute("aria-label", tab.image_alt || tab.label);
                adMapOverlay.classList.toggle("ad-map-overlay--interior", tab.overlay === "interior");
            }
            if (adXrayBase) {
                adXrayBase.src = tab.image;
                adXrayBase.alt = tab.image_alt || tab.label;
            }
            if (adXraySpot) {
                adXraySpot.src = tab.image;
            }
        }

        function renderPicker() {
            if (!autoAppList) return;
            var tab = getTabConfig();
            var prods = (tab && tab.products) ? tab.products : [];
            autoAppList.innerHTML = prods.map(function (p, idx) {
                var n = idx + 1;
                var act = idx === currentPointIndex ? " is-active" : "";
                return (
                    '<li class="p-0 m-0" role="presentation">' +
                    '<button type="button" class="ad-picker-item' + act + '" data-point-index="' + idx + '" role="option" aria-selected="' + (act ? "true" : "false") + '">' +
                    '<span class="ad-picker-num" aria-hidden="true">' + n + "</span>" +
                    '<span class="ad-picker-title">' + escText(p.title) + "</span>" +
                    "</button></li>"
                );
            }).join("");
        }

        function renderHotspots() {
            if (!hotspotsElement) return;
            var tab = getTabConfig();
            var points = (tab && tab.points) ? tab.points : [];
            var products = (tab && tab.products) ? tab.products : [];
            var flip = !!(tab && tab.flip_x);

            hotspotsElement.innerHTML = points.map(function (point, idx) {
                var px = flip ? point.x : (100 - point.x);
                var prod = products[idx];
                var label = (prod && prod.title) ? prod.title : "Point " + (idx + 1);
                var n = idx + 1;
                var activeCls = idx === currentPointIndex ? " active" : "";
                var titleAttr = n + ". " + String(label).replace(/"/g, "&quot;");
                return '<button type="button" class="hotspot' + activeCls + '" data-point-index="' + idx + '" data-hotspot-num="' + n + '" style="left:' + px + "%; top:" + point.y + '%" title="' + titleAttr + '" aria-label="' + titleAttr + '"><span class="hotspot-num" aria-hidden="true">' + n + "</span></button>";
            }).join("");
        }

        function bindHotspotImageZoom() {
            var frame = document.getElementById("adXrayFrame");
            if (!frame || !hotspotsElement || bindHotspotImageZoom._delegated) return;
            bindHotspotImageZoom._delegated = true;

            var reduced = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            function setSpot(btn, on) {
                if (reduced) return;
                if (!on) {
                    frame.classList.remove("is-spot-zoom");
                    return;
                }
                var ox = btn.style.left || "50%";
                var oy = btn.style.top || "50%";
                frame.style.setProperty("--spot-x", ox);
                frame.style.setProperty("--spot-y", oy);
                frame.classList.add("is-spot-zoom");
            }

            hotspotsElement.addEventListener("mouseover", function (e) {
                var btn = e.target && e.target.closest && e.target.closest(".hotspot");
                if (!btn || !hotspotsElement.contains(btn)) return;
                setSpot(btn, true);
            });
            hotspotsElement.addEventListener("mouseout", function (e) {
                var btn = e.target && e.target.closest && e.target.closest(".hotspot");
                if (!btn) return;
                var rel = e.relatedTarget;
                if (rel && btn.contains(rel)) return;
                setSpot(btn, false);
            });
            hotspotsElement.addEventListener("focusin", function (e) {
                var btn = e.target && e.target.closest && e.target.closest(".hotspot");
                if (!btn || !hotspotsElement.contains(btn)) return;
                setSpot(btn, true);
            });
            hotspotsElement.addEventListener("focusout", function (e) {
                var btn = e.target && e.target.closest && e.target.closest(".hotspot");
                if (!btn) return;
                setSpot(btn, false);
            });
        }

        function updateDetailPanel(i) {
            var tab = getTabConfig();
            var products = (tab && tab.products) ? tab.products : [];
            if (!products.length) return;
            var p = products[i] || products[0];
            if (!p) return;
            if (adDetailNum) adDetailNum.textContent = String(i + 1);
            setDetailImage(p.img || autoPlaceholderImg, p.title);
            if (adDetailTitle) adDetailTitle.textContent = p.title;
            if (adDetailBody) adDetailBody.innerHTML = textToDetailBullets(p.text);
            if (adDetailLoc) {
                adDetailLoc.innerHTML = "<strong>On vehicle:</strong> " + escText(p.location || "—");
            }
        }

        function applySelection(index, animate) {
            var tab = getTabConfig();
            var products = (tab && tab.products) ? tab.products : [];
            if (!products.length) return;
            var i = Math.max(0, Math.min(index, products.length - 1));

            function go() {
                currentPointIndex = i;
                if (productCallout) {
                    productCallout.setAttribute("data-active", String(i));
                }
                renderHotspots();
                renderPicker();
                updateDetailPanel(i);
            }

            if (animate && typeof gsap !== "undefined" && hotspotsElement) {
                gsap.timeline()
                    .to(hotspotsElement, { opacity: 0.55, duration: 0.1, ease: "power1.in" })
                    .add(go)
                    .to(hotspotsElement, { opacity: 1, duration: 0.18, ease: "power2.out" });
            } else {
                go();
            }
        }

        function applyTab(tabId, animate) {
            if (!autoTabs[tabId] || tabId === currentTabId) return;
            currentTabId = tabId;
            currentPointIndex = 0;
            updateTabChrome();

            function finish() {
                applySelection(0, false);
            }

            if (animate && typeof gsap !== "undefined" && hotspotsElement) {
                gsap.timeline()
                    .to(hotspotsElement, { opacity: 0, duration: 0.12, ease: "power1.in" })
                    .add(finish)
                    .to(hotspotsElement, { opacity: 1, duration: 0.22, ease: "power2.out" });
            } else {
                finish();
            }
        }

        tabButtons.forEach(function (btn) {
            btn.addEventListener("click", function () {
                var id = btn.getAttribute("data-tab-id");
                if (!id || id === currentTabId) return;
                applyTab(id, true);
            });
        });

        if (autoAppList) {
            autoAppList.addEventListener("click", function (event) {
                var row = event.target.closest(".ad-picker-item");
                if (!row) return;
                var idx = Number(row.getAttribute("data-point-index"));
                if (Number.isNaN(idx)) return;
                applySelection(idx, true);
            });
        }

        if (hotspotsElement) {
            hotspotsElement.addEventListener("click", function (event) {
                var dot = event.target.closest(".hotspot");
                if (!dot) return;
                var idx = Number(dot.getAttribute("data-point-index"));
                if (Number.isNaN(idx)) return;
                applySelection(idx, true);
            });
        }

        updateTabChrome();
        bindHotspotImageZoom();
        applySelection(0, false);
    </script>
@endsection
