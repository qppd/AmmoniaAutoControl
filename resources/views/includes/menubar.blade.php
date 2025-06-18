<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <img src="{{ url('storage/images/applogo.png') }}" alt="Ligtasss" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Ammonia</b> AutoControl</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <br>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard -->

                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Dashboard -->

                <!-- Reports -->
                <li class="nav-item">
                    <a href="{{ url('/reports') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <!-- Reports -->

                <!-- Help -->
                <li class="nav-item">
                    <a href="{{ url('/help') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle-info"></i>
                        <p>
                            Help
                        </p>
                    </a>
                </li>
                <!-- Help -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
