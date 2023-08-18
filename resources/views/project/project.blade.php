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
                                        project
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
                            <form action="{{ $project->id ? route('project.update', $project) : route('project.store') }}"
                                method="POST">
                                @csrf
                                @isset($project->id)
                                    @method('PUT')
                                @endisset
                                <div class="row">
                                    <div class="col-xl-2">
                                        <div class="form-group">
                                            <label>Branch Name *:</label>

                                            <select class="custom-select2 form-control" required name="branch_id"
                                                style="width: 100%; height: 38px">
                                                <option value="" selected disabled>Please select a branch</option>

                                                @if ($project->id)
                                                    @foreach ($branches as $branch)
                                                        <option
                                                            value="{{ $branch->id }}"{{ $branch->id == $project->branch_id ? 'selected' : '' }}>
                                                            {{ $branch->branch_name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}"
                                                            {{ $branch->branch_name == 'Main Branch' ? 'selected' : '' }}>
                                                            {{ $branch->branch_name }}</option>
                                                    @endforeach
                                                @endif


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
                                            <label>Project Name *:</label>

                                            <input type="text" name="name" required
                                                value="{{ old('name', $project->name) }}" class="form-control" />
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="form-group">
                                            <label>Start Date :</label>

                                            <input type="text" name="start_date"
                                                value="{{ old('start_date', $project->start_date) }}"
                                                class="form-control" id="nepali-datepicker" placeholder="Nepali YYYY-MM-DD"/>
                                            @error('start_date')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xl-2">
                                        <div class="form-group">
                                            <label>Status <small class="text-danger"><strong>*</strong></small></label>
                                            <select name="status" id="" class="custom-select2 form-control">
                                                <option value="Not Started"
                                                    {{ $project->status == 'Not Started' ? 'selected' : '' }}>Not Started
                                                </option>
                                                <option value="In Progress"
                                                    {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress
                                                </option>
                                                <option value="Completed"
                                                    {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="On Hold"
                                                    {{ $project->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                <option value="Canceled"
                                                    {{ $project->status == 'Canceled' ? 'selected' : '' }}>Canceled
                                                </option>
                                            </select>
                                            @error('unit')
                                                <label class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-xl-3">
                                        <div class="form-group">
                                            <label>Location *:</label>

                                            <input type="text" required name="location"
                                                value="{{ old('location', $project->location) }}" class="form-control" />
                                            @error('location')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="{{ $project->id ? 'Update' : 'Save' }}"
                                        class="btn btn-info">
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
                                            <th>Project</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $project->branch->branch_name }}</td>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ $project->start_date }}</td>
                                                <td>{{ $project->end_date ? $project->end_date : 'Not Defined' }}</td>
                                                <td>{{ $project->location }}</td>
                                                <td>{{ $project->status }}</td>


                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('project.edit', $project) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('project.delete', $project->id) }}"
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
