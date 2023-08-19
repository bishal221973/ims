@extends('layouts.app')
@section('title','Sales-Payment')
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
                                        Sales Payment
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
                        <div class="pd-20 card mb-2">
                            <h5 class="text-center">{{ $organization->organization_name }}</h5>
                            <p class="col-12 text-center">{{ $organization->organization_address }}</p>

                            <div class="col-12 d-flex justify-content-between mt-5">
                                <div>
                                    <span>
                                        <b>Vat Number:</b> {{ $organization->vat_number }}
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <b>Transaction Date:</b> {{ $sales->transaction_date }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 d-flex mt-5">
                                <div>
                                    <span>
                                        <b>Buyer's Name:</b>
                                    </span>
                                </div>
                                <div style="width: 86%;" class="dashed-bottom px-3">{{ $sales->customer->name }}
                                </div>
                            </div>
                            <div class="col-12 d-flex mt-3">
                                <div>
                                    <span>
                                        <b>Address:</b>
                                    </span>
                                </div>
                                <div style="width: 95%;" class="dashed-bottom px-3">
                                    {{ $sales->customer->address }}</div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-5">
                                <div>
                                    <span>
                                        <b>Invoice number:</b>
                                    </span>
                                </div>
                                <div class="dashed-bottom px-3">{{ $sales->invoice_number }}</div>
                            </div>

                            <div class="mt-5">
                                <table class="myTable col-12" border="1">
                                    <tr>
                                        <th>SN</th>
                                        <th>Particular</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>

                                    @foreach ($sales->salesProduct as $key => $item)
                                        @php
                                            $total = $sales->salesProduct->count();
                                        @endphp
                                        <tr class="{{ $key + 1 == $total ? 'lastRow' : 'firstTr' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }} ({{ $item->product->unit->name }})</td>
                                            <td>RS. {{ $item->price }} /-</td>
                                            <td>RS. {{ $item->quantity * $item->price }} /-</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" rowspan="{{ $sales->tax->count() + 4 }}">
                                            <strong>In Word : <label id="inWord"></label></strong>
                                        </td>
                                        <td colspan="2">
                                            <strong>Sub total</strong>
                                        </td>
                                        <td colspan="2">
                                            RS. {{ $sales->salesAmount->subtotal }} /-
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="2">
                                            <strong>Discount</strong>
                                        </td>
                                        <td colspan="2">
                                            RS. {{ $sales->salesAmount->discount }} /-
                                        </td>
                                    </tr>

                                    <tr>

                                        <td colspan="2">
                                            <strong>Taxable Amount</strong>
                                        </td>
                                        <td colspan="2">
                                            RS. {{ $sales->salesAmount->taxable_amount }} /-
                                        </td>
                                    </tr>

                                    @foreach ($sales->tax as $key => $tax)
                                        <tr>
                                            <td colspan="2">
                                                <strong>{{ $tax->tax_name }} ({{ $tax->tax_rate }}%)</strong>
                                            </td>
                                            <td colspan="2">
                                                RS. {{ $sales->salesAmount->taxable_amount * ($tax->tax_rate / 100) }}/-
                                            </td>
                                            @php
                                            @endphp
                                        </tr>
                                    @endforeach

                                    <tr>

                                        <td colspan="2">
                                            <strong>Grand Total</strong>
                                        </td>
                                        <td colspan="2">
                                            <label>RS. <span id="grandTotal"> {{ $sales->salesAmount->grand_total }}
                                                </span>/-</label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <form action="{{ route('paySales') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sales_id" value="{{ $sales->id }}">
                            <div class="pd-20 card mb-2">
                                <div class="rotm-group">
                                    <label>{{ $edit ? 'Remaining Amount' : 'Total Price (including all taxs)' }}</label>
                                    <input type="text" name="total" class="form-control" readonly
                                        value="{{ $edit ? $sales->due : $sales->salesAmount->grand_total }}">
                                </div>
                                <div class="rotm-group mt-3">
                                    <label>Paying Amount :*</label>
                                    <input type="text" name="paying" class="form-control" required>
                                </div>

                                <div class="row px-3 mt-3">
                                    <div class="form-check col-xl-3">
                                        <input class="form-check-input" type="radio" name="pay_through"
                                            id="flexRadioDefault1" value="Cash Payment">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="form-check col-xl-3">
                                        <input class="form-check-input" type="radio" name="pay_through"
                                            id="flexRadioDefault2" value="Cheque Payment">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Cheque
                                        </label>
                                    </div>
                                    <div class="form-check col-xl-3">
                                        <input class="form-check-input" type="radio" name="pay_through"
                                            id="flexRadioDefault2" value="Credit Payment">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Credit
                                        </label>
                                    </div>
                                    <div class="form-check col-xl-3">
                                        <input class="form-check-input" type="radio" name="pay_through"
                                            id="flexRadioDefault2" value="Other Payment">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="pd-20 card-box mb-2 d-flex justify-content-end">
                                <input type="submit" value="Pay Amount" class="btn btn-warning text-white">
                            </div>

                        </form>
                    </div>

                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
