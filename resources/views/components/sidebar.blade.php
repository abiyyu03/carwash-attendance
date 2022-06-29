<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info bg-light elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-info">
        <img src="{{url('logo/jiwalu-logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle border border-white" style="opacity: .8">
        <span class="brand-text text-white font-weight-bold">Jiwalu Carwash</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('../dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }} <i class="@if (Auth()->user()->role->role_name == 'owner') fas fa-check-circle @endif"></i></a>
                <a href="/logout" class="btn btn-sm btn-warning"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        <!-- database->controller->view -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/attendance" class="nav-link {{ request()->segment(1) == 'config' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                Daftar Kehadiran
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/config" class="nav-link {{ request()->segment(1) == 'config' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
