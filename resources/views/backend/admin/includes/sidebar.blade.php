<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
            DBA<span>Clinic</span>
        </a>
        <div class="sidebar-toggler ">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Admin</li>
            <!--  Dashboard  -->
            <li class="nav-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li
                class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#area" role="button" aria-expanded="false"
                    aria-controls="area">
                    <i class="fa-regular fa-user"></i>
                    <span class="link-title">Area Manage</span>
                    <i class="fa-solid fa-chevron-down link-arrow"></i>
                </a>
                <div class="collapse" id="area">
                    <ul class="nav sub-menu">
                        <li class="nav-item ">
                            <a href="{{route('admin.division')}}"
                                class="nav-link ">Division
                                </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.zilla')}}"
                                class="nav-link ">Zilla</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- partial -->