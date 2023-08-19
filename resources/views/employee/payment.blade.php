@extends('layouts.app')
@section('title','Salary-Payment')
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
                                        Salary Payment
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
                        <div class="card mb-30">

                            <div class="p-3">
                                {{-- multiple-select-row --}}
                                <h4 class="text-center">{{ $employee->user->name }}</h4>
                                <label class="col-12 text-center">{{ $employee->user->email }}</label>
                                <label class="col-12 text-center">
                                    @foreach ($employee->user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </label>

                                <label class="text-uppercase font-weight-bold mt-3">shift</label>
                                <div class="d-flex justify-content-between">
                                    <label>From : {{ $employee->schedule ? $employee->schedule->in_time : 'Null' }}</label>
                                    <label>To : {{ $employee->schedule ? $employee->schedule->out_time : 'Null' }}</label>
                                </div>

                                <h5 class="mt-3">Attendance Records</h5>
                                <div style="height: 35vh;overflow-y:scroll">
                                    <div class="profile-timeline">
                                        <ul>
                                            @php
                                                $totalWorkedHour = 0;
                                                $totalSalary = 0;
                                            @endphp
                                            @foreach ($employee->attendance as $item)
                                                @php
                                                    $totalWorkedHour = $totalWorkedHour + $item->workHour;
                                                    $totalSalary = $totalSalary + $item->salary;
                                                @endphp
                                                <li class="mb-3">
                                                    @if ($item->attendance == 'P')
                                                        <div>
                                                            <label class="font-weight-bold"><i
                                                                    class="fa-solid fa-circle mr-3"></i>{{ $item->date }}</label>
                                                            (Present)
                                                            <br>
                                                            {{-- <label class="font-weight-bold ml-4 pl-2 pr-3 border-right border-secondary ">Present</label> --}}
                                                            <label class="pl-2 pr-3 border-right border-secondary "><span
                                                                    class="font-weight-bold">In-Time :</span>
                                                                {{ $item->inTime }}</label>
                                                            <label class="pl-2 pr-3 border-right border-secondary "><span
                                                                    class="font-weight-bold">Out-Time :</span>
                                                                {{ $item->outTime }}</label>
                                                            <label class="pl-2 pr-3"><span class="font-weight-bold">Worked
                                                                    Hour:</span> {{ $item->workHour }} Hour</label>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <label>
                                        <span class="font-weight-bold">Total Worked Time</span> <br>
                                        {{ $totalWorkedHour }} Hour
                                    </label>
                                    <label>
                                        <span class="font-weight-bold">Total Salary</span> <br>
                                        @php
                                            echo 'RS. ' . number_format($totalSalary, 1) . ' /-';
                                        @endphp
                                    </label>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('salary.pay') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <input type="hidden" value="{{ $employee->id }}" name="employee_id"
                                                    id="">
                                                <input type="hidden" value="{{ $totalSalary }}" name="tobePay"
                                                    id="">
                                                    @php
                                                        $val=number_format($totalSalary,1);
                                                    @endphp
                                                <input type="text" class="form-control" name="salary"
                                                    placeholder="Salary" value="{{$val}}" readonly>
                                            </div>
                                            <div class="col-xl-2">
                                                <input type="submit" class="btn btn-info col-12" value="Pay"
                                                    name="" id="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card mb-30">
                            <table class="table hover ">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Payment Date</th>
                                        <th>From/To</th>
                                        <th>Amount</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> {{ $payment->payment_date }} </td>
                                            <td> From :{{ $payment->payment_from ? $payment->payment_from : 'Undefined' }}
                                                <br>
                                                To :{{ $payment->payment_to ? $payment->payment_to : 'Undefined' }}
                                            </td>
                                            <td>RS. {{$payment->paying_amount}} /-</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
