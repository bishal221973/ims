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
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Time Schedule
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
                        <div class="pd-20 card-box mb-2">
                            <form action="{{$schedule->id ? route('schedule.update',$schedule->id) : route('schedule.store') }}" method="POST">
                                @csrf
                                @isset($schedule->id)
                                    @method('PUT')
                                @endisset
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Branch Name :</label>
                                            <select class="custom-select2 form-control" name="branch_id"
                                                style="width: 100%; height: 38px" id="schedule_branch_id">
                                                <option value="" selected disabled>Please select a branch</option>

                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ $branch->id == $schedule->branch_id ? 'selected' : '' }}>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name :</label>
                                            @if ($schedule->id)
                                                <select class="custom-select2 form-control" name="employee_id"
                                                    style="width: 100%; height: 38px" id=""
                                                    {{ $schedule->id ? 'disabled' : '' }}>
                                                    <option value="" selected disabled>{{$schedule->employee->user->name}}
                                                    </option>

                                                    {{-- @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->user->name }}</option>
                                            @endforeach --}}
                                                </select>
                                                @error('supplier_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            @else
                                                <select class="custom-select2 form-control" name="employee_id"
                                                    style="width: 100%; height: 38px" id="scheduleEmployeeId">
                                                    <option value="" selected disabled>Please select an employee
                                                    </option>

                                                    {{-- @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->user->name }}</option>
                                            @endforeach --}}
                                                </select>
                                                @error('supplier_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group">
                                            <label>In Time *:</label>

                                            <input class="form-control time-picker" value="{{old('in_time',$schedule->in_time)}}" name="in_time" placeholder="time"
                                                type="text" />
                                            @error('in_time')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group">
                                            <label>Out Time *:</label>

                                            <input class="form-control time-picker" value="{{old('out_time',$schedule->out_time)}}" name="out_time" placeholder="time"
                                                type="text" />
                                            @error('out_time')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="{{$schedule->id ? 'Update' : 'Save'}}" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                            </div>
                            <div class="pb-20">
                                <table class="data-table table hover  nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Branch</th>
                                            <th>Employee</th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Working Hour</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $schedule->branch->branch_name }}</td>
                                                <td>{{ $schedule->employee->user->name }}</td>
                                                <td>{{ $schedule->in_time }}</td>
                                                <td>{{ $schedule->out_time }}</td>
                                                <td>{{ $schedule->hour($schedule->in_time, $schedule->out_time) }} Hour</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('schedule.edit', $schedule->id) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('schedule.delete', $schedule) }}"
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
