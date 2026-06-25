<?php $url = url()->current();?>

<aside class="main-sidebar elevation-4" style="background:#000000;color:white;">
    <a href="{{ url('/admin/dashboard') }}" class="brand-link text-white p-2">
        <img src="{{asset('assets/images/auto_dynamic_logo.png')}}" class="brand-image" style="width:70%;">
    </a>
    <div class="sidebar">        
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link text-white @if(preg_match('#/admin/dashboard#',$url)) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                {{-- Notifications --}}
                <li class="nav-item">
                    <a href="{{url('admin/view-notifications')}}" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Notifications</p>
                    </a>
                </li>

                {{-- Home --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-home"></i> 
                        <p>Home Page <i class="fas fa-angle-right right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-banner/')}}" class="nav-link text-white @if(preg_match('/banner/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Banner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/view-about/')}}" class="nav-link text-white @if(preg_match('/about/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/view-stats/')}}" class="nav-link text-white @if(preg_match('/stats/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Stats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/view-whykpca/')}}" class="nav-link text-white @if(preg_match('/whykpca/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Why KPCA
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- About --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i> 
                        <p>About Us Page <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-aboutpage/')}}" class="nav-link text-white @if(preg_match('/aboutpage/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> About Us
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-story/')}}" class="nav-link text-white @if(preg_match('/story/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Our Story
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-core/')}}" class="nav-link text-white @if(preg_match('/core/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Core Values
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-vision/')}}" class="nav-link text-white @if(preg_match('/vision/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Vision & Mission
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-spread/')}}" class="nav-link text-white @if(preg_match('/spread/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Industry Spread
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item d-none">
                    <a href="{{url('admin/view-partners')}}" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Partners</p>
                    </a>
                </li>

                <li class="nav-item d-none">
                    <a href="{{url('admin/view-services')}}" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/admin/view-blogs/')}}" class="nav-link text-white @if(preg_match('/blogs/', $url)) active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Blogs</p>
                    </a>
                </li> 
                
                {{-- Blogs --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i> 
                        <p>Insights <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-industry/')}}" class="nav-link text-white @if(preg_match('/industry/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Reports & Publications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/view-blogs/')}}" class="nav-link text-white @if(preg_match('/blogs/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Blogs
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- clients --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Clients <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-client/')}}" class="nav-link text-white @if(preg_match('/add-client/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add Client
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-client/')}}" class="nav-link text-white @if(preg_match('/view-client/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> View Clients 
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- News --}}
                <li class="nav-item has-treeview @if(preg_match('/add-news|view-news|linkedin-embed|add-linkedin-post|view-linkedin-posts|edit-linkedin-post/', $url)) menu-open @endif">
                    <a href="#" class="nav-link text-white @if(preg_match('/add-news|view-news|linkedin-embed|add-linkedin-post|view-linkedin-posts|edit-linkedin-post/', $url)) active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Media <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-news/')}}" class="nav-link text-white @if(preg_match('/add-news/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add News
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-news/')}}" class="nav-link text-white @if(preg_match('/view-news/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> View News 
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/linkedin-embed/')}}" class="nav-link text-white @if(preg_match('/linkedin-embed/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> LinkedIn Embed URL
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-linkedin-post/')}}" class="nav-link text-white @if(preg_match('/add-linkedin-post/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add LinkedIn Post
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-linkedin-posts/')}}" class="nav-link text-white @if(preg_match('/view-linkedin-posts|edit-linkedin-post/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> View LinkedIn Posts
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Event --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Event  <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-event/')}}" class="nav-link text-white @if(preg_match('/add-event/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add Event
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-event/')}}" class="nav-link text-white @if(preg_match('/view-event/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> View Events 
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-expo/')}}" class="nav-link text-white @if(preg_match('/add-expo/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add Expo Event 
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-expo/')}}" class="nav-link text-white @if(preg_match('/view-expo/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> View Expo Events 
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Career --}}
                <li class="nav-item">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i> 
                        <p>Career <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-career/')}}" class="nav-link text-white @if(preg_match('/career/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Why Work With Us
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/add-opportunities/')}}" class="nav-link text-white @if(preg_match('/add-opportunities/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Add Opportunity
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-opportunities/')}}" class="nav-link text-white @if(preg_match('/opportunities/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Career Opportunities
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-applications/')}}" class="nav-link text-white @if(preg_match('/view-applications/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Job Applications
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/view-joinus-enq')}}" class="nav-link text-white @if(preg_match('/joinus-enq/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Career/Contact Enquiries
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/view-design-uploads')}}" class="nav-link text-white @if(preg_match('/view-design-uploads|delete-design-upload/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Upload Your Design
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/view-achievements')}}" class="nav-link text-white @if(preg_match('/achievement/', $url)) active @endif">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Awards & Certifications</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/view-gallery')}}" class="nav-link text-white @if(preg_match('/gallery/', $url)) active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/view-joinus-enq')}}" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Contact Enquiry</p>
                    </a>
                </li>

                {{-- Contact --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i> 
                        <p>Contact Page <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/view-contact/')}}" class="nav-link text-white @if(preg_match('/contact/', $url)) active @endif">
                                <i class="nav-icon fas fa-arrow-right"></i> Contact Details
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                                <i class="nav-icon fas fa-arrow-right"></i> Contact Enquiry
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Contact --}}
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Contact Enquiry</p>
                    </a>
                </li> --> 

                {{-- Career --}}
                <li class="nav-item d-none">
                    <a href="#" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Career Enquiry</p>
                    </a>
                </li>  
            </ul>
        </nav>  
    </div>
</aside>