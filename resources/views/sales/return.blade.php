@extends('layouts.app')
@section('title', 'Sales-Return')
@section('content')
    <div class="main-container">
        <div class="mt-4 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card p-0 px-3 mb-2">
                    <div class="row">
                        <div class="col-md-6 pt-3 col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Sales Return
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

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

                <div class="row">
                    @can('sales_return_create')
                        <div class="col-xl-12">
                            <div class="pd-20 card mb-2">
                                <small class="text-danger">Warning: You can not remove or update returned record.</small>

                                <form action="{{ route('salesreturn.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sales_id" id="salesId">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Invoice Number</label>
                                                <input type="number" class="form-control" id="txtSalesInvoiceNumber">
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <input type="text" class="form-control" id="txtSalesCustomerName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Phone number</label>
                                                <input type="text" class="form-control" id="txtSalesCustomerPhone" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Transaction Date</label>
                                                <input type="text" class="form-control" id="txtSalesCustomerDate" readonly>
                                            </div>
                                        </div>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>

                                                    </th>
                                                    <th>Product</th>
                                                    <th>Purchased Quantity</th>
                                                    <th>Sales Rate</th>
                                                    <th>Return Quantity</th>
                                                    <th>Return Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody id="myData">

                                            </tbody>
                                        </table>

                                        <div class="col-12 d-flex justify-content-end">
                                            <input type="submit" value="Return" class="btn btn-info text-white mt-3">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan

                    @can('sales_return_read')
                        <div class="col-xl-12">
                            <div class="card mb-30">
                                <div class="pd-20">
                                </div>
                                <div class="pb-20">
                                    <table class="data-table table hover  nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Branch</th>
                                                <th>Product</th>
                                                <th>Customer</th>
                                                <th>Return Quantity</th>
                                                <th>Return Reason</th>
                                                <th>Return Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salesReturns as $salesReturn)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="font-weight-bold">{{ $salesReturn->branch->branch_name }}</td>
                                                    <td>{{ $salesReturn->product->name }}</td>
                                                    <td>{{ $salesReturn->sales->customer->name }}</td>
                                                    <td>{{ $salesReturn->quantity }} {{ $salesReturn->product->unit->name }}
                                                    </td>
                                                    <td>{{ $salesReturn->reason }}</td>
                                                    <td>{{ $salesReturn->returnDate }}</td>


                                                    <td>
                                                        <div class="dropdown">
                                                            {{-- <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('customer.edit', $customer) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('customer.delete', $customer->id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are you sure to delete ?')"
                                                                class="form-inline d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"><i
                                                                        class="dw dw-delete-3"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </div> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
