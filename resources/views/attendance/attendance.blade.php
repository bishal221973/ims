@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="mt-5">
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

                    @can('list_attendance')
                        <div class="col-xl-12">
                            <div class="card-box mb-30" style="overflow-x:scroll">
                                <div class="pd-20">
                                    <h4 class="font-weight-bold"> Attendance record of
                                        {{ App\Models\Organization::find(orgId())->organization_name }}</h4>
                                    <div class="d-flex">
                                        वर्ष : &nbsp; <label id="attendanceYear"></label> <span class="px-3"></span>
                                        महिना : <label id="attendanceMonth"></label>
                                    </div>
                                </div>
                                <div class="pb-20">
                                    {{-- multiple-select-row --}}
                                    <table class="table hover  nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-right border-bottom">Employee</th>
                                                <th class="border-right border-bottom">1</th>
                                                <th class="border-right border-bottom">2</th>
                                                <th class="border-right border-bottom">3</th>
                                                <th class="border-right border-bottom">4</th>
                                                <th class="border-right border-bottom">5</th>
                                                <th class="border-right border-bottom">6</th>
                                                <th class="border-right border-bottom">7</th>
                                                <th class="border-right border-bottom">8</th>
                                                <th class="border-right border-bottom">9</th>
                                                <th class="border-right border-bottom">10</th>
                                                <th class="border-right border-bottom">11</th>
                                                <th class="border-right border-bottom">12</th>
                                                <th class="border-right border-bottom">13</th>
                                                <th class="border-right border-bottom">14</th>
                                                <th class="border-right border-bottom">15</th>
                                                <th class="border-right border-bottom">16</th>
                                                <th class="border-right border-bottom">17</th>
                                                <th class="border-right border-bottom">18</th>
                                                <th class="border-right border-bottom">19</th>
                                                <th class="border-right border-bottom">20</th>
                                                <th class="border-right border-bottom">21</th>
                                                <th class="border-right border-bottom">22</th>
                                                <th class="border-right border-bottom">23</th>
                                                <th class="border-right border-bottom">24</th>
                                                <th class="border-right border-bottom">25</th>
                                                <th class="border-right border-bottom">26</th>
                                                <th class="border-right border-bottom">27</th>
                                                <th class="border-right border-bottom">28</th>
                                                <th class="border-right border-bottom">29</th>
                                                <th class="border-right border-bottom">30</th>
                                                <th class="border-right border-bottom">31</th>
                                                <th class="border-right border-bottom">32</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td class="border-right border-bottom">{{ $employee->user->name }}</td>
                                                    {{-- 1 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 1) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 2 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 2) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 3 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 3) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 4 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 4) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 5 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 5) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 6 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 6) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 7 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 7) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 8 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 8) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 9 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 9) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 10 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 10) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 11 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 11) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 12 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 12) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 13 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 13) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 14 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 14) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 15 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 15) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 16 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 16) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 17 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 17) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 18 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 18) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 19 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 19) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 20 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 20) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 21 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 21) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 22 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 22) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 23 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 23) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 24 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 24) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 25 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 25) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 26 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 26) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 27 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 27) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 28 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 28) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 29 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 29) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 30 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 30) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 31 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 31) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>

                                                    {{-- 32 --}}
                                                    <td class="border-right border-bottom">
                                                        @foreach ($employee->attendance as $item)
                                                            @php

                                                                if (date('j', strtotime($item->date)) == 32) {
                                                                    echo $item->attendance;
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="pd-20">
                                    <label class="font-weight-bold text-uppercase">Where</label>

                                    <ul>
                                        <li><span class="font-weight-bold">P</span> = Present</li>
                                        <li><span class="font-weight-bold">A</span> = Absent</li>
                                        <li><span class="font-weight-bold">L</span> = Leave</li>
                                        <li><span class="font-weight-bold">S</span> = Saturday</li>
                                        <li><span class="font-weight-bold">H</span> = Holyday</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

        </div>
    </div>
@endsection


@push('myscripts')
    <script>
        $("#attendanceYear").text(NepaliFunctions.GetCurrentBsDate().year);
        $("#attendanceMonth").text(NepaliFunctions.GetBsMonth(NepaliFunctions.GetCurrentBsDate().month));
        $("#day").val(NepaliFunctions.GetCurrentBsDate().day);
    </script>
@endpush
