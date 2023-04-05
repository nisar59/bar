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
                    <a href="{{url('/home')}}" class="waves-effect">
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
                        <li><a href="{{url('users')}}">Users</a></li>
                        @endcan
                        @can('permissions.view')
                        <li><a href="{{url('roles')}}">Role & Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- CMS -->
            <li class="menu-title">CMS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-camera-retro fa-3x"></i>
                        <span>CMS</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('pages')}}">Pages</a></li>
                        <li><a href="{{url('menu')}}">Menu</a></li>
                        <li><a href="#">Blocks</a></li>
                    </ul>
                </li>
                <!-- Caffe Menu -->

                 <li class="menu-title">Caffe Menu</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-coffee" aria-hidden="true"></i>
                        <span>Caffe Menu</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('caffe')}}">Caffe Menu</a></li>
                    </ul>
                </li>
                <!-- BOTTOMLESS BRUNCH -->
                <li class="menu-title">Bottomless-Brunch</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-bars"></i>
                        <span>Bottomless-Brunch</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('brunch')}}">Bottomless-Brunch</a></li>
                    </ul>
                </li>
                <!-- Weakly Events -->
                <li class="menu-title">Weekly Events</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>Weekly Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('weaklyevents')}}">Weekly Events</a></li>
                    </ul>
                </li>
                <!-- Events -->              
                <li class="menu-title"> Events</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-calendar"></i>
                        <span> Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('events')}}"> Events</a></li>
                    </ul>
                </li>
                <!-- FAQs -->
                <li class="menu-title"> FAQs</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-calendar"></i>
                        <span> FAQs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('faqs')}}"> FAQs</a></li>
                    </ul>
                </li>
                <!--  -->

                @can('settings')
                <li class="menu-title">Penal Settings</li>
                <li>
                    <a href="{{url('settings')}}" class="waves-effect">
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