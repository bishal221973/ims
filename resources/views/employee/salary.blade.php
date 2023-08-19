@extends('layouts.app')
@section('title','Salary')
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
                                        Salary
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

                <!-- multiple select row Datatable start -->
                <div class="card mb-30">
                    <div class="pd-20">
                    </div>
                    <div class="pb-20">
                        {{-- multiple-select-row --}}
                        <table class="data-table table hover  nowrap">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Employee</th>
                                    <th>Shift</th>
                                    <th>Last Payment Date</th>
                                    <th>Worked Time</th>
                                    <th>Salary (per hour)</th>
                                    <th>Total Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->user->name }} <br> {{ $employee->user->email }}</td>
                                        <td>
                                            From : {{ $employee->schedule ? $employee->schedule->in_time : 'NULL' }} <br>
                                            To : {{ $employee->schedule ? $employee->schedule->out_time : 'NULL' }}
                                            {{-- {{$employee->schedule}} --}}
                                        </td>
                                        <td>Null</td>
                                        {{-- <td>{{$employee->user->dob}}</td> --}}
                                        <td>
                                            @php
                                                $totalWorkedTime = 0;
                                            @endphp
                                            @foreach ($employee->attendance as $attendance)
                                                @php
                                                    $totalWorkedTime = $totalWorkedTime + $attendance->workHour;
                                                @endphp
                                            @endforeach
                                            {{ $totalWorkedTime }} Hour
                                        </td>
                                        <td>RS.
                                            @php
                                                echo number_format($employee->per_hour_salary, 2);
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $totalSalary = 0;
                                            @endphp
                                            @foreach ($employee->attendance as $attendance)
                                                @php
                                                    $totalSalary = $totalSalary + $attendance->salary;
                                                @endphp
                                            @endforeach

                                            @php
                                                echo "RS. ".number_format($totalSalary,1). " Only"
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('salary.payment', $employee->id) }}">
                                                        Pay Salary</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- multiple select row Datatable End -->

            </div>

        </div>
    </div>
@endsection
