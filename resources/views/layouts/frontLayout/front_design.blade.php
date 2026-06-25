<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#061224">
    <meta name="template-color" content="#061224">
    <meta name="keywords" content="@if(!empty($meta_keywords)){{ $meta_keywords }} @else {{config('app.name')}} @endif">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon_autodynamics.png')}}">
    <title>@if(!empty($meta_title)){{ $meta_title }} @else {{config('app.name')}} @endif</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">
    @else
    <meta name="description" content="{{ !empty($meta_title) ? $meta_title : config('app.name') }}">
    @endif

    <meta property="og:title" content="{{config('app.name')}}" />
    <meta property="og:type" content="site" />
    <meta property="og:description" content="{{config('app.name')}}" />
    <meta property="og:url" content="{{url('/')}}" />
    <meta property="og:image"  content="{{asset('assets/images/auto_dynamic_logo.png')}}"/>
    
    <meta name="twitter:title" content="{{config('app.name')}}">
    <meta name="twitter:description" content="{{config('app.name')}}">
    <meta name="twitter:image"  content="{{asset('assets/images/auto_dynamic_logo.png')}}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive-overrides.css')}}">
    <style>
        .ad-submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 22px;
            border: 1px solid rgba(42, 108, 184, 0.35);
            border-radius: 8px;
            font-family: "Inter", system-ui, sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: capitalize;
            color: #061224 !important;
            background: linear-gradient(135deg, #88c3ff 0%, #4d95dd 100%);
            box-shadow: 0 10px 24px rgba(39, 120, 195, 0.32);
            cursor: pointer;
            transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
            text-decoration: none;
        }
        .ad-submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(39, 120, 195, 0.42);
            filter: brightness(1.03);
            color: #061224 !important;
        }
        .ad-submit-btn:disabled,
        .ad-submit-btn[disabled] {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
    </style>
   
    @yield('head_seo')
    @yield('styles')
</head>
<body id="body" class="menu-overlay-enabled">
    <div id="smooth-wrapper"></div>
    <div id="smooth-content"></div>
    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="page-loading">
                    <div class="page-loading-inner">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
    <!-- Page Header-->
    @include('layouts/frontLayout/front_header')

    @yield('content')

    <!-- Page Footer-->
    @include('layouts/frontLayout/front_footer')

    {{-- <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div> --}}

    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('assets/js/wow.js')}}"></script>
    <script src="{{asset('assets/js/appear.js')}}"></script>
    <script src="{{asset('assets/js/swiper.min.js')}}"></script>

    <script src="{{asset('assets/js/gsap.min.js')}}"></script>
    <script src="{{asset('assets/js/ScrollTrigger.min.js')}}"></script>
    <script src="{{asset('assets/js/SplitText.min.js')}}"></script>
    <script src="{{asset('assets/js/splitType.js')}}"></script>
    <script src="{{asset('assets/js/ScrollSmoother.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/mixitup.js')}}"></script>
    <script src="{{asset('assets/js/parallax-scroll.js')}}"></script>
    <script src="{{asset('assets/js/element-in-view.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/script-gsap.js')}}"></script>
  
    <!-- form submit -->
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.form.min.js')}}"></script>
    <script src="{{asset('assets/js/contact-form-script.js')}}"></script>

    @yield('scripts')

</body>
</html>