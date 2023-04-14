@php
$pref = Request()->route()->getPrefix();
$type = Request()->type;
@endphp
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li @if ($pref == '') class="mm-active" @endif>
                    <a href="{{url('admin/home')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @canany(['users.view','permissions.view'])
                <li class="menu-title">Users</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('users.view')
                        <li><a href="{{url('admin/users')}}">Users</a></li>
                        @endcan
                        @can('permissions.view')
                        <li><a href="{{url('admin/roles')}}">Role & Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- CMS -->
                @canany(['pages.view','menu.view','banner.view','slider.view','product-showcase'])
                <li class="menu-title">CMS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-camera-retro fa-3x"></i>
                        <span>CMS</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('pages.view')
                        <li><a href="{{url('admin/pages')}}">Pages</a></li>
                        @endcan
                        @can('menu.view')
                        <li><a href="{{url('admin/menu')}}">Menu</a></li>
                        @endcan
                        @can('banner.view')
                        <li><a href="{{url('admin/banner')}}">Banner</a></li>
                        @endcan
                        @can('slider.view')
                        <li><a href="{{url('admin/slider')}}">Slider</a></li>
                        @endcan
                        @can('product-showcase.view')
                        <li><a href="{{url('admin/product-showcase')}}">Product Showcase</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Table Reservation -->
                @can('tables-reservation.view')
                <li class="menu-title">Tables Reservation</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-coffee" aria-hidden="true"></i>
                        <span>Tables Reservation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('tables-reservation.view')
                        <li><a href="{{url('admin/tables-reservation')}}">Tables Reservation</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Extras -->
                 @can('extras.view')
                <li class="menu-title">Extras</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-circle"></i>
                        <span>Extras</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('extras.view')
                        <li><a href="{{url('admin/extras')}}">Extras</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan


                <!-- Caffe Menu -->
                @can('caffe-menu.view')
                <li class="menu-title">Caffe Menu</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-coffee" aria-hidden="true"></i>
                        <span>Caffe Menu</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('caffe-menu.view')
                        <li><a href="{{url('admin/caffe-menu')}}">Caffe Menu</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- BOTTOMLESS BRUNCH -->
                @can('bottomless-brunch.view')
                <li class="menu-title">Bottomless Brunch</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-bars"></i>
                        <span>Bottomless Brunch</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('bottomless-brunch.view')
                        <li><a href="{{url('admin/bottomless-brunch')}}">Bottomless Brunch</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Weakly Events -->
                @can('weaklyevents.view')
                <li class="menu-title">Weakly Events</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>Weekly Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('weaklyevents.view')
                        <li><a href="{{url('admin/weaklyevents')}}">Weekly Events</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Events -->
                @can('events.view')
                <li class="menu-title"> Events</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-calendar"></i>
                        <span> Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('events.view')
                        <li><a href="{{url('admin/events')}}"> Events</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- FAQs -->
                @can('faqs.view')
                <li class="menu-title"> FAQs</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-calendar"></i>
                        <span> FAQs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('faqs.view')
                        <li><a href="{{url('admin/faqs')}}"> FAQs</a></li>
                        @endcan
                    </ul>
                </li>

                @endcan

                <!-- social media -->
                @can('social-media.view')
                <li class="menu-title">Social Media</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>Social Media</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('social-media.view')
                        <li><a href="{{url('admin/social-media')}}">Social Media</a></li>
                        @endcan
                    </ul>
                </li>

                @endcan
                
                <!--  -->
                @can('settings')
                <li class="menu-title">Penal Settings</li>
                <li>
                    <a href="{{url('admin/settings')}}" class="waves-effect">
                        <i class="fas fa-cogs"></i>
                        <span>Penal Settings</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>