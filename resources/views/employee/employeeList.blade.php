@extends('layouts.app')
@section('title', 'Employee')
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
                                        Employee
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right d-flex align-items-center justify-content-end">
                            <a href="{{ route('employee.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i>
                                New Employee</a>
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

                <!-- multiple select row Datatable start -->
                @can('employee_read')
                    <div class="card mb-30">
                        <div class="pd-20">
                        </div>
                        <div class="pb-20">
                            {{-- multiple-select-row --}}
                            <table class="data-table table hover  nowrap">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Branch</th>
                                        <th>Employee name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $employee->branch->branch_name }}</td>
                                            <td>{{ $employee->user->name }}</td>
                                            <td>{{ $employee->user->email }}</td>
                                            <td>
                                                @foreach ($employee->user->roles as $role)
                                                    <span class="badge bg-info text-white">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $employee->user->dob }}</td>
                                            <td>{{ $employee->user->gender }}</td>
                                            <td>{{ $employee->user->phone }}</td>
                                            <td>{{ $employee->joining_date }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        @can('employee_edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('employee.edit', $employee) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                        @endcan
                                                        @can('employee_delete')
                                                            <form action="{{ route('employee.delete', $employee) }}" method="post"
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
                @endcan
                <!-- multiple select row Datatable End -->

            </div>

        </div>
    </div>
@endsection
