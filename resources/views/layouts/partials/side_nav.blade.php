<!-- BEGIN: Main Menu-->
@php $user = auth()->user(); @endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand"
                                            href="{{ route('dashboard') }}">
                    <span
                            class="brand-logo">
                        <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo" height="30">
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
                @if($user->can('food-event-read'))
                    <li class="@if(request()->segment(1) == 'food-events') active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('food_events.index') }}">
                            <i data-feather="codesandbox"></i><span
                                    class="menu-title text-truncate">Events</span>
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
            @endif
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
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
