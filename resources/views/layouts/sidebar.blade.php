<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">SchoolTech</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="active"><a class="nav-link" href="#"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users-cog"></i> <span>User</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('users')}}">User Management</a></li>
            <li><a class="nav-link" href="{{route('comingsoon')}}">Role Management</a></li>
            <li><a class="nav-link" href="{{route('comingsoon')}}">Permission Management</a></li>
          </ul>
        </li>
      </ul>
  </aside>