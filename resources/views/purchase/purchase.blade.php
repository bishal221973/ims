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
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Purchase
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <form action="{{ route('purchase.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="col-12 p-0 productWrapper">
                                <div class="pd-20 card-box mb-2">
                                    <div class="form-group">
                                        <label>Product *:</label>
                                        <select class="custom-select2 select2 form-control" name="product_id[]"
                                            style="width: 100%; height: 38px" required>
                                            <option value="" selected disabled>Please select a product</option>

                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantity *:</label>
                                                <input type="number" class="form-control" name="quantity[]" required>
                                                @error('quantity')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price *:</label>
                                                <input type="number" class="form-control" name="price[]" required>
                                                @error('price')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-20 card-box mb-2 d-flex justify-content-end">
                                <button class="btn btn-info" type="button" id="btnAddProduct">Add</button>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="pd-20 card-box mb-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Supplier Name :</label>
                                            <select class="custom-select2 select2 form-control" name="supplier_id"
                                                style="width: 100%; height: 38px" required>

                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">
                                                        {{ $supplier->name }} ({{ $supplier->phone }})</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transaction Date :</label>
                                            <input type="text" class="form-control" id="nepali-datepicker"
                                                name="transaction_date" required>
                                            @error('transaction_date')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name :</label>
                                            <select class="custom-select2 form-control" name="branch_id"
                                                style="width: 100%; height: 38px">
                                                <option value="" selected disabled>Please select a branch</option>

                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ $branch->branch_name == 'Main Branch' ? 'selected' : '' }}>
                                                        {{ $branch->branch_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Invoice Number :</label>
                                            <input type="number" class="form-control" name="invoice_number" required>
                                            @error('invoice_number')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount :</label>
                                            <input type="number" class="form-control" name="discount" required>
                                            @error('discount')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pd-20 card-box mb-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Tax :</label>
                                            <select class="custom-select2 select2 form-control" name="tax[]"
                                                style="width: 100%; height: 38px" required multiple>

                                                @foreach ($taxs as $tax)
                                                    <option value="{{ $tax->id }}">
                                                        {{ $tax->name }} ({{ $tax->value }}%)</option>
                                                @endforeach
                                            </select>
                                            @error('price')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="pd-20 card-box mb-2 d-flex justify-content-end">
                                <input type="submit" value="Save Purchase" class="btn btn-info">
                            </div>
                        </div>




                    </div>
                </form>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection


@push('addProduct')
    <script>


        $("#btnAddProduct").on('click', function() {

            var currentRoute = '{{ \Request::route()->getName() }}';
            var productWrapper = $('.productWrapper');
            if (currentRoute == "purchase.create") {
                var myfieldHtml1 = ` <div class="pd-20 card-box mb-2">
                                    <div class="form-group">
                                        <label>Product *:</label>
                                        <select class="custom-select2 select2 form-control" name="product_id[]"
                                            style="width: 100%; height: 38px" required>
                                            <option value="" selected disabled>Please select a product</option>

                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantity *:</label>
                                                <input type="number" class="form-control" name="quantity[]" required>
                                                @error('quantity')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price *:</label>
                                                <input type="number" class="form-control" name="price[]" required>
                                                @error('price')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
            }


            $(productWrapper).append(myfieldHtml1);
            $('.select2').select2();
        });
    </script>
@endpush
