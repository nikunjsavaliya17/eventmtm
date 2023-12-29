<!-- BEGIN: Header-->
<nav
        class="navbar header-navbar navbar navbar-shadow align-items-center navbar-light navbar-expand fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
        </div>
        @php
            $admin = auth()->user();
        @endphp
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                   data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ $admin->name }}</span>
                        <span class="user-status">{{ $admin->relatedRole->title ?? "Admin" }}</span>
                    </div>
                    @if(isset($admin->image))
                        <span class="avatar">
                                <img class="round" src="{{ getFileUrl($admin->image, 'admin') }}" alt="avatar" height="40" width="40">
                            </span>
                    @else
                        <div class="avatar bg-primary">
                            <div class="avatar-content">{{ getNameInitials($admin->name) }}</div>
                            <span class="avatar-status-online"></span>
                        </div>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i
                                class="me-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="me-50" data-feather="power"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
