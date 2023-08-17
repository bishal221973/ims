@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Attendance
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p p-3" style="height: 60vh;overflow:scroll">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="text-uppercase">Attendance History</h4>
                                </div>
                                <div>
                                    @php
                                        $employee = App\Models\Employee::where('id', Auth()->user()->employee->id)->first();
                                    @endphp
                                    <b class="text-uppercase">Shift</b> : From
                                    {{ $employee->schedule ? $employee->schedule->in_time : 'NULL' }} -To
                                    {{ $employee->schedule ? $employee->schedule->out_time : 'NULL' }}
                                </div>
                            </div>
                            <div class="profile-timeline">
                                <div class="profile-timeline-list">
                                    <ul>
                                        @foreach ($attendances as $attendance)
                                            <li>
                                                <div class="date">{{ $attendance->date }}</div>
                                                <div class="task-name">
                                                    @if ($attendance->attendance == 'P')
                                                        Present
                                                    @endif
                                                </div>
                                                <p>
                                                    In Time
                                                    <span class="task-time">{{ $attendance->inTime }}</span>
                                                    <span class="border-right ml-3 border-secondary mr-3"></span>

                                                    @if ($attendance->outTime)
                                                        Out Time
                                                        <span class="task-time">{{ $attendance->outTime }}</span>
                                                        <span class="border-right ml-3 border-secondary mr-3"></span>

                                                        Worked Hour
                                                        <span class="task-time">{{ $attendance->workHour }} Hour</span>
                                                    @endif
                                                </p>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-box height-100-p col-12 p-3">
                            <div class="d-flex">
                                {{-- {{$attendance}} --}}
                                <form action="{{ route('attendance.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="year" id="year">
                                    <input type="hidden" name="month" id="month">
                                    <input type="hidden" name="day" id="day">
                                    <input type="submit" class="btn btn-success " value="In" />
                                </form>
                                @if ($attendance)
                                    <a href="{{ route('attendance.update', $attendance->id) }}"
                                        class="btn btn-warning ml-3">Out</a>
                                @else
                                    <a href="#"
                                        class="btn btn-warning ml-3">Out</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('myscripts')
    <script>
        $("#year").val(NepaliFunctions.GetCurrentBsDate().year);
        $("#month").val(NepaliFunctions.GetCurrentBsDate().month);
        $("#day").val(NepaliFunctions.GetCurrentBsDate().day);
    </script>
@endpush
