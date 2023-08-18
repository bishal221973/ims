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
                                        Tax
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
                    <div class="col-xl-5">
                        <div class="pd-20 card-box mb-2">
                            <form action="{{ $tax->id ? route('tax.update',$tax) : route('tax.store') }}" method="POST">
                                @csrf
                                @isset($tax->id)
                                    @method('PUT')
                                @endisset
                                <div class="form-group">
                                    <label>Tax Name :*</label>

                                    <input type="text" name="name" value="{{ old('name',$tax->name) }}" class="form-control" required/>
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tax Rate (%) :*</label>

                                    <input type="number" name="value" value="{{ old('value',$tax->value) }}" class="form-control" required/>
                                    @error('value')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="{{$tax->id ? "Update" : "Save"}}" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                            </div>
                            <div class="pb-20">
                                <table class="data-table table hover  nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th class="table-plus datatable-nosort">Name</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($taxs as $tax)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$tax->name  }}</td>
                                                <td>{{$tax->value  }} %</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('tax.edit', $tax) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('tax.delete', $tax->id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are you sure to delete ?')"
                                                                class="form-inline d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="dropdown-item"><i
                                                                        class="dw dw-delete-3"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
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
