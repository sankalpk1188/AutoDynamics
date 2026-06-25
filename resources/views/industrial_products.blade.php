@extends('layouts/frontLayout/front_design')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/automotive-showcase.css') }}?v=20260622">
@endsection

@section('content')
@php
    if (empty($showcaseData)) {
        $jsonPath = public_path('assets/data/industrial-showcase.json');
        $showcaseData = file_exists($jsonPath)
            ? json_decode(file_get_contents($jsonPath), true)
            : ['hero' => [], 'categories' => [], 'steps' => []];
    }
    foreach ($showcaseData['steps'] ?? [] as &$step) {
        if (!empty($step['productImage']) && empty($step['productImageUrl'])) {
            $step['productImageUrl'] = asset($step['productImage']);
        }
    }
    unset($step);
    if (!empty($showcaseData['vehicleImages'])) {
        foreach ($showcaseData['vehicleImages'] as $key => $path) {
            if (!str_starts_with($path, 'http')) {
                $showcaseData['vehicleImages'][$key] = asset($path);
            }
        }
    }
@endphp

@include('components.industrial-showcase', ['showcaseData' => $showcaseData])

<section class="is-more-section" aria-label="More industrial products">
    <h2 class="is-more-title">More Industrial Products</h2>
    <div class="is-more-grid">
        {{-- <article class="is-more-card">
            <img src="{{ asset('assets/images/industrial/products/product-industrial-workbench.png') }}" alt="Industrial workbench" loading="lazy">
            <h3>Industrial Workbench</h3>
        </article>
        <article class="is-more-card">
            <img src="{{ asset('assets/images/industrial/products/product-plastic-sawhorse.png') }}" alt="Plastic sawhorse" loading="lazy">
            <h3>Plastic Sawhorse</h3>
        </article> --}}
        <article class="is-more-card">
            <img src="{{ asset('assets/images/industrial/products/product-mailbox.png') }}" alt="Mail box" loading="lazy">
            <h3>Mail Box</h3>
        </article>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/js/automotive-showcase.js') }}?v=20260622"></script>
@endsection
