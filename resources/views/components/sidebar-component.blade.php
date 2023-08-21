<div class="left-side-bar">
    <div class="brand-logo">
        @php
            $org = App\Models\Organization::where('id', orgId())->first();
        @endphp
        <a href="{{ route('home') }}" class="py-2">
            @if ($org)
                @if ($org->logo)
                    <img src="{{ asset('storage') }}{{ '/' }}{{ $org->logo }}" alt="">
                @else
                    <img src="{{ asset('logo.png') }}" alt="" class="light-logo" />
                @endif
            @else
                <img src="{{ asset('logo.png') }}" alt="" class="light-logo" />

            @endif
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('home') }}" class="dropdown-toggle">
                        <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                    </a>
                </li>
                @canany(['product_read', 'product_create', 'product_edit', 'product_delete', 'category_read',
                    'category_create', 'category_edit', 'category_delete', 'brand_read', 'brand_create', 'brand_edit',
                    'brand_delete'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-textarea-resize"></span><span class="mtext">Products</span>
                        </a>
                        <ul class="submenu">
                            @canany('product_create', 'product_read', 'product_edit', 'product_delete')
                                <li><a href="{{ route('product.index') }}">Product</a></li>
                            @endcanany
                            @canany(['category_create', 'category_read', 'category_edit', 'category_delete'])
                                <li><a href="{{ route('category.index') }}">Category</a></li>
                            @endcanany
                            @canany(['brand_create', 'brand_read', 'brand_edit', 'brand_delete'])
                                <li><a href="{{ route('brand.index') }}">Brand</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['sales_read', 'sales_edit', 'sales_delete', 'sales_create', 'sales_return_read',
                    'sales_return_create', 'sales_return_edit', 'sales_return_delete', 'customer_read', 'customer_create',
                    'customer_edit', 'customer_delete'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-table"></span><span class="mtext">Sales</span>
                        </a>
                        <ul class="submenu">
                            @canany(['sales_read', 'sales_edit', 'sales_delete'])
                                <li><a href="{{ route('sales.index') }}">Sales List</a></li>
                            @endcanany
                            @canany(['sales_create'])
                                <li><a href="{{ route('sales.create') }}">New Sales</a></li>
                            @endcanany
                            @canany(['sales_return_create', 'sales_return_read', 'sales_return_edit',
                                'sales_return_delete'])
                                <li><a href="{{ route('salesreturn.index') }}">Sales Return</a></li>
                            @endcanany
                            @canany(['customer_create', 'customer_read', 'customer_edit', 'customer_delete'])
                                <li><a href="{{ route('customer.index') }}">New Customer</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['purchase_read', 'purchase_edit', 'purchase_delete', 'purchase_create', 'supplier_read',
                    'supplier_create', 'supplier_edit', 'supplier_delete'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-archive"></span><span class="mtext"> Purchase </span>
                        </a>
                        <ul class="submenu">
                            @canany(['purchase_read', 'purchase_edit', 'purchase_delete'])
                                <li><a href="{{ route('purchase.index') }}">Purchase List</a></li>
                            @endcanany
                            @canany(['purchase_create'])
                                <li><a href="{{ route('purchase.create') }}">New Purchase</a></li>
                            @endcanany
                            @canany(['supplier_create', 'supplier_read', 'supplier_edit', 'supplier_delete'])
                                <li><a href="{{ route('supplier.index') }}">Supplier</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['report_purchase', 'report_inventory', 'report_sales'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-command"></span><span class="mtext">Report</span>
                        </a>
                        <ul class="submenu">
                            @can('report_purchase')
                                <li><a href="{{ route('purchaseReport') }}">Purchase Report</a></li>
                            @endcan
                            @can('report_inventory')
                                <li><a href="{{ route('inventoryReport') }}">Inventory Report</a></li>
                            @endcan
                            @can('report_sales')
                                <li><a href="{{ route('salesReport') }}">Sales Report</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['country_read', 'country_create', 'country_edit', 'country_delete', 'province_read',
                    'province_create', 'province_edit', 'province_delete'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-pie-chart"></span><span class="mtext">Places</span>
                        </a>
                        <ul class="submenu">
                            @canany(['country_read', 'country_create', 'country_edit', 'country_delete'])
                                <li><a href="{{ route('country.index') }}">Country</a></li>
                            @endcanany
                            @canany(['province_create', 'province_read', 'province_edit', 'province_delete'])
                                <li><a href="{{ route('province.index') }}">Province</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['role_read', 'role_edit', 'role_delete', 'role_create'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Role</span>
                        </a>
                        <ul class="submenu">
                            @canany(['role_read', 'role_edit', 'role_delete'])
                                <li><a href="{{ route('role.index') }}">Role List</a></li>
                            @endcanany
                            @canany(['role_create'])
                                <li><a href="{{ route('role.create') }}">New Role</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['project_read', 'project_create', 'project_edit', 'project_delete', 'assign_project_read',
                    'assign_project_create', 'assign_project_edit', 'assign_project_delete'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-bug"></span><span class="mtext">Project</span>
                        </a>
                        <ul class="submenu">
                            @canany(['project_create', 'project_read', 'project_edit', 'project_delete'])
                                <li><a href="{{ route('project.index') }}">New Project</a></li>
                            @endcanany
                            @canany(['assign_project_create', 'assign_project_read', 'assign_project_edit',
                                'assign_project_delete'])
                                <li><a href="{{ route('assign-project.index') }}">Assign Project</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany


                @canany(['employee_read', 'employee_edit', 'employee_delete', 'employee_create', 'schedule_read',
                    'schedule_create', 'schedule_edit', 'schedule_delete', 'salary_read', 'salary_payment'])
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-back"></span><span class="mtext">Employee</span>
                        </a>
                        <ul class="submenu">
                            @canany('employee_read', 'employee_edit', 'employee_delete')
                                <li><a href="{{ route('employee.index') }}">Employee List</a></li>
                            @endcanany
                            @canany(['employee_create'])
                                <li><a href="{{ route('employee.create') }}">New Employee</a></li>
                            @endcanany
                            @canany(['schedule_create', 'schedule_read', 'schedule_edit', 'schedule_delete'])
                                <li><a href="{{ route('schedule.index') }}">Time Schedule</a></li>
                            @endcanany
                            @canany(['salary_read', 'salary_payment'])
                                <li><a href="{{ route('salary.index') }}">Salary</a></li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
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
                @role('admin')
                    @canany(['branch_create', 'branch_read', 'branch_edit', 'branch_delete'])
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-hdd-stack"></span><span class="mtext">Branch</span>
                            </a>
                            <ul class="submenu">
                                @canany(['branch_create'])
                                    <li><a href="{{ route('branch.create') }}">New Branch</a></li>
                                @endcanany
                                @canany(['branch_read', 'branch_edit', 'branch_delete'])
                                    <li><a href="{{ route('branch.index') }}">List Branch</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany
                @endrole
                @canany(['tax_read', 'tax_create', 'tax_edit', 'tax_delete', 'fiscalYear_read', 'fiscalYear_create',
                    'fiscalYear_edit', 'fiscalYear_delete', 'unit_read', 'unit_create', 'unit_edit', 'unit_delete'])
                    <li>
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-file-pdf"></span><span class="mtext">Configurations</span>
                        </a>
                        <ul class="submenu">
                            @canany(['tax_read', 'tax_create', 'tax_edit', 'tax_delete'])
                                <li><a href="{{ route('tax.index') }}">Tax</a></li>
                            @endcanany
                            @canany(['fiscalYear_read', 'fiscalYear_create', 'fiscalYear_edit', 'fiscalYear_delete'])
                                <li><a href="{{ route('fiscalyear.index') }}">Fiscal Year</a></li>
                            @endcanany
                            @canany(['unit_create', 'unit_read', 'unit_edit', 'unit_delete'])
                                <li><a href="{{ route('unit.index') }}">Unit</a></li>
                            @endcanany
                            {{-- <li><a href="{{ route('leaveType.index') }}">Leave Type</a></li> --}}
                        </ul>
                    </li>
                @endcanany
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-pdf"></span><span class="mtext">Attendance</span>
                    </a>
                    <ul class="submenu">
                        @can('list_attendance')
                            <li><a href="{{ route('attendance.list') }}">Attendance List</a></li>
                        @endcan
                        <li><a href="{{ route('attendance.index') }}">Attendance</a></li>
                        @hasanyrole('super-admin|admin')
                            <li><a href="{{ route('leave.list') }}">Leave List</a></li>
                        @endhasanyrole
                        <li><a href="{{ route('leave.index') }}">Leave</a></li>
                        @canany(['holyday_create', 'holyday_read', 'holyday_edit', 'holyday_delete'])
                            <li><a href="{{ route('holey-day.index') }}">HoleyDay</a></li>
                        @endcanany
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>
