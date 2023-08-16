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
                                        Sales Report
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
                    <div class="col-xl-12">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                            </div>
                            <div class="pb-20">
                                <table class="table hover multiple-select-row data-table-export nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Sales Rate</th>
                                            <th>Customer Name</th>
                                            <th>Transaction Date</th>
                                            <th>Invoice Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $purchase)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$purchase->product->name}}</td>
                                            <td>{{$purchase->quantity}} ({{$purchase->product->unit->name}})</td>
                                            <td>RS. {{$purchase->price}} /-</td>
                                            <td>{{$purchase->sales->customer->name}}</td>
                                            <td>{{$purchase->sales->transaction_date}}</td>
                                            <td>{{$purchase->sales->invoice_number}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
