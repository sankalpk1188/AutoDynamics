@extends('layouts/frontLayout/front_design')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/automotive-showcase.css') }}?v=20260630">
@endsection

@section('content')
@php
    if (empty($showcaseData)) {
        $jsonPath = public_path('assets/data/automotive-showcase.json');
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

@include('components.automotive-showcase', ['showcaseData' => $showcaseData])
@endsection

@section('scripts')
<script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/js/automotive-showcase.js') }}?v=20260630"></script>
@endsection
