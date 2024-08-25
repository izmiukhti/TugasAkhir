<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="{{asset('assets/img/logo_horizontal.png')}}" alt="logo" height="60px" width="193px">
      {{-- <a href="index.html">SchoolTech</a> --}}
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <img src="{{asset('assets/img/logo_sharp.png')}}" alt="logo" height="40px" width="40px">
      {{-- <a href="index.html">St</a> --}}
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="active"><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users-cog"></i> <span>User</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('users')}}">User Management</a></li>
            <li><a class="nav-link" href="{{route('comingsoon')}}">Role Management</a></li>
            <li><a class="nav-link" href="{{route('comingsoon')}}">Permission Management</a></li>
          </ul>
        </li>
        <li class=""><a class="nav-link" href="{{route('categories')}}"><i class="fas fa-tag"></i> <span>Category</span></a></li>
        <li class=""><a class="nav-link" href="{{route('divisions')}}"><i class="fas fa-sitemap"></i> <span>Division</span></a></li>
        <li class="menu-header">Platform Management</li>
        <li class=""><a class="nav-link" href="{{route('opportunities')}}"><i class="fas fa-boxes"></i> <span>Opportunity</span></a></li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-file-alt"></i> <span>Applicant</span></a></li>
        <li class="menu-header">Selection</li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-file-signature"></i> <span>CV Screening</span></a></li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-user-md"></i> <span>Psikotest</span></a></li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-user-check"></i> <span>Interview HR</span></a></li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-fire"></i> <span>Interview User</span></a></li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-handshake"></i> <span>Offering</span></a></li>
        <li class="menu-header">Reporting</li>
        <li class=""><a class="nav-link" href="{{route('comingsoon')}}"><i class="fas fa-fire"></i> <span>Recruitment Report</span></a></li>
      </ul>
  </aside>