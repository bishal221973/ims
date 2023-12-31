@extends('layouts.app')
@section('title', 'Unit')
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
                                        Unit
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
                    @canany(['unit_create'])
                        <div class="col-xl-5">
                            <div class="pd-20 card mb-2">
                                <form action="{{ $unit->id ? route('unit.update', $unit) : route('unit.store') }}"
                                    method="POST">
                                    @csrf
                                    @isset($unit->id)
                                        @method('PUT')
                                    @endisset
                                    <div class="form-group">
                                        <label>Unit Name :*</label>

                                        <input type="text" name="name" value="{{ old('name', $unit->name) }}"
                                            class="form-control" required />
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <hr>

                                    <div class="form-group d-flex justify-content-end">
                                        <input type="submit" value="{{ $unit->id ? 'Update' : 'Save' }}" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcanany

                    @canany(['unit_read'])
                        <div class="col-xl-7">
                            <div class="card mb-30">
                                <div class="pd-20">
                                </div>
                                <div class="pb-20">
                                    <table class="data-table table hover  nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th class="table-plus datatable-nosort">Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($units as $unit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $unit->name }}</td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                                href="#" role="button" data-toggle="dropdown">
                                                                <i class="dw dw-more"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                @can('unit_edit')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('unit.edit', $unit) }}"><i
                                                                            class="dw dw-edit2"></i>
                                                                        Edit</a>
                                                                @endcan
                                                                @can('unit_delete')
                                                                    <form action="{{ route('unit.delete', $unit->id) }}"
                                                                        method="post"
                                                                        onsubmit="return confirm('Are you sure to delete ?')"
                                                                        class="form-inline d-inline">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item"><i
                                                                                class="dw dw-delete-3"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                @endcan
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
                    @endcanany
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
