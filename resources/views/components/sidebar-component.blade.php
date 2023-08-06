<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="index.html">Dashboard</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-textarea-resize"></span><span class="mtext">Products</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('product.index') }}">Product</a></li>
                        <li><a href="{{ route('category.index') }}">Category</a></li>
                        <li><a href="{{ route('brand.index') }}">Brand</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-table"></span><span class="mtext">Sales</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('sales.index') }}">Sales List</a></li>
                        <li><a href="{{ route('sales.create') }}">New Sales</a></li>
                        <li><a href="{{ route('salesreturn.index') }}">Sales Return</a></li>
                        <li><a href="{{ route('customer.index') }}">New Customer</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-archive"></span><span class="mtext"> Purchase </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('purchase.index') }}">Purchase List</a></li>
                        <li><a href="{{ route('purchase.create') }}">New Purchase</a></li>
                        <li><a href="{{ route('supplier.index') }}">Supplier</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-command"></span><span class="mtext">Report</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('purchaseReport')}}">Purchase Report</a></li>
                        <li><a href="{{route('inventoryReport')}}">Inventory Report</a></li>
                        <li><a href="{{route('salesReport')}}">Sales Report</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-pie-chart"></span><span class="mtext">Places</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('country.index') }}">Country</a></li>
                        <li><a href="{{ route('province.index') }}">Province</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Role</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('role.index')}}">Role List</a></li>
                        <li><a href="{{route('role.create')}}">New Role</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-bug"></span><span class="mtext">Project</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="400.html">New Project</a></li>
                        <li><a href="403.html">Assign Project</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-back"></span><span class="mtext">Employee</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('employee.index')}}">Employee List</a></li>
                        <li><a href="{{route('employee.create')}}">New Employee</a></li>
                        <li><a href="blog.html">Time Schedule</a></li>
                    </ul>
                </li>
                @role('super-admin')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-hdd-stack"></span><span class="mtext">Organization</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('organization.create') }}">New Organization</a></li>
                            <li><a href="{{ route('organization.index') }}">List Organization</a></li>
                            <li><a href="{{ route('branch.create') }}">New Branch</a></li>
                            <li><a href="{{ route('branch.index') }}">List Branch</a></li>
                        </ul>
                    </li>
                @endrole
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-pdf"></span><span class="mtext">Configurations</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('tax.index') }}">Tax</a></li>
                        <li><a href="{{ route('fiscalyear.index') }}">Fiscal Year</a></li>
                        <li><a href="{{ route('unit.index') }}">Unit</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
