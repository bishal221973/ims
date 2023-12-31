


@extends('layouts.app')
@section('Home')
@section('content')
    @php
        $totalPurchaseDue = 0;
        $totalSalesDue = 0;
        $org_id = orgId();
        $fiscal_year = App\Models\FiscalYear::select('id')
            ->where('status', 1)
            ->where('organization_id', $org_id)
            ->first();
    @endphp
    @if (Session::has('success'))
        @php
            $msg = Session::get('success');
        @endphp

        @push('message')
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: '{{ $msg }}'
                })
            </script>
        @endpush
    @endif

    @if (Session::has('error'))
        @php
            $msg = Session::get('error');
        @endphp

        @push('message')
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: '{{ $msg }}'
                })
            </script>
        @endpush
    @endif
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    @if ($fiscal_year)
                                        @foreach (App\Models\Purchase::select('due')->where('fiscal_year_id', $fiscal_year->id)->where('organization_id', $org_id)->get() as $item)
                                            @php
                                                $totalPurchaseDue = $totalPurchaseDue + $item->due;
                                            @endphp
                                        @endforeach
                                    @else
                                        @php
                                            $totalPurchaseDue = 0;
                                        @endphp
                                    @endif
                                    RS. {{ $totalPurchaseDue }} /-
                                </div>
                                <div class="font-14 text-secondary weight-500">
                                    Purchase Due
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    {{-- <i class="icon-copy dw dw-calendar1"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    @if ($fiscal_year)
                                        @foreach (App\Models\Sales::select('due')->where('fiscal_year_id', $fiscal_year->id)->where('organization_id', $org_id)->get() as $item)
                                            @php
                                                $totalSalesDue = $totalSalesDue + $item->due;
                                            @endphp
                                        @endforeach
                                    @else
                                        @php
                                            $totalSalesDue = 0;
                                        @endphp
                                    @endif
                                    RS. {{ $totalSalesDue }} /-
                                </div>
                                <div class="font-14 text-secondary weight-500">
                                    Sales Due
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                    {{-- <span class="icon-copy ti-heart"></span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    RS. <span id="purchaseText">0</span> /-
                                </div>
                                <div class="font-14 text-secondary weight-500">
                                    Purchase in this month
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon">
                                    <i class="fa-solid fa-cubes-stacked"></i>
                                    {{-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"> RS. <span id="salesText">0</span> /-
                                </div>
                                <div class="font-14 text-secondary weight-500">Sales in this month</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#09cc06">
                                    <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <a href="{{ route('employee.index') }}" class="card-box height-100-p widget-style3">
                        <div class="d-flex bg-white flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    {{ App\Models\Employee::where('organization_id', $org_id)->get()->count() }}</div>
                                <div class="font-14 text-secondary weight-500">
                                    Employee
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-users fa-2x"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <a href="{{ route('supplier.index') }}" class="bg-white card-box height-100-p widget-style3">
                        <div class="d-flex bg-white rounded flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    {{ App\Models\Supplier::where('organization_id', $org_id)->get()->count() }}
                                </div>
                                <div class="font-14 text-secondary weight-500">
                                    Supplier
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-shop fa-2x"></i>
                                {{-- <i class="fa-solid fa-user-tie fa-2x"></i> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <a href="{{ route('customer.index') }}" class="card-box height-100-p widget-style3">
                        <div class="bg-white d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    {{ App\Models\Customer::where('organization_id', $org_id)->get()->count() }}</div>
                                <div class="font-14 text-secondary weight-500">
                                    Customer
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-user fa-2x"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <a href="{{ route('product.index') }}" class="card-box height-100-p widget-style3">
                        <div class="bg-white d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">
                                    {{ App\Models\Product::where('organization_id', $org_id)->get()->count() }}</div>
                                <div class="font-14 text-secondary weight-500">Total Product</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-laptop fa-2x"></i>
                                {{-- <i class="fa-solid fa-user-tie fa-2x"></i> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- <div class="row pb-10">
                <div class="col-md-8 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                            <div class="h5 mb-md-0">Hospital Activities</div>
                            <div class="form-group mb-md-0">
                                <select class="form-control form-control-sm selectpicker">
                                    <option value="">Last Week</option>
                                    <option value="">Last Month</option>
                                    <option value="">Last 6 Month</option>
                                    <option value="">Last 1 year</option>
                                </select>
                            </div>
                        </div>
                        <div id="activities-chart"></div>
                    </div>
                </div>
                <div class="col-md-4 mb-20">
                    <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                        <div class="d-flex justify-content-between pb-20 text-white">
                            <div class="icon h1 text-white">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                            </div>
                            <div class="font-14 text-right">
                                <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                                <div class="font-12">Since last month</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="text-white">
                                <div class="font-14">Appointment</div>
                                <div class="font-24 weight-500">1865</div>
                            </div>
                            <div class="max-width-150">
                                <div id="appointment-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                        <div class="d-flex justify-content-between pb-20 text-white">
                            <div class="icon h1 text-white">
                                <i class="fa fa-stethoscope" aria-hidden="true"></i>
                            </div>
                            <div class="font-14 text-right">
                                <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                                <div class="font-12">Since last month</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="text-white">
                                <div class="font-14">Surgery</div>
                                <div class="font-24 weight-500">250</div>
                            </div>
                            <div class="max-width-150">
                                <div id="surgery-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p pd-20 min-height-200px">
                        <div class="d-flex justify-content-between pb-10">
                            <div class="h5 mb-0">Top Doctors</div>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    data-color="#1b3133" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="user-list">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="vendors/images/photo1.jpg" class="border-radius-100 box-shadow"
                                                width="50" height="50" alt="" />
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7">4.9</span>
                                            <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="vendors/images/photo2.jpg" class="border-radius-100 box-shadow"
                                                width="50" height="50" alt="" />
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7">4.9</span>
                                            <div class="font-14 weight-600">Dr. Ren Delan</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="vendors/images/photo3.jpg" class="border-radius-100 box-shadow"
                                                width="50" height="50" alt="" />
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7">4.9</span>
                                            <div class="font-14 weight-600">Dr. Garrett Kincy</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="vendors/images/photo4.jpg" class="border-radius-100 box-shadow"
                                                width="50" height="50" alt="" />
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7">4.9</span>
                                            <div class="font-14 weight-600">Dr. Callie Reed</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p pd-20 min-height-200px">
                        <div class="d-flex justify-content-between">
                            <div class="h5 mb-0">Diseases Report</div>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    data-color="#1b3133" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>
                            </div>
                        </div>

                        <div id="diseases-chart"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-20">
                    <div class="card-box height-100-p pd-20 min-height-200px">
                        <div class="max-width-300 mx-auto">
                            <img src="vendors/images/upgrade.svg" alt="" />
                        </div>
                        <div class="text-center">
                            <div class="h5 mb-1">Upgrade to Pro</div>
                            <div class="font-14 weight-500 max-width-200 mx-auto pb-20" data-color="#a6a6a7">
                                You can enjoy all our features by upgrading to pro.
                            </div>
                            <a href="#" class="btn btn-primary btn-lg">Upgrade</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Recent Patient</div>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus">Name</th>
                            <th>Gender</th>
                            <th>Weight</th>
                            <th>Assigned Doctor</th>
                            <th>Admit Date</th>
                            <th>Disease</th>
                            <th class="datatable-nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo4.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Jennifer O. Oster</div>
                                    </div>
                                </div>
                            </td>
                            <td>Female</td>
                            <td>45 kg</td>
                            <td>Dr. Callie Reed</td>
                            <td>19 Oct 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Typhoid</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo5.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Doris L. Larson</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>76 kg</td>
                            <td>Dr. Ren Delan</td>
                            <td>22 Jul 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Dengue</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo6.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Joseph Powell</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>90 kg</td>
                            <td>Dr. Allen Hannagan</td>
                            <td>15 Nov 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                    data-color="#265ed7">Infection</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo9.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Jake Springer</div>
                                    </div>
                                </div>
                            </td>
                            <td>Female</td>
                            <td>45 kg</td>
                            <td>Dr. Garrett Kincy</td>
                            <td>08 Oct 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Covid
                                    19</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo1.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Paul Buckland</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>76 kg</td>
                            <td>Dr. Maxwell Soltes</td>
                            <td>12 Dec 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Asthma</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo2.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Neil Arnold</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>60 kg</td>
                            <td>Dr. Sebastian Tandon</td>
                            <td>30 Oct 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                    data-color="#265ed7">Diabetes</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo8.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Christian Dyer</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>80 kg</td>
                            <td>Dr. Sebastian Tandon</td>
                            <td>15 Jun 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                    data-color="#265ed7">Diabetes</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo1.jpg" class="border-radius-100 shadow"
                                            width="40" height="40" alt="" />
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Doris L. Larson</div>
                                    </div>
                                </div>
                            </td>
                            <td>Male</td>
                            <td>76 kg</td>
                            <td>Dr. Ren Delan</td>
                            <td>22 Jul 2020</td>
                            <td>
                                <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Dengue</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}


        </div>
    </div>
@endsection
