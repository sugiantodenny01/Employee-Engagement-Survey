<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Assessment</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(Route::is('dashboard')) active @endif">
        <a class="nav-link " href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Interface
    </div> --}}

    <!-- Nav Item - Divisions -->
    <li class="nav-item  @if(Route::is('division.*')) active @endif">
        <a class="nav-link" href="{{ route('division.index') }}">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Divisions</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item @if(Route::is('user.*')) active @endif">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Employees -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('employee.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Employees</span></a>
    </li> --}}

    <!-- Nav Item - Categories Collapse Menu -->
    <li class="nav-item @if(Route::is('category.*') || Route::is('category_detail.*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-tag"></i>
            <span>Manage Categories</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category.index') }}">Categories</a>
                <a class="collapse-item" href="{{ route('category_detail.index') }}">Category Details</a>
            </div>
        </div>
    </li>

    <li class="nav-item @if(Route::is('list_assessment.*')) active @endif">
        <a class="nav-link" href="{{ route('list_assessment.index') }}">
            <i class="fas fa-fw fa-clock"></i>
            <span>List Assesments</span></a>
    </li>

    <li class="nav-item @if(Route::is('overall.*')) active @endif">
        <a class="nav-link" href="{{ route('overall.index') }}">
            <i class="fas fa-fw fa-laugh-wink"></i>
            <span>Active Assessments</span></a>
    </li>


    <li class="nav-item @if(Route::is('history.*')) active @endif">
        <a class="nav-link" href="{{ route('history.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>History Of Assessments</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
    /*
    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    */
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-auto">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('backend/img/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
