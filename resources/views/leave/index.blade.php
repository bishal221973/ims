@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="mt-4 xs-pd-20-10">
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
                                        Leave
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
                            <form action="{{$leave->id ? route('leave.update',$leave->id) : route('leave.store') }}" method="POST">
                                @csrf
                                @isset($leave->id)
                                    @method('PUT')
                                @endisset
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Date From:</label>

                                            <input class="form-control" value="{{old('from',$leave->from)}}" name="from"
                                                type="text" id="nepali-datepicker"/>
                                            @error('from')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Date To:</label>

                                            <input class="form-control" value="{{old('to',$leave->to)}}" name="to"
                                                type="text" id="nepali-datepicker1"/>
                                            @error('to')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-xl-2">
                                        <div class="form-group">
                                            <label>Day :</label>

                                            <input class="form-control" readonly value="{{old('day',$leave->day)}}" name="day"
                                                type="text" />
                                            @error('day')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Reason :</label>

                                            <input class="form-control" value="{{old('reason',$leave->reason)}}" name="reason"
                                                type="text" />
                                            @error('reason')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="{{$leave->id ? 'Update' : 'Save'}}" class="btn btn-info">
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
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Day</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$leave->from}}</td>
                                                <td>{{$leave->to}}</td>
                                                <td>{{$leave->day}}</td>
                                                <td>{{$leave->reason}}</td>
                                                <td>{{$leave->status}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('leave.edit', $leave) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('leave.delete', $leave) }}"
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
