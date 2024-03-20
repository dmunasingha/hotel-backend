<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                @include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Admin Panel</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        {{-- main menu --}}
        <li class="menu-item">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bi bi-house"></i>
                <div>Dashboard</div>
            </a>
            {{-- submenu --}}
        </li>

        {{-- menu headers --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Modules</span>
        </li>

        {{-- main menu --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-people"></i>
                <div>User Managment</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div>Users</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <div>Roles</div>
                    </a>
                </li>
            </ul>
            {{-- submenu --}}
        </li>
    </ul>

</aside>
