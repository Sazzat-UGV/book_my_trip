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


    @if (Auth::user()->haspermission('slider-list') ||
            Auth::user()->haspermission('contact-list') ||
            Auth::user()->haspermission('category-list') ||
            Auth::user()->haspermission('package-list')||
            Auth::user()->haspermission('flight-list'))
        <div class="sidebar-heading">
            Interfaces
        </div>
        @can('slider-list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#slider"
                    aria-expanded="true" aria-controls="slider">
                    <i class="fas fa-fw fa-sliders-h"></i>
                    <span>Sliders</span>
                </a>
                <div id="slider" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('slider.index') }}">Slider List</a>
                        @can('slider-create')
                            <a class="collapse-item" href="{{ route('slider.create') }}">Add New Slider</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
        @can('category-list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category"
                    aria-expanded="true" aria-controls="category">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Categories</span>
                </a>
                <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('category.index') }}">Category List</a>
                        @can('category-create')
                            <a class="collapse-item" href="{{ route('category.create') }}">Add New Category</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
        @can('package-list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#package"
                    aria-expanded="true" aria-controls="package">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Packages</span>
                </a>
                <div id="package" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('package.index') }}">Package List</a>
                        @can('package-create')
                            <a class="collapse-item" href="{{ route('package.create') }}">Add New Package</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
        @can('flight-list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#flight"
                    aria-expanded="true" aria-controls="flight">
                    <i class="fas fa-plane"></i>
                    <span>Flights</span>
                </a>
                <div id="flight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('flight.index') }}">Flight List</a>
                        @can('flight-create')
                            <a class="collapse-item" href="{{ route('flight.create') }}">Add New Flight</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
        @can('hotel-list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hotel"
                    aria-expanded="true" aria-controls="hotel">
                    <i class="fas fa-building"></i>
                    <span>Hotels</span>
                </a>
                <div id="hotel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('hotel.index') }}">Hotel List</a>
                        @can('hotel-create')
                            <a class="collapse-item" href="{{ route('hotel.create') }}">Add New Hotel</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan

        @can('contact-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact.index') }}">
                    <i class="fas fa-fw fa-phone-alt"></i>
                    <span>Contacts</span></a>
            </li>
        @endcan

    @endif







































    <hr class="sidebar-divider">
    @if (Auth::user()->haspermission('role-list') || Auth::user()->haspermission('admin-list'))
        <div class="sidebar-heading">
            System Administration
        </div>
        @can('role-list')
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
        @endcan
        @can('admin-list')
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
        @endcan
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
