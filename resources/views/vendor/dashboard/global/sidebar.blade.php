<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            {{-- MAIN NAVIGATION DIVIDER --}}
            <li class="header">{{ trans('dashboard::dashboard.nav.dividers.main') }}</li>

            {{-- Dashboard Links --}}
            <li class="{{ Ekko::isActiveRoute('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('dashboard::dashboard.nav.dashboard') }}</span>
                </a>
            </li>

            <li class="{{ Ekko::areActiveRoutes([
                    'categories.index', 'categories.show', 'categories.create', 'categories.edit',
                    'sections.index', 'sections.show', 'sections.create', 'sections.edit',
                    'products.index', 'products.show', 'products.create', 'products.edit',
                    'characteristics.index', 'characteristics.show', 'characteristics.create', 'characteristics.edit',
                    'units.index', 'units.show', 'units.create', 'units.edit',
                    'weights.index', 'weights.show', 'weights.create', 'weights.edit',
                    'godowns.index', 'godowns.show', 'godowns.create', 'godowns.edit',
                    'customers.index', 'customers.show', 'customers.create', 'customers.edit'
                ]) }} header treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>MASTERS</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(Sentinel::hasAnyAccess(['admin','view_categories']))

                        {{-- Categories Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['categories.index', 'categories.show', 'categories.create', 'categories.edit']) }} treeview">
                            <a href="{{ route('categories.index') }}">
                                <i class="fa fa-indent"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                    @endif
                        @if(Sentinel::hasAnyAccess(['admin','view_sections']))
                        {{-- Sections Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['sections.index', 'sections.show', 'sections.create', 'sections.edit']) }} treeview">
                            <a href="{{ route('sections.index') }}">
                                <i class="fa fa-outdent"></i>
                                <span>Sections</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_products']))

                        {{-- Products Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['products.index', 'products.show', 'products.create', 'products.edit']) }} treeview">
                            <a href="{{ route('products.index') }}">
                                <i class="fa fa-cubes"></i>
                                <span>Products</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_characteristics']))
                        {{-- Technical charachteristics Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['characteristics.index', 'characteristics.show', 'characteristics.create', 'characteristics.edit']) }} treeview">
                            <a href="{{ route('characteristics.index') }}">
                                <i class="fa fa-tags"></i>
                                <span>Technicals</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_units']))

                        {{-- Units Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['units.index', 'units.show', 'units.create', 'units.edit']) }} treeview">
                            <a href="{{ route('units.index') }}">
                                <i class="fa fa-bar-chart"></i>
                                <span>Units</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_weights']))

                        {{-- Weights charachteristics Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['weights.index', 'weights.show', 'weights.create', 'weights.edit']) }} treeview">
                            <a href="{{ route('weights.index') }}">
                                <i class="fa fa-tachometer"></i>
                                <span>Weights</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_godowns']))

                        {{-- Godowns Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['godowns.index', 'godowns.show', 'godowns.create', 'godowns.edit']) }} treeview">
                            <a href="{{ route('godowns.index') }}">
                                <i class="fa fa-ship"></i>
                                <span>Godowns</span>
                            </a>
                        </li>
                    @endif
                    @if(Sentinel::hasAnyAccess(['admin','view_customers']))
                        {{-- Customers Links --}}
                        <li class="{{ Ekko::areActiveRoutes(['customers.index', 'customers.show', 'customers.create', 'customers.edit']) }} treeview">
                            <a href="{{ route('customers.index') }}">
                                <i class="fa fa-users"></i>
                                <span>Customers</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>

            {{-- Transactions --}}
            <li class="{{ Ekko::areActiveRoutes(['transactions.orders.completed.index', 'transactions.orders.completed.show', 'transactions.orders.create.index', 'transactions.orders.create.select.product', 'transactions.orders.pending.index', 'transactions.orders.pending.show', 'transactions.orders.pending.edit', 'transactions.packing.index', 'transactions.packing.create']) }} header treeview">
                <a href="#">
                    <i class="fa fa-car"></i>
                    <span>Transactions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    {{-- Orders --}}
                    <li class="{{ Ekko::areActiveRoutes(['transactions.orders.completed.index', 'transactions.orders.completed.show', 'transactions.orders.create.index', 'transactions.orders.create.select.product', 'transactions.orders.pending.index', 'transactions.orders.pending.show', 'transactions.orders.pending.edit']) }} treeview">
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Orders</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Ekko::areActiveRoutes(['transactions.orders.completed.index', 'transactions.orders.completed.show']) }}">
                                <a href="{{ route('transactions.orders.completed.index') }}">Completed Orders</a>
                            </li>
                            <li class="{{ Ekko::areActiveRoutes(['transactions.orders.create.index', 'transactions.orders.create.select.product']) }}">
                                <a href="{{ route('transactions.orders.create.index') }}">Create New Order</a>
                            </li>
                            <li class="{{ Ekko::areActiveRoutes(['transactions.orders.pending.index', 'transactions.orders.pending.show', 'transactions.orders.pending.edit']) }}">
                                <a href="{{ route('transactions.orders.pending.index') }}">Pending Orders</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Packing Slip --}}
                    <li class="{{ Ekko::areActiveRoutes(['transactions.packing.index', 'transactions.packing.create']) }} treeview">
                        <a href="#">
                            <i class="fa fa-inbox"></i>
                            <span>Packing Slip</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Ekko::isActiveRoute('transactions.packing.index') }}">
                                <a href="{{ route('transactions.packing.index') }}">View Packing Slips</a>
                            </li>
                            <li class="{{ Ekko::isActiveRoute('transactions.packing.create') }}">
                                <a href="{{ route('transactions.packing.create') }}">Create New Packing Slip</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- SMS MANAGEMENT Links --}}
            <li class="{{ Ekko::areActiveRoutes(['sms.sent.index', 'sms.sent.show', 'sms.send.index', 'sms.templates.index', 'sms.templates.create', 'sms.templates.show', 'sms.settings.index', 'sms.settings.create']) }} header treeview">
                <a href="#">
                    <i class="fa fa-inbox"></i>
                    <span>SMS Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Ekko::areActiveRoutes(['sms.sent.index', 'sms.sent.show']) }}">
                        <a href="{{ route('sms.sent.index') }}">Sent SMS</a>
                    </li>
                    <li class="{{ Ekko::isActiveRoute('sms.send.index') }}">
                        <a href="{{ route('sms.send.index') }}">Send SMS</a>
                    </li>
                    <li class="{{ Ekko::areActiveRoutes(['sms.templates.index', 'sms.templates.create', 'sms.templates.show']) }}">
                        <a href="{{ route('sms.templates.index') }}">SMS Templates</a>
                    </li>

                    {{-- SMS Settings --}}
                    <li class="{{ Ekko::areActiveRoutes(['sms.settings.index', 'sms.settings.create']) }} treeview">
                        <a href="#">
                            <i class="fa fa-inbox"></i>
                            <span>SMS Settings</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Ekko::isActiveRoute('sms.settings.index') }}">
                                <a href="{{ route('sms.settings.index') }}">SMS Settings</a>
                            </li>
                            <li class="{{ Ekko::isActiveRoute('sms.settings.create') }}">
                                <a href="{{ route('sms.settings.create') }}">Add New SMS Setting</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- User MANAGEMENT Links --}}
            <li class="{{ Ekko::areActiveRoutes(['users.index', 'users.create', 'users.edit', 'roles.index', 'roles.create', 'roles.edit', 'permissions.index', 'permissions.create', 'permissions.edit']) }} header treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>USER MANAGEMENT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Ekko::isActiveRoute('users.index') }}">
                        <a href="{{ route('users.index') }}">{{ trans('dashboard::dashboard.nav.user.all') }}</a></li>
                    <li class="{{ Ekko::isActiveRoute('users.create') }}">
                        <a href="{{ route('users.create') }}">{{ trans('dashboard::dashboard.nav.user.create') }}</a>
                    </li>

                    {{-- Role Links --}}
                    <li class="{{ Ekko::areActiveRoutes(['roles.index', 'roles.create', 'roles.edit']) }} treeview">
                        <a href="#">
                            <i class="fa fa-shield"></i>
                            <span>{{ trans('dashboard::dashboard.nav.role.title') }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Ekko::isActiveRoute('roles.index') }}">
                                <a href="{{ route('roles.index') }}">{{ trans('dashboard::dashboard.nav.role.all') }}</a>
                            </li>
                            <li class="{{ Ekko::isActiveRoute('roles.create') }}">
                                <a href="{{ route('roles.create') }}">{{ trans('dashboard::dashboard.nav.role.create') }}</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Permission Links --}}
                    <li class="{{ Ekko::areActiveRoutes(['permissions.index', 'permissions.create', 'permissions.edit']) }} treeview">
                        <a href="#">
                            <i class="fa fa-unlock-alt"></i>
                            <span>{{ trans('dashboard::dashboard.nav.permission.title') }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Ekko::isActiveRoute('permissions.index') }}">
                                <a href="{{ route('permissions.index') }}">{{ trans('dashboard::dashboard.nav.permission.all') }}</a>
                            </li>
                            <li class="{{ Ekko::isActiveRoute('permissions.create') }}">
                                <a href="{{ route('permissions.create') }}">{{ trans('dashboard::dashboard.nav.permission.create') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            @foreach($modules->getRegistered() as $module)
                {{-- Module name as title --}}
                <li class="header">{{ strtoupper($module->getName()) }}</li>
                {{-- loop through each primary menu items --}}
                @foreach($module->getMenuItems() as $label => $linkOptions)
                    <li class="{{ Ekko::areActiveURLs(array_pluck(array_where(array_get($linkOptions, 'items', []), function($key, $value) { return array_get($value, 'href', '#'); }), 'href')) }}">
                        <a href="{{ array_get($linkOptions, 'href', '#') }}">
                            {{-- include an icon, either as a template include or as a class --}}
                            @if(array_get($linkOptions, 'icon'))
                                @if(strstr(array_get($linkOptions, 'icon'), ':'))
                                    @include(array_get($linkOptions, 'icon'))
                                @else
                                    <i class="{{ array_get($linkOptions, 'icon') }}"></i>
                                @endif
                            @endif
                            {{-- label of the primary menu item --}}
                            <span>{{ $label }}</span>
                            {{-- add a dropdown icon if sub items exist --}}
                            @if(array_get($linkOptions, 'items'))
                                <i class="fa fa-angle-left pull-right"></i>
                            @endif
                        </a>
                        {{-- loop through each menu sub item --}}
                        @if(array_get($linkOptions, 'items'))
                            <ul class="treeview-menu">
                                @foreach(array_get($linkOptions, 'items', []) as $label => $linkOptions)
                                    <li class="{{ Ekko::isActiveURL(array_get($linkOptions, 'href', '#')) }}">
                                        <a href="{{ array_get($linkOptions, 'href', '#') }}">
                                            @if(array_get($linkOptions, 'icon'))
                                                @if(strstr(array_get($linkOptions, 'icon'), ':'))
                                                    @include(array_get($linkOptions, 'icon'))
                                                @else
                                                    <i class="{{ array_get($linkOptions, 'icon') }}"></i>
                                                @endif
                                            @endif
                                            <span>{{ $label }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endforeach

        </ul>
    </section>
</aside>