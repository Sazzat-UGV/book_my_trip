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

    @if (Auth::user()->haspermission('role-list') || Auth::user()->haspermission('admin-list'))
        <div class="sidebar-heading">
            System Administration
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

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin"
                aria-expanded="true" aria-controls="admin">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>System Admins</span>
            </a>
            <div id="admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.index') }}">Admin List</a>
                    @can('admin-create')
                        <a class="collapse-item" href="{{ route('admin.create') }}">Add New Admin</a>
                    @endcan
                </div>
            </div>
        </li>
    @endif

    <hr class="sidebar-divider">

    @if (Auth::user()->haspermission('backup-list'))
        <div class="sidebar-heading">
            Settings
        </div>
        @can('backup-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backup.index') }}">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Database Backup</span></a>
            </li>
        @endcan
    @endif


</ul>
