@php
    $userRoles = Auth::user()->roles_id;
@endphp

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{ asset('assets/img/logo_horizontal.png') }}" alt="logo" height="60px" width="193px">
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <img src="{{ asset('assets/img/logo_sharp.png') }}" alt="logo" height="40px" width="40px">
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>

        @if ($userRoles === 1 || $userRoles === 2)
            <li class="menu-header">Master Data</li>
            @if ($userRoles == 1)
                <li
                    class="nav-item dropdown {{ request()->routeIs('users', 'admin.roles.*', 'admin.permissions.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-users-cog"></i> <span>User</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->routeIs('users') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('users') }}">User Management</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">Role Management</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.permissions.index') }}">Permission Management</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="{{ request()->routeIs('categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories') }}">
                    <i class="fas fa-tag"></i> <span>Category</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('divisions') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('divisions') }}">
                    <i class="fas fa-sitemap"></i> <span>Division</span>
                </a>
            </li>
        @endif

        <li class="menu-header">Platform Management</li>
        <li class="{{ request()->routeIs('opportunities') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('opportunities') }}">
                <i class="fas fa-boxes"></i> <span>Opportunity</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('applicant') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('applicant') }}">
                <i class="fas fa-file-alt"></i> <span>Applicant</span>
            </a>
        </li>

        <li class="menu-header">Selection</li>
        <li class="{{ request()->routeIs('admin.cv_screenings.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.cv_screenings.index') }}">
                <i class="fas fa-file-signature"></i> <span>CV Screening</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.psikotests.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.psikotests.index') }}">
                <i class="fas fa-user-md"></i> <span>Psikotest</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.interview_hr.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.interview_hr.index') }}">
                <i class="fas fa-user-check"></i> <span>Interview HR</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.interview_user.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.interview_user.index') }}">
                <i class="fas fa-fire"></i> <span>Interview User</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.offerings.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.offerings.index') }}">
                <i class="fas fa-handshake"></i> <span>Offering</span>
            </a>
        </li>

        <li class="menu-header">Reporting</li>
        <li class="{{ request()->routeIs('admin.reportings.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.reportings.index') }}">
                <i class="fas fa-fire"></i> <span>Recruitment Report</span>
            </a>
        </li>
    </ul>
</aside>
