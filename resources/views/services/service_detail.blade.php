@extends('layouts/frontLayout/front_design')
@section('content')

@section('styles')
<style>
    .service ul li{
        list-style: decimal !important;
        margin-left: 15px;
    }
</style>
@endsection('styles')

<main class="main">
    <section class="section banner-contact bg-services bg-10">
        <div class="container">
            <div class="banner-1 position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="breadcrumbs">
                            <ul>
                                <li>
                                    <a href="{{url('/')}}">
                                        <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        Home 
                                    </a>
                                </li>
                                <li>
                                    <a>Services</a>
                                </li>
                                <li>
                                    <a>{{$service->name}}</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="color-brand-1 mb-20 mt-10 wow animate__animated animate__fadeIn" data-wow-delay=".2s">{{$service->name}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-40 content-term">
        <div class="container">
            <div class="content-main mt-50">
                <div class="row mt-70 mb-30">
                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-lg-3 col-md-3">
                        @include('layouts/frontLayout/services_sidebar', ['service_cat_id' => $service->service_cat_id])
                    </div>
                    <div class="col-lg-7 col-md-7">

                        <div class="font-md service">
                            {!! $service->service_content !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection('content')