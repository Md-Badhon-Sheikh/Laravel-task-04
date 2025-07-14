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
            <li class="nav-item nav-category">Operator</li>
            <!--  Dashboard  -->
            <li class="nav-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('operator.dashboard') }}" class="nav-link ">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li
                class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#importantLink" role="button" aria-expanded="false"
                    aria-controls="importantLink">
                    <i class="fa-regular fa-user"></i>
                    <span class="link-title">Important Link Manage</span>
                    <i class="fa-solid fa-chevron-down link-arrow"></i>
                </a>
                <div class="collapse" id="importantLink">
                    <ul class="nav sub-menu">
                        <li class="nav-item ">
                            <a href="{{route('operator.link.add')}}"
                                class="nav-link ">Important Link Add
                                </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link ">Important Link List</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- partial -->
