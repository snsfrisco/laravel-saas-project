
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('company_user.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            @canany(['View User', 'View Role'])
                <li class="nav-item has-treeview" id="users_roles">
                    <a href="#" class="nav-link" id="users_roles_link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            {{ __('Roles And Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('View Role')
                            <li class="nav-item">
                                <a href="{{ route('company_user.roles.index') }}" class="nav-link" id="roles">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>{{ __('Roles') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('View User')
                            <li class="nav-item">
                                <a href="{{ route('company_user.users.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-hospital-user"></i>
                                    <p>
                                        {{ __('Users') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('View Client')
                <li class="nav-item">
                    <a href="{{ route('company_user.clients.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            {{ __('Clients') }}
                        </p>
                    </a>
                </li>
            @endcan

            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Two-level menu
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Child menu</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </nav>

