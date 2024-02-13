<!-- BEGIN: Main Menu-->
@php $user = auth()->user(); @endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand"
                                            href="{{ route('dashboard') }}">
                    <span
                            class="brand-logo">
{{--                        <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo" height="30">--}}
                        <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                        <defs>
                            <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                <stop stop-color="#000000" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                            <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                        </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                    <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                    <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg>
                            </span>
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                            class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                            data-feather="disc"
                            data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @if(request()->segment(1) == '') active @endif">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>
            @if($user->can('event-company-read') || $user->can('event-read'))
                <li class="navigation-header"><span>Event Management</span><i
                            data-feather="more-horizontal"></i>
                </li>
                @if($user->can('event-company-read'))
                    <li class="@if(request()->segment(1) == 'event-company-management') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('event_company_management.index') }}">
                            <i data-feather="package"></i><span
                                    class="menu-title text-truncate">Companies</span>
                        </a>
                    </li>
                @endif
                @if($user->can('event-read'))
                    <li class="@if(request()->segment(1) == 'event-management') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('event_management.index') }}">
                            <i data-feather="codesandbox"></i><span
                                    class="menu-title text-truncate">Events</span>
                        </a>
                    </li>
                @endif
            @endif
            @if($user->can('sponsor-type-read') || $user->can('sponsor-read'))
                <li class="navigation-header"><span>Sponsor Management</span><i
                            data-feather="more-horizontal"></i>
                </li>
                @if($user->can('sponsor-type-read'))
                    <li class="@if(request()->segment(1) == 'sponsor-types') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('sponsor_types.index') }}">
                            <i data-feather="database"></i><span
                                    class="menu-title text-truncate">Types</span>
                        </a>
                    </li>
                @endif
                @if($user->can('sponsor-read'))
                    <li class="@if(request()->segment(1) == 'sponsors') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('sponsors.index') }}">
                            <i data-feather="users"></i><span
                                    class="menu-title text-truncate">Sponsors</span>
                        </a>
                    </li>
                @endif
            @endif
            @if($user->can('food-partner-read') || $user->can('food-event-read') || $user->can('food-type-read') || $user->can('food-menu-read'))
                <li class="navigation-header"><span>Food Management</span><i
                            data-feather="more-horizontal"></i>
                </li>
                @if($user->can('food-partner-read'))
                    <li class="@if(request()->segment(1) == 'food-partners') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('food_partners.index') }}">
                            <i data-feather="users"></i><span
                                    class="menu-title text-truncate">Partners</span>
                        </a>
                    </li>
                @endif
                @if($user->can('food-type-read'))
                    <li class="@if(request()->segment(1) == 'food-types') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('food_types.index') }}">
                            <i data-feather="database"></i><span
                                    class="menu-title text-truncate">Types</span>
                        </a>
                    </li>
                @endif
                @if($user->can('food-menu-read'))
                    <li class="@if(request()->segment(1) == 'food-menu') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('food_menu.index') }}">
                            <i data-feather="book-open"></i><span
                                    class="menu-title text-truncate">Menu</span>
                        </a>
                    </li>
                @endif
                @if($user->can('food-event-read'))
                    <li class="@if(request()->segment(1) == 'food-events') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('food_events.index') }}">
                            <i data-feather="codesandbox"></i><span
                                    class="menu-title text-truncate">Events</span>
                        </a>
                    </li>
                @endif
            @endif
            @if($user->can('orders-read') || $user->can('app-users-read'))
                <li class="navigation-header"><span>Reports</span><i
                            data-feather="more-horizontal"></i>
                </li>
                @if($user->can('app-users-read'))
                    <li class="@if(request()->segment(1) == 'users') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('app_users') }}">
                            <i data-feather="users"></i><span
                                    class="menu-title text-truncate">App Users</span>
                        </a>
                    </li>
                @endif
                @if($user->can('orders-read'))
                    <li class="@if(request()->segment(1) == 'orders') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('orders') }}">
                            <i data-feather="credit-card"></i><span
                                    class="menu-title text-truncate">Orders</span>
                        </a>
                    </li>
                @endif
            @endif
            @if($user->can('admin-user-read') || $user->can('admin-roles-read') || $user->can('faqs-read') || $user->can('custom-page-read') || $user->can('email-templates-read') || $user->can('configuration-read'))
                <li class="navigation-header"><span>System</span><i
                            data-feather="more-horizontal"></i>
                </li>
                @if($user->can('admin-user-read'))
                    <li class="@if(request()->segment(1) == 'admin-users') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin_users.index') }}">
                            <i data-feather="users"></i><span
                                    class="menu-title text-truncate">Admin Users</span>
                        </a>
                    </li>
                @endif
                @if($user->can('admin-roles-read'))
                    <li class="@if(request()->segment(1) == 'roles') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('roles.index') }}">
                            <i data-feather="align-left"></i><span
                                    class="menu-title text-truncate">Admin Roles</span>
                        </a>
                    </li>
                @endif
                @if($user->can('faqs-read'))
                    <li class="@if(request()->segment(1) == 'faqs') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('faqs.index') }}">
                            <i data-feather="help-circle"></i><span
                                    class="menu-title text-truncate">FAQs</span>
                        </a>
                    </li>
                @endif
                @if($user->can('custom-page-read'))
                    <li class="@if(request()->segment(1) == 'custom-page') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('custom_page.index') }}">
                            <i data-feather="book"></i><span
                                    class="menu-title text-truncate">Pages</span>
                        </a>
                    </li>
                @endif
                @if($user->can('email-templates-read'))
                    <li class="@if(request()->segment(1) == 'email-templates') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('email_templates.index') }}">
                            <i data-feather="mail"></i><span
                                    class="menu-title text-truncate">Email Templates</span>
                        </a>
                    </li>
                @endif
                @if($user->can('configuration-read'))
                    <li class="@if(request()->segment(1) == 'configuration') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('configuration.index') }}">
                            <i data-feather="settings"></i><span
                                    class="menu-title text-truncate">Configurations</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
