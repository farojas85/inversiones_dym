<div class="left-side-menu">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">

                    <li class="menu-title">Navegaci&oacute;n</li>
                    @can('dashboard.index')
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-airplay"></i>
                            <span> Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level">
                            <li>
                                <a href="/home">Home</a>
                            </li>
                        </ul>
                    </li>
                    @endcan                    
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
                            @can('permissions.index')
                            <li>
                                <a href="/permissions">Permisos</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-users"></i>
                            <span>Personal</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level">
                            @can('personals.index')
                            <li>
                                <a href="/personals">Personal</a>
                            </li>
                            @endcan
                            @can('personaladelantos.index')
                            <li>
                                <a href="/personaladelantos">Adelanto Personal</a>
                            </li>
                            @endcan
                            @can('personalsalarios.index')
                            <li>
                                <a href="/personalsalarios">Pagos Personal</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="far fa-money-bill-alt"></i>
                            <span> Pr&eacute;stamos </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @can('clientes.index')
                            <li>
                                <a href="/clientes">Clientes</a>
                            </li>
                            @endcan
                            @can('personalmontos.index')
                            <li>
                                <a href="/personalmontos">Asignar Montos</a>
                            </li>
                            @endcan
                            @can('prestamos.index')
                            <li>
                                <a href="/prestamos">Asignar Pr&eacute;stamos</a>
                            </li>
                            @endcan
                            
                        </ul>
                    </li>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->

    </div>