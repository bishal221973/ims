@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header" style="margin-bottom: 7px">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">

                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">Home</a>
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
                    <div class="col-xl-7">
                        <div class="pd-20 card-box mb-2">
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
                                                <th>Quantity</th>
                                                <th>Sales Rate</th>
                                                <th>Return Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myData">

                                        </tbody>
                                    </table>

                                    <div class="col-12 d-flex justify-content-end">
                                        <input type="submit" value="Return" class="btn btn-warning text-white mt-3">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="card-box mb-30">

                        </div>
                    </div>
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
