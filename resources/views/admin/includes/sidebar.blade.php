<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ Vite::asset('resources/assets/img/AdminLTEFullLogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
        </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i
                            class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="#" class="nav-link active"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Link3</p>
                            </a> </li>

                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Category
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create categories')
                            <li class="nav-item"> <a href="{{ route('categories.create') }}" class="nav-link"> <i
                                        class="nav-icon bi bi-arrow-right"></i>
                                    <p>add new</p>
                                </a> </li>
                        @endcan

                        <li class="nav-item"> <a href="{{ route('categories.index') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-arrow-right"></i>
                                <p>list</p>
                            </a> </li>

                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Event
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create events')
                            <li class="nav-item"> <a href="{{ route('events.create') }}" class="nav-link"> <i
                                        class="nav-icon bi bi-arrow-right"></i>
                                    <p>add new</p>
                                </a> </li>
                        @endcan
                        <li class="nav-item"> <a href="{{ route('events.index') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-arrow-right"></i>
                                <p>list</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Link</p>
                    </a> </li>
                @can('view users')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link py-2 bg-primary"> <i
                                class="bi bi-shield-fill-exclamation text-warning"></i>
                            <p>Role Management</p>
                        </a>
                    </li>
                @endcan
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside>
