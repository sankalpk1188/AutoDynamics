@php 
    $url = url()->current(); 
@endphp
<style>
    a.active {
        color: #0b73c0 !important;
        text-decoration: none !important;
        font-weight: bold !important;
        display: inline-block; 
        position: relative;
        padding-bottom: 5px; 
    }

    .has-about-dropdown > a::after,
    .has-technology-dropdown > a::after,
    .has-products-dropdown > a::after,
    .has-media-dropdown > a::after {
        content: "\f107";
        font-family: "Font Awesome 6 Pro";
        font-weight: 900;
        margin-left: 6px;
        font-size: 11px;
        transition: transform 0.3s;
    }
    .has-about-dropdown:hover > a::after,
    .has-technology-dropdown:hover > a::after,
    .has-products-dropdown:hover > a::after,
    .has-media-dropdown:hover > a::after {
        transform: rotate(180deg);
    }

    .main-menu .navigation > li > ul > li > a {
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .main-menu .navigation > li > ul > li:hover > a {
        background: #f1f8ff !important;
        color: #0b73c0 !important;
        padding-left: 24px;
    }

    /* Premium technology mega dropdown */
    .main-menu .navigation > li.has-about-dropdown,
    .main-menu .navigation > li.has-technology-dropdown,
    .main-menu .navigation > li.has-products-dropdown,
    .main-menu .navigation > li.has-media-dropdown {
        position: relative;
    }
    .main-menu .navigation > li.has-about-dropdown > ul.tech-mega-menu,
    .main-menu .navigation > li.has-technology-dropdown > ul.tech-mega-menu,
    .main-menu .navigation > li.has-products-dropdown > ul.tech-mega-menu,
    .main-menu .navigation > li.has-media-dropdown > ul.tech-mega-menu {
        width: 650px;
        max-width: 550px;
        left: -280px;
        padding: 28px 24px 18px !important;
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.22);
        background: linear-gradient(135deg, #1e2e3f 0%, #1c3f5f 52%, #1f5d8a 100%);
        box-shadow: 0 22px 45px rgba(8, 33, 58, 0.42);
        backdrop-filter: blur(6px);
        transform: translateY(14px) scale(0.98);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .main-menu .navigation > li.has-products-dropdown > ul.tech-mega-menu,
    .main-menu .navigation > li.has-media-dropdown > ul.tech-mega-menu {
        left: auto;
        right: -20px;
    }
    .main-menu .navigation > li.has-about-dropdown:hover > ul.tech-mega-menu,
    .main-menu .navigation > li.has-technology-dropdown:hover > ul.tech-mega-menu,
    .main-menu .navigation > li.has-products-dropdown:hover > ul.tech-mega-menu,
    .main-menu .navigation > li.has-media-dropdown:hover > ul.tech-mega-menu {
        transform: translateY(0) scale(1);
        opacity: 1;
        visibility: visible;
    }

    .tech-chip-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 12px;
        margin-bottom: 34px;
    }
    .tech-chip-wrap a {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.45);
        border-radius: 999px;
        background: rgba(15, 30, 46, 0.4);
        color: #fff !important;
        font-weight: 600;
        font-size: 14px;
        line-height: 1;
        padding: 9px 16px !important;
        white-space: nowrap;
        transition: all 0.25s ease;
    }
    .tech-chip-wrap a:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-2px);
        color: #fff !important;
    }

    .tech-mega-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 26px;
    }
    .tech-mega-title {
        color: #fff;
        font-weight: 900;
        font-size: 42px;
        line-height: 1.05;
        margin: 0;
    }

    .tech-quote-btn {
        display: inline-flex !important;
        align-items: center;
        gap: 10px;
        border-radius: 999px;
        background: #fff;
        color: #0c2038 !important;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 24px !important;
        border: 1px solid rgba(255, 255, 255, 0.65);
        white-space: nowrap;
    }
    .tech-quote-btn i {
        font-size: 14px;
    }
    .tech-quote-btn:hover {
        background: #f4f8fc !important;
        color: #0c2038 !important;
    }

    .tech-mega-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.42);
        margin-bottom: 16px;
    }
    .tech-social {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .tech-social li {
        margin: 0 !important;
    }
    .tech-social a {
        color: #fff !important;
        font-size: 18px;
        opacity: 0.92;
    }
    .tech-social a:hover {
        opacity: 1;
    }

    @media (max-width: 1399px) {
        .main-menu .navigation > li.has-about-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-technology-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-products-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-media-dropdown > ul.tech-mega-menu {
            width: 580px;
            max-width: 525px;
            left: -75px;
            padding: 24px 20px 16px !important;
        }
        .main-menu .navigation > li.has-products-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-media-dropdown > ul.tech-mega-menu {
            left: auto;
            right: -10px;
        }
        .tech-mega-title {
            font-size: 20px;
        }
    }

    @media (max-width: 1199px) {
        /* Mobile drawer: hide accordion chevron when there is no submenu (defensive; script also skips .dropdown-btn) */
        .mobile-menu .navigation > li.dropdown:not(:has(> ul)) > .dropdown-btn {
            display: none !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }

        .has-about-dropdown > a::after,
        .has-technology-dropdown > a::after,
        .has-products-dropdown > a::after,
        .has-media-dropdown > a::after {
            display: none !important;
        }

        .main-menu .navigation > li.has-about-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-technology-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-products-dropdown > ul.tech-mega-menu,
        .main-menu .navigation > li.has-media-dropdown > ul.tech-mega-menu {
            min-width: 100%;
            max-width: 100%;
            width: 100%;
            left: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
            backdrop-filter: none;
            transform: none;
            opacity: 1;
            visibility: visible;
            background: transparent;
            padding: 0 !important;
            overflow: visible;
        }
        .tech-chip-wrap {
            display: block;
            margin-bottom: 0;
        }
        .tech-chip-wrap a {
            display: block !important;
            border: 0;
            border-radius: 0;
            background: transparent !important;
            color: #000000 !important;
            opacity: 1 !important;
            font-weight: 600;
            padding: 10px 12px !important;
        }
        .mobile-menu .navigation > li > a,
        .mobile-menu .navigation > li > ul > li > a {
            color: #000000 !important;
            opacity: 1 !important;
        }
        .tech-mega-bottom,
        .tech-mega-divider,
        .tech-social {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .tech-chip-wrap a {
            font-size: 13px;
            padding: 9px 10px !important;
        }
    }

    .marquee-wrapper {
        width: 70%;
        max-width: 100%;
        overflow: hidden;
        white-space: nowrap;
        background: linear-gradient(135deg, #073764, #0b73c0);
        color: #fff;
        font-weight: 600;
        position: relative;
    }

    .marquee-content {
        display: inline-block;
        /*padding-left: 100%;*/
        animation: scroll-left 20s linear infinite;
    }

    @keyframes scroll-left {
        0% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    @media (max-width: 991px) {
        .marquee-wrapper {
            width: 100%;
        }
    }

    @media (max-width: 767px) {
        .main-header .header-lower .container {
            padding-left: 12px;
            padding-right: 12px;
        }
    }

</style>

<div id="wrapper">

    <header class="main-header header-style-four">
        <div class="header-lower">
            <div class="container">
                <!-- Main box -->
                <div class="main-box">
                    <div class="logo-box">
                        <div class="logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset('assets/images/auto_dynamic_logo.png')}}" alt="Logo" /></a>
                        </div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer">
                        <nav class="nav main-menu">
                            <ul class="navigation">
                                <li class="dropdown">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="dropdown has-about-dropdown">
                                    <a href="{{url('about-us')}}">About Us</a>
                                    <ul class="tech-mega-menu">
                                        <li>
                                            <div class="tech-chip-wrap">
                                                <a href="{{url('about-us/our-company')}}">Our Company</a>
                                                <a href="{{url('about-us/why-us')}}">Our Strengths</a>
                                                <a href="{{url('about-us/our-vision')}}">Our Vision</a>
                                                <a href="{{url('about-us/core-values')}}">Core Values</a>
                                                <a href="{{url('about-us/quality-policy')}}">Quality Policy</a>
                                            </div>
                                            <div class="tech-mega-bottom">
                                                <h5 class="tech-mega-title">About Us</h5>
                                                {{-- <a href="{{ url('contact-us') }}" class="tech-quote-btn">
                                                    Get a Quote <i class="fas fa-arrow-up-right-from-square"></i>
                                                </a> --}}
                                            </div>
                                            <div class="tech-mega-divider"></div>
                                            <ul class="tech-social">
                                                <li><a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a></li>
                                                <li><a href="#" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown has-technology-dropdown">
                                    <a href="#">Lightweight Technology</a>
                                    <ul class="tech-mega-menu">
                                        <li>
                                            <div class="tech-chip-wrap">
                                                <a href="{{ route('technology.im-technical-component') }}">Injection Molding of Technical Component</a>
                                                <a href="{{ route('technology.lightweight-imc') }}">IMC Technology</a>
                                                <a href="{{ route('technology.lim') }}">LIM Technology</a>
                                            </div>
                                            <div class="tech-mega-bottom">
                                                <h5 class="tech-mega-title">Lightweight Technology</h5>
                                                {{-- <a href="{{ url('contact-us') }}" class="tech-quote-btn">
                                                    Get a Quote <i class="fas fa-arrow-up-right-from-square"></i>
                                                </a> --}}
                                            </div>
                                            <div class="tech-mega-divider"></div>
                                            <ul class="tech-social">
                                                <li><a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a></li>
                                                <li><a href="#" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="{{ route('capabilities') }}">Capabilities</a>
                                </li>
                                <li class="dropdown has-products-dropdown"><a href="#">Products</a>
                                    <ul class="tech-mega-menu">
                                        <li>
                                            <div class="tech-chip-wrap">
                                                <a href="{{ route('products.automotive') }}">Automotive</a>
                                                <a href="{{ route('products.industrial') }}">Industrial</a>
                                            </div>
                                            <div class="tech-mega-bottom">
                                                <h5 class="tech-mega-title">Products</h5>
                                                <a href="{{ route('upload-design') }}#upload-form" class="tech-quote-btn">
                                                    Get a Quote <i class="fas fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </div>
                                            <div class="tech-mega-divider"></div>
                                            <ul class="tech-social">
                                                <li><a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a></li>
                                                <li><a href="#" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown has-media-dropdown"><a href="{{ url('media/blogs') }}">Media</a>
                                    <ul class="tech-mega-menu">
                                        <li>
                                            <div class="tech-chip-wrap">
                                                <a href="{{ url('media/news') }}">News & Views</a>
                                                <a href="{{ url('media/blogs') }}">Blogs</a>
                                                <a href="{{ url('media/gallery') }}">Gallery</a>
                                            </div>
                                            <div class="tech-mega-bottom">
                                                <h5 class="tech-mega-title">Media</h5>
                                                {{-- <a href="{{ url('contact-us') }}" class="tech-quote-btn">
                                                    Get a Quote <i class="fas fa-arrow-up-right-from-square"></i>
                                                </a> --}}
                                            </div>
                                            <div class="tech-mega-divider"></div>
                                            <ul class="tech-social">
                                                <li><a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a></li>
                                                <li><a href="#" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="dropdown"><a href="{{ url('careers') }}">Career</a>
                                </li> --}}
                                <li class="dropdown"><a href="{{ url('contact-us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Mobile Navigation Toggler -->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                    <!-- Main Menu End-->

                </div>
            </div>
        </div>

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>

            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="upper-box">
                    <div class="nav-logo">
                        <a href="{{url('/')}}"><img src="{{asset('assets/images/auto_dynamic_logo.png')}}" alt="" title="" /></a>
                    </div>
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>

                <ul class="navigation clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </ul>
                <ul class="contact-list-one">
                    <li>
                        <i class="icon lnr-icon-phone-handset"></i>
                        <span class="title">Call Now</span>
                        <div class="text"><a href="tel:+918484015983">+91 8484015983</a></div>
                    </li>
                    <li>
                        <i class="icon lnr-icon-phone-handset"></i>
                        <span class="title">Call Now</span>
                        <div class="text"><a href="tel:+919766914220">+91 9766914220</a></div>
                    </li>
                    <li>
                        <i class="icon lnr-icon-envelope1"></i>
                        <span class="title">Send Email</span>
                        <div class="text"><a href="mailto:info@autodynamics.co.in">info@autodynamics.co.in</a></div>
                    </li>
                    <li>
                        <i class="icon lnr-icon-map-marker"></i>
                        <span class="title">Address</span>
                        <div class="text">Survey No.279/1 & 2, Raisoni Industrial Park, Ph-II, Maan, Tal - Mulshi,Pune.</div>
                    </li>
                </ul>

                <ul class="social-links">
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </nav>
        </div>
        <!-- End Mobile Menu -->

        <!-- Header Search -->
        <div class="search-popup">
            <span class="search-back-drop"></span>
            <button class="close-search"><span class="fa fa-times"></span></button>

            <div class="search-inner">
                <form method="post" action="https://html.kodesolution.com/2025/agencyo-html/index.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search..." required="" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Header Search -->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="container">
                <div class="inner-container">
                    <!--Logo-->
                    <div class="logo">
                        <a href="{{url('/')}}"><img src="{{asset('assets/images/auto_dynamic_logo.png')}}" alt="" title="" /></a>
                    </div>

                    <!--Right Col-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->

                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sticky Menu -->
    </header>

</div>