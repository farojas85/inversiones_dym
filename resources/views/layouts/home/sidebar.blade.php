<div class="left-side-menu">

        <div class="slimscroll-menu">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">

                    <li class="menu-title">Navegaci&oacute;n</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-airplay"></i>
                            <span class="badge badge-success badge-pill float-right">4</span>
                            <span> Dashboards </span>
                        </a>
                        <ul class="nav-second-level">
                            <li>
                                <a href="/home">Home 1</a>
                            </li>
                            <li>
                                <a href="dashboard-2.html">Dashboard 2</a>
                            </li>
                            <li>
                                <a href="dashboard-3.html">Dashboard 3</a>
                            </li>
                            <li>
                                <a href="dashboard-4.html">Dashboard 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-cpu"></i>
                            <span> Sistema </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @can('roles.index')
                            <li>
                                <a href="/roles">Roles</a>
                            </li>
                            @endcan
                            @can('users.index')
                            <li>
                                <a href="/users">Usuarios</a>
                            </li>
                            @endcan
                            @can('personales.index')
                            <li>
                                <a href="/personals">Personal</a>
                            </li>
                            @endcan
                            <li>
                                <a href="apps-contacts.html">Contacts</a>
                            </li>
                            <li>
                                <a href="apps-projects.html">Projects</a>
                            </li>
                            <li>
                                <a href="apps-tickets.html">Tickets</a>
                            </li>
                            <li>
                                <a href="apps-companies.html">Companies</a>
                            </li>
                        </ul>
                    </li>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->

    </div>