@extends('layouts.app')
@section('title', 'Supplier')
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
                                        Supplier
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
                    @can('supplier_create')
                        <div class="col-xl-12">
                            <div class="pd-20 card mb-2">
                                <form
                                    action="{{ $supplier->id ? route('supplier.update', $supplier) : route('supplier.store') }}"
                                    method="POST">
                                    @csrf
                                    @isset($supplier->id)
                                        @method('PUT')
                                    @endisset
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Branch Name *:</label>

                                                <select class="custom-select2 form-control" required name="branch_id"
                                                    style="width: 100%; height: 38px">
                                                    <option value="" selected disabled>Please select a branch</option>

                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}"
                                                            {{ $branch->branch_name == 'Main Branch' ? 'selected' : '' }}{{ $branch->id == $supplier->branch_id ? 'selected' : '' }}>
                                                            {{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('branch_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Supplier Name *:</label>

                                                <input type="text" name="name" required
                                                    value="{{ old('name', $supplier->name) }}" class="form-control" />
                                                @error('name')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Email :</label>

                                                <input type="text" name="email"
                                                    value="{{ old('email', $supplier->email) }}" class="form-control" />
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Vat Number *:</label>

                                                <input type="text" required name="vat_number"
                                                    value="{{ old('vat_number', $supplier->vat_number) }}"
                                                    class="form-control" />
                                                @error('vat_number')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Phone Number *:</label>

                                                <input type="text" required name="phone"
                                                    value="{{ old('phone', $supplier->phone) }}" class="form-control" />
                                                @error('phone')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Country Name :</label>
                                                <select class="custom-select2 form-control" name="country_id"
                                                    style="width: 100%; height: 38px" id="countryId">
                                                    <option value="" selected disabled>Please select a country</option>

                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}
                                                            {{ $country->id == $supplier->country_id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Province :</label>
                                                <select class="custom-select2 form-control" id="ProvinceId" name="province_id"
                                                    style="width: 100%; height: 38px">
                                                    <option value="" selected disabled>Please select a province</option>

                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}"
                                                            {{ old('province_id') == $province->id ? 'selected' : '' }}
                                                            {{ $province->id == $supplier->province_id ? 'selected' : '' }}>
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Address *:</label>

                                                <input type="text" name="address" required
                                                    value="{{ old('address', $supplier->address) }}" class="form-control" />
                                                @error('address')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="form-group d-flex justify-content-end">
                                        <input type="submit" value="{{ $supplier->id ? 'Update' : 'Save' }}"
                                            class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan

                    @can('supplier_read')

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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Vat Number</th>
                                                <th>Phone Number</th>
                                                <th>Country</th>
                                                <th>Province</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suppliers as $supplier)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $supplier->branch->branch_name }}</td>
                                                    <td>{{ $supplier->name }}</td>
                                                    <td>{{ $supplier->email }}</td>
                                                    <td>{{ $supplier->vat_number }}</td>
                                                    <td>{{ $supplier->phone }}</td>
                                                    <td>{{ $supplier->country ? $supplier->country->name : 'Null' }}</td>
                                                    <td>{{ $supplier->province ? $supplier->province->name : 'Null' }}</td>
                                                    <td>{{ $supplier->address }}</td>


                                                    <td>
                                                        <div class="dropdown">
                                                            @can('supplier_edit')
                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                                    href="#" role="button" data-toggle="dropdown">
                                                                    <i class="dw dw-more"></i>
                                                                </a>
                                                            @endcan
                                                            @can('supplier_delete')
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('supplier.edit', $supplier) }}"><i
                                                                            class="dw dw-edit2"></i>
                                                                        Edit</a>
                                                                    <form action="{{ route('supplier.delete', $supplier->id) }}"
                                                                        method="post"
                                                                        onsubmit="return confirm('Are you sure to delete ?')"
                                                                        class="form-inline d-inline">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item"><i
                                                                                class="dw dw-delete-3"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                </div>
                                                            @endcan
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
