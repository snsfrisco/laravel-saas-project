
    <!-- Sidebar Menu -->
    <nav class="mt-2 text-sm">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('portal_user.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            @can(['View User', 'View Role'])
                <li class="nav-item has-treeview" id="users_roles">
                    <a href="#" class="nav-link" id="users_roles_link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            {{ __('Roles And Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_role')
                            <li class="nav-item">
                                <a href="{{ route('portal_user.roles.index') }}" class="nav-link" id="roles">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>{{ __('Roles') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('view_user')
                            <li class="nav-item">
                                <a href="{{ route('portal_user.users.index') }}" class="nav-link">
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


            @can('View Company')
                <li class="nav-item">
                    <a href="{{ route('portal_user.companies.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Companies') }}
                        </p>
                    </a>
                </li>
            @endcan

            @can('View Company Admin')
                <li class="nav-item">
                    <a href="{{ route('portal_user.companies-admins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Companies Admins') }}
                        </p>
                    </a>
                </li>
            @endcan



            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-briefcase-medical"></i>
                    <p>
                        {{ __('Labs/Facilities/Camps') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('view_lab')
                        <li class="nav-item">
                            <a href="{{ route('laboratories.index') }}" class="nav-link" id="branches">
                                <i class="fas fa-map-marked-alt nav-icon"></i>
                                <p>{{ __('Laboratories') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('view_facility')
                        <li class="nav-item">
                            <a href="{{ route('fr-index-url') }}" class="nav-link" id="fr-index-url">
                                <i class="nav-icon fas fa-hospital"></i>
                                <p>
                                    {{ __('Facility') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view_camp')
                        <li class="nav-item">
                            <a href="{{ route('camps.index') }}" class="nav-link" id="fr-index-url">
                                <i class="nav-icon fas fa-clinic-medical"></i>
                                <p>
                                    {{ __('Camps') }}
                                </p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li> --}}

           {{--  @canany(['view_test'])
                <li class="nav-item has-treeview" id="users_roles">
                    <a href="#" class="nav-link" id="users_roles_link">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            {{ __('Tests') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @can('view_test')
                            <li class="nav-item">
                                <a href="{{ route('tests.index') }}" class="nav-link" id="tests">
                                    <i class="nav-icon fas fa-flask"></i>
                                    <p>
                                        {{ __('Tests') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('specimen-type.index') }}" class="nav-link" id="tests">
                                    <i class="nav-icon fas fa-crutch"></i>
                                    <p>
                                        {{ __('Specimen Type') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('view_patients_booking')
                <li class="nav-item">
                    <a href="{{ route('patients.bookings') }}" class="nav-link" id="patients">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>
                            {{ __('Patient\'s Booking') }}
                        </p>
                    </a>
                </li>
            @endcan --}}

		   {{-- @can('view_reports')
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link" id="reports">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            {{ __('Reports') }}
                        </p>
                    </a>
                </li>
            @endcan --}}

            {{-- @can('view_patient_status_reports')
                <li class="nav-item">
                    <a href="{{ route('pt-test-status.index') }}" class="nav-link" id="reports">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Patient Status Reports') }}
                        </p>
                    </a>
                </li>
            @endcan --}}

            {{-- @canany(['view_status_categories', 'view_stage_transitions'])
                <li class="nav-item has-treeview" id="users_roles">
                    <a href="#" class="nav-link" id="users_roles_link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ __('Status Management') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_status_categories')
                            <li class="nav-item">
                                <a href="{{ route('status-master.index') }}" class="nav-link" id="roles">
                                    <i class="nav-icon fas fa-book-medical"></i>
                                    <p>{{ __('Status Master') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('view_stage_transitions')
                            <li class="nav-item">
                                <a href="{{ route('workflow-stage-management.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        {{ __('Stage Management') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @canany(['view_email_template','view_notification_template'])
                <li class="nav-item has-treeview" id="email_templates">
					<a href="#" class="nav-link" >
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            {{ __('Email Template') }}
							 <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
					 <ul class="nav nav-treeview">
						 @can('view_email_template')
						 <li class="nav-item">
							<a href="{{ route('email-template.index') }}" class="nav-link" id="email_templates_link">
							<i class="nav-icon fas fa-envelope"></i>
							<p>
								{{ __('Email Template') }}
							</p>
							</a>
						 </li>
						  @endcan
						  @can('view_notification_template')
                            <li class="nav-item">
                                <a href="{{ route('notification-templates.index') }}" class="nav-link" id="roles">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>{{ __('Notification Templates') }}</p>
                                </a>
                            </li>
                        @endcan

					 </ul>
                </li>
            @endcan


            @canany(['view_facility_bulk_notification', 'view_bulk_notification'])
                <li class="nav-item has-treeview" id="users_roles">
                    <a href="#" class="nav-link" id="users_roles_link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            {{ __('Notification') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @can('view_bulk_notification')
                            <li class="nav-item">
                                <a href="{{ route('bulk-notifications.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-mail-bulk"></i>
                                    <p>
                                        {{ __('Patient Bulk Notifications') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('view_facility_bulk_notification')
                            <li class="nav-item">
                                <a href="{{ route('facility-bulk-notifications') }}" class="nav-link">
                                    <i class="nav-icon fas fa-mail-bulk"></i>
                                    <p>
                                        {{ __('Facility Bulk Notifications') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('view_activity_log')
            <li class="nav-item">
                <a href="{{ route('activity_logs.index') }}" class="nav-link">
                    <i class=" nav-icon fab fa-reddit"></i>
                    <p>
                        {{ __('Activity Log') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('view_settings')
            <li class="nav-item">
                <a href="{{ route('settings.index') }}" class="nav-link" id="settings">
                    <i class="fa fa-cogs nav-icon"></i>
                    <p>{{ __('Settings') }}</p>
                </a>
            </li>
            @endcan --}}



            {{-- <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
            <i class="nav-icon far fa-address-card"></i>
            <p>
                {{__('Status Management')}}
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('status-master.index')}}" class="nav-link" id="roles">
                        <i class="fas fa-book"></i>
                        <p>{{__('Status Master')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('workflow-stage-management.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Stage Management') }}
                        </p>
                    </a>
                </li>
            </ul>
            </li>

            {{-- <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
            <i class="nav-icon far fa-address-card"></i>
            <p>
                {{ __('About us') }}
            </p>
            </a>
            </li>

            <li class="nav-item">
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
    <!-- /.sidebar-menu -->

