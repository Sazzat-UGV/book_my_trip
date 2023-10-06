<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    @can('access-dashboard')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endcan
    <hr class="sidebar-divider">

    @if (Auth::user()->haspermission('role-list'))
        <div class="sidebar-heading">
            System Settings
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#role" aria-expanded="true"
                aria-controls="role">
                <i class="fas fa-fw fa-user-friends"></i>
                <span>System Roles</span>
            </a>
            <div id="role" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('role.index') }}">Role List</a>
                    @can('role-create')
                        <a class="collapse-item" href="{{ route('role.create') }}">Add New Role</a>
                    @endcan
                </div>
            </div>
        </li>
    @endif


</ul>
